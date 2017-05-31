<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $login *
 * @property string $password *
 * @property string $name *
 * @property string $second_name*
 * @property string $last_name*
 * @property string $email*
 * @property string $phone*
 * @property string $position*
 * @property string $mphone*
 * @property string $key*
 * @property string $rangs*
 * @property string $city*
 * @property string $street*
 * @property string $home*
 * @property string $zip*
 * @property string $country*
 * @property string $personal_num*
 * @property string $start_work*
 * @property string $end_work*
 * @property string $department*
 * @property string $second_rangs
 * @property integer $created*
 * @property integer $modified*
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
		return [
            [['login', 'password', 'name'], 'required'],
            [['department'], 'string'],
            [['login', 'password', 'name', 'second_name', 'last_name', 'email', 'phone', 'position'], 'string', 'max' => 250],
            [['mphone', 'key', 'rangs', 'home', 'zip', 'start_work', 'end_work', 'second_rangs'], 'string', 'max' => 50],
            [['city', 'street', 'country', 'personal_num'], 'string', 'max' => 100],
            [['login'], 'unique'],
			['password', 'setSha'],
        ];       
    }

	public function setSha($attribute, $params){
		$this->setPassword($this->password);
		return true;
	}
	
	
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'name' => 'Name',
            'second_name' => 'Second Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'position' => 'Position',
            'mphone' => 'Mphone',
            'key' => 'ключ',
            'rangs' => 'Звания',
            'city' => 'City',
            'street' => 'Street',
            'home' => 'Home',
            'zip' => 'Zip',
            'country' => 'Country',
            'personal_num' => 'персанальный номер',
            'start_work' => 'Start Work',
            'end_work' => 'End Work',
            'department' => 'Department',
            'second_rangs' => 'Second Rangs',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
	
	public function getRoles()
	{
		return $this->hasOne(Role::className(), ['user_id' => 'id']);
//		return $this->hasMany(Role::className(), ['user_id' => 'id']);

	}
	
	public function setPassword($password)
    {
        $this->password = sha1($password);
    }

    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }
	
	static public function getUserByLogin($login){
		if(empty($login)) return false;
		return self::find()->where(['login'=>$login])->one(); 
	}
	
	/**
	 * Дабавляем роли пользователей в систему RBAC
	 */
	static public function addRoleRBAC(){		
//		$r = new \yii\rbac\DbManager();
//		$r->init();
//		
//		$ro1 = $r->createRole("su",    "SU"); 
//		$ro2 = $r->createRole("admin", "Администратор"); 
//		$ro3 = $r->createRole("user",  "Пользователь"); 		
//		$r->add($ro1);
//		$r->add($ro2);
//		$r->add($ro3);
//		
//		$po1 = $r->createPermission('psu');
//		$po2 = $r->createPermission('padmin');
//		$po3 = $r->createPermission('puser');
// 		$r->add($po1);
//		$r->add($po2);
//		$r->add($po3);
//		
//		//правила для SU 
//		$r->addChild($ro1, $po1);
//		$r->addChild($ro1, $po2);
//		$r->addChild($ro1, $po3);
//		
//		//Правила для админа
//		$r->addChild($ro2, $po2);
//		$r->addChild($ro2, $po3);
//		
//		//правила для users
//		$r->addChild($ro3, $po3);
	}
	
//	static public function setRoleUser($roleT, $user_id){
//		
//		if($user_id<=0)return false;
//		
//		$role = new \yii\rbac\DbManager();
//		$role->init();
//		$userRole = $role->getRole($roleT);
//		if($userRole){
//			$role->assign($userRole, $user_id);
//		}
//		return true;
//	}
}
