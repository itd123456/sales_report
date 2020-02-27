<?php

	require('database.php');

	$db = new Database();

	$email = $_POST['email'];

	$sql = "SELECT email
			FROM users
			WHERE email = '$email'";

	$db->fetchAll($sql);
?>