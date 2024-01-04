<?php
include('conn/connection.php');
include("index.php");
  
  $class = $_SESSION['class'];
  
  // Modify your SQL query to fetch data from the dynamic table
  $sql = "SELECT id, class, teacher, title, description, date_assigned, file, due_date FROM homework WHERE class='$class'";
  $result = mysqli_query($con, $sql);
  ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Student Management System</title>
    <style>


 
        div {
            text-align: center;
        }

        .tab {
            position: absolute;
            top: 150px;
            left: 445px;
            max-width: 100%;
            margin: 100px; 
            border-collapse: collapse;
            background-color: #ccc;
        }


        td, th, tr {
            padding: 10px;
            border: 1px solid black;
            overflow: hidden;
            font-size: 16px;
        }


        #ntc {
            position: absolute;
            top: 110px;
            left: 438px;
            width: 100px;
            margin: 100px;
            font-size: 18px;
            font-weight: bold; 
        }

        /* Style the anchor tag for image links */
        .image-link {
            display: block;
        }
        
    </style>
</head>
<body>
    <div id="table">
        <form>
            <table class="tab">
                <tr>
                    <th>ID</th>
                    <th>Class</th>
                    <th>Teacher</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>File</th>
                    <th>Date Assigned</th>
                    <th>Due Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $fileData = $row['file'];

                        // Check if BLOB data is not empty
                        if (!empty($fileData)) {
                            $base64File = base64_encode($fileData);
                            $mimeType = "image/jpeg";  // Change this based on your file types

                            // Create an appropriate data URI
                            echo '<tr>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['class'] . '</td>';
                            echo '<td>' . $row['teacher'] . '</td>';
                            echo '<td>' . $row['title'] . '</td>';
                            echo '<td>' . $row['description'] . '</td>';
                            echo '<td><a class="image-link" href="data:' . $mimeType . ';base64,' . $base64File . '" target="_blank"><img src="data:' . $mimeType . ';base64,' . $base64File . '" alt="Image"></a></td>';
                            echo '<td>' . $row['date_assigned'] . '</td>';
                            echo '<td>' . $row['due_date'] . '</td>';
                            echo '<td><a href="homeworkedit.php?id=' . $row['id'] . '">Edit</a></td>';
                            echo '<td><a href="homeworkdelete.php?id=' . $row['id'] . '">Delete</a></td>';
                            echo '</tr>';
                        } else {
                            echo '<tr><td colspan="10">File not found</td></tr>';
                        }
                    }
                } else {
                    echo '<tr><td colspan="10"><div>No data found</div></td></tr>';
                }
                ?>
            </table>
            <a id="ntc" href="homeworkadd.php">Add Homework</a>
        </form>
    </div>
</body>
<script>
    
</script>
</html>
