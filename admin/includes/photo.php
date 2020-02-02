
<?php

	class Photo extends Db_Object
	{
/*
		Properties (Protected Static):

		• $dbTable			Table
		• $dbFields[]		Fields

		Properties (Public):

		• $id					ID
		• $title				Title
		• $caption				Caption
		• $description			Description
		• $filename				File Name
		• $alternate_text		Alt Text
		• $type					Type
		• $size					File Size

		• $tempPath				Temp Path
		• $folderName			Folder Name

		Methods:

		• setFile				($file)
		• save					()
		• picturePath			()
		• deletePhoto			()
		• displaySidebarData	($photoId)
*/
		protected static $dbTable = "photos";
		protected static $dbFields = array("title", "caption", "description", "filename", "alternate_text", "type", "size");

		public $id;
		public $title;
		public $caption;
		public $description;
		public $filename;
		public $alternate_text;
		public $type;
		public $size;

		public $tempPath;
		public $folderName = "images";

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
				$this->filename = basename($file['name']);
				$this->tempPath = $file['tmp_name'];
				$this->type = $file['type'];
				$this->size = $file['size'];
			}
		}

		public function save()
		{
			if($this->id)
			{
				$this->update();
			}
			else
			{
				if(!empty($this->errors))
				{
					return false;
				}

				if(empty($this->filename) || empty($this->tempPath))
				{
					$this->errors[] = "The file was not available<br><br>" . $this->filename . "<br><br>" . $this->tempPath;
					return false;
				}

				$targetPath = SITE_ROOT . DS . 'admin' . DS . $this->folderName . DS . $this->filename;

				if(file_exists($targetPath))
				{
					$this->errors[] = "The file {$this->filename} already exists";
					return false;
				}

				if(move_uploaded_file($this->tempPath, $targetPath))
				{
					if($this->create())
					{
						unset($this->tempPath);
						return true;
					}
				}
				else
				{
					$this->errors[] = "File cannot be uploaded";
					return false;
				}				
			}
		}

		public function picturePath()
		{
			return $this->folderName . DS . $this->filename;
		}

		public function deletePhoto()
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

		public function displaySidebarData()
		{
			$output  = "<a class='thumbnail' href='#'><img width='100' src='{$this->picturePath()}' ></a> ";
			$output .= "<p>File Name: {$this->filename}</p>";
			$output .= "<p>File Type: {$this->type}</p>";
			$output .= "<p>File Size: {$this->size}</p>";

			echo $output;
		}
	}
?>

