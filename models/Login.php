<?php

namespace app\models;

use app\models\Signup;

class Login extends Signup
{
	public function rules()
    {
        return [
            [['username','password'],'required'],
			['username','validateUser'],
        ];
    }
	
	public function validateUser($attribute, $params)
	{		
		if(!$this->hasErrors()){			
			if( !$user->validatePassword($this->password)){
				$this->addError('password', 'Пароль введен неверно');
			}
		}
	}
}