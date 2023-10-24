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
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="./subjects.php">Subjects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="./instructors.php">Instructors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active current" href="./student.php">Students</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <img src="https://icons.veryicon.com/png/o/business/educational-administration-related/teacher-11.png"
        alt="Bootstrap" width="30" height="24">
    <a class="label label-default" href="Student.php">Student</a> <span> >Subjects of Student</span>


    <?php
    require_once('backend/db_connection.php');

    if (isset($_GET['stu_id']) && is_numeric($_GET['stu_id'])) {
        $stu_id = (int) $_GET['stu_id'];

        $sql_subcodes = "SELECT ins_subcode FROM assignedstu WHERE stu_id = $stu_id";
        $result_subcodes = $conn->query($sql_subcodes);

        if ($result_subcodes && $result_subcodes->num_rows > 0) {
            while ($row_subcode = $result_subcodes->fetch_assoc()) {
                $ins_subcode = $row_subcode['ins_subcode'];
                $sql_assignedsub = "SELECT * FROM assignedsub WHERE ins_subcode = '$ins_subcode'";
                $result_assignedsub = $conn->query($sql_assignedsub);

                if ($result_assignedsub && $result_assignedsub->num_rows > 0) {
                    echo '<div class="container">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead>
                                    <th scope="col">Subject Code</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Schedule</th>
                                    <th scope="col">Room</th>
                                </thead>
                                <tbody>';

                    while ($row = $result_assignedsub->fetch_assoc()) {
                        $ins_sname = $row['ins_sname'];
                        $ins_id = $row['ins_id'];
                        $ins_stime = $row['ins_stime'];
                        $ins_room = $row['ins_room'];
                        $ins_snum = $row['ins_snum'];

                        echo '<tr>
                            <th scope="row">' . $ins_subcode . '</th>
                            <td>' . $ins_sname . '</td>
                            <td> ' . $ins_stime . '</td>
                            <td>' . $ins_room . '</td>
                        </tr>';
                    }

                    echo '</tbody>
                    </table>
                </div>
            </div>
        </div>';
                } else {
                    echo 'No data found for ins_subcode: ' . $ins_subcode;
                }
            }
        } else {
            echo 'No data found for stu_id: ' . $stu_id;
        }
    } else {
        echo 'Invalid or missing stu_id parameter.';
    }

    $conn->close();
    ?>  
</body>

</html>