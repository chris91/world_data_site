<?php

require_once 'PasswordHash.php';

class Security {

	protected static $_instance;

	/*parameters for connecting to the db*/
	private static $_db_host="localhost";
	private static $_db_user="root";
	private static $_db_password="geometry";
	private static $_db_name="mydb";

	private $_current_user;
/**
* The difference between $this and self is that $this referces to the current object
*(non static reference) and self refers to the current class(static reference)
*/	
	public static function instance() {
		if (is_null(self::$_instance)){
			self::$_instance = new Security();
		}
		return self::$_instance;
	}

	private function __construct(){
		//this is to start a new session to store informations 
		//for the user sessions
		//we use the $_SESSION['something'] 
		//to store informations
		//unset to clear the $_SESSION array
		//session_destroy to destroy completely the variable
		session_start();
	}

	public function signup($email, $password,$repeat_password){
		/*normalize email*/
		/*trim used to eliminate the white spaces from the begining and the end of the string*/
		$error_message=NULL;/*to be removed*/
		$email=strtolower(trim($email));
		$error_message=$this->_validate_form_values($email,$password,$repeat_password);
		if(is_null($error_message)){
			$error_message=$this->_create_user($email,$password);
		}
		return $error_message;
	}

	public function login($email,$password){//under testing
		$user =$this->_find_user_by_email($email);
		if(!is_null($user)){
			//if there is a user with this email then
			//check the password
			//create a hasher instance
			$hasher= $this->_get_hasher();
			if($hasher->CheckPassword($password,$user->password_hash)){
				//load to session array the id
				$_SESSION['user_id']=$user->id;
				$_SESSION['user_email']=$user->email;
				//regenerate the session id for security reasons
				session_regenerate_id();//security sooooooos
				return TRUE;
			}
		}
		// if there is no user with is email then return false
		return FALSE;
	}

	public function logout(){
		session_unset();
		session_destroy();
	}
	public function current_user(){
		if(is_null($this->_current_user)){
			if(isset($_SESSION['user_id'])){
				$this->_current_user=$this->_find_user_by_id($_SESSION['user_id']);
			}
		}
		return $this->_current_user;
	}

	public function require_login(){//under development
		if(is_null($this->current_user())){
			header('Location: index.php');
		}
	}


	private function _validate_form_values($email,$password,$repeat_password){
		$error_message=NULL;
		if(filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE){
			$error_message='Please enter a validate email';
		}
		else{
			if(strlen($password)<5){
				$error_message='Please enter a password at least 5 charachers long';
			}
			else{
				if($password!=$repeat_password){
					$error_message='Please repeat the password';
				}
				else{
					if(! is_null($this->_find_user_by_email($email))){//start from here
						$error_message='That email address is allready taken';
						//$error_message=$res;
					}
				}
			}
		}
		return $error_message;
	}

	private function _get_hasher(){
		return new PasswordHash(8, FALSE);
	}

	private function _create_user($email,$password){
	
		//get a hasher

		$hasher=self::_get_hasher();
		//hash the password
		$password_hash=$hasher->HashPassword($password);
		$error_message=NULL;
//
//		//connect to db 
		$mysqli=$this->_db_connect();
		$stmt=$mysqli->prepare('insert into users (email, password_hash) values(?, ?)');
		$stmt->bind_param('ss',$email,$password_hash);
//
//		//insert password
		if(!$stmt->execute()){
			$error_message=$stmt->error;
		}

//
		//close db connecton
		$stmt->close();
		mysqli_close($mysqli);
		return $error_message;
	}	
	
	private function _find_user_by_email($email){
		//connect to the data base		
		$mysqli=$this->_db_connect();
		$sql="select * from users where email='".$email."';";
		$result = $mysqli->query($sql) or die($mysqli->error);
		$user=$result->fetch_object();
		mysqli_close($mysqli);
		return $user;
	}
	
	private function _db_connect(){//under testing
		$db = new mysqli(self::$_db_host,self::$_db_user,self::$_db_password,self::$_db_name);
		if(mysqli_connect_errno()){
			$error='Error connecting to database: '.mysqli_connect_error();
			die($error);
		}
		return $db;
	}

	private function _find_user_by_id($id){
		$mysqli=self::_db_connect();
		$sql="select * from users where id=".$id.";";
		$result=$mysqli->query($sql) or die($mysqli->error);
		$user=$result->fetch_object();
		mysqli_close($mysqli);
		return $user;
	}
}
?>
