<?php
require_once('db_connection.php');
$ins_id = $_GET['ins_id'];

if (isset($_POST['submit'])) {
    $ins_subcode = $_POST['ins_subcode'];
    $ins_sname = $_POST['ins_sname'];
    $ins_sday = $_POST['schedule-day'];
    $ins_stime = $_POST['schedule-time'];
    $ins_room = $_POST['ins_room'];
    $ins_snum = $_POST['ins_snum'];
    $sql = "INSERT INTO assignedsub (ins_id, ins_subcode, ins_sname, ins_sday, ins_stime, ins_room, ins_snum) VALUES ('$ins_id', '$ins_subcode', '$ins_sname', '$ins_sday', '$ins_stime', '$ins_room', '$ins_snum')";



    if ($conn->query($sql) === TRUE) {
        header("location: ../viewsub.php?ins_id=" . $ins_id);
        
    } else {
        echo "Error: " . $sql . "<br>" . conn->error;
    }
    $conn->close;
}
?>