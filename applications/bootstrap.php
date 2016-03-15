<?php

// Include BASE System
require_once APP_DIR.'functions.php';
require_once APP_DIR.'system/config.php';
require_once APP_DIR.'system/model.php';
require_once APP_DIR.'system/modelmongo.php';
require_once APP_DIR.'system/view.php';
require_once APP_DIR.'system/controller.php';

require_once APP_DIR.'libs/php-excel-reader/excel_reader2.php';
require_once APP_DIR.'libs/SpreadsheetReader.php';

function bootstrap(){
	global $config;
// dump($config['base_url']);
// dump($_SERVER['REQUEST_URI']);
	// Remove subfolder
	// $request_uri = trim(str_replace($config['base_url'],'',$_SERVER['REQUEST_URI']), '/');
    $request_uri = preg_replace("/^(\/finance\/)/", '', $_SERVER['REQUEST_URI']);

	// Default class and method name
	$controller = 'mainpage';
	$method = 'base';
// dump($request_uri);
	if( !empty($request_uri) ){
		$controller = $request_uri;

		if( strpos($request_uri, '/') > 0 ){

            $items = explode('/', $request_uri, 3);
// dump($items);
            $count = count($items);

            if( $count === 2 ){
                $controller = $items['0'];
                $method = $items['1'];
            }else if( $count === 3 ){
                $controller = $items['0'];
                $method = $items['1'];
                $params = $items['2'];
            }
		}
	}

	// explode params and add it into method
	if(!empty($params)){
		$params = explode('/', $params);
	}else{
		$params = array();
	}

	$path = APP_DIR.'controllers/'.$controller.'.php';

	// Check path
	if(file_exists($path) !== false){
		require_once $path;

	}else{
		require_once APP_DIR.'controllers/'.$config['error_controller'].'.php';
		$controller = 'Error';
		$method = 'base';
	}

	$controller_name = ucfirst($controller);

	if(class_exists($controller_name)){
		$obj = new $controller_name();
        // dump($method);
        if( !method_exists($obj, $method) ){
            redirect('error');
        }
		
		call_user_func_array(array($obj, $method), $params);
	}

}
