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
    
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have form fields for homework data
    $class = mysqli_real_escape_string($con, $_POST['class']);
    $teacher = mysqli_real_escape_string($con, $_POST['teacher']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $due_date = mysqli_real_escape_string($con, $_POST['due_date']);


    // Check if the submitted class matches the user's logged-in class
    if ($class !== $tableName) {
        echo '<script>alert("You can only add homework for your own class"); window.location.href = "homeworkadd.php";</script>';
        exit(); // Stop execution to prevent further processing
    }

    // File upload handling
    $file = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];

    if (!empty($file)) {
        $upload_directory = "path_to_upload_directory/";

        // Check if the directory exists, create it if not
        if (!is_dir($upload_directory)) {
            mkdir($upload_directory, 0755, true);
        }

        // Check file extension
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'pdf'];
        $file_extension = pathinfo($file, PATHINFO_EXTENSION);

        if (in_array(strtolower($file_extension), $allowed_extensions)) {
            // Move the uploaded file
            if (move_uploaded_file($file_tmp, $upload_directory . $file)) {
                // Insert data into the homework table
                $insertSql = "INSERT INTO homework (class, teacher, title, description, file, due_date) 
                              VALUES ('$class', '$teacher', '$title', '$description', '$file', '$due_date')";

                if (mysqli_query($con, $insertSql)) {
                    echo "Homework added successfully.";
                    header('location: index.php');
                } else {
                    echo "Error adding homework: " . mysqli_error($con);
                }
            } else {
                echo "Error moving the uploaded file.";
            }
        } else {
            echo "Only JPG, JPEG, PNG, and PDF files are allowed.";
        }
    } else {

        $file="No img upload" ;
        // Insert data into the homework table without a file
        $insertSql = "INSERT INTO homework (class, teacher, title, description, file, due_date) 
                      VALUES ('$class', '$teacher', '$title', '$description','$file', '$due_date')";

        if (mysqli_query($con, $insertSql)) {
            echo "Homework added successfully (without an image).";
        } else {
            echo "Error adding homework: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Homework Management</title>
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
        </style>
</head>
<body>
    <div id=box>
    <h2>Add Homework</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label  for="class">Class:</label>
        <input id="text" type="text" name="class" value="<?php echo $tableName; ?>" readonly require><br><br>

        <label  for="teacher">Teacher:</label>
        <input id="text" type="text" name="teacher" required><br><br>

        <label   for="title">Title:</label>
        <input id="text" type="text" name="title" required><br><br>

        <label  for="description">Description:</label>
        <textarea id="text" name="description" rows="4" cols="50" required></textarea><br><br>

        <label  for="file">File:</label>
        <input id="text" type="file" name="file" accept="image/*"><br><br>

        <label  for="due_date">Due Date:</label>
        <input id="text" type="date" name="due_date" required><br><br>

        <input style="font-size: 12px;" id="button" type="submit" value="Add Homework">

    </form>
</div>
</body>
</html>
