<?php
require_once('backend/db_connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects</title>
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
                        <a class="nav-link " href="./subjects.php">Subjects</a>
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
    <a class="label label-default" href="instructors.php">Instructors</a> <span> > </span> <a
        class="label label-default" href="javascript:goBackToPreviousPage();">Subjects</a> > <span>Students</span>

    <?php
    $ins_subcode = $_GET['ins_subcode'];

    $sql = "SELECT * FROM assignedstu WHERE ins_subcode='$ins_subcode'";
    $result = $conn->query($sql);

    echo '
    <div class="container">
    <button class="btn btn-success" id="addButton">Add New Student</button>
    <h1>' . $ins_subcode . '</h1>
</div>

<div class="modal fade" id="addPersonModal" tabindex="-1" role="dialog" aria-labelledby="addPersonModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addPersonModalLabel">Add New Instructor</h5>
        </div>
        
        <div class="modal-body">
            <form id="addPersonForm" method="POST" action="backend/add_newstu.php?ins_subcode=' . $ins_subcode . '">

            <div class="form-group">
            <label for="code">First Name:</label>
            <input type="text" class="form-control" id="stu_fname" name="stu_fname" required>
        </div>
        <div class="form-group">
            <label for="sub">Last Name:</label>
            <input type="text" class="form-control" id="stu_lname" name="stu_lname" required>
        </div>

        <div class="form-group">
        <label for="sub">M.I:</label>
        <input type="text" class="form-control" id="stu_mname" name="stu_mname" required>
    </div>

<div class="form-group">    
    <div class="row">
        <div class="col-md-6">
        <label for="schedule">Program:</label>
            <select class="form-control" id="stu_program" name="stu_program" required>
                <option value="Mth">Mth</option>
                <option value="TF">TF</option>
                <option value="W">W</option>
                <option value="S">S</option>
            </select>
        </div>

        <div class="col-md-6">
        <label for="schedule">Year Level:</label>
            <select class="form-control" id="stu_year" name="stu_year" required>
            <option value="Mth">Mth</option>
            <option value="TF">TF</option>
            <option value="W">W</option>
            <option value="S">S</option>
            </select>
        </div>
        </div>
        <div class="form-group">
        <label for="sub">Grade:</label>
        <input type="text" class="form-control" id="stu_grade" name="stu_grade" required>
    </div>
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

$(document).ready(function () {
    $("#addButton").click(function () {
        $("#addPersonModal").modal("show");
    });
});

var previousPageURL = document.referrer;
function goBackToPreviousPage() {
    window.location.href = previousPageURL;
}


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
                <th scope="col">Grade</th>
                <th scope="col">Operations/th>
            </thead>
            <tbody>';

        while ($row = $result->fetch_assoc()) {
            $stu_id = $row['stu_id'];
            $stu_fname = $row['stu_fname'];
            $stu_lname = $row['stu_lname'];
            $stu_program = $row['stu_program'];
            $stu_year = $row['stu_year'];
            $stu_grade = $row['stu_grade'];


            echo '<tr>
                <th scope="row">' . $stu_id . '</th>
                <td>' . $stu_fname . ' ' . $stu_lname . '</td>
                <td>' . $stu_program . '</td>
                <td> ' . $stu_year . '</td>
                <td> ' . $stu_grade . '</td>
                <td>icons operations</td>
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