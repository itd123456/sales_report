<?php

	Class Sales
	{
		//Localhost Credentials
		// private $host = 'localhost';
		// private $user = 'root';
		// private $pass = '123456';
		// private $db = 'sales_report';
		// private $conn;

		//Linux Credentials
		private $host = "localhost";
		private $user = "network";
		private $pass = 'P@$$w0rd2020!';
		private $db = "sales_report";
		private $conn;

		public function __construct()
		{
			date_default_timezone_set('Asia/Manila');

			$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db, $this->user, $this->pass);
		}

		public function getTotalSales($first, $last, $table, $isAll)
		{
			if ($isAll == 0)
			{
				$sql = "SELECT SUM(t.daily_sales) AS total, t.branch_code, b.branch
					FROM $table t
					JOIN branch b
					ON t.branch_code = b.code
					WHERE t.date_sales BETWEEN '$first'
					AND '$last'
					GROUP BY t.branch_code, b.branch";
				$stmt = $this->conn->prepare($sql);
				$stmt->execute(array());
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
			else
			{
				$totalSales = 0;

				$tables = ['sme', 'sure_cycle', 'north_luzon', 'gma_north', 'gma_south', 'visayas', 'mindanao'];

				for ($i = 0; $i < count($tables); $i++)
				{
					$sql = "SELECT SUM(daily_sales) AS total
							FROM $tables[$i]
							WHERE date_sales BETWEEN '$first'
							AND '$last'";
					$stmt = $this->conn->prepare($sql);
					$stmt->execute(array());
					$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

					$totalSales += $result[0]['total'];
				}
				$result[0]['total'] = $totalSales;
				$result[0]['branch'] = 'All Areas';
			}

			print json_encode($result);
		}

		public function getDailySales($data)
		{
			$table = $data['table'];
			$branch_code = $data['branch_code'];
			$date = $data['year'].'-'.$data['month'].'-01';
			$first = date('Y-m-01', strtotime($date));
			$last = date('Y-m-t', strtotime($date));

			//print_r($data);

			$sql = "SELECT daily_sales, DATE_FORMAT(date_sales, '%b %d') AS date
					FROM $table
					WHERE branch_code = '$branch_code'
					AND date_sales BETWEEN '$first'
					AND '$last'
					ORDER BY date_sales";
			//print_r($sql);
			
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		 	print json_encode($result);
		}

		public function getYear()
		{
			$sql = "SELECT year
					FROM year
					ORDER BY year DESC";

			$stmt = $this->conn->prepare($sql);
			$stmt->execute(array());
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			print json_encode($result);
		}

		public function monVsMon($data)
		{
			$results = [];

			$table1 = $data['group1'];
			$start1 = $data['startDate1'];
			$last1 = $data['lastDate1'];
			$group1 = $data['groupBy1'];

			$table2 = $data['group2'];
			$start2 = $data['startDate2'];
			$last2 = $data['lastDate2'];
			$group2 = $data['groupBy2'];

			$sql = "SELECT SUM(daily_sales) AS total, branch_code
					FROM $table1
					WHERE date_sales BETWEEN '$start1'
					AND '$last1'
					$group1";
			
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(array());
			$result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$sql = "SELECT SUM(daily_sales) AS total, branch_code
					FROM $table2
					WHERE date_sales BETWEEN '$start2'
					AND '$last2'
					$group2";

			$stmt = $this->conn->prepare($sql);
			$stmt->execute(array());
			$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);


			$results['result1'] = $result1;
			$results['result2'] = $result2;

			print json_encode($results);
		}
	}
?>