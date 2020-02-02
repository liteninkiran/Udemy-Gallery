    <?php

        include("includes/init.php");

        if(!$session->isSignedIn())
        {
            redirect("login.php");
        }

        if(empty($_GET['id']))
        {
            redirect("photos.php");
        }

        $photo = Photo::getRecord($_GET['id']);

        if($photo)
        {
            $photo->deletePhoto();
            $session->message("Record {$photo->id} successfully deleted");
            redirect("photos.php");
        }
        else
        {
            echo "Problem";
            //redirect("../photos.php");
        }

    ?>
