<?php
require_once('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['stu_id'])) {
        $stu_id = $_POST['stu_id'];
        $sql = "DELETE FROM assignedstu WHERE stu_id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $stu_id);

            if ($stmt->execute()) {
                echo "success";
            } else {
                echo "error";
            }

            $stmt->close();
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
} else {
    echo "error";
}

$conn->close();
?>