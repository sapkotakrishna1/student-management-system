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
        $class = $_POST['class'];
        $subject_name = $_POST['name'];
        $sections = $_POST['sections'];
        $classteacher = $_POST['classteacher'];
          
        // Check if the submitted class matches the user's logged-in class
        if ($class !== $tableName) {
            echo '<script>alert("You can only admission for your own class"); window.location.href = "addclass.php";</script>';
            exit(); // Stop execution to prevent further processing
        }

        // Assuming 'classes_data' is the table where you want to add the class
        $sql = "INSERT INTO `classes_data` (`id`,`class`, `subject_name`, `sections`, `classteacher`) 
                VALUES ('$id','$class', '$subject_name', '$sections', '$classteacher');";

        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "Class Added Successfully";
            header('location: classes.php');
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
    </style>
</head>
<body>
    <div id="box">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>"  method="post">
            <h2>Add Classes</h2>

            <label>Class :</label>
            <input id="text" type="text" placeholder="Class Name...." name="class" value="<?php echo $tableName; ?>" readonly><br><br>

            <label>Subject Name :</label>
            <input id="text" type="text" placeholder="Subject Name...." name="name" ><br><br>

            <label>Sections :</label>
            <input id="text" type="text" placeholder="Sections..." name="sections"><br><br>

            <label>Class Teacher :</label>
            <input id="text" type="text" placeholder="Teacher Name..." name="classteacher"><br><br>

            <input id="button" type="submit" name="save" value="save"><br><br>
        </form>
    </div>
</body>
</html>
