    <?php

        include("includes/header.php");

        // Redirect if we are not logged in
        if(!$session->isSignedIn())
        {
            redirect("login.php");
        }

        // Check we have been suuplied with an ID in the URL
        //
        // http://localhost/oop/gallery-dev/admin/edit_photo.php?id=88
        // http://localhost/oop/gallery-dev/admin/edit_photo.php
        if(empty($_GET['id'])) 
        {
            // Redirect back to photos
            redirect("photos.php");
        }
        else
        {
            // Find the photo from the supplied ID
            $id = $_GET['id'];
            $photo = Photo::getRecord($id);

            // If we have pressed "Update", set the $photo variable with its new values
            if(isset($_POST['update']))
            {
                // Check we have a valid record to do this with
                if($photo)
                {
                    $photo->title = $_POST['title'];
                    $photo->caption = $_POST['caption'];
                    $photo->description = $_POST['description'];
                    $photo->alternate_text = $_POST['alt_text'];

                    $photo->save();
                    $session->message("Record {$photo->id} successfully updated");

                    redirect("photos.php");
                }
            }
        }
    ?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <?php include("includes/top_nav.php"); ?>
        <?php include("includes/side_nav.php"); ?>
    </nav>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Edit Photo
                        <small><?php echo $photo->title ?></small>
                    </h1>

                    <!-- When form is submitted (i.e. DELETE / UPDATE) it will refresh page -->
                    <form action="" method="post">

                        <!-- Edit record details on LHS of screen -->
                        <div class="col-md-8">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" value="<?php echo $photo->title; ?>" required>
                            </div>

                            <div class="form-group">
                                <a class="thumbnail" href="#"><img src="<?php echo $photo->picturePath(); ?>" alt=""></a>
                            </div>

                            <div class="form-group">
                                <label for="caption">Caption</label>
                                <input type="text" name="caption" class="form-control" value="<?php echo $photo->caption; ?>">
                            </div>

                            <div class="form-group">
                                <label for="alt_text">Alternate Text</label>
                                <input type="text" name="alt_text" class="form-control" value="<?php echo $photo->alternate_text; ?>">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="" cols="30" rows="10"><?php echo $photo->description; ?></textarea>
                            </div>

                        </div>

                        <!-- View record details on RHS of screen -->
                        <div class="col-md-4" >

                            <div class="photo-info-box">

                                <div class="info-box-header">
                                   <h4>Photo Details<span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                </div>

                                <div class="inside">

                                    <div class="box-inner">
                                        <p class="text"><span class="glyphicon glyphicon-calendar"></span>Uploaded on: </p>
                                        <p class="text">Photo Id: <span class="data photo_id_box"><?php echo $photo->id; ?></span></p>
                                        <p class="text">File Name: <span class="data"><?php echo $photo->filename; ?></span></p>
                                        <p class="text">File Type: <span class="data"><?php echo $photo->type; ?></span></p>
                                        <p class="text">File Size: <span class="data"><?php echo $photo->size; ?></span></p>
                                    </div>

                                    <div class="info-box-footer clearfix">

                                        <div class="info-box-delete pull-left">
                                            <a href="delete_photo.php?id=<?php echo $photo->id; ?>" class="delete_link btn btn-danger btn-lg">Delete</a>
                                        </div>

                                        <div class="info-box-update pull-right ">
                                            <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
