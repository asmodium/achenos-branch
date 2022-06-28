<?php
include_once("handling.php");

$data = new FormHandler();
$handler = new GetForm();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tabletype = $_POST['tabletype'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];

$handler->setTable($tabletype);
$handler->setLogin($login);
$handler->setPassword($password);
$handler->setEmail($email);

$table = $handler->getTable();
$fields = "login,password,email";
$params = ":".$handler->getLogin().",:".$handler->getPassword().",:".$handler->getEmail();
$retins = $data->insert($table,$fields,$params);
}
?>