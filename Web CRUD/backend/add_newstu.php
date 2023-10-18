<?php
require_once('db_connection.php');
$ins_subcode = $_GET['ins_subcode'];

if (isset($_POST['submit'])) {
    $stu_fname = $_POST['stu_fname'];
    $stu_lname = $_POST['stu_lname'];
    $stu_mname = $_POST['stu_mname'];
    $stu_program= $_POST['stu_program'];
    $stu_year = $_POST['stu_year'];
    $stu_grade = $_POST['stu_grade'];
    $sql = "INSERT INTO assignedstu (ins_subcode, stu_fname, stu_lname, stu_mname, stu_program, stu_year, stu_grade)
     VALUES ('$ins_subcode', ' $stu_fname', '  $stu_lname', ' $stu_mname', '  $stu_program', '$stu_year', '   $stu_grade')";



    if ($conn->query($sql) === TRUE) {
        header("location: ../viewstu.php?ins_subcode=" . $ins_subcode );
        
    } else {
        echo "Error: " . $sql . "<br>" . conn->error;
    }
    $conn->close;
}
?>