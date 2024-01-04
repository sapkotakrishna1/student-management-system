<?php
include('conn/connection.php');

// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teacher = mysqli_real_escape_string($con, $_POST["teacher"]);
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $message = mysqli_real_escape_string($con, $_POST["message"]);
    $expiry_date = mysqli_real_escape_string($con, $_POST["expiry_date"]);
    $class = mysqli_real_escape_string($con, $_POST["class"]);

    // Check if a file is attached
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        // File upload handling
        $targetDir = "uploads/";  // Specify your upload directory

        // Ensure the directory exists, create it if not
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileExtension = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
        $file = uniqid() . '.' . $fileExtension;
        $targetFile = $targetDir . $fileName;

        // Check if the uploaded file is allowed
        $allowedExtensions = array("jpg", "jpeg", "png", "gif", "pdf");
        if (in_array($fileExtension, $allowedExtensions)) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";

                // Insert data into the database with file name
                $sql = "INSERT INTO notice (class, teacher, title, message, file, date, expiry_date) 
                        VALUES ('$class', '$teacher', '$title', '$message', '$file', CURRENT_DATE, '$expiry_date')";

                // Execute the SQL query
                if (mysqli_query($con, $sql)) {
                    echo "Record inserted successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Invalid file format. Allowed formats: JPG, JPEG, PNG, GIF, PDF.";
        }
    } else {
        // No file attached, handle accordingly
        // Insert data into the database without file_name
        $sql = "INSERT INTO notice (class, teacher, title, message, date, expiry_date) 
                VALUES ('$class', '$teacher', '$title', '$message', CURRENT_DATE, '$expiry_date')";

        // Execute the SQL query
        if (mysqli_query($con, $sql)) {
            echo "Record inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }

    // Close the database connection
    mysqli_close($con);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Notice Form</title>
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
<div id="box">
    <h2>Add Notice</h2>
<form action="noticeadd.php" method="POST">
    <label for="teacher">Teacher:</label>
    <input id="text" type="text" name="teacher" required><br><br>

    <label for="title">Title:</label>
    <input id="text"  type="text" name="title" required><br><br>

    <label for="message">Message:</label>
    <textarea id="text"  name="message" rows="4" cols="50" required></textarea><br><br>

    <label for="class">Class:</label>
    <input id="text"  type="text" name="class" required><br><br>

    <label for="file">File:</label>
    <input id="text"  type="file" name="file" ><br><br>

    <label for="expiry_date">Expiry Date:</label>
    <input id="text"  type="date" name="expiry_date" required><br><br>

    <input id="button"  type="submit" value="Submit">
</form>
<div>

</body>
</html>