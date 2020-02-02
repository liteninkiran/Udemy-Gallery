    <?php

        include("includes/init.php");

        if(!$session->isSignedIn())
        {
            redirect("login.php");
        }

        if(empty($_GET['id']) || empty($_GET['photo_id']))
        {
            redirect("comments.php");
        }

        $commentId = $_GET['id'];
        $photoId = $_GET['photo_id'];

        $comment = Comment::getRecord($commentId);

        $url = "comments.php";

        if($photoId > 0)
        {
            $url .= '?id=' . $photoId;
        }

        if($comment)
        {
            $comment->delete();
            $session->message("Record {$comment->id} successfully deleted");
            redirect($url);
        }
        else
        {
            echo "Problem";
            //redirect("../comments.php");
        }

    ?>
