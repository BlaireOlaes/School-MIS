<?php
require_once('db_connection.php');

if (isset($_POST['code'])) {
    $code = $_POST['code'];
    $sql = "SELECT sub_name FROM subject WHERE sub_code = '$code'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $subjectName = trim(stripslashes($row['sub_name']));
        echo $subjectName;
    } else {
        echo json_encode('Subject not found');
    }

    $conn->close();
}
?>