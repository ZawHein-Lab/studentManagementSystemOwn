<?php require_once("./layout/header.php") ?>

<?php $batch_id = $_GET['batch_id'];
// echo $_GET['class'];
$student_list_attendance = get_attendance($mysqli,$_GET["batch_id"]);
if (count($student_list_attendance ->fetch_all()) === 0) {
    $student_data = get_all_student_with_batch_id($mysqli, $batch_id);
    // $student_data = get_date_not_now($mysqli,$batch_id);
    while($std = $student_data->fetch_assoc()) {
        absent_attendance($mysqli, $std['student_batch_id']);
        // $date =$std['date'];
        // $leave = $std['leave'];
        // $present =$std['present'];
        // $attendance_id =$std['attendance_id'];
        // $student_list = update_not_now_date($mysqli,$leave,$present,$attendance_id);
    }
}
if (isset($_GET['present'])) {
    $id = $_GET['present'];
    if (present_attendance($mysqli, $id)) {
        header("Location:./add_attendance_batch.php?batch_id=$_GET[batch_id]");
    } else {
        $message = "Internal server error!";

    }
}

if (isset($_GET['leave'])) {
    $id = $_GET['leave'];
    if (leave_attendance($mysqli, $id)) {
        header("Location:./add_attendance_batch.php?batch_id=$_GET[batch_id]");
    } else {
        $message = "Internal server error!";

    }
}
if (isset($_GET['present_all'])) {
    $student_list = get_all_student_attendance($mysqli, $_GET["batch_id"]);
    while ($std = $student_list->fetch_assoc()) {
        present_attendance($mysqli, $std['attendance_id']);
    }
}
?>


<h2 class="title">Attendance List</h2>

<div class="card">
    <div class="card-header d-flex justify-content-end">
    <a href="./add_attendance_batch.php?batch_id=<?= $_GET["batch_id"] ?>&present_all" class="btn btn-success me-3">Present All</a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Student Name</th>
                    <th>Student Address</th>
                    <th>Student Age</th>
                    <th>Student Email</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php $student_list = get_attendance($mysqli,$_GET["batch_id"]); ?>
                <?php $i = 1;?>
                <?php while ($student = $student_list->fetch_assoc()) {?>           
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $student["student_name"] ?></td>
                    <td><?= $student["student_email"] ?></td>
                    <td><?= $student["student_address"] ?></td>
                    <td><?= $student["student_age"] ?></td>
                    <td>
                        <?php if ($student["present"] == 0 && $student["leave"] == 0) {?>
                            <a href="./add_attendance_batch.php?batch_id=<?= $_GET["batch_id"] ?>&present=<?= $student["attendance_id"] ?>" class="btn btn-success btn-sm">Present</a>
                            <a href="./add_attendance_batch.php?batch_id=<?= $_GET["batch_id"] ?>&leave=<?= $student["attendance_id"] ?>" class="btn btn-warning btn-sm">Leave</a>
                        <?php } else {?>
                            <?php if ($student["present"] === "1") { ?>
                                <p class="text-success">Present</p>
                            <?php } elseif ($student["leave"] === "1") { ?>
                                    <p class="text-warning">Leave</p>
                                <?php } else {?>
                                <p class="text-danger">Absent</p>
                            <?php } ?>
                        <?php } ?>
                    </td>
                </tr>                  
                <?php $i++;
                } ?>    
            </tbody>
        </table>
    </div>
</div>
<?php require_once("./layout/footer.php") ?>