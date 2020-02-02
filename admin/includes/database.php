<?php

	class Database
	{
		public $conn;

		function __construct()
		{
			$this->openDbConnection();
		}

		private function openDbConnection()
		{
			$this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			if($this->conn->connect_errno)
			{
				die('Connection failed:<br><br>' . $this->conn->connect_error);
			}
		}

		public function query($sql)
		{
			if(PRINT_SQL)
			{
				echo $sql . '<br><br>';
			}
			$result = $this->conn->query($sql);
			$this->confirmQuery($result, $sql);
			return $result;
		}

		private function confirmQuery($result, $sql)
		{
			if(!$result)
			{
				die('Query Failed:<br><br>' . $this->conn->error . '<br><br>' . $sql);
			}
		}

		public function escapeString($string)
		{
			$escapeString = $this->conn->real_escape_string($string);
			return $escapeString;
		}

		public function insertId()
		{
			return $this->conn->insert_id;
		}
	}

	$database = new Database();

?>