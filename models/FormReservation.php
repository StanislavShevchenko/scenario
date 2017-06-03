<?php

namespace app\models;

use yii;
use yii\base\Model;
use app\models\ReservationCars;

class FormReservation extends Model
{
    public $car;
    public $sdate;
    public $edate;
    public $time;
	public $mest;
	public $month;
	public $status;
	
    public function rules()
    {
        return [
            [['car', 'sdate', 'edate', 'time', 'mest', 'month'], 'required'],
			[['car', 'mest', 'month'], 'integer'],
			[['status'], 'string'],
        ];
    }
	
	public function save(){
		$this->attributes['sdate_i'] = strtotime($this->attributes['sdate']);
		$this->attributes['edate_i'] = strtotime($this->attributes['edate']);
		$onReserv = new ReservationCars();
		$onReserv->car     = $this->attributes['car'];
		$onReserv->mest    = $this->attributes['mest'];
		$onReserv->month   = $this->attributes['month'];
		$onReserv->time    = $this->attributes['time'];
		$onReserv->sdate   = $this->attributes['sdate'];
		$onReserv->edate   = $this->attributes['edate'];
		$onReserv->sdate_i = strtotime($this->attributes['sdate']);
		$onReserv->edate_i = strtotime($this->attributes['edate']);
		$onReserv->formulr = 0; //временно 
		$onReserv->status  = (!empty($this->attributes['status'])) ? $this->attributes['status'] : ReservationCars::STATUS_TEMP;
		$onReserv->user    = Yii::$app->user->id;
		$onReserv->created = time();	
		return $onReserv->save();
	}
	
}