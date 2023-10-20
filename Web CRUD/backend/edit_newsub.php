<?php
require_once('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ins_id = $_POST['ins_id'];
    $ins_subcode = $_POST['ins_subcode'];
    $ins_sname = $_POST['ins_sname'];
    $ins_sday = $_POST['ins_sday'];
    $ins_stime = $_POST['ins_stime'];
    $ins_room = $_POST['ins_room'];
    $ins_snum = $_POST['ins_snum'];

    $sql = "UPDATE assignedsub 
            SET ins_sname = '$ins_sname',
                ins_sday = '$ins_sday',
                ins_stime = '$ins_stime',
                ins_room = '$ins_room',
                ins_snum = '$ins_snum'
            WHERE ins_subcode = '$ins_subcode'  AND ins_id = '$ins_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../viewsub.php?ins_id=" . $ins_id . "&ins_subcode=" . $ins_subcode);
        exit();
    } else {
        echo "Error updating the record: " . $conn->error;
    }
}

$conn->close();
?>