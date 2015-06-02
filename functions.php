<?php
function connect($config){
	$conn = new mysqli($config['host'], $config['user'], $config['password'], $config['db']);
	return $conn;
}

function query($query,$conn){
	$result = $conn->query($query);
	return $result;
}

function getValue($query, $identifier, $conn){
	$sql = query($query,$conn);
	if ($sql->num_rows > 0) {
	    while($row = $sql->fetch_array()) {
	        $result = $row[$identifier];
	    }
	}
	return $result;
}