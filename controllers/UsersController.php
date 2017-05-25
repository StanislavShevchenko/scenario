<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
//use app\models\Login;
//use app\models\User;
use yii\data\ActiveDataProvider;

class ReservationController extends Controller
{   

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$arRender = [];	
        return $this->render('reservation_list', $arRender);
    }

}
