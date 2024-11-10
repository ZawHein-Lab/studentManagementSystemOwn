<?php
function add_teacher($mysqli, $teacher_name, $teacher_email, $teacher_experience)
{
    $sql = "INSERT INTO `teacher`(`teacher_name`,`teacher_experience`,`teacher_email`) VALUES ('$teacher_name','$teacher_experience','$teacher_email')";
    return $mysqli->query($sql);
}
function get_all_teacher($mysqli)
{
    $sql = "SELECT * FROM `teacher`";
    return $mysqli->query($sql);
}
function get_teacher_with_id($mysqli, $teacher_id)
{
    $sql = "SELECT * FROM `teacher` WHERE `teacher_id` = $teacher_id ";
    $teacher =  $mysqli->query($sql);
    return $teacher->fetch_assoc();
}
function update_teacher($mysqli, $teacher_id, $teacher_name, $teacher_experience, $teacher_email)
{
    $sql = "UPDATE `teacher`  SET `teacher_name` ='$teacher_name',`teacher_experience` = '$teacher_experience', `teacher_email` = '$teacher_email'  WHERE `teacher_id` = $teacher_id ";
    // $teacher =  $mysqli->query($sql);
    return  $mysqli->query($sql);
}
function delete_teacher($mysqli, $teacher_id)
{
    $sql = "DELETE FROM `teacher` WHERE `teacher_id` = $teacher_id";
    return $mysqli->query($sql);
}

function count_teacher($mysqli)
{
    $sql = "SELECT COUNT(`teacher_id`) as number_of_teacher FROM `teacher`";
    return $mysqli->query($sql);
}
