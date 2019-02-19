<?php 

namespace projet9\controller;
use \Exception;

class sessionController{


	public function newAccount($email, $account, $password, $password_verify){

		
		$accountManager = new \projet9\model\accountManager();

		if (filter_var($email, FILTER_VALIDATE_EMAIL)){
			
			$req = $accountManager->accountEmail($email);
			
			if (isset($req->Email ) && $req->Email == $email){
				$errors[] = "Cet email est déjà utilisé pour un autre compte.";
			}
		}else{
			$errors[] = "L'email n'est pas valide.";
		}

		if(preg_match('/^[a-zA-Z0-9]+$/', $account)){
			
			$req = $accountManager->accountName($account);

			if (strlen($account) >= 4 && strlen($account) <= 25){
				if (isset($req->Name ) && $req->Name == $account){
					$errors[] = "Ce compte existe déjà.";
				}
			}else{
				$errors[] = "Le nom de compte doit eêre compris entre 4 et 25 caractères.";
			}
			
			
		}else{
			$errors[] = "Le nom de compte doit être alphanumérique.";
		}

		if ($password === $password_verify){
			if (strlen($password) < 8){
				$errors[] = "Le mot de passe doit contenir au moins 8 caractères.";

			}
							

		}else{
			$errors[] = "Les mots de passe doivent être identiques.";
		}


		if(empty($errors)){
			$successes[] = "Félicitation votre compte vient d'être créé !";
			
				$password = password_hash($password, PASSWORD_BCRYPT);
				$req = $accountManager->addAccount($account, $password, $email);
					
				$this->createSession($account,$password);
				


				$nav = new \projet9\controller\navController();
				$nav->playHome(1, $successes);
		}else{
			require('view/signupView.php');
		}
		
	}

	private function createSession($account, $password){
		$_SESSION['account'] = $account;
		
		$accountManager = new \projet9\model\accountManager();
		$_SESSION['avatar'] = $accountManager->accountAvatar($_SESSION['account'])->Avatar;

	}

	public function connect($account, $password)
	{
		
		$accountManager = new \projet9\model\accountManager();
		$req = $accountManager->connect($account);

		

	    if($req !== false && password_verify($password, $req->Password)) {
	        
	        $this->createSession($account,$req->Password);
	       

	        $nav = new \projet9\controller\navController();
	        $nav->playHome(1);
	    }
	    else{
	     	$errors[] = "Mauvais nom de compte ou mot de passe.";
	        require('view/loginView.php');
	    }
	}

	public function destroySession()
	{
		$_SESSION = array();
		session_destroy();

		$nav = new \projet9\controller\navController();
		$nav->home();
	}

	public function avatarUpdate(){
				

				$img = $_FILES["file"]["tmp_name"];
				

					if ($_FILES["file"]["type"] == 'image/jpeg'){

						$imgJpg = imageCreateFromJpeg($img);
						$this->saveAvatar($imgJpg, imagesx($imgJpg), imagesy($imgJpg));

					}else if ($_FILES["file"]["type"] == 'image/png'){
						
						$imgPng = imageCreateFromPng($img);
						$this->saveAvatar($imgPng, imagesx($imgPng), imagesy($imgPng));
						
					}else{

						throw new Exception('format d\'image non valide');
					}

				
				
				
				
	}

	private function saveAvatar($img, $x, $y){
	
		
	
			//create new image
			$newImg = imagecreatetruecolor ( 200 , 200 );
			
			//add alpha 
			imagesavealpha($newImg, true);
    		$alpha = imagecolorallocatealpha($newImg, 0, 0, 0, 127);
   			imagefill($newImg, 0, 0, $alpha);

			$path = 'public/img/avatar/';
			$fileName =  $_SESSION['account']. time() . '.png';
			imagecopyresampled ( $newImg , $img , 0, 0 , 0 , 0, 200 , 200 , $x, $y );
			imagepng($newImg, $path . $fileName);
			

			$accountManager = new \projet9\model\accountManager();


			$oldAvatar = $accountManager->accountAvatar($_SESSION['account'])->Avatar;

			if ($oldAvatar != 'default.jpg'){
				unlink($path . $oldAvatar);
			}
			
		


			$accountManager->updateAvatar($_SESSION['account'], $fileName );
			

			$_SESSION['avatar'] = $accountManager->accountAvatar($_SESSION['account'])->Avatar;
			
					
			header('Location: index.php?action=author&name=' . $_SESSION['account']);

		
	}

}

