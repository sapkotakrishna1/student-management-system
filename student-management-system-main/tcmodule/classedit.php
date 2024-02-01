<?php
include('conn/connection.php');

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $class =$_POST['class'];
    $subject_name = $_POST['name'];
    $sections = $_POST['sections'];
    $classteacher = $_POST['classteacher'];

    // Use prepared statement to update data securely
    $sql = "UPDATE classes_data SET  class=?,subject_name=?, sections=?, classteacher=? WHERE id=?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $class, $subject_name, $sections, $classteacher, $id);

    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Records updated successfully";
        header('Location: classes.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">
    <style>
#box{
     position: absolute;
     top: 25%;
     left: 40%;
     background-color: white;
     border: 1px solid black;
     border-radius: 10px;
     margin: auto;
     width: 300px;
     padding: 20px;
}
#text{
    height: 15px;
    border-radius: 5px;
    padding: 4px;
    border: solid thin black;
    width: 100%;
}



    </style>
</head>
<body>
    <div id="box">
        <?php
        $id = $_GET["id"];
        $sql = mysqli_query($con, "SELECT * FROM classes_data WHERE id = $id") or die(mysqli_error($con));
        while ($row = mysqli_fetch_object($sql)) {
        ?>
           <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=$id"; ?>" method="post">
           <div style="font-size: 20px; margin: 10px; color: black;">Edit Classes</div>
           <label>Class :</label>
           <input id="text" type="text" placeholder="Class Name...." name="class" value="<?php echo $row->class; ?>"><br><br>

           <label>Subject Name :</label>
           <input id="text" type="text" placeholder="Subject Name...." name="name" value="<?php echo $row->subject_name; ?>"><br><br>

           <label>Sections :</label>
           <input id="text" type="text" placeholder="Sections..." name="sections" value="<?php echo $row->sections; ?>"><br><br>

           <label>Class Teacher :</label>
           <input id="text" type="text" placeholder="Teacher Name..." name="classteacher" value="<?php echo $row->classteacher; ?>"><br><br>

           <input type="submit" name="update" value="Update"><br><br>
        </form>
    <?php } ?>
</div>
</body>
</html>
