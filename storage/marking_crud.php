<?php
    function add_marking($mysqli,$mark,$student_batch_id,$marking_type_id){
        $sql = "INSERT INTO `marking`(`mark`,`student_batch_id`,`marking_type_id`,`fees`,`description`,`teacher_id`,`class_id`) VALUES ('$mark','$student_batch_id','$marking_type_id')";
        return $mysqli->query($sql);
    }
    function get_all_marking($mysqli){
    $sql = "SELECT * FROM `marking`";
    return $mysqli->query($sql);
    } 
    function get_marking_with_id($mysqli,$marking_id){
    $sql = "SELECT * FROM `marking` WHERE `marking_id` = $marking_id ";
    $marking =  $mysqli->query($sql);
    return $marking->fetch_assoc();
    } 
    function update_marking($mysqli,$marking_id,$mark,$student_batch_id,$marking_type_id){
        $sql = "UPDATE `marking`  SET `mark` ='$mark',`student_batch_id` = '$student_batch_id', `marking_type_id` = $marking_type_id WHERE `marking_id` = $marking_id"; 
        // $marking =  $mysqli->query($sql);
        return  $mysqli->query($sql);
    }
    function delete_marking($mysqli,$marking_id){
        $sql = "DELETE FROM `marking` WHERE `marking_id` = $marking_id";
        return $mysqli->query($sql);
    }
?>