<?php

namespace app\common;

use Yii;


class Noty 
{
	static function setNoty($type, $text, $urlRedirect = '', $status = 302){
		$session = Yii::$app->session;		
		if (!$session->isActive)
			$session->open();
		
		$session->set($type, $text);
		
		if(!empty($urlRedirect))
			header( 'Location: '.$urlRedirect , true, $status );
		exit();
	}
}
