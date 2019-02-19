<?php 
namespace projet9\model;

class accountManager extends dataBase
{

	public function  accountName($account){

		$req = $this->prepare('SELECT Name FROM account WHERE Name = ?', [$account], true);

		return $req;
	}

	public function  accountEmail($email){

		$req = $this->prepare('SELECT Email FROM account WHERE Email = ?', [$email], true);

		return $req;
	}

	public function  accountAvatar($account){

		$req = $this->prepare('SELECT  Avatar FROM account WHERE Name = ?', [$account], true);

		return $req;
	}

	public function updateAvatar($account, $file){

		$req = $this->prepare('UPDATE account SET Avatar = ? WHERE Name = ?', [$file, $account]);

		return $req;

	}

	public function addAccount($account, $password, $email){

		 $req = $this->prepare('INSERT INTO account(Name, Password, Email, Avatar) VALUES(?, ?, ?, ?)', [$account, $password, $email, 'default.jpg']);

		 return $req;

	}

	public function connect($account){

		$req = $this->prepare('SELECT Password FROM account WHERE Name = ?', [$account], true);

		return $req;
	}



	public function modifyPassword($password, $email){
		$this->prepare('	UPDATE account
							SET Password = ?
							WHERE Email = ?', 
							[$password ,  $email]);

				

	}

	public function getAccountWithEmail($email){

		$req = $this->prepare('SELECT Name FROM account WHERE Email = ?', [$email], true);

		return $req;
	}
}