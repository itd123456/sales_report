<?php

	require('cron.php');

	// //Instantiation of Cron class
	 $cron = new Cron();

	$year = $cron->insertYear();

	$today = $cron->getCurrentDate();

	$scSales = $cron->getSc($today);
	$cron->insertSCData($scSales, 'sure_cycle');

	$sme = $cron->getSME($today);
	$cron->insertSCData($sme, 'sme');

	$gmaNorth = $cron->getOthers($today, 'GMA North');
	$cron->insertSCData($gmaNorth, 'gma_north');

	$gmaSouth = $cron->getOthers($today, 'GMA South');
	$cron->insertSCData($gmaSouth, 'gma_south');

	$northLuzon = $cron->getOthers($today, 'North Luzon');
	$cron->insertSCData($northLuzon, 'north_luzon');

	$visayas = $cron->getOthers($today, 'Visayas');
	$cron->insertSCData($visayas, 'visayas');
	
	$mindanao = $cron->getOthers($today, 'Mindanao');
	$cron->insertSCData($mindanao, 'mindanao');
	

	// $area = ['gma_north', 'gma_south', 'north_luzon', 'visayas', 'mindanao', 'sme', 'sure_cycle'];

	// $count = count($area);

	// for ($i = 0; $i < $count; $i++)
	// {
	// 	$sql = "CREATE TABLE $area[$i]
	// 			(
	// 				id INT AUTO_INCREMENT PRIMARY KEY,
	// 				branch_code VARCHAR(5) NOT NULL,
	// 				daily_sales FLOAT NOT NULL,
	// 				date_sales DATETIME NOT NULL
	// 			)";

	// 	$cron->execQuery($sql);
	// }
	
	// $Date =  '2017/10/23';
	// do
	// {
	// 	$Date = str_replace('/', '-', $Date);
	// 	$Date = date('Y-m-d', strtotime($Date));
	// 	$Date = date('Y/m/d', strtotime($Date. "+1 day"));

	// 	//Sure Cycle
	// 	$scSales = $cron->getSc($Date);
	// 	$insertSCSales = $cron->insertSCData($scSales, 'sure_cycle');

	// 	//SME
	// 	$sme = $cron->getSME($Date);
	// 	$cron->insertSCData($sme, 'sme');

	// 	// //GMA North
	// 	$gmaNorth = $cron->getOthers($Date, 'GMA North');
	// 	$cron->insertSCData($gmaNorth, 'gma_north');

	// 	// //GMA South
	// 	$gmaSouth = $cron->getOthers($Date, 'GMA South');
	// 	$cron->insertSCData($gmaSouth, 'gma_south');

	// 	// //North Luzon
	// 	$northLuzon = $cron->getOthers($Date, 'North Luzon');
	// 	$cron->insertSCData($northLuzon, 'north_luzon');

	// 	// //Visayas
	// 	$visayas = $cron->getOthers($Date, 'Visayas');
	// 	$cron->insertSCData($visayas, 'visayas');
		
	// 	// //Mindanao
	// 	$mindanao = $cron->getOthers($Date, 'Mindanao');
	// 	$cron->insertSCData($mindanao, 'mindanao');

	// }while($Date != '2020/03/04');
?>