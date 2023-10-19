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
                        <a class="nav-link" href="./student.php">Students</a>
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
    ?>

    <div class="container">
        <button class="btn btn-success" id="addButton">Add New Subject</button>
    </div>

    <div class="modal fade" id="addPersonModal" tabindex="-1" role="dialog" aria-labelledby="addPersonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPersonModalLabel">Add New Subject</h5>
                </div>
                <div class="modal-body">
                    <form id="addPersonForm" method="POST" action="backend/add_subject.php">
                        <div class="form-group">
                            <label for="sub_code">Subject Code:</label>
                            <input type="text" class="form-control" id="sub_code" name="sub_code" required>
                        </div>
                        <div class="form-group">
                            <label for="sub_name">Subject Name:</label>
                            <input type="text" class="form-control" id="sub_name" name="sub_name" required>
                        </div>
                        <div class="form-group">
                            <label for="sub_unit">Unit:</label>
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

    <div class="modal fade" id="editPersonModal" tabindex="-1" role="dialog" aria-labelledby="editPersonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPersonModalLabel">Edit Subject</h5>
                </div>
                <div class="modal-body">
                    <form id="editPersonForm" method="POST" action="backend/edit_subject.php">
                        <div class="form-group">
                            <label for="edit_sub_code">Subject Code:</label>
                            <input type="text" class="form-control" id="edit_sub_code" name="edit_sub_code" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_sub_name">Subject Name:</label>
                            <input type="text" class="form-control" id="edit_sub_name" name="edit_sub_name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_sub_unit">Unit:</label>
                            <input type="text" class="form-control" id="edit_sub_unit" name="edit_sub_unit">
                        </div>
                        <input type="hidden" id="edit_sub_id" name="edit_sub_id">
                        <div class="modal-footer">
                            <button type="submit" name="submit" class="btn btn-success">SAVE</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
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
                    <p>Are you sure you want to delete this subject?</p>
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
                var subId = $(this).data("sub-id");
                var subCode = $(this).closest("tr").find("th").text();
                var subName = $(this).closest("tr").find("td:eq(0)").text();
                var subUnit = $(this).closest("tr").find("td:eq(1)").text();

                $("#edit_sub_id").val(subId);
                $("#edit_sub_code").val(subCode);
                $("#edit_sub_name").val(subName);
                $("#edit_sub_unit").val(subUnit);
                $("#editPersonModal").modal("show");
            });

            $(".delete-button").click(function () {
                var subId = $(this).data("sub-id");

                // Open the Bootstrap confirmation modal
                $("#deleteConfirmationModal").modal("show");

                // Set data attribute in the modal for subject ID
                $("#deleteConfirmationModal").data("sub-id", subId);
            });

            $("#confirmDeleteButton").click(function () {
                var subId = $("#deleteConfirmationModal").data("sub-id");

                // Send an AJAX request to delete the subject
                $.ajax({
                    url: "backend/delete_subject.php",
                    method: "POST",
                    data: { sub_id: subId },
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
            $sub_id = $row['sub_id'];

            echo '
            <tr>
                <th scope="row">' . $sub_code . '</th>
                <td>' . $sub_name . '</td>
                <td>' . $sub_unit . '</td>
                <td>
                <button class="btn btn-success edit-button" data-sub-id="' . $sub_id . '">Edit</button>
                <button class="btn btn-danger delete-button" data-sub-id="' . $sub_id . '">Delete</button>
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