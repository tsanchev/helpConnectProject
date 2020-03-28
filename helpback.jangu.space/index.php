<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');


$dir = '/../helpconnect';

require(__DIR__ . $dir . '/vendor/autoload.php');
require(__DIR__ . $dir . '/vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . $dir . '/common/config/bootstrap.php');
require(__DIR__ . $dir . '/backend/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . $dir . '/common/config/main.php')
    ,require(__DIR__ . $dir . '/common/config/main-local.php')
    ,require(__DIR__ . $dir . '/backend/config/main.php')
    ,require(__DIR__ . $dir . '/backend/config/main-local.php')
);

(new yii\web\Application($config))->run();
