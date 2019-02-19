<?php
namespace projet9\model;

class lvlManager extends dataBase {

	public function addLvl($array, $author, $url){
		
		 $this->prepare('INSERT INTO lvl(data, author, img) VALUES(?, ?, ?)', [$array, $author, $url]);
		 

	}

	public function showLvls($p, $lvlPerPage){
		
		$req = $this->query('SELECT id, img, author FROM lvl ORDER BY id DESC LIMIT  '.(($p-1)*$lvlPerPage).' , '.$lvlPerPage);
	
		return $req;
	}

	public function lvlByAuthor($p, $lvlPerPage, $author){
		
		$req = $this->prepare('SELECT id, img, author FROM lvl WHERE author = ? ORDER BY id DESC LIMIT  '.(($p-1)*$lvlPerPage).' , '.$lvlPerPage, [$author]);
		
		return $req;
	}

	public function maxLvl(){

		$req = $this->query('SELECT COUNT(id) AS max FROM lvl');
		
		return $req[0]->max;
	}

	public function maxLvlAuthor($author){

		$req = $this->prepare('SELECT COUNT(id) AS max FROM lvl WHERE author = ?', [$author], true);
		
		return $req->max;
	}

	public function getLvl($id){

			$lvl = $this->prepare('SELECT id, data, img FROM lvl WHERE id = ?', [$id], true);


			$lvl->data = $this->arrayToHtml($lvl->data);

			return $lvl;

	}

	private function arrayToHtml($array){
			$array = json_decode($array);
			$lvl ="";


			for($i = 0; $i < count($array); $i ++){
			
				for($i2 = 0; $i2 < count($array[$i]); $i2 ++){
						
						if ($array[$i][$i2] === 'W'){
							
							$lvl = $lvl . '<div class="wood grid-row-'.$i.' grid-col-'.$i2.' block item"></div>';

						}else if ($array[$i][$i2] === 'D'){
							
							$lvl = $lvl . '<div class="damage grid-row-'.$i.' grid-col-'.$i2.' block item"></div>';

						}else if ($array[$i][$i2] === 'S'){
							
							$lvl = $lvl . '<div class="start grid-row-'.$i.' grid-col-'.$i2.' item" id="start"></div>';

						}else if ($array[$i][$i2] === 'E'){
							
							$lvl = $lvl . '<div class="end grid-row-'.$i.' grid-col-'.$i2.' block item"></div>';

						}

				}

			}



			return $lvl;
	}
}