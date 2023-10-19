<?php
require_once('backend/db_connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructors</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-custom">

            <a class="navbar-brand custom-brand" href="#"><img
                    src="https://upload.wikimedia.org/wikipedia/en/1/17/LNUTaclobanLogo.jpg" alt="Logo" height="50"
                    width="50"></a>

            <h6 class="lnu">Leyte Normal University
                <br>
                <span class="label label-default">MIS</span>
            </h6>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto ">
                    <li class="nav-item ">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./subjects.php">Subjects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active current" href="./instructors.php">Instructors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="./student.php">Students</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <img src="https://icons.veryicon.com/png/o/business/educational-administration-related/teacher-11.png"
        alt="Bootstrap" width="30" height="24">
    <h6><span class="label label-default">Instructors</span></h6>

    <?php
    $sql = "SELECT * FROM instructors";
    $result = $conn->query($sql);
    echo '
    <div class="container">
    <button class="btn btn-success" id="addButton">Add New Instructor</button>
</div>

<div class="modal fade" id="addPersonModal" tabindex="-1" role="dialog" aria-labelledby="addPersonModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addPersonModalLabel">Add New Instructor</h5>
        </div>
        <div class="modal-body">
            <form id="addPersonForm" method="POST" action="backend/add_instructor.php">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="ins_fname" name="fname" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="ins_lname" name="lname" required>
                </div>
                <div class="form-group">
                    <label for="middleName">Middle Name</label>
                    <input type="text" class="form-control" id="ins_mname" name="mname">
                </div>
                <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-success">SAVE</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
$(document).ready(function() {
    $("#addButton").click(function() {
        $("#addPersonModal").modal("show");
    });
});
</script>

';






    if ($result->num_rows > 0) {
        echo '<div class="container">
            <div class="row">
            <div class="col-12">';
        echo '<table class="table table-bordered">';
        echo '<thead>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Operations</th>
                <th scope="col">Actions</th>
            </thead>
            <tbody>';

        while ($row = $result->fetch_assoc()) {
            $ins_id = $row['ins_id'];
            $ins_fname = $row['ins_fname'];
            $ins_lastname = $row['ins_lname'];
            $ins_midname = $row['ins_mname'];

            echo '<tr>
                <th scope="row">' . $ins_id . '</th>
                <td>' . $ins_fname . ' ' . $ins_midname . '. ' . $ins_lastname . '</td>
                <td>icons operations</td>
                <td> 
                    <a href="./viewsub.php?ins_id=' . $ins_id . '" class="btn btn-primary"><i class="far fa-eye"></i> View Subjects</a>
                </td>
            </tr>';
        }

        echo '</tbody>
            </table>
            </div>
            </div>
            </div>';
    } else {
        echo '0 results';
    }

    $conn->close();
    ?>
</body>

</html>