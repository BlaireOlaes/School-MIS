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
    <a class="label label-default" href="instructors.php">Instructors</a> <span> > Subjects</span>

    <?php if (isset($_GET['ins_id']) && is_numeric($_GET['ins_id'])) {
        $ins_id = (int) $_GET['ins_id'];


        $sql = "SELECT * FROM assignedsub WHERE ins_id = $ins_id";
        $result = $conn->query($sql);

        $sql_sub = "SELECT sub_code FROM subject";
        $result_sub = $conn->query($sql_sub);
    } else {

    }
    ?>
    <div class="container">
        <button class="btn btn-success" id="addButton">Add New Subject</button>
        <?php
        echo "<h1>" . $ins_id . "</h1>"
            ?>
    </div>

    <div class="modal fade" id="addPersonModal" tabindex="-1" role="dialog" aria-labelledby="addPersonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPersonModalLabel">Add New Subject</h5>
                </div>

                <div class="modal-body">
                    <form id="addPersonForm" method="POST"
                        action="backend/add_newsub.php?ins_id=<?php echo $ins_id; ?>">

                        <div class="form-group">
                            <label for="code">Subject Code:</label>
                            <select class="form-control" id="ins_subcode" name="ins_subcode" required>
                                <?php
                                if ($result_sub->num_rows > 0) {
                                    while ($sub_row = $result_sub->fetch_assoc()) {
                                        echo '<option value="' . $sub_row['sub_code'] . '">' . $sub_row['sub_code'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No subjects available</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ins_sname">Subject Name:</label>
                            <input type="text" class="form-control" id="ins_sname" name="ins_sname" required readonly>
                        </div>


                        <div class="form-group">
                            <label for="schedule">Schedule:</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-control" id="schedule-day" name="schedule-day" required>
                                        <option value="MTh">MTh</option>
                                        <option value="TF">TF</option>
                                        <option value="W">W</option>
                                        <option value="S">S</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <select class="form-control" id="schedule-time" name="schedule-time" required>
                                        <option value="" selected disabled>Select Time</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="room">Room:</label>
                            <input type="text" class="form-control" id="ins_room" name="ins_room" required>
                        </div>
                        <div class="form-group">
                            <label for="room">No. of Students:</label>
                            <input type="text" class="form-control" id="ins_snum" name="ins_snum" required>
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
                    Are you sure you want to delete this record?
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
                    <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="backend/edit_newsub.php">
                        <input type="hidden" name="ins_id" value="<?php echo $ins_id; ?>">
                        <input type="hidden" id="editInsSubcode" name="ins_subcode">
                        <div class="form-group">
                            <label for="ins_sname">Subject Name:</label>
                            <input type="text" class="form-control" id="editInsSname" name="ins_sname" required>
                        </div>
                        <div class="form-group">
                            <label for="schedule-day">Schedule Day:</label>
                            <select class="form-control" id="editScheduleDay" name="ins_sday" required>
                                <option value="MTh">MTh</option>
                                <option value="TF">TF</option>
                                <option value="W">W</option>
                                <option value="S">S</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="schedule-time">Schedule Time:</label>
                            <select class="form-control" id="editScheduleTime" name="ins_stime" required>
                                <option value="7:30-9:00">7:30-9:00</option>
                                <option value="9:00-10:30">9:00-10:30</option>
                                <!-- Add options for other times -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ins_room">Room:</label>
                            <input type="text" class="form-control" id="editInsRoom" name="ins_room" required>
                        </div>
                        <div class="form-group">
                            <label for="ins_snum">No. of Students:</label>
                            <input type="text" class="form-control" id="editInsSnum" name="ins_snum" required>
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
            const scheduleOptions = {
                MTh: ["7:30-9:00", "9:00-10:30", "10:30-12:00", "1:00-2:30", "2:30-4:00", "4:00-5:30", "5:30-7:00"],
                TF: ["7:30-9:00", "9:00-10:30", "10:30-12:00", "1:00-2:30", "2:30-4:00", "4:00-5:30", "5:30-7:00"],
                W: ["8:00-10:00", "10:00-12:00", "1:00-3:00", "3:00-5:00", "5:00-7:00"],
                S: ["8:00-10:00", "10:00-12:00", "1:00-3:00", "3:00-5:00", "5:00-7:00"]
            };
            const scheduleDayDropdown = $("#schedule-day");
            const scheduleTimeDropdown = $("#schedule-time");
            scheduleDayDropdown.on("change", function () {
                const selectedDay = $(this).val();
                const options = scheduleOptions[selectedDay];
                scheduleTimeDropdown.empty();
                options.forEach(function (option) {
                    scheduleTimeDropdown.append($("<option>", {
                        value: option,
                        text: option
                    }));
                });
            });
            scheduleDayDropdown.trigger("change");
        });

        $(document).ready(function () {
            $("#addButton").click(function () {
                $("#addPersonModal").modal("show");
            });
        });


        $(document).ready(function () {
            $('#ins_subcode').change(function () {
                var selectedCode = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'backend/fetch_sub.php',
                    data: { code: selectedCode },
                    success: function (response) {

                        $('#ins_sname').val(response);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                    }
                });
            });
        });




        $(document).ready(function () {
            // Handle the delete button click
            $(".delete-button").click(function () {
                // Get the ins_subcode for the row
                var ins_subcode = $(this).closest("tr").find("th").text();

                // Store the ins_subcode in a data attribute of the confirmation modal
                $("#confirmationModal").data("ins-subcode", ins_subcode);

                // Show the confirmation modal
                $("#confirmationModal").modal("show");
            });

            // Handle the confirmation modal delete button click
            $("#confirmDelete").click(function () {
                // Get the ins_subcode from the data attribute
                var ins_subcode = $("#confirmationModal").data("ins-subcode");

                // Send an AJAX request to delete the record
                $.ajax({
                    type: 'POST',
                    url: 'backend/delete_newsub.php', // Replace with the actual URL to your delete script
                    data: { ins_subcode: ins_subcode },
                    success: function (response) {
                        if (response === "success") {
                            // Row deleted successfully, you can remove it from the table
                            $("tr:contains(" + ins_subcode + ")").remove();
                        } else {
                            // Handle any error or display a message
                            alert("Error deleting the record.");
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        // Handle errors here
                        alert("Error: " + errorThrown);
                    }
                });

                // Close the confirmation modal
                $("#confirmationModal").modal("hide");
            });
        });


        $(document).ready(function () {
            // Handle the edit button click
            $(".edit-button").click(function () {
                // Get the values from the table row for editing
                var row = $(this).closest("tr");
                var ins_subcode = row.find("th").text();
                var ins_sname = row.find("td:nth-child(2)").text();
                var ins_sday_time = row.find("td:nth-child(3)").text().split(" | ");
                var ins_day = ins_sday_time[0];
                var ins_time = ins_sday_time[1];
                var ins_room = row.find("td:nth-child(4)").text();
                var ins_snum = row.find("td:nth-child(5)").text();

                // Populate the edit modal with the data
                $("#editInsSubcode").val(ins_subcode);
                $("#editInsSname").val(ins_sname);
                $("#editScheduleDay").val(ins_day);
                $("#editScheduleTime").val(ins_time);
                $("#editInsRoom").val(ins_room);
                $("#editInsSnum").val(ins_snum);

                // Show the edit modal
                $("#editModal").modal("show");
            });

            // Handle the "Save Changes" button click in the edit modal
            $("#saveEdit").click(function () {
                // Add your code to handle saving the changes, such as an AJAX request.
                // ...

                // Close the edit modal
                $("#editModal").modal("hide");
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
                        <th scope="col">Schedule</th>
                        <th scope="col">Room</th>
                        <th scope="col">No. of Students</th>
                        <th scope="col">Operations</th>
                        <th scope="col">Actions</th>
                    </thead>
                    <tbody>';

        while ($row = $result->fetch_assoc()) {
            $ins_id = $row['ins_id'];
            $ins_subcode = $row['ins_subcode'];
            $ins_sname = $row['ins_sname'];
            $ins_sda = $row['ins_sday'];
            $ins_stime = $row['ins_stime'];
            $ins_room = $row['ins_room'];
            $ins_snum = $row['ins_snum'];

            echo '<tr>
                            <th scope="row">' . $ins_subcode . '</th>
                            <td>' . $ins_sname . '</td>
                            <td> ' . $ins_sda . ' | ' . $ins_stime . '</td>
                            <td> ' . $ins_room . '</td>
                            <td>' . $ins_snum . '</td>
                            <td>  <button class="btn btn-success edit-button" data-sub-id="">Edit</button>
                            <button class="btn btn-danger delete-button" data-sub-id="">Delete</button></td>
                            <td>
                                <a href="./viewstu.php?ins_subcode=' . $ins_subcode . '" class="btn btn-primary"><i
                                        class="far fa-eye"></i> View Students</a>
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