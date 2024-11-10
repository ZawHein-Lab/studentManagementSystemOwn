<?php
function add_attendance($mysqli,$student_batch_id){
    $sql = "INSERT INTO `attendance`( `present`,`leave`,`student_batch_id`,`date`) values(0,0,'$student_batch_id',now())";
    return $mysqli->query($sql);
}

function present_attendance($mysqli, $attendance_id)
{
    $sql = "UPDATE `attendance` SET `present`=1, `leave`=0 WHERE `attendance_id`=$attendance_id";
    return $mysqli->query($sql);
}
// function leave_attendance($mysqli, $attendance_id)
// {
//     $sql = "UPDATE `attendance` SET `leave`=1,`present`=0 WHERE `attendance_id`=$attendance_id";
//     return $mysqli->query($sql);
// }
function get_all_attendance($mysqli){
    $sql = "SELECT * FROM attendance";
    return $mysqli->query($sql);
}
function absent_attendance_update($mysqli, $attendance_id)
{
    $sql = "UPDATE `attendance` SET `present`=0, `leave`=0 WHERE `attendance_id`=$attendance_id";
    return $mysqli->query($sql);
}
function absent_attendance($mysqli, $student_batch_id)
{
    $sql = "INSERT INTO `attendance` (`leave`,`present`,`date`,`student_batch_id`) VALUES (0,0,NOW(),$student_batch_id)";
    return $mysqli->query($sql);
}
function get_attendance_with_student_batch($mysqli, $student_batch_id)
{
    $sql = "SELECT * FROM `attendance` WHERE `student_batch_id`=$student_batch_id";
    return $mysqli->query($sql);
}
function leave_attendance($mysqli, $attendance_id)
{
    $sql = "UPDATE `attendance` SET `leave`=1,`present`=0 WHERE `attendance_id`=$attendance_id";
    return $mysqli->query($sql);
}
// function update_not_now_date($mysqli,$leave,$present,$attendance_id){
//     $sql = "UPDATE `attendance` SET `date` = now() ,`leave`=$leave,`present`=$present WHERE `attendance_id`=$attendance_id";
//     return $mysqli->query($sql);
// }
function insert_attendance($mysqli,$student_batch_id){
    $sql = "INSERT INTO `attendance` (`leave`,`present`,`date`,`student_batch_id`) VALUES (0,0,NOW(),$student_batch_id)";
    return $mysqli->query($sql);
 }
 function get_student_batch($mysqli){
    $sql = "SELECT * FROM `student_batch` ORDER BY `student_batch_id` desc LIMIT 1";
    return $mysqli->query($sql);
}
function get_attendance($mysqli,$batch_id){
    $sql = "SELECT * FROM `attendance` a LEFT JOIN student_batch sb on sb.student_batch_id = a.student_batch_id LEFT JOIN student st ON st.student_id = sb.student_id LEFT JOIN batch b ON b.batch_id = sb.batch_id WHERE b.batch_id = $batch_id AND a.date = Date(Now())" ;
   return $mysqli->query($sql);
}
function get_date_not_now($mysqli,$batch_id){
    $sql = "SELECT * FROM `attendance` a LEFT JOIN student_batch sb on sb.student_batch_id = a.student_batch_id LEFT JOIN student st ON st.student_id = sb.student_id LEFT JOIN batch b ON b.batch_id = sb.batch_id WHERE b.batch_id = $batch_id AND a.date !='2024-11-08'";
   return $mysqli->query($sql);
}
function get_batch_end_date($mysqli,$batch_id){
    $sql = "SELECT end_date FROM batch where batch_id = $batch_id";
    return $mysqli->query($sql);
}
function get_batch_start_date($mysqli,$batch_id){
    $sql = "SELECT start_date FROM batch where batch_id = $batch_id";
    return $mysqli->query($sql);
}
?>