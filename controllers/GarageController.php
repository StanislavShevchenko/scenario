<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Cars;
use app\assets\AppAsset;


class GarageController extends Controller
{   

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$arRender = [];			
		if(Yii::$app->request->post('Cars')){
			$post = Yii::$app->request->post('Cars');					
			$oCars = ($post['id']>0) ? Cars::findOne($post['id']): new Cars();
			if($oCars->load(Yii::$app->request->post())){
				if($oCars->save()){
					Yii::$app->session->setFlash('success', ($post['id']>0) ? 'Машина отредактирована': 'Машина добавленна');
					$this->redirect('/garage');
				}else{
					$arRender['errors'] = $oCars->getErrors();
					$arRender['active_modal_win'] = 'form_edit_car_modal'; // передаем ид активной модалки
					Yii::$app->session->setFlash('error', 'Ошибка добавления машины');
				}
			}else{
				$arRender['errors'] = $oCars->getErrors();
				$arRender['active_modal_win'] = 'form_edit_car_modal'; // передаем ид активной модалки
				Yii::$app->session->setFlash('error', 'Ошибка добавления машины');
			}
        }
		
		$searchText = trim(Yii::$app->request->get('q'));
		$queryCars =  Cars::find();
		
		if(!empty($searchText)){
			$queryCars->andFilterWhere(['or',
				['like', 'number', $searchText],
				['like', 'brand',  $searchText],
				['like', 'model',  $searchText],
				]);
		}
		
		$arRender['arCarList'] = $queryCars->asArray()->all(); 
		
	    $this->getView()->registerJsFile('/js/garage/script.js', ['depends' => [AppAsset::className()]]);
        return $this->render('index', $arRender);
    }
	
	public function actionAjax(){
		$action   = Yii::$app->request->get('action',   Yii::$app->request->post('action', 0));
		$dataType = Yii::$app->request->get('dataType', Yii::$app->request->post('dataType', 'JSON'));
		$view     = Yii::$app->request->get('view',     Yii::$app->request->post('view', 'ajax'));

		
		switch ($action){
			case 'getCar':{
				$id = Yii::$app->request->post('id');
				$arRender = Cars::find()->where(['id'=>$id])->asArray()->one();
				break;
			}
			case 'delCar':{				
				$id = Yii::$app->request->post('id');
				if($id > 0){
					$oCars = Cars::findOne($id);
					$oCars->delete();
					$arRender['OK'] = 'Машина удалена';
				}else{
					$arRender['ERROR'] = 'Машина не найдена';
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