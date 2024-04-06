<?php
$title = "Create Resume | Resume Builder";
require './assets/includes/header.php';
require "./assets/includes/navbar.php";
$fn->authPage();
?>


<div class="container">

    <div class="bg-white rounded shadow p-2 mt-4" style="min-height:80vh">
        <div class="d-flex justify-content-between border-bottom">
            <h5>Create Resume</h5>
            <div>
                <a class="text-decoration-none" href="myresumes.php"><i class="bi bi-arrow-left-circle"></i>
                    Back</a>
            </div>
        </div>

        <div>

            <form class="row g-3 p-3" action="actions/create-resumes.action.php" method="post">
                <div class="col-md-6">
                    <label class="form-label">Resume Title</label>
                    <input type="text" placeholder="Web Dev" class="form-control" name="resume_title" required
                        value="resume<?= time() ?>">
                </div>
                <h5 class="mt-3 text-secondary"><i class="bi bi-person-badge"></i> Personal Information</h5>
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" placeholder="XYZ" class="form-control" name="full_name" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" placeholder="abc@media.com" class="form-control" name="email" required>

                </div>
                <div class="col-md-12">
                    <label class="form-label">Objective</label>
                    <textarea class="form-control" name="objective" required></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Mobile No</label>
                    <input type="number" min="1111111111" placeholder="9569569569" max="9999999999" name="mobile"
                        required class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date Of Birth</label>
                    <input type="date" class="form-control" name="dob" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Gender</label>
                    <select class="form-select" name="gender" required>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Transgender</option>




                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Religion</label>
                    <select class="form-select" name="religion" required>
                        <option>Hindu</option>
                        <option>Muslim</option>
                        <option>Sikh</option>
                        <option>Christian</option>



                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nationality</label>
                    <select class="form-select" name="nationality" required>
                        <option>Indian</option>
                        <option>Non Indian</option>


                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Marital Status</label>
                    <select class="form-select" name="marital_status" required>
                        <option>Married</option>
                        <option>Single</option>
                        <option>Divorced</option>

                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Hobbies</label>
                    <input type="text" placeholder="Reading Books, Watching Movies" class="form-control" name="hobbies"
                        required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Languages Known</label>
                    <input type="text" placeholder="Hindi,English" class="form-control" name="languages" required>
                </div>

                <div class="col-12">
                    <label for="inputAddress" class="form-label"> Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address"
                        required>
                </div>
        </div>



        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Add
                Resume</button>
        </div>
        </form>
    </div>





</div>

<?php
require './assets/includes/footer.php';
?>