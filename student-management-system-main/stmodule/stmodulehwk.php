
<?php
include('../conn/connection.php');
include("studentindex.php");

$class = $_SESSION['class'];

// Modify your SQL query to fetch data from the dynamic table
$sql = "SELECT id,class,teacher,title,description,date_assigned,file,due_date FROM homework WHERE class='$class'";
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
            top: 110px;
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
			<th >Class</th>
            <th >Teacher</th>
            <th>Title</th>
            <th>Descciption</th>
            <th>file</th>
            <th>Date Assigned</th>
            <th>Due Date</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
					<td><?php echo $row['class']; ?></td>
                    <td><?php echo $row['teacher']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['file']; ?></td>
                    <td><?php echo $row['date_assigned']; ?></td>
					<td><?php echo $row['due_date']; ?></td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='10'><div >No data found</div></td></tr>";
        }
        ?>
    </table>
   
    </div>
    </form>
       
</body>
<script>
    
</script>
</html>
