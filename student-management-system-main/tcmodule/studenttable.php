<?php
   
   include('conn/connection.php');
    include("index.php");

  
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
     
        .tab {
            position: absolute;
            top: 150px;
            left: 449px;
            max-width: 100%;	
            margin: 100px;
            border-collapse: collapse;
        }

        div {
            text-align: center;
        }

        td, th, tr {
            padding: 10px;
            border: 1px solid black;
            font-size: 16px;
            background-color: #ccc;
        }

        #admission {
            position: absolute;
            top: 125px;
            left: 442px;
            width: 100px;
            margin: 100px;
            font-weight: bold;
            font-size: 18px;
        }
        @media(max-width:998px) {
			tab{
				width: 100% ;
			}
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
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            if (mysqli_num_rows($result) > 0) {
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
                        <td><a href="studentedit.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                        <td><a href="studentdelete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='9'><div>No data found</div></td></tr>";
            }
            ?>
            <div class="flip-container">
            <a id="admission" href="studentaddmision.php">Admission</a>
            </div>
        </table>
    </form>
</div>

</body>
</html>
