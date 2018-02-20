<?php

try{
	$pdo = new PDO("mysql:dbname=xxx;host=localhost;", "root", "");
}catch(PDOException $e){
	echo "Falhou:".$e->getMessage();
	exit;
}

?>