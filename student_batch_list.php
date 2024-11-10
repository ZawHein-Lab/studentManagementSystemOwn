<?php require_once("./layout/header.php") ?>

<?php $batch_id = $_GET['batch_id'];?>
<?php $end = get_batch_end_date($mysqli, $_GET["batch_id"]);
$compare_date = $end->fetch_assoc();
$end_date = $compare_date['end_date'];
// var_dump($end_date);
$now = date('Y-m-d H:i:s');
// var_dump($now);
$start = get_batch_start_date($mysqli, $_GET["batch_id"]);
$compate_start_date = $start->fetch_assoc();
$start_date = $compate_start_date['start_date'];
$addedTwoWeek = date('Y-m-d H:i:s', strtotime($start_date . ' + 14 days'));
// var_dump($addedTwoWeek);
?>

<h2 class="title">Student Batch List</h2>

<div class="card">
    <div class="card-header d-flex justify-content-end">
    <div class="card-header d-flex justify-content-end">
        <?php if ($now < $end_date) { ?>
            <div class="btn btn-info" onclick="location.replace('add_attendance_batch.php?batch_id=<?= $batch_id ?>')">Add Attendance</div>

        <?php } ?>
        <?php if ($now < $addedTwoWeek) { ?>
            <div class="btn btn-success" onclick="location.replace('add_student_with_batch_id.php?batch_id=<?= $batch_id; ?>')">Add Student</div>
        <?php } ?>
    </div>
       
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
                </tr>
            </thead>
            <tbody>
            <?php $student_list = get_student_with_batch_id($mysqli,$batch_id); 
            $i= 1;
            while( $student_batch_list = $student_list->fetch_assoc()){?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?=  $student_batch_list ['student_name']?></td>
                    <td><?=  $student_batch_list ['student_address']?></td>
                    <td><?=  $student_batch_list ['student_age']?></td>
                    <td><?=  $student_batch_list ['student_email']?></td>
                </tr>
                <?php $i++; } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once("./layout/footer.php") ?>
