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
                        <a class="nav-link active current" href="./subjects.php">Subjects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="./instructors.php">Instructors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="./student.php">Students</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <img src="https://i.pinimg.com/originals/dd/eb/23/ddeb23e067d822d84d50cca6fa04044f.png" alt="Bootstrap" width="30"
        height="24">
    <h6><span class="label label-default">Subjects</span></h6>

    <?php
    $sql = "SELECT * FROM subject";
    $result = $conn->query($sql);

    echo '
    <div class="container">
    <button class="btn btn-success" id="addButton">Add New Subject</button>
</div>

<div class="modal fade" id="addPersonModal" tabindex="-1" role="dialog" aria-labelledby="addPersonModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addPersonModalLabel">Add New Subject</h5>
        </div>
        <div class="modal-body">
            <form id="addPersonForm" method="POST" action="backend/add_subject.php">
                <div class="form-group">
                    <label for="subcode">Subject Code:</label>
                    <input type="text" class="form-control" id="sub_code" name="sub_code" required>
                </div>
                <div class="form-group">
                    <label for="subname">Subject Name:</label>
                    <input type="text" class="form-control" id="sub_name" name="sub_name" required>
                </div>
                <div class="form-group">
                    <label for="subunit">Unit:</label>
                    <input type="text" class="form-control" id="sub_unit" name="sub_unit">
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

$(document).on("click", "#delete-users", function(){
    var id = $(this).data("id");
    $(this).addClass("hide");
    $(".delete-submit")
});


</script>

';



    if ($result->num_rows > 0) {
        echo '<div class="container">
            <div class="row">
            <div class="col-12">';
        echo '<table class="table table-bordered">';
        echo '<thead>
                <th scope="col">Subject Code</th>
                <th scope="col">Description</th>
                <th scope="col">Unit</th>
                <th scope="col">Operation</th>
            </thead>
            <tbody>';

        while ($row = $result->fetch_assoc()) {
            $sub_code = $row['sub_code'];
            $sub_name = $row['sub_name'];
            $sub_unit = $row['sub_unit'];

            echo '
            <tr>
                <th scope="row">' . $sub_code . '</th>
                <td>' . $sub_name . '</td>
                <td>' . $sub_unit . '</td>
                <td>
                <button class="btn btn-success" id="editButton">Edit</button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal' .$sub_code . '">Delete</button>
                </td>
            </tr>
            
            
            
            
            ';
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