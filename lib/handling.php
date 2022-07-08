<?php

class Handling{
    private $db;
		public function __construct(){
			$this->db = new Database();
		}
		private function __clone(){}
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

		private function getLoginUser($username,$password){
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
			}else{
				$msg = "<div class='alert alert-danger'><strong>Usuário ou senha incorretos</strong></div>";
				return $msg;
			}
		}

	private function getUpdateName($name,$username){
		$sql = "UPDATE usuarios SET name=:name WHERE username=:username";
		$query = $this->db->pdo->prepare($sql);
		$query->bindParam(':name',$name);
		$query->bindValue(':username',$username);
		$result = $query->execute();	
		return $result;
	}	

	public function updateName($data){
		$name = $data['name'];
		$name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH);
		$username = $data['username'];
		$username = filter_var($username,FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_FLAG_STRIP_HIGH);
		$result = $this->getUpdateName($name,$username);
		if ($result){
			$sql = "SELECT * FROM usuarios WHERE username=?";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(1,$username);
			$query->execute();
			$sname1= $query->fetch(PDO::FETCH_OBJ);
			Session::set('name',$sname1->name);
			$msg = "<div class='alert alert-sucess'><strong>Nome alterado com sucesso!</strong></div>";
			return $msg;
		} else {
			$msg = "<div class='alert alert-danger'><strong>Ops, algo deu errado...</strong></div>";
			return $msg;
		}
	}

	private function getUpdateEmail($username,$email){
		$sql = "UPDATE usuarios SET email=:email WHERE username=:username";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':email',$email);
		$query->bindValue(':username',$username);
		$result = $query->execute();
		return $result;
	}

	public function updateEmail($data){
		$username = $data['username'];
		$username = filter_var($username,FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_FLAG_STRIP_HIGH);
		$email	  =	$data['email'];
		$result = $this->getUpdateEmail($username,$email);
		if ($result){
			$sql = "SELECT * FROM usuarios WHERE username=?";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(1,$username);
			$query->execute();
			$sname1= $query->fetch(PDO::FETCH_OBJ);
			Session::set('email',$sname1->email);
			$msg = "<div class='alert alert-sucess'><strong>Endereço de e-mail alterado com sucesso!</strong></div>";
			return $msg;
		} else {
			$msg = "<div class='alert alert-danger'><strong>Ops, algo deu errado...</strong></div>";
			return $msg;
		}
	}

	private function getUpdatePassword($username,$old_password,$password){
		$check = "SELECT * FROM usuarios WHERE username=:username AND password=:old_password";
		$checking = $this->db->pdo->prepare($check);
		$checking->bindValue(':username',$username);
		$checking->bindValue(':old_password',$old_password);
		$checked = $checking->execute();
		if ($checked){
		$sql = "UPDATE usuarios SET password=:password WHERE username=:username";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':username',$username);
		$query->bindValue(':password',$password);
		$result = $query->execute();
		return $result;
		} else {
		}
	}

	public function updatePassword($data){
		$username = $data['username'];
		$username = filter_var($username,FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_FLAG_STRIP_HIGH);
		$old_password = $data['old_password'];
		$password = $data['password'];
		$password = md5($password);
		$result = $this->getUpdatePassword($username,$old_password,$password);
		if ($result){
			$msg = "<div class='alert alert-sucess'><strong>Senha alterada com sucesso!</strong></div>";
			return $msg;
		} else {
			$msg = "<div class='alert alert-danger'><strong>Ops, algo deu errado...</strong></div>";
			return $msg;
		}

	}

	private function getUpdatePicture($username,$profilepic){
		$sql = "UPDATE usuarios SET profilepic=? WHERE username=?";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue($profilepic,$username);
		$result = $query->execute();
		return $result;
	}

	public function updatePicture($data){
		$username = $data['username'];
		$username = filter_var($username,FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_FLAG_STRIP_HIGH);
		$image_name = $_FILES['profilepic']['name'];
		$image_temp = $_FILES['profilepic']['tmp_name'];
		$exp = explode(".",$image_name);
		$end = end($exp);
		$name = time().".".$end;
		$path = DIR."img/profile/".$name;
		$allowed_ext = array("gif","jpg","jpeg","png");
		$profilepic = $image_name;
			if(in_array($end, $allowed_ext)){
				if(unlink("profile/".$username)){
					if(move_uploaded_file($image_temp, $path)){
						$result = $this->getUpdatePicture($username,$profilepic);
						}if ($result){
							$sql = "SELECT * FROM usuarios WHERE username=?";
							$query = $this->db->pdo->prepare($sql);
							$query->bindValue(1,$username);
							$query->execute();
							$sname1= $query->fetch(PDO::FETCH_OBJ);
							Session::set('profilepic',$sname1->profilepic);
							$msg = "<div class='alert alert-sucess'><strong>Imagem alterada com sucesso!</strong></div>";
							return $msg;
						} else {
							$msg = "<div class='alert alert-danger'><strong>Ops, algo deu errado...</strong></div>";
							return $msg;
						}
		}
	}

	}



}

?>