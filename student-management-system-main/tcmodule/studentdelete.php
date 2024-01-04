<?php
session_start();
include('conn/connection.php');

if (!isset($_SESSION['class'])) {
    header('location: login.php'); // Redirect if the user is not logged in
    exit();
}

$tableName = $_SESSION['class'];

if (isset($_GET['id'])) {
    $delete_id = $_GET['id'];

    // Remove single quotes around $tableName
    $sql = "DELETE FROM $tableName WHERE id='$delete_id'";

    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "Delete Successfully";
        header('location: index.php');
        exit;
    } else {
        echo "Error in delete: " . mysqli_error($con);
    }
}
?>
