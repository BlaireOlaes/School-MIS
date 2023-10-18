<?php
require_once('backend/db_connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
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
                        <a class="nav-link " href="./instructors.php">Instructors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  active current" href="./student.php">Students</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <img src="data:image/png;base64,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"
        alt="Bootstrap" width="30" height="24">
    <h6><span class="label label-default">Students</span></h6>

    <?php
    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);

    echo '
    <div class="container">
    <button class="btn btn-success" id="addButton">Add New Student</button>
</div>

<div class="modal fade" id="addPersonModal" tabindex="-1" role="dialog" aria-labelledby="addPersonModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addPersonModalLabel">Add New Instructor</h5>
        </div>
        <div class="modal-body">
            <form id="addPersonForm" method="POST" action="backend/add_student.php">
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" class="form-control" id="stu_fname" name="stu_fname" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" class="form-control" id="stu_lname" name="stu_lname" required>
                </div>
                <div class="form-group">
                    <label for="middleName">M.I:</label>
                    <input type="text" class="form-control" id="stu_mname" name="stu_mname" required>
                </div>
                <div class="form-group">
                <label for="program">Program:</label>
                <input type="text" class="form-control" id="stu_program" name="stu_program" required>
            </div>
            <div class="form-group">
                <label for="year">Year level:</label>
                <input type="text" class="form-control" id="stu_year" name="stu_year" required>
            </div>
            <div class="form-group">
            <label for="year">Grade:</label>
            <input type="text" class="form-control" id="stu_grade" name="stu_grade">
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
                <th scope="col">Student ID</th>
                <th scope="col">Student Name</th>
                <th scope="col">Program</th>
                <th scope="col">Year Level</th>
                <th scope="col">Operation</th>
                <th scope="col">Actions</th>
            </thead>
            <tbody>';

        while ($row = $result->fetch_assoc()) {
            $stu_id = $row['stu_id'];
            $stu_fname = $row['stu_fname'];
            $stu_lname = $row['stu_lname'];
            $stu_mname = $row['stu_mname'];
            $stu_program = $row['stu_program'];
            $stu_year = $row['stu_year'];



            echo '<tr>
                <th scope="row">' . $stu_id . '</th>
                <td>' . $stu_fname . ' ' . $stu_mname . '. ' . $stu_lname . '</td>
                <td>' . $stu_program . '</td>
                <td>' . $stu_year . '</td>
                <td>icons operations</td>
                <td> 
                <a type="button" href="" class="btn btn-primary"><i class="far fa-eye"></i> View Subjects</a>
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