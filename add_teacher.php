<?php require_once("./layout/header.php") ?>

<?php
$teacher_name_err =$teacher_name = $teacher_experience_err= $teacher_experience=$teacher_email = $teacher_email_err = "";
$add_teacher_fail = $upd_teacher_fail = "";
if (isset($_GET['teacher_id'])) {
    $teacher_id = $_GET['teacher_id'];
    $teacher =  get_teacher_with_id($mysqli, $teacher_id);
    // var_dump($teacher);
    $get_teacher_id = $teacher['teacher_id'];
    $teacher_name = $teacher['teacher_name'];
    $teacher_experience = $teacher['teacher_experience'];
    $teacher_email = $teacher['teacher_email'];
}
if (isset($_POST['teacher_name'])) {
    $teacher_name = $_POST['teacher_name'];
    $teacher_experience = $_POST['teacher_experience'];
    $teacher_email = $_POST['teacher_email'];

    if ($teacher_name === "") {
        $teacher_name_err = "Please enter name...";
    }
    if ($teacher_experience === "") {
        $teacher_experience_err = "Please enter experience...";
    }

    if ($teacher_email === "") {
        $teacher_email_err = "Please enter email...";
    }
    if ($teacher_name_err == "" && $teacher_email_err == "" && $teacher_experience_err == "") {
        if (isset($_GET['teacher_id'])) {
            if (update_teacher($mysqli, $teacher_id, $teacher_name, $teacher_experience, $teacher_email)) {
                header("location:teacher_list.php");
            } else {
                $upd_teacher_fail = "Cann't add teacher.Try Again";
            }
        } else {
            if (add_teacher($mysqli, $teacher_name, $teacher_experience, $teacher_email)) {
                header("location: teacher_list.php");
            } else {
                $add_teacher_fail = "Cann't add teacher.Try Again";
            }
        }
    }
}
?>

<h2 class="title" style="text-align: center !important;">Teacher</h2>
<div class="card w-50 mx-auto">
    <div class="card-header">
        <h4>Add New Teacher</h4>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <?php if ($add_teacher_fail) { ?>
                <div class="alert alert-danger">
                    <?= $add_teacher_fail ?>
                </div>
            <?php } ?>
            <?php if ($upd_teacher_fail) { ?>
                <div class="alert alert-danger">
                    <?= $upd_teacher_fail ?>
                </div>
            <?php } ?>
            <div class="form-group my-2">
                <label for="name">Name</label>
                <input type="text" name="teacher_name" id="teacher_name" value="<?=  $teacher_name ?>" class="form-control">
                <?php if ($teacher_name_err !== "") { ?>
                    <span class="text-danger"><?= $teacher_name_err ?></span>
                <?php } ?>
            </div>
            <div class="form-group my-2">
                <label for="name">Experience</label>
                <input type="text" max="100" name="teacher_experience" id="teacher_experience" value="<?=  $teacher_experience ?>" class="form-control">
                <?php if ($teacher_experience_err !== "") { ?>
                    <span class="text-danger"><?= $teacher_experience_err ?></span>
                <?php } ?>
            </div>
            <div class="form-group my-2">
                <label for="email">Email</label>
                <input type="text" name="teacher_email" value="<?= $teacher_email ?>" id="teacher_email" class="form-control">
                <?php if ($teacher_email_err !== "") { ?>
                    <span class="text-danger"><?= $teacher_email_err ?></span>
                <?php } ?>
            </div>
            <div class="text-center my-2">
                <button class="btn btn-info" name="submitBtn">Submit</button>
            </div>
        </form>
    </div>
</div>
<?php require_once("./layout/footer.php") ?>