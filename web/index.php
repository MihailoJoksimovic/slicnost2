<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../protected/vendor/autoload.php');
require(__DIR__ . '/../protected/vendor/yiisoft/yii2/yii/Yii.php');
Yii::importNamespaces(require(__DIR__ . '/../protected/vendor/composer/autoload_namespaces.php'));

$config = require(__DIR__ . '/../protected/config/web.php');

$application = new yii\web\Application($config);
$application->run();
