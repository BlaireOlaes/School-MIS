<?php
require_once('db_connection.php'); // Include your database connection code here

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_ins_id'])) {
    // Sanitize and validate input data
    $ins_id = $_POST['edit_ins_id'];
    $ins_fname = $_POST['edit_ins_fname'];
    $ins_lname = $_POST['edit_ins_lname'];
    $ins_mname = $_POST['edit_ins_mname'];

    // Perform an SQL update to edit instructor data
    $sql = "UPDATE instructors SET ins_fname = ?, ins_lname = ?, ins_mname = ? WHERE ins_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssi", $ins_fname, $ins_lname, $ins_mname, $ins_id);

        if ($stmt->execute()) {
            // Editing successful
            header('Location: ../instructors.php'); // 
        } else {
            // Handle the case where the update query fails
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Handle the case where the SQL statement preparation fails
        echo "Error: " . $conn->error;
    }
} else {
    // Handle GET requests or other methods
    // You may redirect or display an error message here
}
?>