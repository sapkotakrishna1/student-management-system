<?php
include('conn/connection.php');


if (!isset($_GET['id'])) {
    header('location: index.php');
    exit();
}

$id = $_GET['id'];

// Retrieve homework details based on the ID
$sql = "SELECT * FROM homework WHERE id = $id";
$result = mysqli_query($con, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Homework not found.";
    exit();
}

$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class = mysqli_real_escape_string($con, $_POST['class']);
    $teacher = mysqli_real_escape_string($con, $_POST['teacher']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $due_date = mysqli_real_escape_string($con, $_POST['due_date']);

    // File upload handling (similar to your existing code)

    $updateSql = "UPDATE homework SET class='$class', teacher='$teacher', title='$title',
                  description='$description', due_date='$due_date' WHERE id='$id'";

    $updateResult = mysqli_query($con, $updateSql);

    if ($updateResult) {
        echo "Homework updated successfully.";
        header('location: studenttable.php');
        exit();
    } else {
        echo "Error updating homework: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Homework</title>
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
        <h2>Edit Homework</h2>
        <form action="" method="POST" enctype="multipart/form-data">

            <label for="class">Class:</label>
            <input id="text" type="text" name="class" value="<?= $row['class'] ?>" required readonly><br><br>

            <label for="teacher">Teacher:</label>
            <input id="text" type="text" name="teacher" value="<?= $row['teacher'] ?>" required><br><br>

            <label for="title">Title:</label>
            <input id="text" type="text" name="title" value="<?= $row['title'] ?>" required><br><br>

            <label for="description">Description:</label>
            <textarea id="text" name="description" rows="4" cols="50" required><?= $row['description'] ?></textarea><br><br>
            
            <label for="due_date">Date Assigned:</label>
            <input id="text" type="date" name="date_assigned" value="<?= $row['date_assigned'] ?>" required><br><br>

            <label for="date">File:</label>
            <input id="text" type="file" name="file" value="<?= $row['file'] ?>" required><br><br>

            <label for="due_date">Due Date:</label>
            <input id="text" type="date" name="due_date" value="<?= $row['due_date'] ?>" required><br><br>

            

            <input style="font-size: 12px;" id="button" type="submit" value="Update Homework">
        </form>
    </div>
</body>
</html>
