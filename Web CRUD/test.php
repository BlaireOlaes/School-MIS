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

    <?php
    $ins_id = $_GET['ins_id'];
    $sql = "SELECT * FROM assignedsub WHERE ins_id = $ins_id";
    $result = $conn->query($sql);

    $sql_sub = "SELECT sub_code FROM subject";
    $result_sub = $conn->query($sql_sub);
    ?>

    <div class="container">
        <button class="btn btn-success" id="addButton">Add New Subject</button>
        <h1><?php echo $ins_id; ?></h1>
    </div>

    <div class="modal fade" id="addPersonModal" tabindex="-1" role="dialog" aria-labelledby="addPersonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPersonModalLabel">Add New Instructor</h5>
                </div>

                <div class="modal-body">
                    <form id="addPersonForm" method="POST" action="backend/add_newsub.php?ins_id=<?php echo $ins_id; ?>">

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
                            <label for="sub">Subject Name:</label>
                            <input type="text" class="form-control" id="ins_sname" name="ins_sname" required>
                        </div>

                        <!-- Rest of your form fields -->

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
        Mth: ["7:30-9:00", "9:00-10:30", "10:30-12:00", "1:00-2:30", "2:30-4:00", "4:00-5:30", "5:30-7:00"],
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
                <th scope="col">Operations/th>
                <th scope="col">Actions/th>
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
                <td>icons operations</td>
                <td> 
                <a href="./viewstu.php?ins_subcode=' . $ins_subcode . '" class="btn btn-primary"><i class="far fa-eye"></i> View Students</a>
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

</html>Copyright (c) 2000, 2022, Oracle and/or its affiliates.

This is a release of MySQL, an SQL database server.

License information can be found in the LICENSE file.

In test packages where this file is renamed README-test, the license
file is renamed LICENSE-test.

This distribution may include materials developed by third parties.
For license and attribution notices for these materials,
please refer to the LICENSE file.

For further information on MySQL or additional documentation, visit
  http://dev.mysql.com/doc/

For additional downloads and the source of MySQL, visit
  http://dev.mysql.com/downloads/

MySQL is brought to you by the MySQL team at Oracle.
