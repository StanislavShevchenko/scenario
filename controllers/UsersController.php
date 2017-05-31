<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

use app\models\User;
use app\models\Role;
use app\assets\AppAsset;

class UsersController extends Controller
{   

	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => [
							'index',
							'ajax'
						],
						'allow' => true,
						'roles' => ['padmin'],
					],
				],
				'denyCallback' =>  function ($rule, $action) {
					Yii::$app->session->setFlash('error', 'Доступ запрещен');
					$this->redirect('/');
				}
			],
		];
	}
	
    public function actionIndex()
    {
		$arRender = [];		
	
		if(Yii::$app->request->post('User')){
			$post = Yii::$app->request->post('User');					
			$oUser = ($post['id']>1) ? User::findOne($post['id']): new User();
			if($oUser->load(Yii::$app->request->post())){
				if($oUser->save()){
					Yii::$app->session->setFlash('success', ($post['id']>0) ? 'Пользователь отредактирован': 'Пользователь добавлен');
					Role::setRoleUser($post['roles'], $oUser->getId());
					$this->redirect('/users');
				}else{
					$arRender['errors'] = $oUser->getErrors();
					$arRender['active_modal_win'] = 'form_edit_user_modal'; // передаем ид активной модалки
					Yii::$app->session->setFlash('error', 'Ошибка добавления пользователя');
				}
			}else{
				$arRender['errors'] = $oUser->getErrors();
				$arRender['active_modal_win'] = 'form_edit_user_modal'; // передаем ид активной модалки
				Yii::$app->session->setFlash('error', 'Ошибка добавления пользователя');
			}
        }
		
		$searchText = trim(Yii::$app->request->get('q'));
		$queryUsers = User::find();
		
		if(!empty($searchText)){
			$queryUsers->andFilterWhere(['or',
				['like', 'name', $searchText],
				['like', 'last_name',  $searchText],
				['like', 'second_name',  $searchText]]);
		}
		
		

		$arRender['arUsersList'] = $queryUsers->asArray()->with('roles')->all(); 	
		$this->getView()->registerJsFile('/js/users/script.js', ['depends' => [AppAsset::className()]]);
        return $this->render('users_list', $arRender);
    }
	
	public function actionAjax(){
		$action   = Yii::$app->request->get('action',   Yii::$app->request->post('action', 0));
		$dataType = Yii::$app->request->get('dataType', Yii::$app->request->post('dataType', 'JSON'));
		$view     = Yii::$app->request->get('view',     Yii::$app->request->post('view', 'ajax'));

		
		switch ($action){
			case 'getUser':{
				$id = Yii::$app->request->post('id');
				$arRender = User::find()->where(['id'=>$id])->with('roles')->asArray()->one();
				break;
			}
			case 'delUser':{				
				$id = Yii::$app->request->post('id');
				if($id > 1){
					$oCars = User::findOne($id);
					$oCars->delete();
					$arRender['OK'] = 'Пользователь удалена';
				}else{
					$arRender['ERROR'] = 'Пользователь не найдена';
				}
				break;
			}
			default :{
				die(' нет акшина');
				break;
			}
				
		}
		if($dataType == 'JSON')
			return json_encode($arRender, JSON_UNESCAPED_UNICODE);
		else
			return $this->render($view, $arRender);
	}

}
