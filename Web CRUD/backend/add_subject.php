<?php
require_once('db_connection.php');

if (isset($_POST['submit'])) {
    $sub_code = $_POST['sub_code'];
    $sub_name = $_POST['sub_name'];
    $sub_unit = $_POST['sub_unit'];
    $sql = "INSERT INTO subject (sub_code, sub_name, sub_unit)
    VALUES (' $sub_code', ' $sub_name', '$sub_unit')";


    if ($conn->query($sql) === TRUE) {
        header("location:../subjects.php");
    } else {
        echo "Error: " . $sql . "<br>" . conn->error;
    }
    $conn->close;
}
?>