<?php
error_reporting(E_ALL);
session_start();
include('conn/connection.php');

$username_error = $password_error = $emailExists = $invalidemail = $erroremptyfield = $fullname_error = '';
$signupsucc = false; // Initialize the variable

if (isset($_POST['Signup'])) {
    $student = $_POST['role'];
    $class = htmlspecialchars($_POST['class']);
    $section = htmlspecialchars($_POST['section']);
    $fullname = htmlspecialchars($_POST['fullname']);
    $address = htmlspecialchars($_POST['address']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    if (!empty($student) && !empty($class) && !empty($fullname) && !empty($email) && !empty($password)) {

        // Check for a valid email format
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "SELECT * FROM request WHERE email='$email'";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) != 0) {
                $emailExists = "*Email already exists. Try another one.";
            } else {
                // Check for a valid username
                $pattern = '/^[a-zA-Z ]+$/';

                if (preg_match($pattern, $fullname)) {

                    // Check for a strong password
                    $pattern = '/^[A-Z].*\d.*$/';

                    if (preg_match($pattern, $password)) {

                        // Hash the password
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                        // Set initial status to 'waiting'
                        $status = 'waiting';

                        // Store the data in the database
                        $sql = "INSERT INTO request (student, class, section, fullname, address, email, password, status) 
                            VALUES ('$student', '$class', '$section', '$fullname','$address', '$email', '$hashedPassword', '$status')";
                        $result = mysqli_query($con, $sql);

                        if ($result) {
                            $signupsucc = true; // Sign Up Successfully
                    
                            // Display confirmation message using JavaScript
                            echo "<script>
                                    var statusMessage = 'Signup Successful wait for approval.';
                                    alert(statusMessage);
                                    window.location.href = 'login.php';
                                  </script>";
                            exit;
                        } else {
                            echo "*Error in Sign Up: " . mysqli_error($con);
                        }
                    } else {
                        $password_error = "*Password must be 6 characters with one uppercase letter and one number.";
                    }
                } else {
                    $username_error = "*Invalid username.";
                }
            }
        } else {
            $invalidemail = "*Invalid email format.";
        }
    } else {
        $erroremptyfield = "*Empty fields not allowed.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url(img/sms5.jpg);
            background-size: cover;
        }

        #box {
            position: relative;
            top: 25px;
            left: 3%;
            border: 1px solid black;
            border-radius: 10px;
            margin: auto;
            width: 300px;
            padding: 20px;
            background-image: url(img/sms7.png);
            background-size: cover;
        }

        #role {
            width: 310px;
            height: 35px;
        }

        #signup {
            text-decoration: none;
            background-color: #ccc;
            border-radius: 10px;
        }

        #signup:hover {
            color: black;
            font-weight: bold;
        }

        #button {
            width: 310px;
            height: 35px;
            font-weight: bold;
            border-radius: 10px;
        }

        #text {
            width: 300px;
            height: 30px;
        }
        .error-message{
              color: red;
        }
    </style>
</head>
<body>
<div id="box">
    <form method="post">
        <div style="font-size: 20px; margin: 10px; color: black;">Signup</div>

        <label>
            <select id="role" name="role">
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
            <span style="color: red;"><?php echo $erroremptyfield; ?></span>
        </label><br>

        <input id="text" type="text" placeholder="Section" name="section" required><br>
        <span style="color: red;"><?php echo $erroremptyfield; ?></span><br>

        <input id="text" type="text" placeholder="Username" name="fullname" required>
        <span style="color: red;"><?php echo $username_error; ?></span>
        <span style="color: red;"><?php echo $erroremptyfield; ?></span><br>

        <input id="text" type="text" placeholder="Address" name="address" required><br>
        <span style="color: red;"><?php echo $erroremptyfield; ?></span><br>

        <input id="text" type="email" placeholder="Email" name="email" required><br>
        <span style="color: red;"><?php echo $emailExists; ?></span>
        <span style="color: red;"><?php echo $invalidemail; ?></span>
        <span style="color: red;"><?php echo $erroremptyfield; ?></span><br>

        <input id="text" type="password" placeholder="Password" name="password" required>
        <span style="color: red;"><?php echo $password_error; ?></span>
        <span style="color: red;"><?php echo $erroremptyfield; ?></span><br>

        <input id="button" type="submit" name="Signup" value="Sign Up"><br><br>

        <a id="signup" href="login.php">Click to Login</a><br><br>
    </form>
</div>
</body>
<script>

</script>
</html>
