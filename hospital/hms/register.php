<?php
include_once('include/config.php');
if(isset($_POST['submit']))
{
$fname=$_POST['full_name'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$query=mysqli_query($con,"insert into user(fullname,email,password) values('$fname','$email','$password')");
if($query)
{
    echo"<script>alert('Successfully Registered. You can login now');</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
</head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
<body>
    <div class="register-container">
        <h2>Register on OTT Platform</h2>
        <form id="registerForm">
            <input type="text" id="name" placeholder="Full Name" required><br>
            <input type="email" id="email" placeholder="Email" required><br>
            <input type="password" id="password" placeholder="Password" required><br>
            <input type="password" id="confirmPassword" placeholder="Confirm Password" required><br>
            <button type="submit">Register</button>
            <p>Already have an account? <a href="login.html">Login</a></p>
        </form>
        <div id="registerError"></div>
    </div>

    <script src="app.js"></script>
</body>
</html>
