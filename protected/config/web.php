<?php
$params = require(__DIR__ . '/params.php');
$config = array(
    'id' => 'bootstrap',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'front',
    'components' => array(
        'request' => array(
            'enableCsrfValidation' => true,
        ),
        'cache' => array(
            'class' => 'yii\caching\FileCache',
        ),
        'user' => array(
            'identityClass' => 'app\models\User',
        ),
        'errorHandler' => array(
            'errorAction' => 'error/error',
        ),
        'log' => array(
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => array(
                array(
                    'class' => 'yii\log\FileTarget',
                    'levels' => array('error', 'warning'),
                ),
            ),
        ),
        'db' => array(
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=slicnost_dev',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
    ),
    'params' => $params,
);

if (YII_ENV_DEV) {
    $config['preload'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
