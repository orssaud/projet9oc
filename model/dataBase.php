<?php
namespace projet9\model;
use \PDO;
class  dataBase{

	private $db_name;
	private $db_user;
	private $db_pass;
	private $db_host;
	private $pdo;

	public function  __construct(){

		require('var/var.php');

		$this->db_name = $db_name;
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->db_host = $db_host;

		if($this->pdo === null){
			$pdo = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name.';charset=utf8', $this->db_user, $this->db_pass);
			$this->pdo = $pdo;
		}

	}



	public function query($statement){
		$req = $this->pdo->query($statement);
		$data = $req->fetchAll(PDO::FETCH_OBJ);
		return $data;
	}

	public function prepare($statement, $atributes, $one = false){

		$req = $this->pdo->prepare($statement);
    	$req->execute($atributes);
    	
    		if($one){
    			$data = $req->fetch(PDO::FETCH_OBJ);

    		}else{
    			$data = $req->fetchAll(PDO::FETCH_OBJ);
    		}
  

    	return $data;
	}


}