<?php require_once("./layout/header.php") ?>

<?php 
        $description =  $fees = $end_date = $start_date = $batch_name = $teacher_id = $class_id ="";
        $description_err = $fees_err = $end_date_err = $start_date_err = $batch_name_err =$teacher_id_err = $class_id_err= "";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //form input value
        $batch_name = $_POST['batch_name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $fees = $_POST['fees'];
        $description =  $_POST['description'];
        $class_id = $_POST['class_id'];
        $teacher_id = $_POST['teacher_id'];
        // echo $teacher_id;

        //make validation
        if($description === ""){
            $description_err = "Please enter description ..";
        }
        if($fees === ""){
            $fees_err = "Please enter fees ..";
        }
        if($start_date === ""){
            $start_date_err = "Please enter start date ..";
        }
        if($end_date === ""){
            $end_date_err = "Please enter end date ..";
        }
        if($batch_name === ""){
            $batch_name_err = "Please enter batch name..";
        }
        if($class_id === ""){
            $class_id_err = "Please select class name..";
        }
        if($teacher_id === ""){
            $teacher_id_err = "Please select teacher name..";
        }
        if( $description_err == "" && $fees_err == "" && $end_date_err == "" && $start_date_err == "" && $batch_name_err == "" && $teacher_id_err == "" && $class_id_err== ""){
            // echo "True";
            if(add_batch($mysqli,$batch_name,$start_date,$end_date,$fees,$description,$teacher_id,$class_id)){
                // echo True;
                header("location:batch_list.php");
            }
        }
    }
?>
<h2 class="title" style="text-align: center !important;">Student</h2>
<div class="card w-50 mx-auto">
    <div class="card-header">
        <h4>Add New Batch</h4>
    </div>
    <div class="card-body">
            <form action="" method="post">
                <div class="form-group my-2">
                    <label for="batch_name">Batch Name</label>
                    <input type="text"  name="batch_name" id="batch_name" value="<?= $batch_name ?>"  class="form-control">
                    <span class="text-danger"><?php if($batch_name_err) echo $batch_name_err ?></span>
                </div>
                <div class="form-group my-1 row">
                    <div class="form-group col-6">
                        <label for="teacher_id">Teacher Name</label>
                        <select id="teacher_id" name="teacher_id" class="form-select">
                            <option value="">Select teacher</option>
                            <?php  $teacher_list = get_all_teacher($mysqli); 
                           while($teacher = $teacher_list->fetch_assoc()){ ?>
                            <option value="<?= $teacher['teacher_id'] ?>"  <?php if($teacher['teacher_id'] == $teacher_id) echo "selected" ?>  ><?= $teacher['teacher_name'] ?></option>
                       <?php } ?>
                        </select>
                        <span class="text-danger"><?php if($teacher_id_err) echo $teacher_id_err ?></span>
                    </div>
                    <div class="form-group col-6">
                        <label for="class_id">Class Name</label>
                        <select id="class_id" name="class_id" class="form-select">
                            <option value="">Select class</option>
                            <?php   $class_list = get_all_class($mysqli); 
                           while($class = $class_list->fetch_assoc()){ ?>
                            <option value="<?= $class['class_id'] ?>" <?php if($class['class_id'] == $class_id) echo "selected" ?> ><?= $class['class_name'] ?></option>
                       <?php } ?>
                        </select>
                        <span class="text-danger"><?php if($class_id_err) echo $class_id_err ?></span>
                    </div>
                </div>
                <div class="form-group my-1 row">
                    <div class="form-group col-6">
                        <label for="start_date">Start Date</label>
                        <input type="date" name="start_date" value="<?=$start_date ?>" id="start_date" class="form-control">
                        <span class="text-danger"><?php if($start_date_err) echo $start_date_err ?></span>
                    </div>
                    <div class="form-group col-6">
                        <label for="end_date">End Date</label>
                        <input type="date" name="end_date" value="<?= $end_date ?>" id="end_date" class="form-control">
                        <span class="text-danger"><?php if($end_date_err) echo $end_date_err ?></span>
                    </div>
                </div>
                <div class="form-group my-1">
                    <label for="fees">Fees</label>
                    <input type="number" name="fees" value="<?php $fees ?>" id="fees" class="form-control">
                    <span class="text-danger"><?php if($fees_err) echo $fees_err ?></span>
                </div>
                <div class="form-group my-1">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4" class="form-control"><?= $description ?></textarea>
                    <span class="text-danger"><?php if($description_err) echo $description_err ?></span>
                </div>
                <div class="text-center my-1">
                <button class="btn btn-info" name="submitBtn">Submit</button>
                </div>
            </form>
    </div>
</div>
<?php require_once("./layout/footer.php") ?>
