<?php
    $mysqli = new mysqli("localhost","root","");
    if($mysqli->connect_error){
        echo "Cann't connect to the database";
    }else{
        $sql ="CREATE DATABASE IF NOT EXISTS `student_management_system_own`"; 
        if($mysqli->query($sql)){
            // echo "crate database success";
            if($mysqli->select_db("student_management_system_own")){
                // echo "Database selection ok";
                if(!create_table_own($mysqli)){
                    echo "Cann't create table";
                    die();
                }
            }
        }
    }
    function create_table_own($mysqli){
        $sql = "CREATE TABLE IF NOT EXISTS `student`(`student_id` INT NOT NULL AUTO_INCREMENT,`student_name` VARCHAR(200) NOT NULL,`student_address` VARCHAR(200) NOT NULL,`student_age` INT NOT NULL,`student_email` VARCHAR(50) NOT NULL,PRIMARY KEY (`student_id`))";
        if(!$mysqli->query($sql)){
            return false;
        }
        $sql = "CREATE TABLE IF NOT EXISTS `class`(`class_id` INT NOT NULL AUTO_INCREMENT,`description` TEXT ,`class_name` VARCHAR(50) NOT NULL,PRIMARY KEY (`class_id`)) ";
        if(!$mysqli->query($sql)){
            return false;
        }
        $sql = "CREATE TABLE IF NOT EXISTS `teacher`(`teacher_id` INT NOT NULL AUTO_INCREMENT,`teacher_name` VARCHAR(50) NOT NULL,`teacher_email` VARCHAR(50) NOT NULL,`teacher_experience` VARCHAR(200),PRIMARY KEY(`teacher_id`))";
        if(!$mysqli->query($sql)){
            return false;
        }
        $sql = "CREATE TABLE IF NOT EXISTS `marking_type`(`marking_type_id` INT NOT NULL AUTO_INCREMENT,`type_name` VARCHAR(50) NOT NULL,`min_mark` INT NOT NULL,`max_mark` INT NOT NULL,PRIMARY KEY(`marking_type_id`))";
        if(!$mysqli->query($sql)){
            return false;
        }
        $sql = "CREATE TABLE IF NOT EXISTS `batch`(`batch_id` INT NOT NULL AUTO_INCREMENT,`batch_name` VARCHAR(50) NOT NULL,`start_date` DATETIME,`end_date` DATETIME,`fees` INT NOT NULL,`description` TEXT,`teacher_id` INT,`class_id` INT,PRIMARY KEY(`batch_id`),FOREIGN KEY(`teacher_id`) REFERENCES `teacher`(`teacher_id`),FOREIGN KEY(`class_id`)  REFERENCES `class`(`class_id`))";
        if(!$mysqli->query($sql)){
            return false;
        }
        $sql = "CREATE TABLE IF NOT EXISTS `student_batch`(`student_batch_id`INT NOT NULL AUTO_INCREMENT,`student_id` INT,`batch_id` INT,PRIMARY KEY(`student_batch_id`),FOREIGN KEY(`student_id`) REFERENCES `student`(`student_id`),FOREIGN KEY(`batch_id`) REFERENCES `batch`(`batch_id`))";
        if(!$mysqli->query($sql)){
            return false;
        }
        $sql = "CREATE TABLE IF NOT EXISTS `student_grade`(`student_grade_id` INT NOT NULL AUTO_INCREMENT,`student_grade` INT NOT NULL,`student_batch_id` INT,PRIMARY KEY(`student_grade_id`),FOREIGN KEY(`student_batch_id`) REFERENCES `student_batch`(`student_batch_id`)) ";
        if(!$mysqli->query($sql)){
            return false;
        }
        $sql = "CREATE TABLE IF NOT EXISTS `marking`(`marking_id` INT NOT NULL AUTO_INCREMENT,`mark` INT NOT NULL,`student_batch_id` INT,`marking_type_id` INT,PRIMARY KEY(`marking_id`),FOREIGN KEY(`student_batch_id`) REFERENCES `student_batch`(`student_batch_id`),FOREIGN KEY(`marking_type_id`) REFERENCES `marking_type`(`marking_type_id`))";
        if(!$mysqli->query($sql)){
            return false;
        }
        $sql = "CREATE TABLE IF NOT EXISTS `attendance`(`attendance_id` INT AUTO_INCREMENT,`date` DATE,`present` BOOLEAN NOT NULL DEFAULT FALSE ,`leave` BOOLEAN NOT NULL DEFAULT FALSE,`student_batch_id` INT NOT NULL,PRIMARY KEY(`attendance_id`),FOREIGN KEY (`student_batch_id`) references `student_batch`(`student_batch_id`))";

        if (!$mysqli->query($sql)) {
            return false;
        }
        return true;
    }
?>