<?php
define('isMySQL', true);
/****************************************************************************************************************
 db_open()
 @return connection object
 ****************************************************************************************************************/
function db_open() {
	include_once 'userdata.php';
	try {
		if(isMySQL) {
			$pdo_dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
			$pdo_dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
			$pdo_dbh->exec("set names utf8");
		} else {
			$pdo_dbh = new PDO("pgsql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_pass);
			$pdo_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		//$pdo_dbh->setAttribute( PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
	} catch(PDOException $e) {
		echo 'Failed to connect to '. (isMySQL ? 'MySQL: ' : 'PostgreSQL: ') . $e->getMessage();
		file_put_contents('DBErrors.txt', $e->getMessage(), FILE_APPEND);
		return null;
	}
	return $pdo_dbh;
}

/****************************************************************************************************************
 db_sendData($data)
 @param $data - data to send
****************************************************************************************************************/
function sendData($data) {
	$compressOutput = TRUE;
	
	if($compressOutput) {
		$data_to_send = gzencode(json_encode($data),-1,FORCE_GZIP);
		
		header("Content-Type: application/json");
		header("Content-length: ".strlen($data_to_send));
		header("Content-Encoding: gzip");
	} else {
		$data_to_send = json_encode($data);
		
		header("Content-Type: application/json");
		header("Content-length: ".strlen($data_to_send));
	}
	echo $data_to_send;
}

/****************************************************************************************************************
 db_close($conn)
 @param $conn - connection object
****************************************************************************************************************/
function db_close($conn) {
	if($conn) {
		# close the connection
		$conn = null;
	}
}
?>