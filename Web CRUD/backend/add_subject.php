<?php
require_once('db_connection.php');

if (isset($_POST['submit'])) {
    $ins_id = $_POST['sub_code'];
    $sub_name = $_POST['sub_name'];
    $ins_mname = $_POST['sub_unit'];
    $sql = "INSERT INTO subject (sub_code, sub_name, sub_unit)
    VALUES (' $ins_id', ' $sub_name', '$ins_mname')";


    if ($conn->query($sql) === TRUE) {
        header("location:../subjects.php");
    } else {
        echo "Error: " . $sql . "<br>" . conn->error;
    }
    $conn->close;
}
?>