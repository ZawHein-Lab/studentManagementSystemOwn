<?php require_once("./layout/header.php") ?>

<?php $batch_id = $_GET['batch_id'];
// echo $batch_id;
$student_id = $student_id_err = "";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $student_id = $_POST['student_id'];
if($student_id === ""){
    $student_id_err = "Please select student";
}
if($student_id_err === ""){
    if(add_student_batch($mysqli,$student_id,$batch_id)){
        $student_batch_data = get_student_batch($mysqli);
        $data =  $student_batch_data->fetch_assoc();
         $student_batch_id = $data['student_batch_id'];
          // var_dump($data['student_batch_id']);
         if(insert_attendance($mysqli,$student_batch_id)){
        //   header("Location:student_batch_list.php?batch_id=$_GET[batch_id]");
          header("Location:student_batch_list.php?batch_id=$_GET[batch_id]&class=$_GET[class]");

         }
    //    header("location:student_batch_list.php?batch_id=$batch_id");
    }
}
}
?>

<h2 class="title" style="text-align: center !important;">Student</h2>
<div class="card w-50 mx-auto">
    <div class="card-header">
        <h4>Add Student With Batch Id</h4>
    </div>
    <div class="card-body">
            <form action="" method="post">
                <div class="form-group my-2">
                    <label for="name">Experience</label>
                    <select id="student_id" name="student_id" class="form-select">
                            <option value="">Select student</option>
                            <?php  $student_list = get_student_without_current_batch_id($mysqli,$batch_id); 
                           while($student = $student_list->fetch_assoc()){ ?>
                            <option value="<?= $student['student_id'] ?>"  <?php if($student['student_id'] == $student_id) echo "selected" ?>  ><?php echo $student['student_name'] ?></option>
                       <?php } ?>
                        </select>
                </div>
                <div class="text-center my-2">
                <button class="btn btn-info" name="submitBtn">Submit</button>
                </div>
            </form>
    </div>
</div>
<?php require_once("./layout/footer.php") ?>
