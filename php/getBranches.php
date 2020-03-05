<?php
	
	require('database.php');

	$db = new Database();

	$area = $_POST['area'];

	$sql = "SELECT code, branch
			FROM branch
			WHERE area = '$area'";

	$db->fetchAll($sql);
?>