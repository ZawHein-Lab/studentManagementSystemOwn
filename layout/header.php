<?php require_once("./storage/db.php")?>
<?php require_once("./storage/attendance_crud.php") ?>
<?php require_once("./storage/batch_crud.php") ?>
<?php require_once("./storage/class_crud.php") ?>
<?php require_once("./storage/marking_crud.php") ?>
<?php require_once("./storage/marking_type_crud.php") ?>
<?php require_once("./storage/student_batch_crud.php") ?>
<?php require_once("./storage/student_crud.php") ?>
<?php require_once("./storage/teacher_crud.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="assets/js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
       <?php require_once("./layout/sidebar.php") ?>
            <div class="content">
                <nav class="nav-bar">
                    <div class="left-nav">
                        <div class="leftNav-item">
                            <form action="" method="post">
                            <i class="bi bi-search fs-5 ms-2"></i>
                            <input type="text" placeholder="Search" name="search">
                            </form>
                        </div>
                    </div>
                    <div class="right-nav">
                        <div class="dropdown">
                            <div data-bs-toggle="dropdown">
                            <img src="./image/profile.png" >
                            </div>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">My Profile</a></li>
                            <li><a class="dropdown-item " href="#">Logout</a></li> 
                            </ul>
                      </div>
                    </div>
                </nav>