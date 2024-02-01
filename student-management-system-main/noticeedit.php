<?php
session_start();
include('conn/connection.php');


if (!isset($_GET['id'])) {
    header('location: index.php');
    exit();
}

$id = $_GET['id'];

// Retrieve homework details based on the ID
$sql = "SELECT * FROM notice WHERE id = $id";
$result = mysqli_query($con, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Notice not found.";
    exit();
}

$row = mysqli_fetch_assoc($result);


if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $teacher = mysqli_real_escape_string($con, $_POST['teacher']);
    $class = mysqli_real_escape_string($con, $_POST['class']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $message = mysqli_real_escape_string($con, $_POST['message']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $file = mysqli_real_escape_string($con, $_POST['file']);
    $expiry_date = mysqli_real_escape_string($con, $_POST['expiry_date']);

  
    // Corrected the table name and added the SET keyword
    $sql = "UPDATE `notice` SET teacher='$teacher', class='$class', title='$title',
           message='$message', date='$date',file='$file', expiry_date='$expiry_date' WHERE id='$id'";

    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "Records updated successfully";
        header('Location: index.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Notice</title>
    <style>
        body {
            background-color: #ccc;
        }

        #box {
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

        #text {
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
   
        <h2>Edit Notice</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            
            <label for="teacher">Teacher</label>
            <input id="text" type="text" name="teacher" value="<?= $row['teacher'] ?>" required><br><br>

            <label for="class">Class</label>
            <input id="text" type="text" name="class" value="<?= $row['class'] ?>" required readonly><br><br>

            <label for="title">Title:</label>
            <input id="text" type="text" name="title" value="<?= $row['title'] ?>" required><br><br>

            <label for="message">Message</label>
            <textarea id="text" name="message" rows="4" cols="50" required><?= $row['message'] ?></textarea><br><br>
            
            <label for="date">File:</label>
            <input id="text" type="file" name="file" value="<?= $row['file'] ?>" required><br><br>

            <label for="date">Date Assigned:</label>
            <input id="text" type="date" name="date" value="<?= $row['date'] ?>" required><br><br>

            <label for="expiry_date">Expiry Date:</label>
            <input id="text" type="date" name="expiry_date" value="<?= $row['expiry_date'] ?>" required><br><br>

           

            <input style="font-size: 12px;" id="button" type="submit"  name="update" value="Update Notice">
        </form>
       
    </div>
</body>
</html>
