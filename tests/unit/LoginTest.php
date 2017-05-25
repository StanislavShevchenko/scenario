<?php
use app\models\Login;
use app\models\User;
use app\models\Wallets;

class LoginTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

	protected $POST = [
		'username' => 'LoginTest',
		'password' => 'LoginTest',
	];


	protected function _before()
    {
		
    }

    protected function _after()
    {
		Yii::$app->user->logout();
    }

	private function signUpOrLogin($POST){
		$mLogin = new Login();
		$mLogin->attributes = $this->POST;
		if($mLogin->validate()){
			$this->assertTrue(Yii::$app->user->login(User::getUserByName($mLogin->username)));
		}
		$this->assertGreaterThan(0, Yii::$app->user->id, 'Not auth:');
	}
	
	private function clearDB(){
		$mUser = User::findOne(['id' => Yii::$app->user->id]);
		$mWallets = Wallets::findOne(['user_id' => Yii::$app->user->id]);
		$mUser->delete();
		$mWallets->delete();
	}
	
	
    /**
	 * Будет создан и авторизован
	 */
    public function testSignUP()
    {
		$this->signUpOrLogin($this->POST);
    }

	/**
	 * Будет авторизован
	 */
    public function testLogin()
    {
		$this->signUpOrLogin($this->POST);
		$this->clearDB();		
    }
	
	
}