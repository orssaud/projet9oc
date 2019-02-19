<?php

namespace projet9\controller;

class recoveryController{

	
	
	public function password($errors = null){
		require('view/passwordForgotView.php');
	}
	
	public function passwordRecovery($email){

		if (filter_var($email, FILTER_VALIDATE_EMAIL)){ // verify if this email have a email format 
			$accountManager = new \projet9\model\accountManager();
			$req = $accountManager->accountEmail($email);
			
			if (isset($req->Email ) && $req->Email == $email){ // verify if this email is in the database
				$rnd = new \projet9\lib\rand();
				$key = $rnd->randStr(8);

				$recovery = new \projet9\model\recoveryManager();

					if ($recovery->newRecovery($email, $key)){ // create security key
						require('var/mail.php');
						mail($email , utf8_decode($objet), utf8_decode($mail) );
						$successes[] = 'Un email de récupération de mot de passe vous a été envoyé.';
					}else{
						
						$successes[] = 'Un email de récupération de mot de passe vous a déjà été envoyé il y a moins de 5 minutes.';
					}
				
				require('view/passwordForgotView.php');
				
			}else{
				$errors[] = "L'email n'est pas valide.";
				require('view/passwordForgotView.php');
			}
			


		}else{
			$errors[] = "L'email n'est pas valide.";
			require('view/passwordForgotView.php');
		}

	}

	public function recovery(){

		require('view/recoveryView.php');
	}



	public function newPassword($email, $key, $password, $confirmPassword){

		
			$recovery = new \projet9\model\recoveryManager();
			$req = $recovery->accountInfo($email);

			if($req){

				if ($req->email === $email ){
					
					if (!password_verify($key, $req->security_key)){
						
						$errors[] = "La clé n'est pas valide.";

					}
					if ($req->date + 86400 < time()){ // after 24h key is not valid any more
						$errors[] = "La clé n'est plus valide, demander une nouvelle clé <a href='index.php?action=password'>ici</a>.";
					}
				}else{
					$errors[] = "L'email n'est pas valide.";
				}


			}else{
				$errors[] = "Aucune demande de récupération de mot de passe n'a été effectué pour ce compte.";
			}
			


		if ($password === $confirmPassword){
			if (strlen($password) < 8){
				$errors[] = "Le mot de passe doit contenir au moins 8 caractères.";

			}
							

		}else{
			$errors[] = "Les mots de passe doivent être identiques.";
		}

		if (empty($errors)){
			$accountManager = new \projet9\model\accountManager();

			// hash password
			$password = password_hash($password, PASSWORD_BCRYPT);
			// modify password in database				
			$accountManager->modifyPassword($password, $email);
			// delete recovery request 				
			$recovery->delRequest($email);
			// find accound name with email				
			$account = $accountManager->getAccountWithEmail($email);

			$session = new \projet9\controller\sessionController();
			// create session 	
			$session->createSession($account->Name, $password);
			
			$nav = new \projet9\controller\navController();				
			$nav->playHome(1);
		}else{
			require('view/recoveryView.php');	
		}
	}

}

