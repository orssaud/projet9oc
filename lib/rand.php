<?php
namespace projet9\lib;

class rand{

	public function randStr($lenght){
		
		$alphanumeric = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$a_lenght = strlen($alphanumeric) -1 ;

		
 
 		$key = '';
		for ($i = 0; $i < $lenght; $i++) {

			$key .= substr($alphanumeric, rand(0, $a_lenght), 1);

		}
		

		return $key;
	}
}