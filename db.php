<?php
	//Ñîåäèíåíèå ñ áàçîé äàííûõ
	$host = '127.0.0.1';
	$db = 'todo01';
	$charset = 'utf8';
	$user = 'root';
	$pass = '';
	
	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
	
	$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	);
