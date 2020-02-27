<?php
	require('Sales.php');
	$group = new Sales();

	$time_frame = $_POST['time_frame'];
	$chosen_group = $_POST['group'];
	$year = $_POST['year'];

	if ($time_frame == "monthly")
	{
		$month = $_POST['month'];

		$query_date = $year.'-'.$month.'-01';
		$first = date('Y-m-01', strtotime($query_date)) ;
		$last = date('Y-m-t', strtotime($query_date));
	}
	else
	{
		$first = $year.'-01-01';
		$last = $year.'-12-31';
	}

	$sales = $group->getTotalSales($first, $last, $chosen_group);
?>