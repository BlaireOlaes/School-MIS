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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    ?>
    <div class="container">
        <button class="btn btn-success" id="addButton">Add New Instructor</button>
    </div>

    <div class="modal fade" id="addPersonModal" tabindex="-1" role="dialog" aria-labelledby="addPersonModalLabel"
        aria-hidden="true">
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



    <div class="modal fade" id="editInstructorModal" tabindex="-1" role="dialog"
        aria-labelledby="editInstructorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editInstructorModalLabel">Edit Instructor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editInstructorForm" method="POST" action="backend/edit_instructor.php">
                        <div class="form-group">
                            <label for="editInsFname">First Name</label>
                            <input type="text" class="form-control" id="editInsFname" name="edit_ins_fname" required>
                        </div>
                        <div class="form-group">
                            <label for="editInsLname">Last Name</label>
                            <input type="text" class="form-control" id="editInsLname" name="edit_ins_lname" required>
                        </div>
                        <div class="form-group">
                            <label for="editInsMname">Middle Name</label>
                            <input type="text" class="form-control" id="editInsMname" name="edit_ins_mname">
                        </div>
                        <input type="hidden" id="editInsId" name="edit_ins_id">
                        <div class="modal-footer">
                            <button type="submit" name="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this Instructor?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#addButton").click(function () {
                $("#addPersonModal").modal("show");
            });

            $(".edit-button").click(function () {
                var insId = $(this).data("ins-id");
                var insFname = $(this).data("ins-fname");
                var insLname = $(this).data("ins-lname");
                var insMname = $(this).data("ins-mname");


                $("#editInsId").val(insId);
                $("#editInsFname").val(insFname);
                $("#editInsLname").val(insLname);
                $("#editInsMname").val(insMname);


                $("#editInstructorModal").modal("show");
            });

            $(".delete-button").click(function () {
                var insId = $(this).data("ins-id");

                // Open the Bootstrap confirmation modal
                $("#deleteConfirmationModal").modal("show");

                // Set data attribute in the modal for instructor ID
                $("#deleteConfirmationModal").data("ins-id", insId);
            });

            $("#confirmDeleteButton").click(function () {
                var insId = $("#deleteConfirmationModal").data("ins-id");

                // Send an AJAX request to delete the instructor
                $.ajax({
                    url: "backend/delete_instructor.php", // Adjust the URL to your PHP file
                    method: "POST",
                    data: { delete_ins_id: insId }, // Adjust the parameter name if needed
                    success: function (data) {
                        // Reload the page after successful deletion
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        // Handle errors, e.g., display an error message
                        console.error("Error: " + error);
                    }
                });

                // Close the Bootstrap confirmation modal
                $("#deleteConfirmationModal").modal("hide");
            });


        });
    </script>

    <?php



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
                            <td> 
                            <button class="btn btn-success edit-button" data-ins-id="' . $ins_id . '" data-ins-fname="' . $ins_fname . '" data-ins-lname="' . $ins_lastname . '" data-ins-mname="' . $ins_midname . '">Edit</button>
                            <button class="btn btn-danger delete-button" data-ins-id="' . $ins_id . '">Delete</button>
                            </td>
                            <td>
                                <a href="./viewsub.php?ins_id=' . $ins_id . '" class="btn btn-primary"><i
                                        class="far fa-eye"></i> View Subjects</a>
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