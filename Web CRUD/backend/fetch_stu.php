<?php
require_once('db_connection.php');

if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    $sql = "SELECT stu_fname, stu_lname, stu_mname, stu_program, stu_year FROM student WHERE stu_id = '$student_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $studentData = [
            'stu_fname' => $row['stu_fname'],
            'stu_lname' => $row['stu_lname'],
            'stu_mname' => $row['stu_mname'],
            'stu_program' => $row['stu_program'],
            'stu_year' => $row['stu_year'],
        ];

        // Return the student data as JSON
        echo json_encode($studentData);
    }
}


?>