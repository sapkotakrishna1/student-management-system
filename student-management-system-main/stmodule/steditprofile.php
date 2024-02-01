<?php
session_start();
include('../conn/connection.php');

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// Get the user's email from the session
$email = $_SESSION['email'];

// Fetch user data from the database using the email
$select_query = "SELECT * FROM user_data WHERE email = ?";
$stmt = mysqli_prepare($con, $select_query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && $row = mysqli_fetch_assoc($result)) {
    // User data found, proceed with form submission
    if (isset($_POST['update'])) {
        $fullname = $_POST['name'];
        $newEmail = $_POST['email'];
        $section = $_POST['section'];
        $address = $_POST['address'];
        $password = $_POST['oldpassword'];
        $newpass = $_POST['newpassword'];
        $repass = $_POST['repassword'];

        // Validate old password
        if (password_verify($password, $row['password'])) {
            // Old password is correct, proceed with the update
            $hashedNewPass = password_hash($newpass, PASSWORD_DEFAULT);

           // Update the user's profile
             $update_query = "UPDATE user_data SET fullname = ?, email = ?, address = ?, section = ?, password = ? WHERE email = ?";
             $stmt = mysqli_prepare($con, $update_query);
             
             // Adjusted the number of placeholders and parameters to match the query
             mysqli_stmt_bind_param($stmt, "ssssss", $fullname, $newEmail, $address, $section, $hashedNewPass, $email);
             $update_result = mysqli_stmt_execute($stmt);

            if ($update_result) {
                // Update the email in the session after a successful update
                $_SESSION['email'] = $newEmail;
                $_SESSION['fullname'] = $fullname;
                // Display the alert message using JavaScript
                echo "<script>alert('Profile Updated Successfully login for change');";
                // Redirect to the studentindex.php page after displaying the alert
                echo "window.location.href='studentindex.php';</script>";

            } else {
                echo "<script>alert('Error occurred while updating profile');</script>";
                header('location: studentindex.php');
            }
        } else {
            // Old password is incorrect
            echo "<script>alert('Old Password Mismatch');</script>";
        }
    }
} else {
    // User not found, handle appropriately (redirect, error message, etc.)
    echo "<script>alert('User not found');</script>";
}

mysqli_stmt_close($stmt);
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
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
        
    </style>
</head>
<body>
    <div id="box">
        <form method="post">
            <h2>Edit Profile</h2>
            
            <!-- Modify the following line to use 'name' instead of 'fullname' -->
            <label>Name</label>
            <input id="text" type="text" name="name" value="<?php echo isset($row['fullname']) ? $row['fullname'] : ''; ?>"><br><br>

            <!-- Add the following lines to retrieve and display the current email -->
            <label>Email</label>
            <input id="text" type="text" name="email" value="<?php echo $email; ?>" readonly><br><br>

            <label>Address</label>
            <input id="text" type="text" placeholder="Address" name="address" value="<?php echo isset($row['address']) ? $row['address'] : ''; ?>"><br><br>

            <label>Section</label>
            <input id="text" type="text" placeholder="Section" name="section" value="<?php echo isset($row['section']) ? $row['section'] : ''; ?>"><br><br>

            <label>Old Password</label>
            <input id="text" type="password" placeholder="Old Password" name="oldpassword"><br><br>

            <label>New Password</label>
            <input id="text" type="password" placeholder="New Password" name="newpassword"><br><br>

            <label>Retype Password</label>
            <input id="text" type="password" placeholder="Retype Password" name="repassword"><br><br>

            <input id="button" type="submit" name="update" value="Update"><br><br>
        </form>
    </div>
</body>
</html>
