<?php
use app\models\Login;
use app\models\FormTransactions;
use app\models\Wallets;
use app\models\Transactions;
use app\models\User;

class TransactionTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

	protected $POST = [
		'sender' =>[
			'username' => 'sender',
			'password' => 'sender',
		],
		'recipient' =>[
			'username' => 'recipient',
			'password' => 'recipient',
		],
		'summ' => 150		
	];


	protected function _before()
    {
		
    }

    protected function _after()
    {
		$this->clearDB();
	}

	private function signUpOrLogin($POST, $auth = false){
		$mLogin = new Login();
		$mLogin->attributes = $POST;
		$this->assertTrue($mLogin->validate());
		if($auth){
			$this->assertTrue(Yii::$app->user->login(User::getUserByName($mLogin->username)));
			$this->assertGreaterThan(0, Yii::$app->user->id, 'Not auth');
		}
	}
	
	private function clearDB(){
		$mUserSender = User::findOne(['username' => $this->POST['sender']['username']]);
		Wallets::findOne(['user_id' => $mUserSender->id])->delete();
		Transactions::findOne(['sender' => $mUserSender->id])->delete();
		$mUserSender->delete();
		
		$mUserRecipient = User::findOne(['username' => $this->POST['recipient']['username']]);
		Wallets::findOne(['user_id' => $mUserRecipient->id])->delete();		
		$mUserRecipient->delete();
	}
	
	private function comparisonAmountForUsername($username, $amount){
		$selfUser = User::find()->where(['username'=>$username])->With('wallet')->one(); 
		$selfWallet = $selfUser->wallet;
		return $selfWallet->amount == $amount;
	}
	
    /**
	 * Будет создан и авторизован
	 */
    public function testTransaction()
    {
		//регистрация получателя
		$this->signUpOrLogin($this->POST['recipient']);
		
		//регистрация и авторизация отправтителя		
		$this->signUpOrLogin($this->POST['sender'], true);
		
		//проводим транзакцию
		$mFormTransaction = new FormTransactions();
		$mFormTransaction->attributes = [
			'username' => $this->POST['recipient']['username'],
			'summ' => $this->POST['summ']
		];		
		$this->assertTrue($mFormTransaction->validate(), 'Транзакция не прошла валидацию');
		
		$mFormTransaction->makeTransaction();
		//***************************
		
		//проверка счетов
		$this->assertTrue($this->comparisonAmountForUsername($this->POST['sender']['username'], -150),   'bed summ sender');
		$this->assertTrue($this->comparisonAmountForUsername($this->POST['recipient']['username'], 150), 'bed summ recipient');

		
    }
	
}