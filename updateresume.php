<?php
$title = "Create Resume | Resume Builder";
require './assets/includes/header.php';
require "./assets/includes/navbar.php";
$fn->authPage();
$authId = $fn->Auth()['id'];
$slug = $_GET["resume"] ?? "";
$resumes = $db->query("SELECT * from resumes where (slug = '$slug' and user_id =" . $authId . ")");
$resume = $resumes->fetch_assoc();
if (!$resume) {
    $fn->redirect("myresumes.php");
}
$exps = $db->query("SELECT * from experience where (resume_id =" . $resume['id'] . ")");
$exps = $exps->fetch_all(1);

$skills = $db->query("SELECT * from skills where (resume_id =" . $resume['id'] . ")");
$skills = $skills->fetch_all(1);

$education = $db->query("SELECT * from education where (resume_id =" . $resume['id'] . ")");
$education = $education->fetch_all(1);
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

            <form class="row g-3 p-3" action="actions/update-resume.action.php" method="post">
                <input type="number" hidden value="<?= $resume["id"] ?>" name="id" />
                <input type="text" hidden value="<?= $resume["slug"] ?>" name="slug" />
                <div class="col-md-6">
                    <label class="form-label">Resume Title</label>
                    <input type="text" placeholder="Web Dev" class="form-control" name="resume_title" required
                        value="<?= @$resume["resume_title"] ?>">
                </div>
                <h5 class="mt-3 text-secondary"><i class="bi bi-person-badge"></i> Personal Information</h5>
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" placeholder="Dev Ninja" class="form-control" name="full_name" required
                        value="<?= @$resume["full_name"] ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" placeholder="abc@media.com" class="form-control" name="email" required
                        value="<?= @$resume["email"] ?>">

                </div>
                <div class="col-md-12">
                    <label class="form-label">Objective</label>
                    <textarea class="form-control" name="objective" required><?= @$resume["objective"] ?></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Mobile No</label>
                    <input type="number" min="1111111111" placeholder="9569569569" max="9999999999" name="mobile"
                        value="<?= @$resume["mobile"] ?>" required class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date Of Birth</label>
                    <input type="date" class="form-control" name="dob" required value="<?= @$resume["dob"] ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Gender</label>
                    <select class="form-select" name="gender" required>
                        <option <?= ($resume['gender'] == "Male" ? "selected" : "") ?>>Male</option>
                        <option <?= ($resume['gender'] == "Female" ? "selected" : "") ?>>Female</option>
                        <option <?= ($resume['gender'] == "Transgender" ? "selected" : "") ?>>Transgender</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Religion</label>
                    <select class="form-select" name="religion" required>
                        <option <?= ($resume['religion'] == "Hindu" ? "selected" : "") ?>>Hindu</option>
                        <option <?= ($resume['religion'] == "Muslim" ? "selected" : "") ?>>Muslim</option>
                        <option <?= ($resume['religion'] == "Sikh" ? "selected" : "") ?>>Sikh</option>
                        <option>Christian</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nationality</label>
                    <select class="form-select" name="nationality" required>
                        <option <?= ($resume['nationality'] == "Indian" ? "selected" : "") ?>>Indian</option>
                        <option <?= ($resume['nationality'] == "Non Indian" ? "selected" : "") ?>>Non Indian</option>


                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Marital Status</label>
                    <select class="form-select" name="marital_status" required>
                        <option <?= ($resume['marital_status'] == "Married" ? "selected" : "") ?>>Married</option>
                        <option <?= ($resume['marital_status'] == "Single" ? "selected" : "") ?>>Single</option>
                        <option <?= ($resume['marital_status'] == "Divorced" ? "selected" : "") ?>>Divorced</option>

                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Hobbies</label>
                    <input type="text" placeholder="Reading Books, Watching Movies" class="form-control" name="hobbies"
                        value="<?= @$resume["hobbies"] ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Languages Known</label>
                    <input type="text" placeholder="Hindi,English" value="<?= @$resume["languages"] ?>"
                        class="form-control" name="languages" required>
                </div>

                <div class="col-12">
                    <label for="inputAddress" class="form-label"> Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address"
                        value="<?= @$resume["address"] ?>" required>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <h5 class=" text-secondary"><i class="bi bi-briefcase"></i> Experience</h5>
                    <div>
                        <a class="text-decoration-none" data-toggle="modal" data-target="#addExp"><i
                                class="bi bi-file-earmark-plus"></i> Add New</a>
                    </div>
                </div>

                <div class="d-flex flex-wrap">

                    <?php
                    if ($exps) {
                        foreach ($exps as $exp) {
                            ?>
                            <div class="col-12 col-md-6 p-2">
                                <div class="p-2 border rounded">
                                    <div class="d-flex justify-content-between">
                                        <h6>
                                            <?= @$exp["position"] ?>
                                        </h6>
                                        <a
                                            href="actions/delete-experience.action.php?id=<?= $exp['id'] ?>&resume_id=<?= $exp['resume_id'] ?>&slug=<?= $resume['slug'] ?>"><i
                                                class="bi bi-x-lg"></i></a>
                                    </div>

                                    <p class="small text-secondary m-0" style="">
                                        <i class="bi bi-buildings"></i>
                                        <?= @$exp["company"] ?>
                                        (
                                        <?= @$exp["started"] ?>
                                        -
                                        <?= @$exp["ended"] ?>
                                        )
                                    </p>
                                    <p class="small text-secondary m-0" style="">
                                        <?= @$exp["job_desc"] ?>

                                    </p>

                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="col-6 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6>No Experience Added</h6>

                                </div>
                                <p class="small text-secondary m-0" style="">
                                    If you have experience you can add it !
                                </p>

                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>

                <hr>
                <div class="d-flex justify-content-between">
                    <h5 class=" text-secondary"><i class="bi bi-journal-bookmark"></i> Education</h5>
                    <div>
                        <a class="text-decoration-none" data-toggle="modal" data-target="#addEdu"><i
                                class="bi bi-file-earmark-plus"></i> Add New</a>
                    </div>
                </div>

                <div class="d-flex flex-wrap">


                    <?php
                    if ($education) {
                        foreach ($education as $edu) {
                            ?>
                            <div class="col-12 col-md-6 p-2">
                                <div class="p-2 border rounded">
                                    <div class="d-flex justify-content-between">
                                        <h6>
                                            <?= @$edu["course"] ?>
                                        </h6>
                                        <a
                                            href="actions/delete-education.action.php?id=<?= $edu['id'] ?>&resume_id=<?= $edu['resume_id'] ?>&slug=<?= $resume['slug'] ?>"><i
                                                class="bi bi-x-lg"></i></a>
                                    </div>

                                    <p class="small text-secondary m-0" style="">
                                        <i class="bi bi-book"></i>
                                        <?= @$edu["institute"] ?>
                                    </p>
                                    <p class="small text-secondary m-0" style="">
                                        (
                                        <?= @$edu["started"] ?>
                                        -
                                        <?= @$edu["ended"] ?>
                                        )
                                    </p>

                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="col-6 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6>No Education Added</h6>

                                </div>
                                <p class="small text-secondary m-0" style="">
                                    If you have education you can add it !
                                </p>

                            </div>
                        </div>
                        <?php
                    }
                    ?>


                </div>

                <hr>
                <div class="d-flex justify-content-between">
                    <h5 class=" text-secondary"><i class="bi bi-boxes"></i> Skills</h5>
                    <div>
                        <a class="text-decoration-none" data-toggle="modal" data-target="#addSkills"><i
                                class="bi bi-file-earmark-plus"></i> Add New</a>
                    </div>
                </div>
                <div class="d-flex flex-wrap">
                    <?php
                    if ($skills) {
                        foreach ($skills as $skill) {
                            ?>
                            <div class="col-12 p-2">
                                <div class="p-2 border rounded">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6><i class="bi bi-caret-right"></i>
                                            <?= @$skill["skills"] ?>
                                        </h6>
                                        <a
                                            href="actions/delete-skills.action.php?id=<?= $skill['id'] ?>&resume_id=<?= $skill['resume_id'] ?>&slug=<?= $resume['slug'] ?>"><i
                                                class="bi bi-x-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="col-6 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6>No Skills Added</h6>

                                </div>
                                <p class="small text-secondary m-0" style="">
                                    If you have skills you can add it !
                                </p>

                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Update
                        Resume</button>
                </div>
            </form>
        </div>





    </div>

    <!-- Modal Experience -->
    <div class="modal fade" id="addExp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Experience</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="actions/add-experience.action.php">
                        <input type="number" hidden value="<?= $resume["id"] ?>" name="resume_id" />
                        <input type="text" hidden value="<?= $resume["slug"] ?>" name="slug" />
                        <div class="form-row g-3">
                            <div class="form-group col-12 my-2">
                                <label for="inputEmail4">Position / Job Role</label>
                                <input type="text" class="form-control" id="inputEmail4"
                                    placeholder="Web Developer Consultant (2+ Years)" name="position" required>
                            </div>
                            <div class="form-group col-12 my-2">
                                <label for="inputPassword4">Company</label>
                                <input type="text" class="form-control" id="inputPassword4"
                                    placeholder="Dominos,New Delhi" name="company" required>
                            </div>
                            <div class="form-group col-6 my-2">
                                <label for="joined">Joined At </label>
                                <input type="text" class="form-control" id="joined" placeholder="October,2021"
                                    name="started" required>
                            </div>
                            <div class="form-group col-6 my-2">
                                <label for="resigned">Resigned At</label>
                                <input type="text" class="form-control" id="resigned" placeholder="Current" name="ended"
                                    required>
                            </div>
                            <div class="form-group col-12 my-2">
                                <label for="jobDesc">Job Description</label>
                                <textarea class="form-control" id="jobDesc"
                                    placeholder="Handling customers and fulfilling their needs" name="job_desc"
                                    required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="my-2 btn btn-primary float-end">Add Experience</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Experience -->


    <!-- Modal Education -->
    <div class="modal fade" id="addEdu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Education</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="actions/add-education.action.php">
                        <input type="number" hidden value="<?= $resume["id"] ?>" name="resume_id" />
                        <input type="text" hidden value="<?= $resume["slug"] ?>" name="slug" />
                        <div class="form-row g-3">
                            <div class="form-group col-12 my-2">
                                <label for="inputEmail4">Course / Degree</label>
                                <input type="text" class="form-control" id="inputEmail4"
                                    placeholder="Completed 12th Class (Arts Stream)" name="course" required>
                            </div>
                            <div class="form-group col-12 my-2">
                                <label for="inputPassword4">Institute / Board</label>
                                <input type="text" class="form-control" id="inputPassword4"
                                    placeholder="Central Board Of Secondary Education, New Delhi" name="institute"
                                    required>
                            </div>
                            <div class="form-group col-6 my-2">
                                <label for="joined">Started At </label>
                                <input type="text" class="form-control" id="joined" placeholder="October,2021"
                                    name="started" required>
                            </div>
                            <div class="form-group col-6 my-2">
                                <label for="resigned">Ended At</label>
                                <input type="text" class="form-control" id="resigned" placeholder="Current" name="ended"
                                    required>
                            </div>
                        </div>
                        <button type="submit" class="my-2 btn btn-primary float-end">Add Education</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Experience -->

    <!-- Modal Skills -->
    <div class="modal fade" id="addSkills" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Skills</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="actions/add-skill.action.php">
                        <input type="number" hidden value="<?= $resume["id"] ?>" name="resume_id" />
                        <input type="text" hidden value="<?= $resume["slug"] ?>" name="slug" />
                        <div class="form-row g-3">
                            <div class="form-group col-12 my-2">
                                <label for="inputEmail4">Skill</label>
                                <input type="text" class="form-control" id="inputEmail4"
                                    placeholder=" Basic Knowledge in Computer & Internet" name="skills" required>
                            </div>
                        </div>
                        <button type="submit" class="my-2 btn btn-primary float-end">Add Skill</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Experience -->
    <?php
    require './assets/includes/footer.php';
    ?>