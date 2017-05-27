<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
	<script src="/js/global.js"></script>
</head>

<body cz-shortcut-listen="true">
<?//Опустошим сообщения?>
	<script>
		var noty_error   = "<?=(!empty($_SESSION['error']) ? $_SESSION['error'] : '');?>";
		var noty_success = "<?=(!empty($_SESSION['success']) ? $_SESSION['success'] : '');?>";
		var noty_info    = "<?=(!empty($_SESSION['info']) ? $_SESSION['info'] : '');?>";
		var name_csrf    = "<?=Yii::$app->request->csrfParam;?>";
		var csrf         = "<?=Yii::$app->request->getCsrfToken();?>";
	</script>
<?php
	unset($_SESSION['info']);
	unset($_SESSION['success']);
	unset($_SESSION['error']);
?>

	<?php $this->beginBody() ?>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Jk</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Jesenik v0.1</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<?php
						$url = Yii::$app->request->pathInfo;
					?>
					<!-- <li class="active"><a href="#">Home</a></li> -->
<!--					<li><a href="#">Uzivatele</a></li>
					<li><a href="#">Pridat Uzivatele</a></li>
					<li><a href="#">Spravovat opravneni</a></li>
					<li><a href="#">Nastaveni</a></li>
					<li><a href="#">Ke schvaleni</a></li>
					<li><a href="#">Muj profil</a></li>
					<li><a href="#">Odhlasit</a></li>-->
					<li><a href="/reservation/" class="<?=(strripos($url, 'reservation/') === false)?'':'active_main_menu'?>"><i  class="fa fa-calendar-check-o  " aria-hidden="true"></i> Бронирования</a></li>
					<li><a href="/garage/" class="<?=(strripos($url, 'garage/') === false)?'':'active_main_menu'?>"><i  class="fa fa-car" aria-hidden="true"></i> Гараж</a></li>
					<li><a href="/users/" class="<?=(strripos($url, 'users/') === false)?'':'active_main_menu'?>"><i  class="fa fa-users " aria-hidden="true"></i> Пользователи</a></li>
				</ul>
				<ul class="nav navbar-nav menu_sign" >
					<li style="border-right: 1px solid;"><a><?=Yii::$app->user->identity->name?> <?=Yii::$app->user->identity->second_name?></a></li>
					<li>
						<?php if(Yii::$app->user->isGuest):?>
							<a href="/login" class="<?=(strripos($url, 'login') === false)?'':'active_main_menu'?>"><i  class="fa fa-sign-in " aria-hidden="true"></i> Войти</a>
						<?php else:?>	
							<a href="/logout"><i  class="fa fa-sign-out " aria-hidden="true"></i> Выйти</a>
						<?php endif;?>
					</li>
				</ul>
			</div>
		</div>
		<div class="container container_main">		
			<?= $content ?>
		</div>

		<footer class="footer">
			<div class="container">
				<p class="pull-left">&copy; Jesenik v0.1 <?= date('Y') ?></p>
			</div>
		</footer>
		
	<?php $this->endBody() ?>
	
</body>
</html>
<?php $this->endPage() ?>
