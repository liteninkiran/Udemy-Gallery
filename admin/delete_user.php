    <?php

        include("includes/init.php");

        if(!$session->isSignedIn())
        {
            redirect("login.php");
        }

        if(empty($_GET['id']))
        {
            redirect("users.php");
        }

        $user = User::getRecord($_GET['id']);

        if($user)
        {
            $user->deleteUser();
            $session->message("Record {$user->id} successfully deleted");
            redirect("users.php");
        }
        else
        {
            echo "Problem";
            //redirect("../photos.php");
        }

    ?>
