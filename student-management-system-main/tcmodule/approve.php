<?php
    include('conn/connection.php');
    include("index.php");


    // Modify your SQL query to fetch data from the dynamic table
    $sql = "SELECT * FROM request";
    $result = mysqli_query($con, $sql);

    $class = $_SESSION['class'];
      
      // Modify your SQL query to fetch data from the dynamic table
      $sql = "SELECT id,class,section,fullname,address,email,status FROM request WHERE class='$class'";
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
                <th>Class</th>
                <th>Section</th>
                <th>Full Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>ACCEPT</th>
                <th>REJECT</th>
            </tr>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['class']; ?></td>
                        <td><?php echo $row['section']; ?></td>
                        <td><?php echo $row['fullname']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><a href="accept.php?id=<?php echo $row['id']; ?>">ACCEPT</a></td>
                        <td><a href="reject.php?id=<?php echo $row['id']; ?>">REJECT</a></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='9'><div>No data found</div></td></tr>";
            }
            ?>
        </table>
    </form>
</div>

</body>
</html>
