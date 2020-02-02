
<?php

	class Comment extends Db_Object
	{
/*
		Properties (Protected Static):

		• $dbTable			Table
		• $dbFields[]		Fields

		Properties (Public):

		• $id				ID
		• $photo_id			Photo ID
		• $author			Author
		• $body				Body

		Methods:

		• createComment		($photoId, $author, $body)
		• getComments		($photoId, $orderBy = 'id')
*/


		protected static $dbTable = "comments";
		protected static $dbFields = array("photo_id", "author", "body");

		public $id;
		public $photo_id;
		public $author;
		public $body;

		public static function createComment($photoId, $author, $body)
		{
			if(!empty($photoId) && !empty($author) && !empty($body))
			{
				$comment = new Comment();

				$comment->photo_id = (int)$photoId;
				$comment->author = $author;
				$comment->body = $body;

				return $comment;
			}
			else
			{
				return false;
			}
		}

		public static function getComments($photoId, $orderBy = 'id')
		{
			global $database;

			$escPhotoId = $database->escapeString($photoId);

			// Build SQL string
			$sql  = "SELECT * ";
			$sql .= "FROM " . static::$dbTable . " ";
			$sql .= "WHERE photo_id = " . $escPhotoId . " ";
			$sql .= "ORDER BY " . $orderBy . ";";

			// Execute SQL statement
			$result = static::executeQuery($sql);

			// Return the result
			return $result;
		}

	}


?>

