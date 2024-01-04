<?php
session_start();
include('../conn/connection.php');

if (!isset($_SESSION["email"]) || $_SESSION["submit"] !== true) {
    header("Location: login.php");
    exit;

}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/86924d7fa0.js" crossorigin="anonymous"></script>
    <style>
*{
margin: 0px;
padding: 0px;
}

body{
position: static;
background-color:#ccc;
background-image: url();
background-size: cover;
}

nav{
 
background-color: rgb(158, 168, 177);
padding: 30px;
background-color:  #1A1110;

}

#profile{
position: absolute;
top: 13px;
left: 94%;
color: white;
font-size: 25px;
font-weight: bold;
border: 1px solid black;
border-radius: 10px;
padding: 5px;

}

.container{

padding: 15px;
background-color: lightblue;
background-image: url(img/sms2.avif);
background-size: cover;
}

.leftbar{
position: absolute;
top: 150px;
left: 12%;
width: 45px;
height: 70%;
border: 1px solid white;
padding-left: 200px;
padding-bottom: 100px;
background-color: rgba(194, 140, 167, 0.699);
border-radius: 20px;	
background-image: url(img/sms2.jpg);
background-size: cover;
}

p{
position: absolute;
top: 15px;
left: 3%;
color: rgb(56, 52, 52);
padding: px;
font-weight: bold;
font-size: 24px;
color:white;
}

div .student{
position: absolute;
top: 80px;
left: 70px;
border: 1px solid white;
border-radius: 10px;
padding: 5px;

}

div span{
position: absolute;
top: 130px;
left: 70px;
font-size: 25px;
font-weight: bold;
border: 1px solid white;
border-radius: 10px;
padding: 5px;
}

div .homework{
position: absolute;
top: 180px;
left: 70px;
border: 1px solid white;
border-radius: 10px;
padding: 5px;

}

div .notice{
position: absolute;
top: 230px;
left: 70px;
border: 1px solid white;
border-radius: 10px;
padding: 5px;

}

a{
text-decoration: none;
}	  

a:hover{
border-radius: 10px; 
color: black;
} 
#logout:hover{
background-color: red;
}


#stud{
position: absolute;
top: 88px;
left: 38px;
font-size: 24px;
}

#crown{
position: absolute;
top: 138px;
left: 39px;
font-size: 24px;
}

#hwk{
position: absolute;
top: 188px;
left: 40px;
font-size: 24px;
}

#notic{
position: absolute;
top: 238px;
left: 40px;
font-size: 24px;
}




/* Style the dropdown container */
.dropdown {
    position: relative;
    display: flex;
}

/* Style the dropdown content (initially hidden) */
.dropdown-content {
    display: none;
    padding: 10px;
    position: absolute;
    background-color: white;
    border: 1px solid white;
    border-radius: 10px;
    min-width: 160px;
    z-index: 1;
    top: 18px ;
    height: 150px;
    left: 1033px ;
    transition: transform 0.5s;
    
}

.editprofile {
    position: absolute;
    top: 45px;
    left: 30px;
    font-size: 24px;
}
.editprofile1 {
    position: absolute;
    top: 80px;
    left: 30px;
    font-size: 24px;
}

#edit {
    position: absolute;
    top: 50px;
    left: 10px;
    font-size: 15px;
}

#edit1 {
    position: absolute;
    top: 86px;
    left: 10px;
    font-size: 15px;
}


.dropdown-content.open-menu {
    display: block;
}


</style>
</head>
<body>
    <nav>
        <ul>
            <a href="studentindex.php"><p>STUDENT MANAGEMENT SYSTEM</p></a>
        </ul>
        <i id="profile" class="fa-solid fa-circle-user" onclick="toggleMenu()"></i>
        <div class="dropdown">
            <div class="dropdown-content" id="submenu">
                     <h2>Hello!<?php echo $_SESSION['fullname']; ?></h2>
                    <hr>
                    <i id="edit" class="fa-solid fa-pen-to-square"></i>
                    <p class="editprofile"><a href="steditprofile.php">Edit Profile</a></p>
                    <i id="edit1" class="fa-solid fa-arrow-right-from-bracket"></i>
                    <p class="editprofile1"><a href="../logout.php">Logout</a></p>
             </div>
        </div>
    </nav>

    <div>
        <nav class="container">
            <marquee>Welcome ! <?php echo $_SESSION['fullname']; ?></marquee>
        </nav>
    </div>

    <div class="leftbar">
        
        <i id="stud" class="fa-sharp fa-solid fa-graduation-cap"></i>
        <i id="crown" class="fa-sharp fa-solid fa-crown"></i>
        <i id="notic" class="fa-solid fa-bell"></i>
        <i id="hwk" class="fa-solid fa-book"></i>
        <p class="student"><a target="_self" href="stmoduletable.php">STUDENT</a></p>
        <span><a href="stmoduleclasses.php">CLASSES</a></span>
        <p class="homework"><a href="stmodulehwk.php">HOMEWORK</a></p>
        <p class="notice"><a href="stmodulenotice.php">NOTICE</a></p>

    </div>

    <script>
        let sessionExpireTimer;
        const sessionTimeout = 600; // 600 seconds (10 minutes)

        function startSessionTimer() {
            clearTimeout(sessionExpireTimer);
            sessionExpireTimer = setTimeout(function () {
                alert("Your session has expired due to inactivity. Please log in again.");
                window.location.href = "login.php";
            }, sessionTimeout * 1000);
        }

        // Start the session timer when the page loads
        startSessionTimer();

        // Reset the session timer when the user interacts with the page (e.g., mousemove, keypress)
        document.addEventListener("mousemove", startSessionTimer);
        document.addEventListener("keypress", startSessionTimer);

        let submenu = document.getElementById("submenu");

        function toggleMenu() {
            submenu.classList.toggle("open-menu");
        }
    </script>
</body>
</html>
