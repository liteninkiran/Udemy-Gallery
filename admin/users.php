    <?php

        include("includes/header.php");

        if(!$session->isSignedIn())
        {
            redirect("login.php");
        }

        $users = User::getRecords();

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
                        Users
                        <a href="add_user.php" class="btn btn-primary">Add User</a>
                    </h1>

                    <p class="bg-success">
                        <?php echo $session->message; ?>
                    </p>

                    <div class="col-md-12">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="80px">ID</th>
                                    <th width="200px" >Photo</th>
                                    <th >User Name</th>
                                    <th >First Name</th>
                                    <th >Last Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user): ?>
                                    <tr>
                                        <td><?php echo $user->id; ?></td>
                                        <td><img class="admin-user-thumbnail" src="<?php echo $user->picturePath(); ?>" alt=""></td>
                                        <td>
                                            <?php echo $user->username; ?>
                                            <div class="action_links">
                                                <a class="delete_link" href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                                                <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a>
                                            </div>
                                        </td>
                                        <td><?php echo $user->first_name; ?></td>
                                        <td><?php echo $user->last_name; ?></td>
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
