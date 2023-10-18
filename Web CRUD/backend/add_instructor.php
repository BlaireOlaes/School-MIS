<?php
require_once('db_connection.php');

if (isset($_POST['submit'])) {
    $ins_fname = $_POST['fname'];
    $ins_lname = $_POST['lname'];
    $ins_mname = $_POST['mname'];
    $sql = "INSERT INTO instructors (ins_fname, ins_lname, ins_mname)
    VALUES (' $ins_fname', ' $ins_lname', '$ins_mname')";


    if ($conn->query($sql) === TRUE) {
        header("location:../instructors.php");
    } else {
        echo "Error: " . $sql . "<br>" . conn->error;
    }
    $conn->close;
}
?>