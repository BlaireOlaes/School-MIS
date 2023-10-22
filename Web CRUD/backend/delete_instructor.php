<?php
require_once('db_connection.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_ins_id'])) {

    $ins_id = $_POST['delete_ins_id'];


    $sql = "DELETE FROM instructors WHERE ins_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $ins_id);

        if ($stmt->execute()) {

            echo "Instructor deleted successfully.";
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