<?php
require_once('db_connection.php');

if (isset($_POST['submit'])) {
    $stu_fname = $_POST['stu_fname'];
    $stu_lname = $_POST['stu_lname'];
    $stu_mname = $_POST['stu_mname'];
    $stu_program = $_POST['stu_program'];
    $stu_year = $_POST['stu_year'];
    $stu_grade = $_POST['stu_grade'];
    $sql = "INSERT INTO student (stu_fname, stu_lname,  stu_mname, stu_program, stu_year, stu_grade)
    VALUES ('$stu_fname', '$stu_lname', '$stu_mname','$stu_program','$stu_year','$stu_grade')";


    if ($conn->query($sql) === TRUE) {
        header("location:../student.php");
    } else {
        echo "Error: " . $sql . "<br>" . conn->error;
    }
    $conn->close;
}
?>