
<?php

	class Db_Object
	{
/*
		Properties:

		• $errors[]
		• $errorLookups[]

		Methods:

		• instantiation		($dbObject)
		• getRecord			($id)
		• getRecords		($orderBy = 'id')
		• executeQuery		($sql)
		• create			()
		• update			()
		• delete			()
		• save				()
		• hasProp			($prop)
		• cleanProperties	()
		• properties		()
		• countRecords		()
*/

		public $errors = array();
		public $errorLookups = array
		(
			UPLOAD_ERR_OK           => "There is no error",
			UPLOAD_ERR_INI_SIZE		=> "The uploaded file exceeds the upload_max_filesize directive in php.ini",
			UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
			UPLOAD_ERR_PARTIAL      => "The uploaded file was only partially uploaded.",
			UPLOAD_ERR_NO_FILE      => "No file was uploaded.",               
			UPLOAD_ERR_NO_TMP_DIR   => "Missing a temporary folder.",
			UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disk.",
			UPLOAD_ERR_EXTENSION    => "A PHP extension stopped the file upload."					
		);

		public static function instantiation($dbObject)
		{
			$callingClass = get_called_class();
			$object = new $callingClass;

			foreach ($dbObject as $prop => $value)
			{
				if($object->hasProp($prop))
				{
					$object->$prop = $value;
				}
			}

			return $object;
		}

		public static function getRecord($id)
		{
			$sql = "SELECT * FROM " . static::$dbTable . " WHERE id = $id;";
			$result = static::executeQuery($sql);

			return empty($result) ? false : array_shift($result);
		}

		public static function getRecords($limit = 0, $offset = 0, $orderBy = 'id')
		{
			// Build SQL string
			$sql = "SELECT * FROM " . static::$dbTable . " ORDER BY " . $orderBy;

			// Check if a row limit has been supplied
			if($limit !== 0)
			{
				// Include the supplied row limit
				$sql .= " LIMIT {$limit} ";

				// Add in the offset
				$sql .= " OFFSET {$offset}";
			}

			// Terminate SQL statement
			$sql .= ";";

			// Execute SQL statement
			$result = static::executeQuery($sql);

			// Return the result
			return $result;
		}

		public static function executeQuery($sql)
		{
			global $database;

			$result = $database->query($sql);

			$objArray = array();

			while ($row = mysqli_fetch_assoc($result))
			{
				$objArray[] = static::instantiation($row);
			}

			return $objArray;
		}

		public function create()
		{
			global $database;

			$props = $this->cleanProperties();
			$props = array_filter($props); // Removes blank elements from the array

			$sql  = "INSERT INTO " . static::$dbTable . "(" . implode(", ", array_keys($props)) . ") ";
			$sql .= "VALUES ('" . implode("','", array_values($props)) . "');";

			if($database->query($sql))
			{
				$this->id = $database->insertId();
				return true;
			}
			else
			{
				return false;
			}
		}

		public function update()
		{
			global $database;

			$props = $this->cleanProperties();

			$propPairs = array();

			foreach($props as $key => $value)
			{
				if($value == '')
				{
					$propPairs[] = "{$key} = null";
				}
				else
				{
					$propPairs[] = "{$key} = '{$value}'";
				}
				
			}

			$sql  = "UPDATE " . static::$dbTable . " As u SET"           . " ";
			$sql .= implode(", ", $propPairs)                            . " ";
			$sql .= "WHERE u.id = " . $database->escapeString($this->id) . ";";

			$database->query($sql);

			$rows = mysqli_affected_rows($database->conn);

			if($rows == 1)
			{
				return true;
			}
			else
			{
				$this->errors[] = "Record has not been edited";
				return false;
			}

			//return ($rows == 1) ? true : false;
		}

		public function delete()
		{
			global $database;

			$sql  = "DELETE FROM " . static::$dbTable . " ";
			$sql .= "WHERE id   = "  . $database->escapeString($this->id) . ";";

			$database->query($sql);

			return (mysqli_affected_rows($database->conn) == 1) ? true : false;
		}

		public function save()
		{
			return isset($this->id) ? $this->update() : $this->create();
		}

		private function hasProp($prop)
		{
			$objectProps = get_object_vars($this);
			return array_key_exists($prop, $objectProps);
		}

		protected function cleanProperties()
		{
			global $database;

			$cleanProps = array();

			foreach($this->properties() as $key => $value)
			{
				$cleanProps[$key] = $database->escapeString($value);
			}

			return $cleanProps;
		}

		protected function properties()
		{

			$props = array();

			foreach(static::$dbFields as $dbField)
			{
				if(property_exists($this, $dbField))
				{
					$props[$dbField] = $this->$dbField;
				}
			}

			return $props;
		}

		public static function countRecords()
		{
			global $database;

			$sql = "SELECT COUNT(*) FROM " . static::$dbTable . " ";

			$result = $database->query($sql);

			$row = mysqli_fetch_array($result);

			return array_shift($row);
		}

	}

?>

