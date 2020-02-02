    <?php

        include("includes/header.php");
        include("includes/photo_library_modal.php");

        // Redirect if we are not logged in
        if(!$session->isSignedIn())
        {
            redirect("login.php");
        }

        // Check we have been suuplied with an ID in the URL
        //
        // http://localhost/oop/gallery-dev/admin/edit_user.php?id=88
        // http://localhost/oop/gallery-dev/admin/edit_user.php
        if(empty($_GET['id'])) 
        {
            // Redirect back to users
            redirect("users.php");
        }
        else
        {
            // Find the user from the supplied ID
            $id = $_GET['id'];
            $user = User::getRecord($id);

            // If we have pressed "Update", set the $user variable with its new values
            if(isset($_POST['update']))
            {
                // Check we have a valid record to do this with
                if($user)
                {
                    $user->username = $_POST['username'];
                    $user->first_name = $_POST['first_name'];
                    $user->last_name = $_POST['last_name'];
                    $user->password = $_POST['password'];

                    if(is_uploaded_file($_FILES['user_image']['tmp_name']))
                    {
                        $user->setFile($_FILES['user_image']);
                        if($user->saveWithImage())
                        {
                            $session->message("Record {$user->id} successfully updated");
                            redirect("users.php");
                        }
                        else
                        {
                            echo join('<br>', $user->errors) . '<br><br>';
                        }
                    }
                    else
                    {
                        if($user->save())
                        {
                            $session->message("Record {$user->id} successfully updated");
                            redirect("users.php");
                        }
                        else
                        {
                            echo join('<br>', $user->errors) . '<br><br>';
                        }

                    }

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
                        Edit User
                        <small><?php echo $user->first_name . ' ' . $user->last_name ?></small>
                    </h1>

                    <!-- User Image -->
                    <div class="col-md-4 user_image_box">
                        <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="<?php echo $user->picturePath(); ?>" alt=""></a>
                    </div>

                    <!-- When form is submitted (i.e. DELETE / UPDATE) it will refresh page -->
                    <form action="" method="post" enctype="multipart/form-data">

                        <!-- Edit record details on LHS of screen -->
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="username">User Name</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" value="<?php echo $user->password; ?>" required>
                            </div>

                            <div class="form-group">
                                <input type="file" name="user_image">
                            </div>

                        </div>

                        <!-- View record details on RHS of screen -->
                        <div class="col-md-4" >
                            <div class="photo-info-box">

                                <div class="info-box-header">
                                   <h4>User Details<span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                </div>

                                <div class="inside">

                                    <div class="box-inner">
                                        <p class="text"><span class="glyphicon glyphicon-calendar"></span>Uploaded on: </p>
                                        <p class="text">User Id: <span class="data photo_id_box"><?php echo $user->id; ?></span></p>
                                        <p class="text">User Name: <span class="data"><?php echo $user->username; ?></span></p>
                                        <p class="text">First Name: <span class="data"><?php echo $user->first_name; ?></span></p>
                                        <p class="text">Last Name: <span class="data"><?php echo $user->last_name; ?></span></p>
                                    </div>

                                    <div class="info-box-footer clearfix">

                                        <div class="info-box-delete pull-left">
                                            <a id="user-id" href="delete_user.php?id=<?php echo $user->id; ?>" class="delete_link btn btn-danger btn-lg">Delete</a>
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
