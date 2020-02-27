<?php
	
	$Date =  '2017/10/23';

	for ($i = 0; $i < 10; $i++)
	{
		$Date = str_replace('/', '-', $Date);
		$Date = date('Y-m-d', strtotime($Date));
		$Date = date('Y/m/d', strtotime($Date. "+1 day"));
		print_r($Date.' ');
	}

		//Sofia Credentials
		private $sofiaHost = '192.168.0.26';
		private $sofiaDB = 'GLOBAL_SOFIADB';
		private $sofiaUser = 'saprog';
		private $sofiaPass = 'SQL@2012!';
		private $sofiaConn;

		//Localhost Credentials
		private $localHost = '192.168.1.167';
		private $localDB = 'global_reports';
		private $localUser = 'sa';
		private $localPass = '1234';
		private $localConn;

		//Constructor
		public function __construct()
		{
			//Set the default date and time to philippines
			date_default_timezone_set('Asia/Manila');
			//Connection to Sofia
			$this->sofiaConn = new PDO("sqlsrv:server=".$this->sofiaHost.";Database=".$this->sofiaDB, $this->sofiaUser, $this->sofiaPass);
			//Connection to Localhost
			$this->localConn = new PDO("sqlsrv:server=".$this->localHost.";Database=".$this->localDB, $this->localUser, $this->localPass);
		}

		do
		{

		}while($Date != '2020/07/01')

		

?>