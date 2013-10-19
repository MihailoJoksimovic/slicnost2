<?php

Yii::setPathOfAlias('wrappers', dirname(__FILE__) . '/../components/wrappers');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Slicnost',
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.components.wrappers.*',
        'application.validators.*',
        'application.modules.page.models.*',
    ),
    'components' => array(
        'db' => require_once 'db_connection.php',
    ),
    'commandMap' => array(
        'migrate' => array(
            'class' => 'application.commands.IMigrateCommand',
            'templateFile' => 'application.migrations._template',
        ),
        'message' => 'application.commands.IMessageCommand',
    ),
);
