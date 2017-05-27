<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\assets\AppAsset;

class UsersController extends Controller
{   

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$arRender = [];	
		$arRender['arUsersList'] = User::find()->asArray()->all();
		
		$this->getView()->registerJsFile('/js/users/script.js', ['depends' => [AppAsset::className()]]);
        return $this->render('users_list', $arRender);
    }

}
