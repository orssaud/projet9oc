<?php 
namespace projet9\model;

class recoveryManager extends dataBase
{


	public function newRecovery($email, $key){

		$key = password_hash($key, PASSWORD_BCRYPT);

		$req = $this->prepare('SELECT email, date FROM recovery WHERE email = ?', [$email], true);


		if (isset($req->email)){ //one recovery link currently exist

			if ( time() - 300 > $req->date){ //update recovery link if 5 minutes past

				$this->prepare('	UPDATE recovery
									SET security_key = ?, date = UNIX_TIMESTAMP()
									WHERE email = ?', 
									[$key,   $email]);

				return true;

			}else{

				
				return false;
			}
		
		}else{ // no recovery link exist
			
			$req = $this->prepare('INSERT INTO recovery(email, security_key, date) VALUES(?, ?,  UNIX_TIMESTAMP())', [$email, $key]);

			return true;
		}

		
	}

	public function  accountInfo($email){

		$req = $this->prepare('SELECT email, security_key, date FROM recovery WHERE email = ?', [$email], true);

		return $req;
	}

	public function delRequest($email){
				$this->prepare('DELETE FROM recovery
								WHERE email = ?',
								 [$email]);
	}
}