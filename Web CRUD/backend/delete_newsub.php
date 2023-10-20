<?php
require_once('db_connection.php');

if (isset($_POST['ins_subcode'])) {
    $ins_subcode = $_POST['ins_subcode'];
    $sql = "DELETE FROM assignedsub WHERE ins_subcode = '$ins_subcode'";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }

    $conn->close();
}
?>