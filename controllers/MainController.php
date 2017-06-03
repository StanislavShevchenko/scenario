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
