<?php

echo 'My username is ' .$_ENV["APP_NAME"] . '!';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "firebird:dbname=62.28.229.114:d:\one-key\swworking.gdb";
$user = "SYSDBA";
$pass = "60087.hs";


$lokos = new PDO($host,$user,$pass);
$stmt = $lokos->prepare("SELECT * FROM API_USER_JOB_EXPERIENCE_DELETE( '302755225' , 'dsdadsadasdsa' , 'ahmed@teste.pt' , 2)");
$stmt->execute();
$dados = $stmt->fetchAll(PDO::FETCH_OBJ);
$lokos->commit();
print_r($dados);

?>