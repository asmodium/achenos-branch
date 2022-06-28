<?php
require_once("vars.php");


class FormHandler extends PDO{
    private static $dbtype = "mysql";
    private static $host = "localhost";
    private static $port = "3306";
    private static $user = "root";
    private static $password = "";
    private static $db = "achenos";
    private function getDBType()    {return self::$dbtype;}
    private function getHost()      {return self::$host;}
    private function getPort()      {return self::$port;}
    private function getUser()      {return self::$user;}
    private function getPassword()  {return self::$password;}
    private function getDB()        {return self::$db;}

    public function __construct(){
        session_start();
    }
    private function __clone(){}
    public function __destruct()
    {
        session_destroy();
    }

    public function connect(){
        try
        {
            $this->conn = new PDO($this->getDBType().":host=".$this->getHost().";port=".$this->getPort().";dbname=".$this->getDB(), $this->getUser(), $this->getPassword());
        }
        catch (PDOException $e)
        {
            die("Erro: <code>" . $e->getMessage() . "</code>");
        }
        
        return ($this->conn);
    }

    public function disconnect(){
        $this->conn = null;
    }

    public function unsetter(){
        foreach ($this as $key => $value) {unset($this->$key);}
        foreach (array_keys(get_defined_vars()) as $var) {unset(${"var"});}
        unset($var);
    }

//Selecionar
    public function select($table,$fields="*",$where=null){
        $sql = "SELECT $fields FROM $table";
        if(isset($where)) $sql.= " WHERE $where";
        return $this->DBselect($sql,null);
    }
    public function DBselect($sql,$params=null,$class=null){
        $query=$this->connect()->prepare($sql);
        if(isset($params)){
        $query->execute($params);
        }
        else{}   
        if(isset($class)){
            $fetch = $query->fetchAll(PDO::FETCH_CLASS,$class) or die($query->errorInfo());
        }
        else {
            $fetch = $query->fetchALL(PDO::FETCH_OBJ) or die($query->errorInfo());
        }
        return $fetch;
        self::unsetter();
        self::disconnect();
    }
//Inserir
    public function insert($table,$fields,$params=null){
        $numparams="";
        for($i=0; $i<count($params); $i++) $numparams.=",?";
        $numparams=substr($numparams,1);
        $sql= "INSERT INTO $table ($fields) VALUES ($numparams)";
        $retins=$this->DBinsert($sql,$params);
        return $retins;
    }
    public function DBinsert($sql,$params=null){
        $insert=self::connect();
        $query=$insert->prepare($sql);
        $query->execute($params);
        $retins=$insert->lastInsertId() or die ($query->errorInfo());
        return $retins;
        self::unsetter();
        self::disconnect();
    }
//Atualizar
    public function update($table,$fields,$params=null,$where=null){
        $numfields="";
        for($i=0; $i<count($fields); $i++) $numfields.=", $fields[$i] = ?";
        $numfields=substr($numfields,2);
        $sql= "UPDATE INTO $table SET $numfields";
        if(isset($where)) $sql.= " WHERE $where";
        $retupd=$this->DBupdate($sql,$params);
        return $retupd;
    }
    public function DBupdate($sql,$params=null){
        $update=self::connect();
        $query=$update->prepare($sql);
        $query->execute($params);
        $retupd=$query->rowCount() or die ($query->errorInfo());
        return $retupd;
        self::unsetter();
        self::disconnect();
    }
//Excluir
    public function delete($table,$params=null,$where=null){
        $sql= "DELETE FROM $table";
        if(isset($where)) $sql.= " WHERE $where";
        $retdel=$this->DBdelete($sql,$params);
        return $retdel;
    }
    public function DBdelete($sql,$params=null){
        $delete=self::connect();
        $query=$delete->prepare($sql);
        $query->execute($params);
        $retdel=$query->rowCount() or die ($query->errorInfo());
        return $retdel;
        self::unsetter();
        self::disconnect();
    }
}

class GetForm extends FormHandler{

    public function __construct(){}
    private function __clone(){}
    public function __destruct(){
        foreach ($this as $key => $value){
            unset($this->$key);
        }
        foreach (array_keys(get_defined_vars()) as $var){
            unset(${"$var"});
        }
        unset($var);
    }
    
    public function setTable($tabletype){
		$this->tabletype = $tabletype;
	}
    public function getTable(){
		return $this->tabletype;
	}
	
    public function setLogin($login){
		$this->login = $login;
	}
    public function getLogin(){
		return $this->login;
	}

    public function setPassword($password){
		$this->password = $password;
	}
	public function getPassword(){
		return $this->password;
	}
	
    public function setEmail($email){
        $this->email = $email;
    }
	public function getEmail(){
		return $this->email;
	}
}

class SearchHandler extends FormHandler{

    public function __construct(){}
    private function __clone(){}
    public function __destruct(){
        foreach ($this as $key => $value){
            unset($this->$key);
        }
        foreach (array_keys(get_defined_vars()) as $var){
            unset(${"$var"});
        }
        unset($var);
    }

    public function setLogin($login){
		$this->login = $login;
	}
    public function getLogin(){
		return $this->login;
	}

    public function setPassword($password){
		$this->password = $password;
	}
	public function getPassword(){
		return $this->password;
	}
	
    public function setEmail($email){
        $this->email = $email;
    }
	public function getEmail(){
		return $this->email;
	}
//Busca

public function fetch($table,$fields="*"){
    $sql = "SELECT $fields FROM $table";
    return $this->DBfetch($sql);
}

public function DBfetch($sql){
    $query=$this->connect()->prepare($sql);
    $fetch = $query->fetch(PDO::FETCH_OBJ) or die ($query->errorInfo());
    foreach ($fetch as $row){
        echo "                        
        <tr>
            <td>".$row."</td>
            <td>".$row."</td>
            <td>".$row."</td>
        </tr>";               
    }
    return $fetch;
    self::unsetter();
    self::disconnect();
}

}
?>