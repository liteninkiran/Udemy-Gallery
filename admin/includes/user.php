
<?php

	class User extends Db_Object
	{
/*
		Properties (Protected Static):

		• $dbTable			Table
		• $dbFields[]		Fields

		Properties (Public):

		• $id				ID
		• $username			Username
		• $password			Password
		• $first_name		First Name
		• $last_name		Last Name
		• $user_image		User Image

		• $placeHolder		Place Holder
		• $folderName		Folder Name

		Methods:

		• picturePath		()
		• verifyUser		(username, $password)
		• setFile			($file)
		• saveWithImage		()
		• deleteUser		()
*/


		protected static $dbTable = "users";
		protected static $dbFields = array("username", "password", "first_name", "last_name", "user_image");

		public $id;
		public $username;
		public $password;
		public $first_name;
		public $last_name;
		public $user_image;


		public $placeHolder = "http://placehold.it/400x400&text=image";
		public $folderName = "images";
		public $tempPath;

		public function picturePath()
		{
			return empty($this->user_image) ? $this->placeHolder : $this->folderName . DS . $this->user_image;
		}

		public static function verifyUser($username, $password)
		{
			global $database;

			$username = $database->escapeString($username);
			$password = $database->escapeString($password);

			$sql = "SELECT * FROM " . self::$dbTable . " WHERE username = '{$username}' AND password = '{$password}';";
			$result = self::executeQuery($sql);

			if(empty($result))
			{
				return false;
			}
			else
			{
				return array_shift($result);
			}
		}

		public function setFile($file)
		{
			if(empty($file) || !$file || !is_array($file))
			{
				$this->errors[] = "There was no file uploaded";
				return false;
			}
			elseif($file['error'] != 0)
			{
				$this->errors[] = $this->errorLookups[$file['error']];
				return false;
			}
			else
			{
				$this->user_image = basename($file['name']);
				$this->tempPath = $file['tmp_name'];
			}
		}

		public function saveWithImage()
		{
			if(!empty($this->errors))
			{
				return false;
			}

			if(empty($this->user_image) || empty($this->tempPath))
			{
				$this->errors[] = "The file was not available<br><br>" . $this->user_image . "<br><br>" . $this->tempPath;
				return false;
			}

			$targetPath = SITE_ROOT . DS . 'admin' . DS . $this->folderName . DS . $this->user_image;

			if(move_uploaded_file($this->tempPath, $targetPath))
			{
				if($this->save())
				{
					unset($this->tempPath);
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				$this->errors[] = "File cannot be uploaded";
				return false;
			}				
		}

		public function deleteUser()
		{
			if($this->delete())
			{
				$targetPath = SITE_ROOT . DS . 'admin' . DS . $this->picturePath();
				return unlink($targetPath) ? true : false;
			}
			else
			{
				return false;
			}
		}
	}


?>

