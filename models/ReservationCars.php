<?php

namespace app\models;

use Yii;

use app\models\Cars;
use app\models\User;

/**
 * This is the model class for table "reservation_cars".
 *
 * @property integer $id
 * @property integer $car
 * @property integer $mest
 * @property integer $month
 * @property string $time
 * @property string $sdate
 * @property string $edate
 * @property integer $formulr
 * @property integer $status
 * @property integer $user
 * @property string $created
 * @property string $sdate_i
 * @property string $edate_i
 */
class ReservationCars extends \yii\db\ActiveRecord
{
	
	const STATUS_TEMP    = 'temp';
	const STATUS_REPAIRS = 'repairs';

	
	/**
	 * Вернет Список заронировнных дат 
	 * @param type $idCar
	 */
	public static function getReservList($carID, $month){
		$arResult = [];
		$arTemp   = self::find()->where(['car'=>$carID, 'month' => $month])->with(['cars', 'users'])->asArray()->all();
		
		foreach ($arTemp as $key => $item){
			$arResult[(int)date('d', $item['sdate_i'])] = $item;
			if($item['sdate_i'] < $item['edate_i']){
				$time = $item['sdate_i'];
				while($time < $item['edate_i']){
					$time +=86400;
					$arResult[(int)date('d', $time)] = $item;
					$arResult[(int)date('d', $time)]['parent'] = (int)date('d', $item['sdate_i']);
				}
			}
		}
		
		return $arResult;
	}

	public function getCars()
	{
		return $this->hasOne(Cars::className(), ['id' => 'car']);
	}

	public function getUsers()
	{
		return $this->hasOne(User::className(), ['id' => 'user']);
	}

	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reservation_cars';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['car', 'mest', 'month', 'time', 'sdate', 'edate', 'formulr', 'user', 'created', 'sdate_i', 'edate_i'], 'required'],
            [['car', 'mest', 'month', 'formulr', 'user', 'created', 'sdate_i', 'edate_i'], 'integer'],
            [['time'], 'string', 'max' => 5],
            [['sdate', 'edate'], 'string', 'max' => 10],
            [['status'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car' => 'Car',
            'mest' => 'Mest',
            'month' => 'Month',
            'time' => 'Time',
            'sdate' => 'Sdate',
            'edate' => 'Edate',
            'formulr' => 'Formulr',
            'status' => 'Статус',
            'user' => 'User',
            'created' => 'Created',
            'sdate_i' => 'Sdate I',
            'edate_i' => 'Edate I',
        ];
    }
}
