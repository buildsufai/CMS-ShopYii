<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'MLM Shop',
	'language' => 'ru',
    'theme' => 'nahrin',

	// path aliases
	'aliases' => array(
		'ext' => 'application.extensions',
		'bootstrap' => 'ext.bootstrap',
		'backend' => 'application.views.backend',
	),
	
	// preloading 'log' component
	'preload'=>array('log','config'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.modules.*',
        'application.modules.news.models.*',
		'application.components.*',
        'application.components.behaviors.*',
        'application.components.helpers.*',
        'application.components.portlets.*',
		'ext.imperavi-redactor-widget.*',
	),

	'modules'=>array(
		'contacts',
        'mainpage',
        'promokit',
        'fastorder',
		'page' => array(
			'duration' => 0,
			'dependency' => new CDbCacheDependency('SELECT MAX(date_update) FROM {{pages}}'),
		),
		'news' => array(
			'duration' => 0,
			'dependency' => new CDbCacheDependency('SELECT MAX(date_update) FROM {{news}}'),
		),
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'yii',
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array(
                'bootstrap.gii',
            ),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
            'class' => 'WebUser',
			'allowAutoLogin'=>true,
			'loginUrl'=>array('/auth'),
		),
        'authManager' => array(
            // Будем использовать свой менеджер авторизации
            'class' => 'PhpAuthManager',
            // Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
            'defaultRoles' => array('guest'),
        ),
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'urlSuffix' => '.html',
			'rules' => array(
                '/' => 'mainpage/default/index',
				'backend' => 'backend/index',
				'contacts' => 'contacts/default/index',
                'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',

                // Modules
                '<module:(page|news)>/index' => '<module>/default/index',
                '<module:(page|news)>/<slug:[a-zA-Z-]*>' => '<module>/default/view',

                // Default rules
                //'<controller:\w+>/<slug:[a-zA-Z-]*>' => '<controller>/view',
                //'<controller:\w+>/<action:\w+>/<slug:[a-zA-Z-]*>' => '<controller>/<action>',
                //'<controller:\w+>/<action:\w+>' => '<controller>/<action>',

			),
		),

        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),

        'session' => array (
            'autoStart' => true,
            'cookieMode' => 'allow'
        ),

		'config'=>array(
			'class' => 'DConfig',
			'cache' => 1,
			'dependency' => new CDbCacheDependency('SELECT MAX(date_update) FROM {{configs}}'),
		),

        /*
		'cache' => array(
            'class' => 'system.caching.CMemCache',
            'servers' => array(
				array('host' => '127.0.0.1', 'port' => 11211, 'weight' => 100)
            ),
        ),
        */

        'cache' => array(
            'class' => 'CDummyCache',
        ),

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=mlmshop.zu',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'mlmshop_',

            'enableProfiling' => false,
            'enableParamLogging' => false,
		),

		'errorHandler'=>array(
			// use 'error/error' action to display errors
			'errorAction'=>'error/index',
		),
		
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
                array(
                    'class'=>'ext.db_profiler.DbProfileLogRoute',
                    'countLimit' => 1, // How many times the same query should be executed to be considered inefficient
                    'slowQueryMin' => 0.01, // Minimum time for the query to be slow
                ),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
        // Директории загрузки
        'uploads' => array(
            'images' => 'images',
            'files'  => 'files'
        ),
        // Выводить когда пусто
        'empty' => array(
            'image' => '/themes/nahrin/images/noimage.png',
        ),
        //Количество элементов на странице
        'countOnPage' => 30
	),
);