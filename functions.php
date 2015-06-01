<?php

$config = [
	'host' => 'localhost',
	'user' => 'root',
	'password' => 'root',
	'db' => 'practice'
];

function connect($config){
	$conn = new mysqli($config['host'], $config['user'], $config['password'], $config['db']);
	return $conn;
}

function query($query,$conn){
	$result = $conn->query($query);
	return $result;
}

