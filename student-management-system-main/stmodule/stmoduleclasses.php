<?php

include('../conn/connection.php');
include("studentindex.php");

$class = $_SESSION['class'];

// Modify your SQL query to fetch data from the dynamic table
$sql = "SELECT id,class,subject_name,sections,classteacher FROM classes_data WHERE class='$class'";
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

#table {
position: absolute;
top: 150px;
left: 445px;
width: 800px;
margin: 100px;
border-collapse: collapse;
background-image: url(../sms4.jpg);
background-size: cover;
overflow: hidden; 
z-index: 1; 
}

       
td,th,tr{
 padding: 10px;
 border: 1px solid black;
 overflow: hidden;
 font-size: 16px;
 border-collapse: collapse;
 border-radius: 10px;
          
}
    
    </style>
</head>
<body>
    <div id="table">
    <table>
        <tr>
            <th >ID</th>
            <th >Class</th>
            <th>Subject Name</th>
            <th>Sections</th>
            <th>Class Teacher</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['class']; ?></td>
                    <td><?php echo $row['subject_name']; ?></td>
                    <td><?php echo $row['sections']; ?></td>
                    <td><?php echo $row['classteacher']; ?></td>
                    
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='6'><div>No data found</div></td></tr>";
        }
        ?>
        
    </table>
    </div>
    </form>
       
</body>
</html>
