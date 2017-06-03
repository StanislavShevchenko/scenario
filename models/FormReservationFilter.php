<?php

namespace app\models;

use yii;
use yii\base\Model;
use app\models\ReservationCars;

class FormReservationFilter extends Model
{
	const FILTER_STATUS_FREE        = 'free';
	const FILTER_STATUS_FREE_PLACES = 'free_places';
	const FILTER_STATUS_REPIAR      = 'repairs';
	
    public $sdate;
    public $edate;
	public $mest;
	public $status;
	
	
	
    public function rules()
    {
       return [
            [['status', 'sdate', 'edate', 'mest'], 'required'],
        ];
    }
	
	/**
	 * Вернейт список ид машин которые нужно исклчить из списка
	 * @return array
	 */
	public function getListFilter(){
		$arReturnIDCars = [];
		$start_date = strtotime($this->sdate);
		$end_date   = strtotime($this->edate);
		$obReserv   = ReservationCars::find()->andFilterWhere(['and',
						['>=', 'sdate_i',  $start_date],
						['<=', 'sdate_i',  $end_date],
					]);
		switch ($this->status){
			case self::FILTER_STATUS_FREE:{
				$arTemp = $obReserv->asArray()->all();
				foreach ($arTemp as $key => $value) {
					$arReturnIDCars[$value['car']] = $value['car'];
				}
				break;
			}
			case self::FILTER_STATUS_FREE_PLACES:{
				$arTemp = $obReserv->with('cars')->asArray()->all();
				foreach ($arTemp as $key => $value) {
					if($value['mest'] >= $value['cars']['seats']){
						$arReturnIDCars[$value['car']] = $value['car'];
					}				
				}
				break;
			}
			case self::FILTER_STATUS_REPIAR:{
				$arTemp = $obReserv->andFilterWhere(['and', ['=', 'status', self::FILTER_STATUS_REPIAR]])->asArray()->all();
				foreach ($arTemp as $key => $value) {
					$arReturnIDCars[$value['car']] = $value['car'];
		
				}
				break;
			}
		}
		
		return $arReturnIDCars;
	}
	
}