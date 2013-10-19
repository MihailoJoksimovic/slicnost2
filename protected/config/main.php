<?php

$dbConnection = require('db_connection.php');

return array(
    'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name' => 'Slicnost',
    'preload' => array('log'),
    'homeUrl' => array('/front'),

    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.components.wrappers.*',
        'application.validators.*',
    ),

    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '111',
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
                'application.gii',
            ),
        ),
    ),

    'components' => array(
        'user' => array(
            'class' => 'WebUser',
            'allowAutoLogin' => true,
            'loginUrl' => array('/user/login'),
            'autoRenewCookie' => true,
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '' => 'front',
            ),
            'showScriptName' => true,
            'useStrictParsing' => false,
        ),
        'db' => $dbConnection,
        'errorHandler' => array(
            'class' => 'application.components.wrappers.ErrorHandler',
            'errorAction' => 'front/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                array(
                    'class' => 'CWebLogRoute',
                    'filter' => array(
                        'class' => 'CLogFilter',
                    ),
                ),
                array(
                    'class' => 'CProfileLogRoute',
                    'report' => 'callstack',
                ),
            ),
        )
    )
);
