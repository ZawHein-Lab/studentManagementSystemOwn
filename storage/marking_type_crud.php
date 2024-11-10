<?php
    function add_marking_type($mysqli,$type_name,$min_mark,$max_mark){
        $sql = "INSERT INTO `marking_type`(`type_name`,`min_mark`,`max_mark`) VALUES ('$type_name','$min_mark','$max_mark')";
        return $mysqli->query($sql);
    }
    function get_all_marking_type($mysqli){
    $sql = "SELECT * FROM `marking_type`";
    return $mysqli->query($sql);
    }
    function get_marking_type_with_id($mysqli,$marking_type_id){
    $sql = "SELECT * FROM `marking_type` WHERE `marking_type_id` = $marking_type_id ";
    $marking_type =  $mysqli->query($sql);
    return $marking_type->fetch_assoc();
    } 
    function update_marking_type($mysqli,$marking_type_id,$type_name,$min_mark,$max_mark){
        $sql = "UPDATE `marking_type`  SET `type_name` ='$type_name',`min_mark` = '$min_mark',`max_mark`='$max_mark' WHERE `marking_type_id` = $marking_type_id"; 
        // $marking_type =  $mysqli->query($sql); 
        return  $mysqli->query($sql);
    }
    function delete_marking_type($mysqli,$marking_type_id){
        $sql = "DELETE FROM `marking_type` WHERE `marking_type_id` = $marking_type_id";
        return $mysqli->query($sql);
    }
?>