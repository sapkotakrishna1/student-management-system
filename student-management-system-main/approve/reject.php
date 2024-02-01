<?php
include('conn/connection.php');


if (isset($_GET['id'])) {
    $delete_id = $_GET['id'];

    $sql = "DELETE FROM request WHERE id='$delete_id'";

    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "Account has been Rejected";
        header('location: ../index.php');
        exit;
    } else {
        echo "Error in delete: " . mysqli_error($con);
    }
}
?>
