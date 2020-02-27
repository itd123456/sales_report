<?php

	Class Sales
	{
		private $host = '192.168.1.167';
		private $db = 'global_reports';
		private $user = 'sa';
		private $pass = '1234';
		private $conn;

		public function __construct()
		{
			$this->conn = new PDO("sqlsrv:server=".$this->host.";Database=".$this->db, $this->user, $this->pass);
		}

		public function getTotalSales($first, $last, $table)
		{
			$sql = "SELECT SUM(daily_sales) AS total, branch_code
					FROM $table
					WHERE date_sales BETWEEN '$first'
					AND '$last'
					GROUP BY branch_code";

			$stmt = $this->conn->prepare($sql);
			$stmt->execute(array());
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			print json_encode($result);
		}

		public function getDailySales($data)
		{
			$table = $data['table'];
			$branch_code = $data['branch_code'];
			$date = $data['year'].'-'.$data['month'].'-01';
			$first = date('Y-m-01', strtotime($date));
			$last = date('Y-m-t', strtotime($date));

			$sql = "SELECT daily_sales, FORMAT(date_sales, 'MMM dd') AS date
					FROM $table
					WHERE branch_code = '$branch_code'
					AND date_sales BETWEEN '$first'
					AND '$last'
					ORDER BY date_sales";

			$stmt = $this->conn->prepare($sql);
			$stmt->execute(array());
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
			$branch1 = $data['branch1'];

			$table2 = $data['group2'];
			$start2 = $data['startDate2'];
			$last2 = $data['lastDate2'];
			$branch2 = $data['branch2'];

			$sql = "SELECT SUM(daily_sales) AS total, branch_code
					FROM $table1
					WHERE date_sales BETWEEN '$start1'
					AND '$last1'
					AND branch_code IN($branch1)
					GROUP BY branch_code";

			$stmt = $this->conn->prepare($sql);
			$stmt->execute(array());
			$result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$sql = "SELECT SUM(daily_sales) AS total, branch_code
					FROM $table2
					WHERE date_sales BETWEEN '$start2'
					AND '$last2'
					AND branch_code IN($branch2)
					GROUP BY branch_code";

			$stmt = $this->conn->prepare($sql);
			$stmt->execute(array());
			$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);


			$results['result1'] = $result1;
			$results['result2'] = $result2;

			print json_encode($results);
		}
	}
?>