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

if (isset($_POST['save'])) {
    $reg_no = $_POST['register'];
    $roll = $_POST['roll'];
    $fullname = $_POST['full_name'];
    $gender = $_POST['gender'];
    $class = $_POST['class'];
    $section = $_POST['section'];

    // Check if the submitted class matches the user's logged-in class
    if ($class !== $tableName) {
        echo '<script>alert("You can only admission for your own class"); window.location.href = "admissionform.php";</script>';
        exit(); // Stop execution to prevent further processing
    }
    $sql = "INSERT INTO `$tableName` (`reg_no`, `roll`, `fullname`, `gender`, `class`, `section`) 
            VALUES ('$reg_no', '$roll', '$fullname', '$gender', '$class', '$section');";

    $result = mysqli_query($con, $sql);
    if ($result == true) {
        echo "Admission Successfully";
        header('location: index.php');
    } else {
        echo "Error in Save: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">

    <style>
        body{
            background-color: #ccc;
        }
        
		#box{
             position: absolute;
             top: 15%;
             left: 40%;
             background-color: white;
             border: 1px solid black;
             border-radius: 10px;
             margin: auto;
             width: 300px;
             padding: 20px;
        }

        #text{

            height: 20px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin black;
            width: 100%;
}
        #box{
         position: absolute;
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
        <form action="<?php echo $_SERVER['PHP_SELF'];?>"  method="post">
            <h2>Student Admission</h2>
            <label>Register No</label>
            <input id="text" type="number" placeholder="Register No" name="register" required><br><br>

            <label>Roll No</label>
            <input id="text" type="number" placeholder="Roll No" name="roll"><br><br>

            <label>Full Name</label>
            <input id="text" type="text" placeholder="Full Name" name="full_name"><br><br>

            <label>Gender:</label><br>
            <input type="radio" name="gender" value="male" required >
            <label>Male</label>
            <input type="radio" name="gender" value="female">
            <label>Female</label>
            <input type="radio" name="gender" value="other">
            <label>Other</label>
            <br><br>

            <label>Class</label>
            <input id="text" type="text" placeholder="Class" name="class" value="<?php echo $tableName; ?>" readonly><br><br>

            <label>Section</label>
            <input id="text" type="text" placeholder="Section" name="section"><br><br>

            <input id="button" type="submit" name="save" value="save"><br><br>
        </form>
    </div>
</body>
</html>
