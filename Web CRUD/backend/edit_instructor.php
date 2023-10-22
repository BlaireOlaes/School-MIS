<?php
require_once('db_connection.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_ins_id'])) {

    $ins_id = $_POST['edit_ins_id'];
    $ins_fname = $_POST['edit_ins_fname'];
    $ins_lname = $_POST['edit_ins_lname'];
    $ins_mname = $_POST['edit_ins_mname'];


    $sql = "UPDATE instructors SET ins_fname = ?, ins_lname = ?, ins_mname = ? WHERE ins_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssi", $ins_fname, $ins_lname, $ins_mname, $ins_id);

        if ($stmt->execute()) {

            header('Location: ../instructors.php'); // 
        } else {

            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {

        echo "Error: " . $conn->error;
    }
} else {

}
?>