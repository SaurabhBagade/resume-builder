<?php
$title = "My Resumes | Resume Builder";
require './assets/includes/header.php';
require "./assets/includes/navbar.php";
$fn->authPage();
$user = $db->query("SELECT full_name, email from users where id='" . $fn->Auth()['id'] . "'");
$user = $user->fetch_assoc();
?>

<div class="container">

    <div class="bg-white rounded shadow p-2 mt-4">
        <div class="d-flex justify-content-between border-bottom">
            <h5>Edit Profile</h5>
            <div>
                <a class="text-decoration-none" href="myresumes.php"><i class="bi bi-arrow-left-circle"></i>
                    Back</a>
            </div>
        </div>

        <div>

            <form class="row g-3 p-3" action="./actions/update-profile.action.php" method="post">

                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" placeholder="Dev Ninja" class="form-control" required
                        value="<?= @$user['full_name'] ?>" name="full_name">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" placeholder="dev@abc.com" class="form-control" required
                        value="<?= @$user['email'] ?>" name="email">
                </div>
                <div class="col-12">
                    <label class="form-label">New Password</label>
                    <input type="text" class="form-control" name="password">
                </div>




                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Update
                        Profile</button>
                </div>
            </form>
        </div>





    </div>

    <?php
    require './assets/includes/footer.php';
    ?>