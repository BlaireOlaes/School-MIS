<?php
require_once('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['edit_sub_id'])) {

        $sub_id = $_POST['edit_sub_id'];
        $sub_code = $_POST['edit_sub_code'];
        $sub_name = $_POST['edit_sub_name'];
        $sub_unit = $_POST['edit_sub_unit'];
        $sql = "UPDATE subject SET sub_code = ?, sub_name = ?, sub_unit = ? WHERE sub_id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssii", $sub_code, $sub_name, $sub_unit, $sub_id);

            if ($stmt->execute()) {

                header('Location: ../subjects.php');
                exit();
            } else {

                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {

            echo "Error: " . $conn->error;
        }
    }
} else {

}
?>