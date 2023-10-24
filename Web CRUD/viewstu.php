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
    ?>





    <div class="container">
        <button class="btn btn-success" id="addButton">Add New Student</button>
        <?php
        echo "<h1>" . $ins_subcode . "</h1>"
            ?>
    </div>

    <div class="modal fade" id="addPersonModal" tabindex="-1" role="dialog" aria-labelledby="addPersonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPersonModalLabel">Add Student to Subject</h5>
                </div>

                <div class="modal-body">
                    <form id="addPersonForm" method="POST"
                        action="backend/add_newstu.php?ins_subcode=<?php echo $ins_subcode ?>">


                        <div class="form-group">
                            <label for="code">Student ID:</label>
                            <input type="text" class="form-control" id="stu_id" name="stu_id" required>
                        </div>

                        <div class="form-group">
                            <label for="code">First Name:</label>
                            <input type="text" class="form-control" id="stu_fname" name="stu_fname" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="sub">Last Name:</label>
                            <input type="text" class="form-control" id="stu_lname" name="stu_lname" required readonly>
                        </div>

                        <div class="form-group">
                            <label for="sub">M.I:</label>
                            <input type="text" class="form-control" id="stu_mname" name="stu_mname" required readonly>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="schedule">Program:</label>
                                    <input class="form-control" id="stu_program" name="stu_program" required readonly>
                                </div>

                                <div class="col-md-6">
                                    <label for="schedule">Year Level:</label>
                                    <input class="form-control" id="stu_year" name="stu_year" required readonly>

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


    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this student from the subject?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editStudentForm" method="POST" action="backend/edit_newstu.php">
                        <input type="hidden" name="ins_subcode" value="<?php echo $ins_subcode; ?>">
                        <input type="hidden" name="stu_id" id="editStuId">
                        <div class="form-group">
                            <label for="editStuProgram">Program:</label>
                            <input type="text" class="form-control" id="editStuProgram" name="stu_program" required>
                        </div>
                        <div class="form-group">
                            <label for="editStuYear">Year Level:</label>
                            <input type="text" class="form-control" id="editStuYear" name="stu_year" required>
                        </div>
                        <div class="form-group">
                            <label for="editStuGrade">Grade:</label>
                            <input type="text" class="form-control" id="editStuGrade" name="stu_grade" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="submit" class="btn btn-success">SAVE</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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

        $(document).ready(function () {
            $('#stu_id').on('input', function () {
                var studentId = $(this).val();
                if (studentId) {
                    $.ajax({
                        type: 'POST',
                        url: 'backend/fetch_stu.php',
                        data: { student_id: studentId },
                        success: function (data) {
                            var studentData = JSON.parse(data);
                            $('#stu_fname').val(studentData.stu_fname);
                            $('#stu_lname').val(studentData.stu_lname);
                            $('#stu_mname').val(studentData.stu_mname);
                            $('#stu_program').val(studentData.stu_program);
                            $('#stu_year').val(studentData.stu_year);
                        }
                    });
                } else {
                    $('#stu_fname').val('');
                    $('#stu_lname').val('');
                    $('#stu_mname').val('');
                    $('#stu_program').val('');
                    $('#stu_year').val('');
                }
            });
        });

        $(document).ready(function () {
            $(".delete-button").click(function () {
                var stu_id = $(this).closest("tr").find("th").text();
                $("#confirmationModal").data("stu-id", stu_id);
                $("#confirmationModal").modal("show");
            });

            $("#confirmDelete").click(function () {
                var stu_id = $("#confirmationModal").data("stu-id");
                $.ajax({
                    type: 'POST',
                    url: 'backend/delete_newstu.php',
                    data: { stu_id: stu_id, ins_subcode: "<?php echo $ins_subcode; ?>" },
                    success: function (response) {
                        if (response === "success") {
                            $("tr:contains(" + stu_id + ")").remove();
                        } else {
                            alert("Error deleting the student record.");
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert("Error: " + errorThrown);
                    }
                });
                $("#confirmationModal").modal("hide");
            });
        });


        $(document).ready(function () {
            $(".edit-button").click(function () {
                var stu_id = $(this).data("stu-id");
                $("#editStuId").val(stu_id);

                var stu_program = $(this).closest("tr").find("td:nth-child(3)").text();
                var stu_year = $(this).closest("tr").find("td:nth-child(4)").text();
                var stu_grade = $(this).closest("tr").find("td:nth-child(5)").text();

                $("#editStuProgram").val(stu_program);
                $("#editStuYear").val(stu_year);
                $("#editStuGrade").val(stu_grade);

                $("#editModal").modal("show");
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
                <th scope="col">Student ID</th>
                <th scope="col">Student Name</th>
                <th scope="col">Program</th>
                <th scope="col">Year Level</th>
                <th scope="col">Grade</th>
                <th scope="col">Operations</th>
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
                <td>' . $stu_year . '</td>
                <td>' . $stu_grade . '</td>
                <td> <button class="btn btn-success edit-button" data-stu-id="' . $stu_id . '">Edit</button>

                <button class="btn btn-danger delete-button" data-sub-id="">Delete</button></td>
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