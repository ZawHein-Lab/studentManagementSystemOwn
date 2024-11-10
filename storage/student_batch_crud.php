<?php

    function add_student_batch($mysqli,$student_id,$batch_id){
        $sql = "INSERT INTO `student_batch`(`student_id`,`batch_id`) values('$student_id','$batch_id')";
        return $mysqli->query($sql);
    }
    function get_student_with_batch_id($mysqli,$batch_id){
        $sql= "SELECT * from student_batch st LEFT JOIN student s on st.student_id = s.student_id WHERE st.batch_id = $batch_id";
        return $mysqli->query($sql);
    }
    function get_student_without_current_batch_id($mysqli,$batch_id){
        $sql = "SELECT * FROM `student` WHERE student_id not IN (SELECT student_id FROM student_batch WHERE batch_id = $batch_id)";
        return $mysqli->query($sql);
                                             
    }
    // function get_all_student_batch($mysqli){
    // $sql = "SELECT * FROM `student_batch`";
    // return $mysqli->query($sql);
    // }
    // function get_student_batch_with_id($mysqli,$student_batch_id){
    // $sql = "SELECT * FROM `student_batch` WHERE `student_batch_id` = $student_batch_id ";
    // $student_batch =  $mysqli->query($sql);
    // return $student_batch->fetch_assoc();
    // } 
    // function update_student_batch($mysqli,$student_batch_id,$student_batch_name,$student_batch_address,$student_batch_age = 12,$student_batch_email){
    //     $sql = "UPDATE `student_batch`  SET `student_batch_name` ='$student_batch_name',`student_batch_address` = '$student_batch_address', `student_batch_age` = $student_batch_age, `student_batch_email` = '$student_batch_email'  WHERE `student_batch_id` = $student_batch_id "; 
    //     // $student_batch =  $mysqli->query($sql);
    //     return  $mysqli->query($sql);
    // }
    // function delete_student_batch($mysqli,$student_batch_id){
    //     $sql = "DELETE FROM `student_batch` WHERE `student_batch_id` = $student_batch_id";
    //     return $mysqli->query($sql);
    // }

    // function count_student_batch($mysqli){
    //     $sql = "SELECT COUNT(`student_batch_id`) as number_of_student_batch FROM `student_batch`";
    //     return $mysqli->query($sql);
    // }
   
   
?>