<?php

	require('Sales.php');

	$sales = new Sales();

	$daily_sales = $sales->getDailySales($_POST);
?>