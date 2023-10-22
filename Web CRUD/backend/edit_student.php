<?php
require_once('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['edit_stu_id'])) {
    $stu_id = $_POST["edit_stu_id"];
    $stu_fname = $_POST["edit_stu_fname"];
    $stu_lname = $_POST["edit_stu_lname"];
    $stu_mname = $_POST["edit_stu_mname"];
    $stu_program = $_POST["edit_stu_program"];
    $stu_year = $_POST["edit_stu_year"];


    $sql = "UPDATE student SET stu_fname= ?, stu_lname= ?, stu_mname= ?, stu_program= ?, stu_year= ? WHERE stu_id= ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssssi", $stu_fname, $stu_lname, $stu_mname, $stu_program, $stu_year, $stu_id);

        if ($stmt->execute()) {

            header('Location: ../student.php'); 
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