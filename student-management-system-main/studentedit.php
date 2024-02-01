<?php
session_start();
include('conn/connection.php');

// Check if the user is logged in and get the user's class from the session
if (!isset($_SESSION['class'])) {
    // user le login gare na bane aauxa
    header('location: login.php');
    exit();
}

$tableName = $_SESSION['class'];

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $reg_no = $_POST['reg_no'];
    $roll = $_POST['roll'];
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $class = $_POST['class'];
    $section = $_POST['section'];

    // Check if the submitted class matches the user's logged-in class
    if ($class !== $tableName) {
        echo '<script>alert("You cannot change the class"); window.location.href = "admissionform.php";</script>';
        exit(); // Stop execution to prevent further processing
    }

    // Corrected the table name and added the SET keyword
    $sql = "UPDATE `$tableName` SET reg_no='$reg_no', roll='$roll', fullname='$fullname',
           gender='$gender', class='$class', section='$section' WHERE id='$id'";

    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "Records updated successfully";
        header('Location: studenttable.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        	#box{
             position: sticky;
             top: 15%;
             left: 40%;
             background-color: white;
             border: 1px solid black;
             border-radius: 10px;
             margin: auto;
             width: 300px;
             padding: 20px;
        }
    </style>
</head>
<body>
    <div id="box">
    <?php 
         $id = $_GET["id"];
         $sql = mysqli_query($con, "SELECT * FROM $tableName WHERE id = $id") or die(mysqli_error($con));
         while ($row = mysqli_fetch_object($sql)) {
         
         ?>
        <form method="post">
            <div style="font-size: 20px; margin: 10px; color: black;">Admission</div>
            <label>Register No</label>
            <input id="text" type="number" name="reg_no" value="<?php print ''.$row->reg_no.''?>"><br><br>

            <label>Roll No</label>
            <input id="text" type="number" placeholder="Roll No" name="roll" value="<?php print ''.$row->roll.''?>"><br><br>

            <label>Full Name</label>
            <input id="text" type="text" placeholder="Full Name" name="fullname" value="<?php print ''.$row->fullname.''?>"><br><br>

            <label>Gender:</label><br>
             <input type="radio" name="gender" value="male" <?php if (isset($row->gender) && $row->gender == 'male') echo 'checked'; ?>>
             <label>Male</label>
             <input type="radio" name="gender" value="female" <?php if (isset($row->gender) && $row->gender == 'female') echo 'checked'; ?>>
             <label>Female</label>
             <input type="radio" name="gender" value="others" <?php if (isset($row->gender) && $row->gender == 'others') echo 'checked'; ?>>
             <label>Other</label>
             <br><br>


            <label>Class</label>
            <input id="text" type="text" placeholder="Class" name="class" value="<?php print ''.$row->class.''?>"><br><br>

            <label>Section</label>
            <input id="text" type="text" placeholder="Section" name="section" value="<?php print ''.$row->section.''?>"><br><br>

            <input id="button" type="submit" name="update" value="Update"><br><br>
        </form>
        <?php } ?>
    </div>
</body>
</html>
