<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
		'/plugins/daterangepicker/daterangepicker.css',
        'css/noty.css',
        'css/site.css',
		
    ];
    public $js = [
		'js/jquery.js',
		'js/bootstrap.min.js',
		'js/noty.min.js',
		'/plugins/daterangepicker/moment.js',
		'/plugins/daterangepicker/daterangepicker.js',
		'js/common.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
