<?php

	require('database.php');

	$db = new Database();

	$sql = "CREATE TABLE branch
			(
				id INT AUTO_INCREMENT PRIMARY KEY,
				code INT(5) NOT NULL,
				branch VARCHAR(30) NOT NULL,
				area VARCHAR(20) NOT NULL
			)";

	$db->execQuery($sql);

	$code = ['100', '101', '102', '103', '104', '105', '106', '107', '108', '111', '115', '116', '117', '118',
			 '200', '201', '202', '203', '204', '205', '206', '207', '208', '209', '210', '211', '212', '213', '215', '216',
			 '300', '301', '302', '303', '304', '305', '306', '307', '308', '309', '310', '311', '312', '313', '314', '315', '316', '317', '318', '319', '320', '321', '322',
			 '400', '401', '402', '403', '404', '406', '407', '408', '409', '410', '411', '412', '413', '414', '415', '416',
			 '500', '501', '502', '503', '504', '505', '506', '507', '508', '509', '513', '514', '515', '516',
			 '109', '112', '114',
			 '510', '511', '512'];

	$branch = ['Head Office', 'Antipolo City', 'Cainta', 'Lagro', 'Marikina', 'POEA', 'Quezon Ave', 'Tanay', 'Tandang Sora', 'Valenzuela', 'Autoloans', 'Tungko', 'Malabon', 'Taguig',
			   'Makati', 'Manila', 'Cavite', 'Harrison Plaza', 'Imus', 'Intramuros', 'Las Pinas', 'Lipa', 'Muntinlupa', 'Paranaque', 'Calamba', 'Naga', 'San Pablo',' Makati A', 'Bacoor', 'General Trias',
				'Baguio', 'Baler', 'Baliug', 'Bataan', 'Cabanatuan', 'Dagupan', 'Dau', 'Gapan', 'La Trinidad', 'La Union', 'Malolos', 'Meycuayan', 'Olangapo', 'San Fernando PA', 'Santiago', 'Talavera', 'Tarlac', 'Tuguegarao', 'Laoag', 'San Jose', 'Cauayan', 'Urdaneta', 'Vigan',
			   'Bacolod', 'Cebu', 'Consolacion', 'Dumaguete', 'Iloilo', 'Manduae', 'Tacloban', 'Tagbilaran', 'Roxas', 'Kabankalan', 'Talisay', 'Kalibo', 'Lapu Lapu', 'Antique', 'Ormoc', 'Calbuyog',
			   'Butuan', 'Cagayan De Oro', 'Davao', 'General Santos', 'Koronadal', 'Tagum', 'Valencia', 'Digos', 'Malaybalay', 'kidapawan', 'Panabo', 'San Francisco', 'Buhangin', 'SC Gensan',
				'San Mateo', 'SME Marikina', 'SME Antipolo',
				'Digos Trike', 'SC Koronadal', 'SC Panabo'];

	$area = ['gma_north', 'gma_north', 'gma_north', 'gma_north', 'gma_north', 'gma_north', 'gma_north', 'gma_north', 'gma_north', 'gma_north', 'gma_north', 'gma_north', 'gma_north', 'gma_north', 
			 'gma_south', 'gma_south', 'gma_south', 'gma_south', 'gma_south', 'gma_south', 'gma_south', 'gma_south', 'gma_south', 'gma_south', 'gma_south', 'gma_south', 'gma_south', 'gma_south', 'gma_south', 'gma_south', 
			 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 'north_luzon', 
			 'visayas', 'visayas', 'visayas', 'visayas', 'visayas', 'visayas', 'visayas', 'visayas', 'visayas', 'visayas', 'visayas', 'visayas', 'visayas', 'visayas', 'visayas', 'visayas', 
			 'mindanao', 'mindanao', 'mindanao', 'mindanao', 'mindanao', 'mindanao', 'mindanao', 'mindanao', 'mindanao', 'mindanao', 'mindanao', 'mindanao', 'mindanao', 'mindanao', 
			 'sme', 'sme', 'sme', 
			 'sure_cycle', 'sure_cycle', 'sure_cycle'];

	for ($i = 0; $i < count($code); $i++)
	{
		$sql = "INSERT INTO branch(code, branch, area)
				VALUES($code[$i], '$branch[$i]', '$area[$i]')";

		$db->execQuery($sql);
	}

?>