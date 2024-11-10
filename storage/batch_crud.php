<?php
    function add_batch($mysqli,$batch_name,$start_date,$end_date,$fees,$description,$teacher_id,$class_id){
        $sql = "INSERT INTO `batch`(`batch_name`,`start_date`,`end_date`,`fees`,`description`,`teacher_id`,`class_id`) VALUES ('$batch_name','$start_date','$end_date','$fees','$description','$teacher_id','$class_id')";
        return $mysqli->query($sql);
    }
    function get_all_batch($mysqli){
    $sql = "SELECT * FROM `batch`";
    return $mysqli->query($sql);
    } 
    function get_batch_with_id($mysqli,$batch_id){
    $sql = "SELECT * FROM `batch` WHERE `batch_id` = $batch_id ";
    $batch =  $mysqli->query($sql);
    return $batch->fetch_assoc();
    } 
    function update_batch($mysqli,$batch_id,$batch_name,$start_date,$end_date,$fees,$description,$teacher_id,$class_id){
        $sql = "UPDATE `batch`  SET `batch_name` ='$batch_name',`start_date` = '$start_date', `end_date` = $end_date, `fees` = '$fees',`description` = '$description',`teacher_id` = '$teacher_id',`class_id` = '$class_id'  WHERE `batch_id` = $batch_id"; 
        // $batch =  $mysqli->query($sql);
        return  $mysqli->query($sql);
    }
    function delete_batch($mysqli,$batch_id){
        $sql = "DELETE FROM `batch` WHERE `batch_id` = $batch_id";
        return $mysqli->query($sql);
    }

    function count_batch($mysqli){
        $sql = "SELECT COUNT(`batch_id`) as number_of_batch FROM `batch`";
        return $mysqli->query($sql);
    }
    function join_with_class_teacher($mysqli){
     $sql =  "SELECT batch.*, class.class_name as CLASS_NAME, teacher.teacher_name as TEACHER_NAME FROM `batch` join class on batch.class_id = class.class_id join teacher on batch.teacher_id = teacher.teacher_id;";
     return $mysqli->query($sql);
    }
    function get_last_batch_with_class_id($mysqli,$class_id){
        $sql = "SELECT * FROM batch b join class c on b.class_id = c.class_id where b.class_id = $class_id ORDER by b.batch_id DESC LIMIT 1";
        $class_id =  $mysqli->query($sql);
        return $class_id->fetch_assoc();
    }
    function get_last_student_batch_id($mysqli,$student_id){
        $sql ="SELECT * FROM `student_batch` where student_id = $student_id  ORDER BY student_batch_id DESC LIMIT 1";
        $student_batch_id =  $mysqli->query($sql);
        return $student_batch_id->fetch_assoc();
    }
    function delete_last_student_batch_id($mysqli,$last_student_batch_id,$batch_id){
        $sql = "DELETE  FROM student_batch where student_batch_id = $last_student_batch_id and batch_id = $batch_id";
        return $mysqli->query($sql);
    }
    function delete_last_attendance($mysqli,$last_student_batch_id){
        $sql = "DELETE FROM attendance where student_batch_id = $last_student_batch_id";
        return $mysqli->query($sql);
    }
    function get_unique_name($mysqli,$batch_name){
        $sql = "SELECT batch_name FROM `batch` WHERE batch_name LIKE '%$batch_name%'";
        $student_batch_id =  $mysqli->query($sql);
        return $student_batch_id->fetch_assoc();
    }
    function search_batch_with_class_teacher($mysqli,$search){
        $sql =  "SELECT batch.*, class.class_name as CLASS_NAME, teacher.teacher_name as TEACHER_NAME FROM `batch` join class on batch.class_id = class.class_id join teacher on batch.teacher_id = teacher.teacher_id WHERE batch_name LIKE '%$search%' OR teacher_name LIKE '%$search%' OR class_name LIKE '%$search%' OR fees LIKE '%$search%' OR start_date LIKE '%$search%' OR end_date LIKE '%$search%'";
        return $mysqli->query($sql);
       }