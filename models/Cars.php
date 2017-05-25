<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cars".
 *
 * @property integer $id
 * @property string $number
 * @property string $brand
 * @property string $model
 * @property string $fuel
 * @property integer $year
 * @property integer $liters
 * @property integer $seats
 * @property string $relay
 * @property string $color
 * @property string $rubber
 * @property integer $consumption
 * @property integer $kilometers
 * @property integer $user
 * @property integer $date_edit
 */
class Cars extends \yii\db\ActiveRecord
{
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cars';
    }
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'brand', 'model', 'fuel', 'seats'], 'required'],
            [['fuel', 'relay'], 'string'],
            [['year', 'liters', 'seats', 'consumption', 'kilometers'], 'integer'],
            [['number', 'brand', 'model', 'color', 'rubber'], 'string', 'max' => 50],
            [['number'], 'unique'],
        ];
    }
	
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'number' => 'Номер',
            'brand' => 'Бренд',
            'model' => 'Модель',
            'fuel' => 'вид топливо',
            'year' => 'год выпуска',
            'liters' => 'обьем двигателя',
            'seats' => 'посадочных мест',
            'relay' => 'привод',
            'color' => 'цвет',
            'rubber' => 'резина',
            'consumption' => 'расход',
            'kilometers' => 'пробег',
            'user' => 'кто создал/редактировал',
            'date_edit' => 'время последней редакции',
        ];
    }
}
