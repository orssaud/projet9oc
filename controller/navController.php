<?php

namespace projet9\controller;

class navController {

	
	public function home(){

		
		require('view/homeView.php');
	}
	
	public function playHome($p=1, $successes = null){
		

		$lvlPerPage = 5;
		$lvlManager = new \projet9\model\lvlManager();
		
		
		$max = $lvlManager->maxLvl();

		$maxPage = ceil($max/$lvlPerPage);

		if ($p > $maxPage){
				$p = $maxPage;
		}


		$lvls = $lvlManager->showLvls($p, $lvlPerPage);

		$accountManager = new \projet9\model\accountManager();

		for ($i = 0; $i < count($lvls); $i++) {

		      $lvls[$i]->{"avatar"} = $accountManager->accountAvatar($lvls[$i]->author)->Avatar;
		   
		}

		require('view/playHomeView.php');
	}
	
	public function play($id){
		
		$lvlManager = new \projet9\model\lvlManager();
		$lvl = $lvlManager->getLvl($id);

		require('view/playView.php');
	}
	
	public function login(){
		require('view/loginView.php');
	}
	
	public function signup($errors = null){
		require('view/signupView.php');
	}
	
	public function create(){
		
		require('view/createView.php');
	}
	
	public function save($lvl){


		if(is_array($lvlDecode = json_decode($lvl))){


				$arrayToPng = new \projet9\lib\arrayToPng();
				$file = $arrayToPng->createPng($lvlDecode);



				$lvlManager = new \projet9\model\lvlManager();
				$lvlManager->addLvl($lvl, $_SESSION['account'], $file);

				
				header("Location: index.php?action=play");

		}else{
			$this->playHome(1);

		}
	
	}


	public function author($author, $p=1){

		$accountManager = new \projet9\model\accountManager();
		
		if (!empty($accountManager->accountName($author))){

			$authorAvatar = $accountManager->accountAvatar($author)->Avatar;
		

			$lvlPerPage = 5;
			$lvlManager = new \projet9\model\lvlManager();
			
			
			$max = $lvlManager->maxLvlAuthor($author);
			
			$maxPage = ceil($max/$lvlPerPage);

			if ($p > $maxPage){
				$p = $maxPage;
			}


			$lvls = $lvlManager->lvlByAuthor($p, $lvlPerPage, $author);

			require('view/authorView.php');


		}else{

			$this->playHome(1);
		}

		
	}

}


