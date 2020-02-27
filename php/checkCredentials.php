<?php

	require('database.php');

	$db = new Database();

	$email = $_POST['email'];
	$pass = md5($_POST['pass']);

	$sql = "SELECT *
			FROM users
			WHERE email = '$email'
			AND password = '$pass'";

	$db->fetchAll($sql);
	$data = $db->returnData($sql);
	
	session_start();

	$_SESSION['email'] = $data[0]['email'];
?>