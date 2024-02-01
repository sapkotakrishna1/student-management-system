<?php

// Include the connection file and the file where you store the user's session
include('../conn/connection.php');
include("studentindex.php");


$tableName = $_SESSION['class'];

// Modify your SQL query to fetch data from the dynamic table
$sql = "SELECT * FROM $tableName";
$result = mysqli_query($con, $sql);

?>

        

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Student Management System</title>
    <style>
       
.table{
    position: absolute;
    top: 150px;
    left: 449px;
    width: 800px;
    margin: 100px;
    border-collapse: collapse; 
    background-image: url(../sms4.jpg); 
    background-size: cover;  
    }
        
div {
    text-align: center;
            
    }

td,th,tr{
    padding: 10px;
    border: 1px solid black;
    font-size: 16px;
             
          
          
    }
    </style>
</head>
<body>
    <div class="table">
        <form>
            <table class="tab">
                <tr>
                    <th>ID</th>
                    <th>Reg_No</th>
                    <th>Roll_No</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Class</th>
                    <th>Section</th>
                </tr>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['reg_no']; ?></td>
                            <td><?php echo $row['roll']; ?></td>
                            <td><?php echo $row['fullname']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['class']; ?></td>
                            <td><?php echo $row['section']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='7'><div>No data found</div></td></tr>";
                }
                ?>
            </table>
        </form>
    </div>
</body>
</html>


