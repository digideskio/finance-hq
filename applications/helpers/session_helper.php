<?php
/**
 * 
 */
class Session_helper 
{
	
	public static function get($name){
		return isset($_SESSION[$name]) ? $_SESSION[$name] : false ;
	}
	
	public static function set($key, $val){
		$_SESSION[$key] = $val;
	}
	
	public static function destroy(){
		session_destroy();
	}
}
