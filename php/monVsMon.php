<?php
	require('Sales.php');

	$time = $_POST['time'];
	
	$year1 = $_POST['year1'];
	$year2 = $_POST['year2'];

	if ($time == "monthly")
	{
		$month1 = $_POST['month1'];
		$month2 = $_POST['month2'];

		$firstDate = $year1.'-'.$month1.'-01';
		$startDate1 = date('Y-m-01', strtotime($firstDate));
		$lastDate1 = date('Y-m-t', strtotime($firstDate));

		$secondDate = $year2.'-'.$month2.'-01';
		$startDate2 = date('Y-m-01', strtotime($secondDate));
		$lastDate2 = date('Y-m-t', strtotime($secondDate));

		$_POST['startDate1'] = $startDate1;
		$_POST['lastDate1'] = $lastDate1;
		$_POST['startDate2'] = $startDate2;
		$_POST['lastDate2'] = $lastDate2;
	}
	else
	{
		$startDate1 = $year1.'-01-01';
		$lastDate1 = $year1.'-12-31';

		$startDate2 = $year2.'-01-01';
		$lastDate2 = $year2.'-12-31';

		$_POST['startDate1'] = $startDate1;
		$_POST['lastDate1'] = $lastDate1;
		$_POST['startDate2'] = $startDate2;
		$_POST['lastDate2'] = $lastDate2;
	}

	if ($_POST['branch1'] != 'all')
	{
		$_POST['groupBy1'] = "AND branch_code = '".$_POST['branch1']."'
						   GROUP BY branch_code";
	}
	else
	{
		$_POST['groupBy1'] = '';
	}

	if ($_POST['branch2'] != 'all')
	{
		$_POST['groupBy2'] = "AND branch_code = '".$_POST['branch2']."'
						   GROUP BY branch_code";
	}
	else
	{
		$_POST['groupBy2'] = '';
	}

	$data = new Sales();

	$data->monVsMon($_POST);
?>