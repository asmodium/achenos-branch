<?php

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
			$password = md5($data['password']);

			$sql = "INSERT INTO usuarios (name,username,email,password) VALUES (:name,:username,:email,:password)";
			$query = $this->db->pdo->prepare($sql);
			$query->bindParam(':name',$name);
			$query->bindValue(':username',$username);
			$query->bindValue(':email',$email);
			$query->bindValue(':password',$password);
			$result = $query->execute();
			if ($result) {
				$msg = "<div class='alert alert-success'><strong>Cadastrado com sucesso!</strong></div>";
				return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Ops, algo deu errado...</strong></div>";
				return $msg;
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
			$result = $this->getLoginUser($username,$password);
			if ($result) {
				Session::init();
				Session::set('login',true);
				Session::set('id',$result->id);
				Session::set('name',$result->name);
				Session::set('username',$result->username);
				Session::set('email',$result->email);
				Session::set('loginmsg',"<div class='alert alert-success'><strong>Seja bem vindo $username</strong></div>");
				header('Location:home.php');
			}else{
				$msg = "<div class='alert alert-danger'><strong>Usuário ou senha incorretos</strong></div>";
				return $msg;
			}
		}

}
?>