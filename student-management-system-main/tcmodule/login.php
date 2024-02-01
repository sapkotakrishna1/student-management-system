<?php
ob_start();
session_set_cookie_params(0);
session_start();
include('conn/connection.php');

if (isset($_POST['submit'])) {
    $role = $_POST['role'];
    $class = $_POST['class'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($role === 'teacher') {
        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM log_teacher WHERE email=? AND password=? AND class=?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $email, $password, $class);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            // Fetch the user data
            $user_data = mysqli_fetch_assoc($result);

            // Set session variables
            $_SESSION["email"] = $email;
            $_SESSION['user_data'] = $user_data;
            $_SESSION["submit"] = true;
            $_SESSION['last_activity'] = time();
            $_SESSION['name'] = $user_data['name'];
            $_SESSION['class'] = $user_data['class'];

            // Redirect to the index page
            header("location: index.php");
        } else {
            // Display a message
            echo "Invalid teacher email, password, or class";
            $errorteacherdata = true;
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
                echo "Invalid password";
                $errorstudentdata = true;
            }
        } else {
            // Display a message
            echo "Invalid student email and class";
            $errorstudentdata = true;
        }
    } else {
       // Display a message
       echo "Invalid role";
       $errorrole = true;
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
            position: relative;
            top: 50px;
            left: 9%;
            background-color: blanchedalmond;
            border: 1px solid black;
            border-radius: 10px;
            margin: auto;
            width: 300px;
            padding: 20px;
            background-image: url(img/sms6.jpg);
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

        <form method="post">
            <div id="sms">Student Management System</div>
            <label>
                <select id="role" name="role">
                    <option>--Select User Type---</option>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                </select><br>

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

            <input id="text" type="email" placeholder="Email" name="email" required><br><br>

            <input id="text" type="password" placeholder="Password" name="password" required><br><br>

            <input id="button" type="submit" name="submit" value="Log In"><br>
            <p>If you are a Student, Sign Up first!</p>
            <a id="signup" href="signup.php">Click to Sign Up</a><br><br>
        </form>
    </div>
</body>
<script>
    <?php if (isset($errorrole)) { ?>
        alert("Invalid role");
    <?php } ?>
</script>
</html>