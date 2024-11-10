<?php

function add_student($mysqli, $student_name, $student_address, $student_age, $student_email)
{
    $sql = "INSERT INTO `student`(`student_name`,`student_address`,`student_age`,`student_email`) VALUES ('$student_name','$student_address',$student_age,'$student_email')";
    return $mysqli->query($sql);
}
function get_all_student($mysqli)
{
    $sql = "SELECT * FROM `student`";
    return $mysqli->query($sql);
}
function get_student_with_id($mysqli, $student_id)
{
    $sql = "SELECT * FROM `student` WHERE `student_id` = $student_id ";
    $student =  $mysqli->query($sql);
    return $student->fetch_assoc();
}
function update_student($mysqli, $student_id, $student_name, $student_address, $student_age = 12, $student_email)
{
    $sql = "UPDATE `student`  SET `student_name` ='$student_name',`student_address` = '$student_address', `student_age` = $student_age, `student_email` = '$student_email'  WHERE `student_id` = $student_id ";
    // $student =  $mysqli->query($sql);
    return  $mysqli->query($sql);
}
function delete_student($mysqli, $student_id)
{
    $sql = "DELETE FROM `student` WHERE `student_id` = $student_id";
    return $mysqli->query($sql);
}
function get_all_student_attendance($mysqli, $batch_id)
{
    $date = date("Y-m-d");
    $sql = "SELECT st.*,sb.student_batch_id,a.leave,a.present,a.date,a.attendance_id FROM `student_batch` sb INNER JOIN `student` st ON sb.student_id=st.student_id LEFT JOIN `attendance` a ON a.student_batch_id=sb.student_batch_id  WHERE sb.`batch_id`=$batch_id AND a.date='$date'";
    return $mysqli->query($sql);
}
function get_all_student_with_batch_id($mysqli, $batch_id)
{
    $sql = "SELECT st.*,sb.student_batch_id FROM `student_batch` sb INNER JOIN `student` st ON sb.student_id=st.student_id WHERE sb.`batch_id`=$batch_id";
    return $mysqli->query($sql);
}
function count_student($mysqli)
{
    $sql = "SELECT COUNT(`student_id`) as number_of_student FROM `student`";
    return $mysqli->query($sql);
}
function get_batch_with_student_id($mysqli, $student_id)
{
    $sql = "SELECT t.teacher_name,b.batch_name,c.class_name,sb.student_id,sb.student_batch_id FROM `batch` b INNER JOIN `student_batch` sb ON sb.batch_id = b.batch_id INNER JOIN `class` c ON c.class_id=b.class_id INNER JOIN `teacher` t ON t.teacher_id=b.teacher_id WHERE sb.student_id=$student_id";
    return $mysqli->query($sql);
}
function get_last_student_id($mysqli)
{
    $sql = "SELECT *  FROM `student` Where student_id = (SELECT Max(student_id) from student);";
    $student_id =  $mysqli->query($sql);
    return $student_id->fetch_assoc();
}
function get_class_from_batch($mysqli)
{
    $sql = "SELECT DISTINCT class.* from batch JOIN class on batch.class_id = class.class_id";
    return $mysqli->query($sql);
}
// query data for search bar

function search_student($mysqli,$search){
    $sql = "SELECT * FROM `student` WHERE student_name LIKE '%$search%' OR student_email LIKE '$search%@gmail.com' ";
    return $mysqli->query($sql);
}