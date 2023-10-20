<?php
require_once('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stu_id = $_POST['stu_id'];
    $ins_subcode = $_POST['ins_subcode'];
    $stu_program = $_POST['stu_program'];
    $stu_year = $_POST['stu_year'];
    $stu_grade = $_POST['stu_grade'];
    $sql = "UPDATE assignedstu SET stu_program = ?, stu_year = ?, stu_grade = ? WHERE stu_id = ? AND  ins_subcode = '$ins_subcode'";
    
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssii", $stu_program, $stu_year, $stu_grade, $stu_id);

        if ($stmt->execute()) {
            header("Location: ../viewstu.php?ins_subcode=" . $ins_subcode);
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

$conn->close();
?>