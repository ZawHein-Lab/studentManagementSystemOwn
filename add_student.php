<?php require_once("./layout/header.php") ?>

<?php
$student_name_err = $student_batch = $student_address_err = $student_age_err = $student_email_err = "";
$add_student_fail = $upd_student_fail = "";
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    // echo $student_id;
    $student =  get_student_with_id($mysqli, $student_id);
    // var_dump($student);
    $get_student_id = $student['student_id'];
    $get_student_name = $student['student_name'];
    $get_student_address = $student['student_address'];
    $get_student_age = $student['student_age'];
    $get_student_email = $student['student_email'];
}

if (isset($_POST['student_name'])) {
    $student_name = $_POST['student_name'];
    $student_age = $_POST['student_age'];
    $student_address = $_POST['student_address'];
    $student_email = $_POST['student_email'];
    $student_batch = $_POST['student_batch'];
    // var_dump($student_batch);
    if ($student_name === "") {
        $student_name_err = "Please enter name...";
    }
    if ($student_address === "") {
        $student_address_err = "Please enter address...";
    }
    if ($student_age === "") {
        $student_age_err = "Please enter age...";
    }
    if ($student_email === "") {
        $student_email_err = "Please enter name...";
    }
    if ($student_name_err == "" && $student_address_err == "" && $student_email_err == "" && $student_age_err == "") {
        //    $name = "this is name";
        //    echo $name; 
        if (isset($_GET['student_id'])) {
            $current_student = $_GET['student_id'];
            if (update_student($mysqli, $current_student, $student_name, $student_address, $student_age, $student_email)) {
                if($student_batch !== ""){
                    // $current_student = get_last_student_id($mysqli);
                    // var_dump($current_student_id['student_id'])."<br>";
                   
                //    var_dump($class_id['batch_id']);
                    $student_batch_id =  get_last_student_batch_id($mysqli,$_GET['student_id']);
                    // var_dump($student_batch_id['student_batch_id']);
                    //  $now = date('Y-m-d');
                    if(delete_last_attendance($mysqli,$student_batch_id['student_batch_id'])){
                        echo "Not Success";
                    }
                   if(delete_last_student_batch_id($mysqli,$student_batch_id['student_batch_id'],$student_batch_id['batch_id'])){
                    $batch =  get_last_batch_with_class_id($mysqli,$student_batch);
                    if( add_student_batch($mysqli,$_GET['student_id'],$batch['batch_id'])){
                        $student_batch_data = get_student_batch($mysqli);
                        $data =  $student_batch_data->fetch_assoc();
                        $student_batch_id = $data['student_batch_id'];
                        // // var_dump($data['student_batch_id']);
                        if(insert_attendance($mysqli,$student_batch_id)){
                        // // header("Location:student_batch_list.php?batch_id=$_GET[batch_id]");
                        header("location: student_list.php");
                        }
                    }
                } else{
                header("location: student_list.php");
                } 
            } else {
                $upd_student_fail = $mysqli->error;
            }}
        } else {
            if (add_student($mysqli, $student_name, $student_address, $student_age, $student_email)) {

                if ($student_batch !== "") {
                    $current_student = get_last_student_id($mysqli);
                    // var_dump($current_student_id['student_id'])."<br>";
                    $batch =  get_last_batch_with_class_id($mysqli, $student_batch);
                    //    var_dump($class_id['batch_id']);
                    if (add_student_batch($mysqli, $current_student['student_id'], $batch['batch_id'])) {
                        $student_batch_data = get_student_batch($mysqli);
                        $data =  $student_batch_data->fetch_assoc();
                        $student_batch_id = $data['student_batch_id'];
                        // var_dump($data['student_batch_id']);
                        if (insert_attendance($mysqli, $student_batch_id)) {
                            // header("Location:student_batch_list.php?batch_id=$_GET[batch_id]");
                            header("location: student_list.php");
                        }
                    }
                } else {
                    header("location: student_list.php");
                }
            } else {
                $add_student_fail = $mysqli->error;
            }
        }
    }
}
?>

<h2 class="title" style="text-align: center !important;">Student</h2>
<div class="card w-50 mx-auto">
    <div class="card-header">
        <h4>Add New Student</h4>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <?php if ($add_student_fail) { ?>
                <div class="alert alert-danger">
                    <?php echo $add_student_fail ?>
                </div>
            <?php } ?>
            <?php if ($upd_student_fail) { ?>
                <div class="alert alert-danger">
                    <?= $upd_student_fail ?>
                </div>
            <?php } ?>
            <div class="form-group my-2">
                <label for="name">Name</label>
                <input type="text" name="student_name" id="student_name" value="<?php if (isset($get_student_name)) {
                                                                                    echo $get_student_name;
                                                                                } ?>" class="form-control">
                <?php if ($student_name_err !== "") { ?>
                    <span class="text-danger"><?= $student_name_err ?></span>
                <?php } ?>
            </div>
            <div class="form-group my-2">
                <label for="address">Address</label>
                <input type="text" name="student_address" value="<?php if (isset($get_student_address)) {
                                                                        echo $get_student_address;
                                                                    } ?>" id="student_address" class="form-control">
                <?php if ($student_address_err !== "") { ?>
                    <span class="text-danger"><?= $student_address_err ?></span>
                <?php } ?>
            </div>
            <div class="row">
                <div class="form-group col-6">
                    <label for="age">Age</label>
                    <input type="number" name="student_age" value="<?php if (isset($get_student_age)) {
                                                                        echo $get_student_age;
                                                                    } ?>" id="student_age" class="form-control">
                    <?php if ($student_age_err !== "") { ?>
                        <span class="text-danger"><?= $student_age_err ?></span>
                    <?php } ?>
                </div>
                <div class="form-group col-6">
                    <label for="class">Class</label>
                    <select name="student_batch" id="student_batch" class="form-select">
                        <option value="">Select Class</option>
                        <?php $class_list = get_class_from_batch($mysqli);
                        // var_dump($class_list->fetch_assoc());
                        while ($class = $class_list->fetch_assoc()) { ?>
                            <option value="<?php echo $class['class_id']; ?>" <?php if ($class['class_id'] == $student_batch)  echo "selected"; ?>><?= $class['class_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group my-2">
                <label for="email">Email</label>
                <input type="text" name="student_email" value="<?php if (isset($get_student_email)) {
                                                                    echo $get_student_email;
                                                                } ?>" id="student_email" class="form-control">
                <?php if ($student_email_err !== "") { ?>
                    <span class="text-danger"><?= $student_email_err ?></span>
                <?php } ?>
            </div>
            <div class="text-center my-2">
                <button class="btn btn-info" name="submitBtn">Submit</button>
            </div>
        </form>
    </div>
</div>
<?php require_once("./layout/footer.php") ?>