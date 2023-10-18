<?php
require_once('backend/db_connection.php');

if (isset($_POST['subjectCode'])) {
    $subjectCode = $_POST['subjectCode'];

    // Perform a database query to fetch the subject name
    $sql = "SELECT sub_name FROM subject WHERE sub_code = '$subjectCode'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['sub_name'];
    } else {
        echo ""; // Subject code not found, or an error occurred
    }

    $conn->close();
}
?>