<?php
require_once('db_connection.php'); // Include your database connection code here

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if form data has been submitted
    if (isset($_POST['edit_sub_id'])) {
        // Sanitize and validate input data
        $sub_id = $_POST['edit_sub_id'];
        $sub_code = $_POST['edit_sub_code'];
        $sub_name = $_POST['edit_sub_name'];
        $sub_unit = $_POST['edit_sub_unit'];

        // Perform an SQL update to modify the subject data
        $sql = "UPDATE subject SET sub_code = ?, sub_name = ?, sub_unit = ? WHERE sub_id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssii", $sub_code, $sub_name, $sub_unit, $sub_id);

            if ($stmt->execute()) {
                // Data updated successfully
                header('Location: ../subjects.php'); // Redirect to the subjects page after editing
                exit();
            } else {
                // Handle the case where the update query fails
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            // Handle the case where the SQL statement preparation fails
            echo "Error: " . $conn->error;
        }
    }
} else {
    // Handle GET requests or other methods
    // You may redirect or display an error message here
}
?>