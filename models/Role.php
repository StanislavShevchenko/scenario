<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "auth_assignment".
 *
 * @property string  $item_name
 * @property integer $user_id
 * @property integer $created_at
 * 
 */
class Role extends ActiveRecord
{
	const ROLE_USER  = 'user';
	const ROLE_ADMIN = 'admin';
	
	const PERM_PUSER  = 'puser';
	const PERM_PADMIN = 'padmin';
	
	
	protected $arRole = [
		'user',
		'admin'
	];
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
		return [
            [['item_name', 'user_id', 'created_at'], 'required'],
            [['item_name'], 'string'],
            [['user_id', 'created_at'], 'integer'],
        ];       
    }

	/**
	 * Дабавляем роли пользователей в систему RBAC
	 */
	static public function addRoleRBAC(){		
		$r = new \yii\rbac\DbManager();
		$r->init();
		$ro1 = $r->createRole("su",    "SU"); 
		$ro2 = $r->createRole("admin", "Администратор"); 
		$ro3 = $r->createRole("user",  "Пользователь"); 
		$r->add($ro1);
		$r->add($ro2);
		$r->add($ro3);
	}
	
	
	static public function setRoleUser($roleT, $user_id){		
		if($user_id<=0) return false;
		
		$new = new Role();
		if(!in_array($roleT, $new->arRole))
			$roleT = $new->ROLE_USER;		
		
		$new->deleteAll(['user_id' => $user_id]);
		
		
		$new->item_name  = $roleT;
		$new->user_id    = $user_id;
		$new->created_at = time();
		
		$new->save();
		
//		$role = new \yii\rbac\DbManager();
//		$role->init();
//		$userRole = $role->getRole($roleT);
//		if($userRole){
//			$role->assign($userRole, $user_id);
//		}
		return true;
	}
}
