<?php

class autoloader{

	static function register(){

		spl_autoload_register(array(__CLASS__, 'autoload'));
	}


	static function autoload($className){

		$className = str_replace('projet9\\', '', $className);
		$className = str_replace('\\', '/', $className);
		
		require  $className . '.php';
	}



}