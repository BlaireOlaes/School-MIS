<?php
require_once('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sub_id'])) {

    $sub_id = $_POST['sub_id'];


    $sql = "DELETE FROM subject WHERE sub_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $sub_id);

        if ($stmt->execute()) {

            echo "Subject deleted successfully.";
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