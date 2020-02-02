    <?php

        include("includes/header.php");

        if(!$session->isSignedIn())
        {
            redirect("login.php");
        }

        // Check if a Photo ID has been passed in
        if(empty($_GET['id']))
        {
            $comments = Comment::getRecords();
            $photoId = -1;
        }
        else
        {
            // Store the Photo ID
            $photoId = $_GET['id'];

            // Store the photo for use in subheading
            $cPhoto = Photo::getRecord($photoId);

            // Find Comments for Photo
            $comments = Comment::getComments($photoId);
        }

    ?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <!-- Brand and toggle get grouped for better mobile display -->
        <?php include("includes/top_nav.php"); ?>

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <?php include("includes/side_nav.php"); ?>

    </nav>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <?php
                            if($photoId == -1)
                            {
                                echo "All Comments";
                            }
                            else
                            {
                                echo "Comments ";
                                echo "<small>$cPhoto->title</small>";
                            }
                        ?>
                    </h1>

                    <p class="bg-success">
                        <?php echo $session->message; ?>
                    </p>

                    <div class="col-md-12">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="150px">ID</th>
                                    <?php if($photoId == -1): ?>
                                        <th width="200px" >Photo Title</th>
                                    <?php endif; ?>
                                    <th width="200px" >Author</th>
                                    <th >Body</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($comments as $comment): ?>
                                    <?php $photo = Photo::getRecord($comment->photo_id); ?>
                                    <tr>
                                        <td><?php echo $comment->id; ?></td>
                                        <?php if($photoId == -1): ?>
                                            <td><?php echo $photo->title; ?></td>
                                        <?php endif; ?>
                                        <td>
                                            <?php echo $comment->author; ?>
                                            <div class="action_links">
                                                <a class="delete_link" href="delete_comment.php?id=<?php echo $comment->id; ?>&photo_id=<?php echo $photoId; ?>">Delete</a>
                                            </div>
                                        </td>
                                        <td><?php echo $comment->body; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
