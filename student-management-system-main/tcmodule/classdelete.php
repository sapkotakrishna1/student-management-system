<?php
include('conn/connection.php');


if (isset($_GET['id'])) {
    $delete_id = $_GET['id'];

    $sql = "DELETE FROM classes_data WHERE id='$delete_id'";

    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "Delete Successfully";
        header('location: classes.php');
        exit;
    } else {
        echo "Error in delete: " . mysqli_error($con);
    }
}
?>