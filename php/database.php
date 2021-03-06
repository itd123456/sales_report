<?php

	Class Database
	{
		//Linux Credentials
		private $host = "localhost";
		private $user = "network";
		private $pass = 'P@$$w0rd2020!';
		private $db = "sales_report";
		private $conn;

		//Localhost Credentials
		// private $host = 'localhost';
		// private $user = 'root';
		// private $pass = '123456';
		// private $db = 'sales_report';
		// private $conn;

		public function __construct()
		{
			date_default_timezone_set('Asia/Manila');

			$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db, $this->user, $this->pass);
		}

		public function fetchAll($sql)
		{
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			print json_encode($result);
		}

		public function execQuery($sql)
		{
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
		}

		public function returnData($sql)
		{
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $result;
		}
	}
?>