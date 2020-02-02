    <?php

        include("includes/header.php");

        // Redirect if we are not logged in
        if(!$session->isSignedIn())
        {
            redirect("login.php");
        }

        $user = new User();

        // If we have pressed "Create", set the $user variable with its new values
        if(isset($_POST['create']))
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
                        $session->message("Record {$user->id} successfully created");
                        redirect("users.php");
                    }
                    else
                    {
                        echo join("<br>", $user->errors) . '<br><br>';
                    }
                }
                else
                {
                    $user->save();
                    $session->message("Record {$user->id} successfully created");
                    redirect("users.php");
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
                        Add User
                        <small>Subheading</small>
                    </h1>

                    <!-- When form is submitted (i.e. DELETE / UPDATE) it will refresh page -->
                    <form action="" method="post" enctype="multipart/form-data">

                        <!-- Edit record details on LHS of screen -->
                        <div class="col-md-6 col-md-offset-3">

                            <div class="form-group">
                                <label for="username">User Name</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="user_image">User Image</label>
                                <input type="file" name="user_image">
                            </div>

                            <div class="info-box-update pull-right">
                                <input type="submit" name="create" value="Create" class="btn btn-primary btn-lg">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
