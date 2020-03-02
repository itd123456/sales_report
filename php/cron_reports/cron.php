<?php
	Class Cron
	{
		//Sofia Credentials
		private $sofiaHost = '192.168.0.26';
		private $sofiaDB = 'GLOBAL_SOFIADB';
		private $sofiaUser = 'saprog';
		private $sofiaPass = 'SQL@2012!';
		private $sofiaConn;

		//Localhost Credentials
		// private $localHost = '192.168.1.167';
		// private $localDB = 'global_reports';
		// private $localUser = 'sa';
		// private $localPass = '1234';
		// private $localConn;

		//Linux Credentials
		private $mysqlHost = 'localhost';
		private $mysqlDB = 'sales_report';
		private $mysqlUser = 'network';
		private $mysqlPass = 'P@$$w0rd2020!';
		private $mysqlConn;

		//Constructor
		public function __construct()
		{
			//Set the default date and time to philippines
			date_default_timezone_set('Asia/Manila');
			//Connection to Sofia
			$this->sofiaConn = new PDO("sqlsrv:server=".$this->sofiaHost.";Database=".$this->sofiaDB, $this->sofiaUser, $this->sofiaPass);
			//Connection to Localhost
			// $this->localConn = new PDO("sqlsrv:server=".$this->localHost.";Database=".$this->localDB, $this->localUser, $this->localPass);

			$this->mysqlConn = new PDO("mysql:host=".$this->mysqlHost.";dbname=".$this->mysqlDB, $this->mysqlUser, $this->mysqlPass);
		}

		public function getCurrentDate()
		{
			$currentDate = date('Y-m-d');

			return $currentDate;
		}

		public function insertYear()
		{
			$currentYear = date('Y');

			$sql = "SELECT MAX(year)
					FROM year";

			// $stmt = $this->localConn->prepare($sql);
			// $stmt->execute();
			// $result = $stmt->fetchAll();

			$stmt = $this->mysqlConn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();

			if ($currentYear > $result[0][0])
			{
				$sql = "INSERT INTO year(year)
						VALUES($currentYear)";

				// $stmt = $this->localConn->prepare($sql);
				// $stmt->execute();

				$stmt = $this->mysqlConn->prepare($sql);
				$stmt->execute();
			}
		}

		public function getSC($today)
		{
			$sql = "SELECT LOAN_BR, SUM(LOAN_AMOUNT_APPROVED) AS amount, LOAN_RELEASED_DATE
					FROM LM_LOAN
					WHERE LOAN_RELEASED_DATE = '$today'
					AND LOAN_BR IN(510,511,512)
					AND LOAN_STATUS = 5
					GROUP BY LOAN_BR, LOAN_RELEASED_DATE";

			//prepare the sql query for execution
			$stmt = $this->sofiaConn->prepare($sql);
			//execution the query
			$stmt->execute(array());
			//rersult of the query
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $result;
		}

		public function insertSCData($data)
		{
			$count = count($data);
			
			//print_r($date);
			for ($i = 0; $i < $count; $i++)
			{
				$code = $data[$i]['LOAN_BR'];
				$date = $data[$i]['LOAN_RELEASED_DATE'];
				$amount = $data[$i]['amount'];

				$sql = "INSERT INTO sure_cycle(branch_code, daily_sales, date_sales)
						VALUES('$code', $amount, '$date')";

				// $stmt = $this->localConn->prepare($sql);
				// $stmt->execute();

				$stmt = $this->mysqlConn->prepare($sql);
				$stmt->execute();
			}
		}
	}
?>