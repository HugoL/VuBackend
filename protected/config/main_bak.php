<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Virtual Usatic Backend',
	'theme'=>'admin',
	'language'=>'es',
	'defaultController'=>'user/login',
// preloading 'log' component
	'preload'=>array('log'),
// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.user.models.*',
		'application.modules.user.components.*',
		'application.modules.rights.*',
		'application.modules.rights.components.*',
		),	
	'modules'=>array(
// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'',
// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			),
		'user'=>array(
			'tableUsers' => 'vu_users',
			'tableProfiles' => 'vu_profiles',
			'tableProfileFields' => 'vu_profiles_fields',
			),
		'rights'=>array(
			'install'=>true,
			),
		),
// application components
	'components'=>array(
		'user'=>array(
			'class'=>'RWebUser',
			'behaviors' => array(
				'application.vendor.schmunk42.web-user-behavior.WebUserBehavior'
				),
// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>array('/user/login'),
			),
		'authManager'=>array(
			'class'=>'RDbAuthManager',
			'connectionID'=>'db',
			'defaultRoles'=>array('Authenticated', 'Guest'),
			),
// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				),
			),
		'bootstrap'=>array(
			'class'=>'bootstrap.components.Bootstrap',
			),
/*'db'=>array(
'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
),*/
// uncomment the following to use a MySQL database
'db'=>array(
	'connectionString' => 'mysql:host=localhost;dbname=virtualUsaticInscritosBD',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => '523360',
	'charset' => 'utf8',
	'tablePrefix' => 'vu',
	),
'errorHandler'=>array(
// use 'site/error' action to display errors
	'errorAction'=>'site/error',
	),
'log' => array(
	'class' => 'CLogRouter',
	'routes' => array(
		array(
			'class' => 'CFileLogRoute',
			'levels' => 'trace, info, error, warning, vardump',
			),
// uncomment the following to show log messages on web pages
		array(
			'class' => 'CWebLogRoute',
			'enabled' => YII_DEBUG,
			'levels' => 'error, warning, trace, notice',
			'categories' => 'application',
			'showInFireBug' => true,
			),
		),
	),
),
// application-level parameters that can be accessed
// using Yii::app()->params['paramName']
'params'=>array(
// this is used in contact page
	'adminEmail'=>'hlanga@hlanga.es',
	'email'=>'siludermis@gmail.com',
	'debugContent'=>'',
	),
);