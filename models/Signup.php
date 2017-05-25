<?php

namespace app\models;

use yii\base\Model;

class Signup extends Model
{
    public $username;
    public $password;
	
    public function signup()
    {
        $user = new Users();
        $user->username = $this->username;
        $user->setPassword($this->password);
		$user->save();
        return false;
    }

}