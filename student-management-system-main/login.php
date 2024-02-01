<?php
ob_start();
session_set_cookie_params(0);
session_start();
include('conn/connection.php');

$errorteacherdata = $errorstudentdata = $errorrole = $errorstudentpass = $errorteacherpass='';

if (isset($_POST['submit'])) {
    $role = $_POST['role'];
    $class = $_POST['class'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($role === 'teacher') {
        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM log_teacher WHERE email=? AND class=?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $email, $class);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        if (mysqli_num_rows($result) > 0) {
            // Fetch the user data
            $log_teacher = mysqli_fetch_assoc($result);
    
            // Check if the entered password matches the non-hashed password
            if ($password == $log_teacher['password']) {
                // Password is correct, set session variables
                $_SESSION["email"] = $email;
                $_SESSION['log_teacher'] = $log_teacher;
                $_SESSION["submit"] = true;
                $_SESSION['last_activity'] = time();
                $_SESSION['name'] = $log_teacher['name'];
                $_SESSION['class'] = $log_teacher['class'];
    
                // Redirect to the index page
                header("location: index.php");
            } elseif (password_verify($password, trim($log_teacher['password']))) {
                // Password is hashed, set session variables
                $_SESSION["email"] = $email;
                $_SESSION['log_teacher'] = $log_teacher;
                $_SESSION["submit"] = true;
                $_SESSION['last_activity'] = time();
                $_SESSION['name'] = $log_teacher['name'];
                $_SESSION['class'] = $log_teacher['class'];
    
                // Redirect to the index page
                header("location: index.php");
            } else {
                // Display a message
                $errorteacherpass = "Invalid password";
            }
        } else {
            // Display a message
            $errorteacherdata = "Invalid teacher email and class";
        }
    
    } elseif ($role === 'student') {
        $sql = "SELECT * FROM user_data WHERE email=? AND class=?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $email, $class);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            if (password_verify($password, trim($user_data['password']))) {
                $_SESSION["email"] = $email;
                $_SESSION['user_data'] = $user_data;
                $_SESSION["submit"] = true;
                $_SESSION['last_activity'] = time();
                $_SESSION['fullname'] = $user_data['fullname'];
                $_SESSION['class'] = $user_data['class'];
            
                // Redirect to the student index page
                header("location: stmodule/studentindex.php");
            } else {
                // Display a message
                $errorstudentpass = "Invalid password";
            }
        } else {
            // Display a message
            $errorstudentdata = "Invalid student email and class";
        }
    } else {
       // Display a message
       $errorrole = "Invalid role";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url(img/sms.jpg);
            background-size: cover;
            background-color: #ccc;
        }

        #box {
            position: absolute;
            top: 100px;
            left: 40%;
            background-color: blanchedalmond;
            border: 1px solid black;
            border-radius: 10px;
            margin: auto;
            width: 300px;
            padding: 20px;
            background-image: url(img/sms5.jpg);
            background-size: cover;
        
        }
        #sms {
            font-size: 20px;
            margin: 15px;
            color: black;
        }

        #role {
            width: 310px;
            height: 35px;
        }

        #signup {
            color: black;
            text-decoration: none;
            background-color: #ccc;
            border-radius: 10px;
            text-align: center;
        }

        #signup:hover {
            color: black;
            font-weight: bold;
        }

        #button {
            width: 310px;
            height: 45px;
            font-weight: bold;
            border-radius: 10px;
            
        }

        #text {
            width: 300px;
            height: 30px;
        }
    </style>
</head>

<body>

    <div id="box">
    <form method="post" onsubmit="return validateForm()">
            <div id="sms">Student Management System</div>
            <label>
                <select id="role" name="role">
                    <option>--Select User Type---</option>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                </select><br>
                <span style="color: red;"><?php echo $errorrole; ?></span>

            </label><br>

            <label>
            <select id="role" name="class">
            <option>--Your Class---</option>
                    <option value="one">Class 1</option>
                    <option value="two">Class 2</option>
                    <option value="three">Class 3</option>
                    <option value="four">Class 4</option>
                    <option value="five">Class 5</option>
                    <option value="six">Class 6</option>
                    <option value="seven">Class 7</option>
                    <option value="eight">Class 8</option>
                    <option value="nine">Class 9</option>
                    <option value="ten">Class 10</option>
                    <option value="eleven">Class 11</option>
                    <option value="twelven">Class 12</option>
            </select><br>
        </label><br>

            <input id="text" type="email" placeholder="Email" name="email" required><br>
            <span style="color: red;"><?php echo $errorstudentdata; ?></span>
            <span style="color: red;"><?php echo $errorteacherdata; ?></span><br>

            <input id="text" type="password" placeholder="Password" name="password" required><br>
            <span style="color: red;"><?php echo $errorstudentpass; ?></span>
            <span style="color: red;"><?php echo $errorteacherpass; ?></span>
            <span style="color: red;"><?php echo $errorteacherdata; ?></span><br>

            <input id="button" type="submit" name="submit" value="Log In"><br>
            <p>If you are a Student, Sign Up first!</p>
            <a id="signup" href="signup.php">Click to Sign Up</a><br><br>



        </form>
    </div>
</body>
<script>
        // Function to validate the form before submission
        function validateForm() {
            // Reset all error messages
            document.getElementById('errorrole').innerHTML = '';
            document.getElementById('errorstudentdata').innerHTML = '';
            document.getElementById('errorteacherdata').innerHTML = '';
            document.getElementById('errorstudentpass').innerHTML = '';
            document.getElementById('errorteacherpass').innerHTML = '';

            // Get form values
            var role = document.getElementById('role').value;
            var classValue = document.getElementById('class').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            // Check for errors
            if (role === '--Select User Type---' || classValue === '--Your Class---') {
                document.getElementById('errorrole').innerHTML = 'Invalid role or class';
                return false;
            }

            // Add similar checks for other fields if needed

            // If no errors, proceed with submission
            return true;
        }
    </script>


       
</html>