<?php

	spl_autoload_register('classAutoLoader');

	function classAutoLoader($class)
	{
		// Store class name in lower case
		$class = strtolower($class);

		// Define file path
		$path = "includes/{$class}.php";

/*
		if(is_file($path) && !class_exists($class))
		{
			require_once($path);
		}
*/
///*
		if(file_exists($path))
		{
			require_once($path);
		}
		else
		{
			die("The file {$class}.php was not found.");
		}
//*/
	}

	function getUrl()
	{
		return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}

	function redirect($location)
	{
		header("Location: {$location}");
	}

	function formatBytes($bytes)
	{
		if ($bytes >= 1073741824){$bytes = number_format($bytes / 1073741824, 2) . ' GB';}
		elseif ($bytes >= 1048576){$bytes = number_format($bytes / 1048576, 2) . ' MB';}
		elseif ($bytes >= 1024){$bytes = number_format($bytes / 1024, 2) . ' KB';}
		elseif ($bytes > 1){$bytes = $bytes . ' bytes';}
		elseif ($bytes == 1){$bytes = $bytes . ' byte';}
		else{$bytes = '0 bytes';}

		return $bytes;
	}

?>
