<?php require_once("./layout/header.php") ?>

<?php
    $number_of_student = count_student($mysqli);
    $student_count = $number_of_student->fetch_assoc();

    $number_of_class = count_class($mysqli);
    $class_count = $number_of_class->fetch_assoc();

    $number_of_teacher = count_teacher($mysqli);
    $teacher_count = $number_of_teacher->fetch_assoc();
    // var_dump();
    // $num_of_student = $number_of_student->fetch_assoc();
    // var_dump($num_of_student->fetch_assoc());
?>
                <h2 class="title">Dashboard</h2>
                <div class="main-content  row justify-content-center">
                    <div class="col-3 circle2 rounded-3  bg-info d-flex align-items-center">
                        <div class="w-35"><i class="bi bi-people-fill"></i></div>
                        <div class="w-55 ms-3">
                            <div class="fs-3"><?= $student_count['number_of_student'] ?></div>
                            <div class="fs-5">Students</div>
                        </div>
                    </div>
                    <div class="col-3 circle2 rounded-3 offset-1  bg-info d-flex align-items-center">
                        <div class="w-35"><i class="bi bi-people-fill"></i></div>
                        <div class="w-55 ms-3">
                            <div class="fs-3"><?= $teacher_count['number_of_teacher'] ?></div>
                            <div class="fs-5">Teachers</div>
                        </div>
                    </div>
                    <div class="col-3 circle2 rounded-3 offset-1  bg-info d-flex align-items-center">
                        <div class="w-35"><i class="bi bi-people-fill"></i></div>
                        <div class="w-55 ms-3">
                            <div class="fs-3"><?= $class_count['number_of_class'] ?></div>
                            <div class="fs-5">Classes</div>
                        </div>
                    </div>
                </div>
<?php require_once("./layout/footer.php") ?>