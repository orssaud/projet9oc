<?php

namespace projet9\controller;

class ajaxController {

	
	public function emailCheck($email){

		$email = urldecode ($email);
		$status = false;
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL)){ // verify if this email have a email format 
			$accountManager = new \projet9\model\accountManager();
			$req = $accountManager->accountEmail($email);
			
			if (!(isset($req->Email ) && $req->Email == $email)){

				$status = true;

			}
		}
		
		$result = array('id' => 'email',
						'status' => $status);

		echo json_encode($result);


	}

	public function accountCheck($account){
		
		$account = urldecode ($account);
		$status = false;
		
			$accountManager = new \projet9\model\accountManager();
			$req = $accountManager->accountName($account);
			

			if (!(isset($req->Name ) && $req->Name == $account)){

				$status = true;

			}
		
			$result = array('id' => 'account',
						'status' => $status);

			echo json_encode($result);


	}
	

}