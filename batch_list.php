<?php require_once("./layout/header.php") ?>

<h2 class="title">Batch</h2>
<div class="card me-4">
    <div class="card-header d-flex justify-content-end">
        <div class="btn btn-success" onclick="location.replace('add_batch.php')">Add New Batch</div>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Fees</th>
                    <th>Descriptioin</th>
                    <th>Class Name</th>
                    <th>Teacher Name</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                 <?php $i=1; $joinTable = join_with_class_teacher($mysqli);
                   if(isset($_POST['search'])){
                    // var_dump($_POST['search']);
                    $search = $_POST['search'];
                    $joinTable =   search_batch_with_class_teacher($mysqli,$search);
                };
                while($result = $joinTable->fetch_assoc()){?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $result["batch_name"] ?></td>
                    <td><?= date("Y-m-d", strtotime($result["start_date"])) ?></td>
                    <td><?= date("Y-m-d", strtotime($result["end_date"])) ?></td>
                    <td><?= $result["fees"] ?></td>
                    <td><?= $result["description"] ?></td>
                    <td><?= $result["CLASS_NAME"] ?></td>
                    <td><?= $result["TEACHER_NAME"] ?></td>
                    <td>
                        <a href="./student_batch_list.php?batch_id=<?=$result["batch_id"]  ?>&class=<?= $result["CLASS_NAME"] ?>" class="btn btn-primary">View stu</a>
                    </td>
                </tr>
               <?php $i++;  } ?>
                
            </tbody>
        </table>
    </div>
</div>
<?php require_once("./layout/footer.php") ?>
