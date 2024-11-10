<?php require_once ("./layout/header.php") ?>

<h2></h2>
<div class="card">
    <div class="card-body">
        <table class="table table-border">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Batch</th>
                    <th>Class</th>
                    <th>Teacher</th>
                    <th>Attendance</th>
                </tr>
            </thead>
            <tbody>
                <?php $detail_list = get_batch_with_student_id($mysqli, $_GET["student_id"]); ?>
                <?php $i = 1;?>
                <?php while ($student = $detail_list->fetch_assoc()) { ?>             
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $student["batch_name"] ?></td>
                    <td><?= $student["class_name"] ?></td>
                    <td><?= $student["teacher_name"] ?></td>
                    <td><a href="./student_attendance.php?student_batch_id=<?= $student["student_batch_id"] ?>" class="btn btn-sm btn-success">attendance</a>
                        </td>
                </tr>                  
                <?php $i++;
                } ?>    
            </tbody>
        </table>
    </div>
</div>
<?php require_once ("./layout/footer.php") ?>