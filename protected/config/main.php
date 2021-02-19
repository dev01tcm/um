<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off") {
 	$protocol = "https://";
} else {
 	$protocol = "http://";
}

	$url = $protocol.$_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) ;

	$cf_url = $url;
	$cf_path =  $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER["PHP_SELF"]); 

	$cf_themes_url = $url . '/themes';
	$cf_themes_path = $cf_path . '/themes';

	$cf_name = 'um';
	$cf_fullname = 'User Management';

	$cf_ver = '1905';

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>$cf_fullname,
	'language' => 'en',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1234',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class' => 'CustomWebUser',
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
			'showScriptName'=>false,
		),
		
		// 'db'=>array(
		// 	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		// ),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=um_db',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),

		 // 'db'=>array(
		 // 	'connectionString' => 'mysql:host=172.20.91.85;dbname=um_db', 
		 // 	'emulatePrepare' => true,
		 // 	'username' => 'appum',
		 // 	'password' => 'APP@um',
		 // 	'charset' => 'utf8',
		 // ),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'request'=>array(
            'enableCookieValidation'=>true,
			'enableCsrfValidation'=>true,
			//'baseUrl' => 'http://www.example.com',
        ),

		'clientScript' => array(
			'scriptMap' => array(
				'jquery.js' => false,
				'jquery.min.js' => false,
			),
		),		
		
		'CommonFnc' => array(
			'class'=>'CommonFnc',
        ),	
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		'data_ctrl'=>array(	
		),
		'prg_ctrl'=>array(
  		    'domain' => $cf_url,
	        /*'indextitle' => $cf_name,*/
			'name'	=> $cf_name,
			'fullname'	=> $cf_fullname,
			'version'	=> $cf_ver,
			'fullnameversion'	=> $cf_fullname.' ('.$cf_ver.')',
			'pagetitle'	=> ' | '.$cf_name.' '.$cf_ver,
			'logo' => $cf_url . '/images/common/logo.png',
			'logo_sq' => $cf_url . '/images/common/logo_small.png',
			'favicon' => $cf_url . '/images/common/favicon.ico',
			'appleicon' => $cf_url . '/images/common/appleicon.png',
			'ldap' => array(
				'server' => '172.16.19.94',
				'port' => '389', 
				'bind_uid' => 'appssoum',		
				'bind_pwd' => 'appssoum',			
				'bind_dn' => 'uid=appssoum,cn=App,ou=internal,DC=ESSS,DC=SSO,DC=GO,DC=TH',			
				'filter_attr' => 'uid',
				'publiccode_attr' => 'ssopersoncitizenid',
				'arr_search_attr' => array('firstname'=>'ssofirstname','uid'=>'uid', 'lastname'=>'ssosurname', 'mail'=>'mail','dep_id'=>'ssobranchcode','userid'=>'uid','publiccode'=>'ssopersoncitizenid','sn'=>'sn','ssopersonclass'=>'ssopersonclass','initials'=>'initials','maildrop'=>'maildrop','ssopersonempdate'=>'ssopersonempdate','cn'=>'cn','quota'=>'quota'),
				'arr_basedn' => 'cn=Users,ou=internal,dc=ESSS,dc=SSO,dc=GO,dc=TH',			
				),
			'dboracle'=>array(
				'username' =>'appum',
				'password' =>'APP@um',
				'databasedpis'=>'DPIS',
				'databasedpisem'=>'DPISEMP1',
				'connectdatabase'=>'(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = 172.20.91.17)(PORT = 1521)) 
								(CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = DPIS) ))',
				'connectdatabaseem'=>'(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = 172.20.91.17)(PORT = 1521)) 
								(CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = DPISEMP1) ))',				
				),
			'ipservice'=>array(
				//'ipzonedev' =>'https://172.16.19.36',
				'ipzonedev' =>'http://localhost',
			),
				'username' =>'appum',
			'authCookieDuration' => 7,  //the duration of the user login cookie in days	
			'url' => array(
				'baseurl' => $cf_url, 
				'upload' => $cf_url . '/uploads',
				'media' => $cf_url . '/media/',
				'themes'=> $cf_themes_url . '/remark_base',
				'idplogout'=>'https://idpdev01.app.sso.go.th:9443/oidc/logout?id_token_hint=',
				'idplogoutparam'=>'&post_logout_redirect_uri='.$url.'/&state=state_2',
			),
			'path' => array(
				'basepath' => $cf_path, 				
				'upload' => $cf_path . '\uploads',										
				'media' => $cf_path . '\media', 
				'themes'=> $cf_themes_path . '\remark_base',
			),		
			'vendor' => array(	
			),	
			'pagination' => array(
				'default' => array ( 
					'pagesize' => '5',
					'maxbuttoncount' => '12',
					'maxitem' => '1000',									
				),
			),	 					
		),			 
			

	),
);