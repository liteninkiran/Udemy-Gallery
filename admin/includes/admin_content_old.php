
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Admin
                    <small>Subheading</small>
                </h1>

                <?php

/*
                    // Return all Photos
                    echo '<h3>Return all photos:</h3>';
                    $photos = Photo::getRecords(10, 0, 'size, id');
                    foreach($photos as $p)
                    {
                        echo '<li>' . $p->id . ' - ' . $p->title . ' (' . $p->filename . ' - ' . $p->size . ')</li>';
                    }

                    // Return one Photo
                    echo '<br><br><h3>Return one Photo:</h3>';
                    $photo = Photo::getRecord(81);
                    echo '<li>' . $photo->id . ' - ' . $photo->title . ' (' . $photo->filename . ' - ' . $photo->size . ')</li>';

                    // Create new Photo
                    $photo = new Photo();

                    $photo->title = "Title";
                    $photo->caption = "Caption";
                    $photo->description = "Description";
                    $photo->filename = "File Name";
                    $photo->alternate_text = "Alt Text";
                    $photo->type = "Type";
                    $photo->size = 99;

                    echo '<br><br><h3>Create new Photo:</h3>';
                    $photo->save();
                    echo '<li>' . $photo->id . ' - ' . $photo->title . ' (' . $photo->filename . ' - ' . $photo->size . ')</li>';

                    // Update Photo
                    $photo->title = "New Title";

                    echo '<br><br><h3>Update Photo:</h3>';
                    $photo->save();
                    echo '<li>' . $photo->id . ' - ' . $photo->title . ' (' . $photo->filename . ' - ' . $photo->size . ')</li>';

                    // Return all Photos
                    echo '<br><br><h3>Return all photos:</h3>';
                    $photos = Photo::getRecords(10, 0, 'size, id');
                    foreach($photos as $p)
                    {
                        echo '<li>' . $p->id . ' - ' . $p->title . ' (' . $p->filename . ' - ' . $p->size . ')</li>';
                    }

                    // Delete Photo
                    echo '<br><br><h3>Delete Photo:</h3>';
                    $message = '<li> (' . $photo->id . ') ' . $photo->title . ' - ' . $photo->filename . ' - DELETED!</li>';
                    $photo->delete();
                    echo $message;

                    // 
                    echo '<br><br>';
*/

                    // Return all Users
                    echo '<h3>Return all users:</h3>';
                    $users = User::getRecords();
                    foreach($users as $u)
                    {
                        echo '<li> (' . $u->id . ') ' . $u->first_name . ' ' . $u->last_name . '</li>';
                    }

                    // Return one User
                    echo '<br><br><h3>Return one user:</h3>';
                    $user = User::getRecord(167);
                    echo '<li> (' . $user->id . ') ' . $user->first_name . ' ' . $user->last_name . '</li>';

                    // Create new user
                    $user = new User();

                    $user->username = "test.person";
                    $user->password = "password1";
                    $user->first_name = "Test";
                    $user->last_name = "Person";

                    echo '<br><br><h3>Create new user:</h3>';
                    $user->save();
                    echo '<li> (' . $user->id . ') ' . $user->first_name . ' ' . $user->last_name . '</li>';

                    // Update user
                    $user->first_name = "Mary";

                    echo '<br><br><h3>Update user:</h3>';
                    $user->save();
                    echo '<li> (' . $user->id . ') ' . $user->first_name . ' ' . $user->last_name . '</li>';

                    // Return all Users
                    echo '<br><br><h3>Return all users:</h3>';
                    $users = User::getRecords();
                    foreach($users as $u)
                    {
                        echo '<li> (' . $u->id . ') ' . $u->first_name . ' ' . $u->last_name . '</li>';
                    }

                    // Delete user
                    echo '<br><br><h3>Delete user:</h3>';
                    $message = '<li> (' . $user->id . ') ' . $user->first_name . ' ' . $user->last_name . ' - DELETED!</li>';
                    $user->delete();
                    echo $message;

                    // 
                    echo '<br><br>';

                ?>

            </div>
        </div>
    </div>
