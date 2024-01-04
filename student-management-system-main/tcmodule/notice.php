<?php

include('conn/connection.php');
include("index.php");

$class = $_SESSION['class'];

// Modify your SQL query to fetch data from the dynamic table
$sql = "SELECT id,teacher,class,title,message,file,date,expiry_date FROM notice WHERE class='$class'";
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
        .tab{
            position: absolute;
            top: 150px;
            left: 445px;
            max-width: 100%;
            margin: 100px; 
            border-collapse: collapse;
            background-color: #ccc;
              
        }
       
        td,th,tr{
             padding: 10px;
             border: 1px solid black;
             overflow: hidden;
             font-size: 16px;
             
          
          
        }
       #ntc{
        position: absolute;
            top: 125px;
            left: 438px;
            width: 100px;
            margin: 100px;
            font-size: 18px;
            font-weight: bold;  
       }

    </style>
</head>
<body>
    
    <div id="table">
        <form>
    <table class="tab" >
        <tr>
            <th >ID</th>
			<th >Teacher</th>
            <th >Class</th>
            <th>Title</th>
            <th>Message</th>
            <th>File Path</th>
            <th>Date</th>
            <th>Expiry Date</th>
			<th>Edit</th>
			<th>Delete</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
					<td><?php echo $row['teacher']; ?></td>
                    <td><?php echo $row['class']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td><?php echo $row['file']; ?></td>
					<td><?php echo $row['date']; ?></td>
					<td><?php echo $row['expiry_date']; ?></td>
                    <td><a href="noticeedit.php ?id=<?php echo $row['id'];?>">Edit</a></td>
                    <td><a href="noticedelete.php ?id=<?php echo $row['id'];?>">Delete</a></td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='10'><div >No data found</div></td></tr>";
        }
        ?>
        <a id="ntc" href="noticeadd.php">Add Notice</a>
    </table>
   
    </div>
    </form>
       
</body>
<script>
    
</script>
</html>
