<?php
include('conn/connection.php');

$id = $_GET['id'];
$query = "SELECT * FROM `request` WHERE `id` = '$id';";
$sql = mysqli_query($con, $query) or die(mysqli_error($con));

while ($row = mysqli_fetch_assoc($sql)) {
    $student = $row['student'];
    $class = $row['class'];
    $section = $row['section'];
    $fullname = $row['fullname'];
    $address = $row['address'];
    $email = $row['email'];
    $password = $row['password'];

    $insertQuery = "INSERT INTO `user_data` (`student`, `class`, `section`, `fullname`, `address`, `email`, `password`) 
             VALUES ('$student', '$class', '$section', '$fullname', '$address', '$email', '$password');";
    
    if (performQuery($insertQuery)) {
        $deleteQuery = "DELETE FROM `request` WHERE `id` = '$id';";
        if (performQuery($deleteQuery)) {
            echo "Account has been accepted.";
            header("location: index.php");
        } else {
            echo "Error deleting request.";
        }
    } else {
        echo "Error accepting request.";
    }
}

function performQuery($query) {
    global $con;
    return mysqli_query($con, $query);
}
?>
<br/><br/>
