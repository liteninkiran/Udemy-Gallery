<?php

	require_once("init.php");

	// photoId gets set when an image is clicked on
	if(isset($_POST['photoId']))
	{
		// Store photo ID
		$photoId = $_POST['photoId'];

		// Get photo object
		$photo = Photo::getRecord($photoId);

		if($photo)
		{
			$photo->displaySidebarData();
		}
		else
		{
			echo "Cannot find photo";	
		}
	}

	// photoName and userId get set when the "Apply Selection" button is clicked on
	if(isset($_POST['photoName']))
	{

		$userImage = $_POST['photoName'];
		$userId = $_POST['userId'];

		$user = User::getRecord($userId);

		if($user->user_image == $userImage)
		{
			//echo "Same image selected!";
		}
		else
		{
			$user->user_image = $userImage;
			$user->save();
		}
	}

?>