<?php
$this->title = 'scenario';
?>
<?php if(!Yii::$app->user->isGuest):?>
	<h1><?=Yii::$app->user->identity->name?> <?=Yii::$app->user->identity->second_name?> (<?=Yii::$app->user->identity->position?>)</h1>
	<hr>
<?php endif;?>

