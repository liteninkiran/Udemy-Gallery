    <?php

        include("includes/header.php");

        if(!$session->isSignedIn())
        {
            redirect("login.php");
        }

        $message = "";

        if(isset($_FILES['file']))
        {
            $photo = new Photo();
            $photo->title = $_POST['title'];
            $photo->caption = $_POST['caption'];
            $photo->description = $_POST['description'];
            $photo->alternate_text = $_POST['alt_text'];
            $photo->setFile($_FILES['file']);

            if($photo->save())
            {
                $message = "Photo uploaded successfully";
            }
            else
            {
                $message = join("<br>", $photo->errors);
            }
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
                        Upload
                    </h1>

                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $message; ?>
                            <form action="upload.php" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <input type="text" name="title" class="form-control" placeholder="Enter Title">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="caption" class="form-control" placeholder="Enter Caption">
                                </div>

                                <div class="form-group">
                                    <input type="textarea" name="description" class="form-control" placeholder="Enter Description">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="alt_text" class="form-control" placeholder="Enter Alternative Text">
                                </div>

                                <div class="form-group">
                                    <input type="file" name="file">
                                </div>

                                <input type="submit" name="submit">

                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <form action="upload.php" class="dropzone"></form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
