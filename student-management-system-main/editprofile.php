<?php
session_start();
include('conn/connection.php');

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// Get the user's email from the session
$email = $_SESSION['email'];

// Fetch user data from the database using the email
$select_query = "SELECT * FROM log_teacher WHERE email = ?";
$select_stmt = mysqli_prepare($con, $select_query);
mysqli_stmt_bind_param($select_stmt, "s", $email);
mysqli_stmt_execute($select_stmt);
$result = mysqli_stmt_get_result($select_stmt);

if ($result && $row = mysqli_fetch_assoc($result)) {
    // User data found, proceed with form submission
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $newEmail = $_POST['email'];
        $password = $_POST['oldpassword'];
        $newpass = $_POST['newpassword'];
        $repass = $_POST['repassword'];

        // Fetch stored password from the database
        $storedPassword = $row['password'];

        // Check if the stored password is hashed
        $isStoredPasswordHashed = (strlen($storedPassword) > 30); // Change the threshold as needed

        // Validate old password
        if (($isStoredPasswordHashed && password_verify($password, $storedPassword)) || (!$isStoredPasswordHashed && $password === $storedPassword)) {
            // Old password is correct

            // Check if the new password is the same as the old password
            if ($newpass === $password) {
                // New password is the same as the old password
                echo "<script>alert('New password must be different from the old password');</script>";
            } else {
                // Check if the new password and re-entered password are the same
                if ($newpass === $repass) {
                    // Proceed with the update
                    $hashedNewPass = password_hash($newpass, PASSWORD_DEFAULT);

                    // Update the user's profile
                    $update_query = "UPDATE log_teacher SET name = ?, email = ?, password = ? WHERE email = ?";
                    $update_stmt = mysqli_prepare($con, $update_query);

                    mysqli_stmt_bind_param($update_stmt, "ssss", $name, $newEmail, $hashedNewPass, $email);
                    $update_result = mysqli_stmt_execute($update_stmt);

                    if ($update_result) {
                        // Update the email in the session after a successful update
                        $_SESSION['email'] = $newEmail;
                        echo "<script>alert('Profile Updated Successfully');</script>";
                        header('location: index.php');
                    } else {
                        echo "<script>alert('Error occurred while updating profile');</script>";
                        header('location: index.php');
                    }

                    // Close the update statement after execution
                    mysqli_stmt_close($update_stmt);
                } else {
                    // New password and re-entered password do not match
                    echo "<script>alert('New password and re-entered password must be the same');</script>";
                }
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

// Close the select statement after usage
mysqli_stmt_close($select_stmt);

// Close the database connection
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
            <input id="text" type="text" name="name" value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>"><br><br>

            <!-- Add the following lines to retrieve and display the current email -->
            <label>Email</label>
            <input id="text" type="text" name="email" value="<?php echo $email; ?>" readonly><br><br>

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
