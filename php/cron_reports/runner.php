<?php
	require('cron.php');

	// //Instantiation of Cron class
	 $cron = new Cron();
	// //get current Year
	// $year = $cron->insertYear();
	// //Date Today
	// $today = $cron->getCurrentDate();
	// //get the sales of Sure Cycle
	// $scSales = $cron->getSc($today);
	// //insert the SC Sales in the local database
	// $insertSCSales = $cron->insertSCData($scSales);
	$Date =  '2017/10/23';
	do
	{
		$Date = str_replace('/', '-', $Date);
		$Date = date('Y-m-d', strtotime($Date));
		$Date = date('Y/m/d', strtotime($Date. "+1 day"));

		$scSales = $cron->getSc($Date);

		$insertSCSales = $cron->insertSCData($scSales);

	}while($Date != '2020/27/02');

?>