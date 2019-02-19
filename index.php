<?php
session_start();


require('lib/autoloader.php');
autoloader::register();



try{

	if (isset($_GET['action'])) {
		if (isset($_SESSION['account'])){ //logged
			
			if ($_GET['action'] == 'logout'){
				$session = new \projet9\controller\sessionController();
				$session->destroySession();

			}else if ($_GET['action'] == 'create'){
				$nav = new \projet9\controller\navController();
				$nav->create();

			}else if ($_GET['action'] == 'save'){

				
				if (isset($_POST['lvl'])){
					$nav = new \projet9\controller\navController();
					$nav->save($_POST['lvl']);
				}else{
					$nav = new \projet9\controller\navController();
					$nav->playHome(1);
				}

			}else if ($_GET['action'] == 'play'){

				  if (isset($_GET['id']) && $_GET['id'] >= 0) {
				  	$nav = new \projet9\controller\navController();
				 	$nav->play($_GET['id']);

				 }else{

				 	if (isset($_GET['p']) && is_numeric($_GET['p']) && (intval($_GET['p']) == $_GET['p']) && $_GET['p'] > 0){
				 		
				 		if (isset($_GET['name'])){
				 			$nav = new \projet9\controller\navController();
							$nav->author($_GET['name'], $_GET['p']);

						}else{
							$nav = new \projet9\controller\navController();
							$nav->playHome($_GET['p']);
						}
				 	}else{

				 		$nav = new \projet9\controller\navController();
				 		$nav->playHome(1);
				 	}

				 }
				
			}else if ($_GET['action'] == 'sendAvatar'){
				$session = new \projet9\controller\sessionController();
				$session->avatarUpdate();
				

			}else if ($_GET['action'] == 'author'){

				if (isset($_GET['name'])){
					$nav = new \projet9\controller\navController();
					$nav->author($_GET['name']);

				}else{
					$nav = new \projet9\controller\navController();
					$nav->playHome(1);
				}

			}else{
				$nav = new \projet9\controller\navController();
				$nav->playHome(1);
			}

				
		}


		else{//not logged
				

			if ($_GET['action'] == 'play'){

				 if (isset($_GET['id']) && $_GET['id'] >= 0) {
				 	$nav = new \projet9\controller\navController();
				 	$nav->play($_GET['id']);

				 }else{

				 	if (isset($_GET['p']) && is_numeric($_GET['p']) && (intval($_GET['p']) == $_GET['p']) && $_GET['p'] > 0){
				 						 		
				 		if (isset($_GET['name'])){
				 			$nav = new \projet9\controller\navController();
							$nav->author($_GET['name'], $_GET['p']);

						}else{
							$nav = new \projet9\controller\navController();
							$nav->playHome($_GET['p']);
						}
				 	}else{

				 		$nav = new \projet9\controller\navController();
				 		$nav->playHome(1);
				 	}


				 }
				
			}else if ($_GET['action'] == 'create'){
				$nav = new \projet9\controller\navController();
				$nav->login();

			}else if ($_GET['action'] == 'login'){

				if (isset($_POST['password']) && isset($_POST['account'])){ 
					$session = new \projet9\controller\sessionController();
					$session->connect($_POST['account'], $_POST['password']);
				}
				else{
					$nav = new \projet9\controller\navController();
					$nav->login();
				}

			}else if ($_GET['action'] == 'signup'){
				$nav = new \projet9\controller\navController();
				$nav->signup();

			}else if ($_GET['action'] == 'newAccount'){

				if (isset($_POST['email']) && isset($_POST['password_verify']) && isset($_POST['password']) && isset($_POST['account'])){

					$session = new \projet9\controller\sessionController();
					$session->newAccount($_POST['email'], $_POST['account'], $_POST['password'], $_POST['password_verify']);

				}else{
					$nav = new \projet9\controller\navController();
					$nav->signup();

				}
				

			}else if ($_GET['action'] == 'password'){
				$recovery = new \projet9\controller\recoveryController();
				$recovery->password();

			}else if ($_GET['action'] == 'sendPassword'){
				
				if (isset($_POST['email'])){
					$recovery = new \projet9\controller\recoveryController();
					$recovery->passwordRecovery($_POST['email']);
				
				}else{
					$errors[] = "vous n'avez pas entrer d'email";
					$recovery = new \projet9\controller\recoveryController();
					$recovery->password($errors);


				}

			}else if ($_GET['action'] == 'recovery'){
				$recovery = new \projet9\controller\recoveryController();
				$recovery->recovery();

			}else if ($_GET['action'] == 'newPassword'){

				if (isset($_POST['email']) && isset($_POST['key']) && isset($_POST['password']) && isset($_POST['confirmPassword'])){
					$recovery = new \projet9\controller\recoveryController();
					$recovery->newPassword($_POST['email'], $_POST['key'], $_POST['password'], $_POST['confirmPassword']);
				}else{
					$recovery = new \projet9\controller\recoveryController();
					$recovery->recovery();
				}
				

			}else if ($_GET['action'] == 'ajax'){

				if (isset($_GET['email'])){

					$ajax = new \projet9\controller\ajaxController();
					$ajax->emailCheck($_GET['email']);

				}elseif (isset($_GET['account'])){

					$ajax = new \projet9\controller\ajaxController();
					$ajax->accountCheck($_GET['account']);
				}else{

					  throw new Exception('Aucune requette ajax valide.');

				}
				
			
					
					
				
			}else if ($_GET['action'] == 'author'){

				if (isset($_GET['name'])){
					$nav = new \projet9\controller\navController();
					$nav->author($_GET['name']);

				}else{
					$nav = new \projet9\controller\navController();
					$nav->playHome(1);
				}

			}else{
				$nav = new \projet9\controller\navController();
				$nav->home();
			}
		}
	}else{
		$nav = new \projet9\controller\navController();
		$nav->home();

	}

}
catch (Exception $e){

	require('view/errorView.php');
}