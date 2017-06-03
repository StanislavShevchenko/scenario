<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\Cars;
use app\models\ReservationCars;
use app\models\FormReservation;
use app\models\FormReservationFilter;
use app\assets\AppAsset;
use app\common\Noty;

class ReservationController extends Controller
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
							'calendar',
							'add',
						],
						'allow' => true,
						'roles' => ['puser'],
					],
				],
				'denyCallback' =>  function ($rule, $action) {
					Yii::$app->session->setFlash('error', 'Доступ запрещен');
					$this->redirect('/');
				}
			],
		];
	}
	
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$arRender   = [];	
		$searchText = trim(Yii::$app->request->get('q'));
		
		if(Yii::$app->request->get('Filter')){
			$arRender['arFilter'] = Yii::$app->request->get('Filter');
			
			//выберем данные для календаря и оработаем их -----------
			$FormReservationFilter = new FormReservationFilter();
			$FormReservationFilter->attributes = $arRender['arFilter'];
			if($FormReservationFilter->validate()){
				$arFilterResult = $FormReservationFilter->getListFilter();
			}
			//-------------------------------------------------------
		}
			
		//список машин----------------------------------------
		$queryCars  = Cars::find();		
		
		//Фильтр исключений-----------------------------------
		if(!empty($arFilterResult)){
			$queryCars->where(['not in', 'id', $arFilterResult]);
		}
		//----------------------------------------------------
		//поиск по названию-----------------------------------
		if(!empty($searchText)){
			$queryCars->andFilterWhere(['or',
				['like', 'number', $searchText],
				['like', 'brand',  $searchText],
				['like', 'model',  $searchText],
			]);
		}		
		//---------------------------------------------------
		$arRender['arCarList']  = $queryCars->asArray()->all(); 
		//---------------------------------------------------
		
		
		$this->getView()->registerJsFile('/js/reservation/script.js', ['depends' => [AppAsset::className()]]);
        return $this->render('reservation_list', $arRender);
    }
	
	public function actionCalendar($carID){
		$arRender = [];	
		$getMonth = trim(Yii::$app->request->get('month'));
		
		//выбор активного автомобиля-----------------------------
		$arCar = Cars::find()
				->where(['id' => (int)$carID])
				->asArray()
				->one();
		if(empty($arCar)){
			Noty::setNoty('error', 'машина не найдена', '/reservation/');			
		}
		$arRender['id'] = $carID;
		$arRender['arCar'] = $arCar;
		//-------------------------------------------------------
		
		//список автомобилей-------------------------------------
		$arRender['arCarList'] = Cars::find()->asArray()->all(); 
		//-------------------------------------------------------
		
		//выберем данные для календаря и оработаем их -----------
		$arRender['arListReserv'] = ReservationCars::getReservList($carID, $getMonth);
		//-------------------------------------------------------
		
		//определения месяца-------------------------------------
		
		$monthNow = date('n');        
        if(isset($getMonth) && (int)$getMonth > 0 && (int)$getMonth <= 12)
            $monthNow = $getMonth;		
		$arRender['arCalendar'] = $this->getCalendar($monthNow);
		//-------------------------------------------------------
		
		$this->getView()->registerJsFile('/js/reservation/script.js', ['depends' => [AppAsset::className()]]);
		return $this->render('calendar', $arRender);		
	}
	
	/**
	 * Создание бронирования, екшен не имеет шаблона
	 */
	public function actionAdd(){		
		if( Yii::$app->request->post('Reser')){
			
			$arReser = Yii::$app->request->post('Reser');
			
			$FormReservation = new FormReservation();
			$FormReservation->attributes = $arReser;
			if($FormReservation->validate()){
				if($FormReservation->save()){
					Noty::setNoty('success', 'Бронирование сохранено ', '/reservation/'.$arReser['car'].'?month='.$arReser['month']);	
				}
			}else{
				Noty::setNoty('error', 'Ошибка получения данных', '/reservation/');		
			}
		}
		$this->redirect('/reservation/');
	}
	
	protected function getCalendar($month = 0){
		$arMonth = array(
            1  => 'Январь',
            2  => 'Февраль',
            3  => 'Март',
            4  => 'Апрель',
            5  => 'Май',
            6  => 'Июнь',
            7  => 'Июль',
            8  => 'Август',
            9  => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь',
        );
        
        $monthNow = date('n');
        
        if((int)$month > 0 && (int)$month <= 12)
            $monthNow = (int)$month;

        $dayMonth  = date("t", strtotime('1.'.$monthNow.'.'.date('Y')));
		$dayW      = '';
		$arMontDay = array();
		$w         = 1;
		
		for($i=1; $i<=$dayMonth; $i++){
			$dayW = date("w", strtotime($i.'.'.$monthNow.'.'.date('Y')));
			$dayW = ($dayW == 0) ? 7 : $dayW;
			if($dayW != 1){
				$arMontDay[$w][$dayW] = $i;
			}else{
				if(empty($arMontDay)){
					$arMontDay[$w][$dayW] = $i;
				}else{
					$w++;
					$arMontDay[$w][$dayW] = $i;
				}
			}
		}
		return ['arMontDay' => $arMontDay, 'arMonth' => $arMonth, 'monthNow' => $monthNow];
	}

}
