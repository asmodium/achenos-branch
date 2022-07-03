<?php

require_once DIR.'/lib/validator.php';


class Handling{
    private $db;
		public function __construct(){
			$this->db = new Database();
		}
		public function userRegistration($data){
			$name	  = $data['name'];
			$name =  filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH);
			$username = $data['username'];
			$username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH);
			$email	  =	$data['email'];
			$password = $data['password'];
			$check_email = $this->checkEmail($email);

			if (empty($name) || empty($username) || empty($email) || empty($password)) {
				$msg = "<div class='alert alert-danger'><strong>Este campo deve ser preenchido</strong></div>";
				return $msg;
			}
			
			if (strlen($username) < 3) {
				$msg = "<div class='alert alert-danger'><strong>Nome de usuário muito curto</strong></div>";
				return $msg;
			}elseif (preg_match('/[^a-z0-9_-]+/i', $username)) {
				$msg = "<div class='alert alert-danger'><strong>Deve conter apenas letras, números ou underscore ( _ )</strong></div>";
				return $msg;
			}
			if (filter_var($email,FILTER_VALIDATE_EMAIL) === false) {
				$msg = "<div class='alert alert-danger'><strong>Endereço de e-mail inválido</strong></div>";
				return $msg;
			}
			if ($check_email == true) {
				$msg = "<div class='alert alert-danger'><strong>Este endereço de e-mail já está em uso</strong></div>";
				return $msg;
			}
			$password = md5($data['password']);

			$sql = "INSERT INTO usuarios (name,username,email,password) VALUES (:name,:username,:email,:password)";
			$query = $this->db->pdo->prepare($sql);
			$query->bindParam(':name',$name);
			$query->bindValue(':username',$username);
			$query->bindValue(':email',$email);
			$query->bindValue(':password',$password);
			$result = $query->execute();
			if ($result) {
				$msg = "<div class='alert alert-success'><strong>Success !</strong> You have registered Succesfully  !!</div>";
				return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Something going wrong  !! Try agin Later.. </div>";
				return $msg;
			}

		}

		public function checkEmail($email){
			$sql 	= "SELECT email FROM usuarios WHERE email= :email";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':email',$email);
			$query->execute();
			if ($query->rowCount() > 0) {
				return true;
			}else{
				return false;
			}
		}

		public function getLoginUser($username,$password){
			$sql = "SELECT * FROM usuarios WHERE username=:username AND password=:password ";
			$query =  $this->db->pdo->prepare($sql);
			$query->bindValue(':username',$username);
			$query->bindValue(':password',$password);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_OBJ);
			return $result;
		}

		public function userLogin($data){
			$username = $data['username'];
			$password = md5($data['password']);

			if (empty($username) || empty($password)) {
				$msg = "<div class='alert alert-danger'><strong>Este campo deve ser preenchido</strong></div>";
				return $msg;

			}
			if ($username === false) {
				$msg = "<div class='alert alert-danger'><strong>Este campo deve ser preenchido</strong></div>";
				return $msg;
			}

			$result = $this->getLoginUser($username,$password);
			if ($result) {
				Session::init();
				Session::set('login',true);
				Session::set('id',$result->id);
				Session::set('name',$result->name);
				Session::set('username',$result->username);
				Session::set('email',$result->email);
				Session::set('loginmsg',"<div class='alert alert-success'><strong>Logado com sucesso, redirecionando para a página principal.</strong></div>");
				header('Location:index.php');
			}else{
				$msg = "<div class='alert alert-danger'><strong>Dados não encontrados</strong></div>";
				return $msg;
			}
		}

}
?>