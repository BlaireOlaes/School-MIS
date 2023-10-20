<?php
require_once('db_connection.php'); // Include your database connection code here

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_ins_id'])) {
    // Sanitize and validate the input data
    $ins_id = $_POST['delete_ins_id'];

    // Perform an SQL delete to delete the instructor
    $sql = "DELETE FROM instructors WHERE ins_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $ins_id);

        if ($stmt->execute()) {
            // Deletion successful
            echo "Instructor deleted successfully.";
        } else {
            // Handle the case where the delete query fails
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