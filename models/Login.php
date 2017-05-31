<?php

namespace app\models;
use yii\base\Model;

class Login extends Model
{
	public $login;
    public $password;
	
	public function rules()
    {
        return [
            [['login','password'],'required'],
			['login','validateUser'],
        ];
    }
	
	public function validateUser($attribute, $params)
	{		
		if(!$this->hasErrors()){
			$user = User::getUserByLogin($this->login); 
			if(!$user){
				$this->addError('login', 'Пользователь не найден');
			}else{
				if( !$user->validatePassword($this->password)){
					$this->addError('password', 'Пароль введен неверно');
				}
			}
		}
	}
}