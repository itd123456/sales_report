<?php

	require('database.php');

	$db = new Database();

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$pass = md5($_POST['pass']);

	$sql = "INSERT INTO users(fname, lname, email, password)
			VALUES('$fname', '$lname', '$email', '$pass')";

	$db->execQuery($sql);
?>