<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Login;
use app\models\User;
use yii\data\ActiveDataProvider;

class MainController extends Controller
{   

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$arRender = [];
		/*
		$dataProvider = new ActiveDataProvider([
			'query' => User::find()->joinWith('wallet'),
			'pagination' => [
				'pageSize' => 20,
			],
		]);
		User::find()->where(['id'=>Yii::$app->user->id])->With('wallet')->one(); 
		$arRender['dataProvider'] = $dataProvider;
		
		if (!Yii::$app->user->isGuest){			
			
			$FormTransactions = new FormTransactions();
			
			$dataRecipient = new ActiveDataProvider([
				'query' => Transactions::find()->where(['recipient'=>Yii::$app->user->id])->joinWith('senderUser'),
				'pagination' => [
					'pageSize' => 20,
				],
			]);
			$arRender['dataRecipient'] = $dataRecipient;	

			$dataSender = new ActiveDataProvider([
				'query' => Transactions::find()->where(['sender'=>Yii::$app->user->id])->joinWith('recipientUser'),
				'pagination' => [
					'pageSize' => 20,
				],
			]);
			$arRender['dataSender'] = $dataSender;	
			
			if( Yii::$app->request->post('FormTransactions')){
				$FormTransactions->attributes = Yii::$app->request->post('FormTransactions');
				if($FormTransactions->validate()){
					$FormTransactions->makeTransaction();
				}
			}
			$arRender['FormTransactions'] = $FormTransactions;
		}
		*/
        return $this->render('index', $arRender);
    }
	
	    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest){
            return $this->goHome();
        }

        $mLogin = new Login();

        if( Yii::$app->request->post('Login')){
            $mLogin->attributes = Yii::$app->request->post('Login');
            if($mLogin->validate()){
                Yii::$app->user->login(User::getUserByLogin($mLogin->login));
                return $this->goHome();
            }
        }

        return $this->render('login', ['mLogin'=>$mLogin]);		
    }
	
	/**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
