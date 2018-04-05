<?php
class DBController {
	private $host = "rockleedb.cqkqw4vhznsx.us-east-1.rds.amazonaws.com";
	private $user = "rocklee";
	private $password = "lindenwood";
	private $database = "rocklee";
	private $conn;

	function __construct() {
		$this->conn = $this->connectDB();
	}

	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}

	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}
		if(!empty($resultset))
			return $resultset;
	}

	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;
	}

	function updateQuery($query) {
		$result = mysqli_query($this->conn,$query);
		if (!$result) {
			die('Invalid query: ' . mysqli_error($this->conn));
		} else {
			return $result;
		}
	}

	function insertQuery($query) {
		$result = mysqli_query($this->conn,$query);
		if (!$result) {
			die('Invalid query: ' . mysqli_error($this->conn));
		} else {
			return mysqli_insert_id($this->conn);
		}
	}

	function addTokenQuery($query)
	{ 
		$result = mysqli_query($this->conn, $query); 

		if(!$result)
		{ 
			die('Invalid query: ' .  mysqli_error($this->conn)); 
			return $result; 
		}
		else
		{ 
            return $result; 
		}
	}

	function deleteQuery($query) {
		$result = mysqli_query($this->conn,$query);
		if (!$result) {
			die('Invalid query: ' . mysqli_error());
		} else {
			return $result;
		}
	}
	function generateNewString($len = 10) {
		$token = "poiuztrewqasdfghjklmnbvcxy1234567890";
		$token = str_shuffle($token);
		$token = substr($token, 0, $len);

		return $token;
	}
}
?>
