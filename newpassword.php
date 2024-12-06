<?php
session_start();
$valid = true;
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if(!isset($_SESSION['otp_verfied']) || !$_SESSION['otp_verfied'])
        {
            header("location: resetpassword.php");
            exit;  
        }
        else
        {
            require "_dbconnect.php";
            $user_mail = $_SESSION['email'];
            $pass = $_POST['password'];
            $sql = "UPDATE details set password ='$pass' where Email='$user_mail'";
            $res  = mysqli_query($conn,$sql);
            if(!$res)
            {   
                $valid = false;
            }
            else
            {
                header("location: signin.php");
                exit;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
                body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #FFF;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.1); 
            padding: 40px;
            border-radius: 10px;
            max-width: 400px;
            text-align: center;
            color: #FFF;
        }
        .login-container h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #FFF;
        }
        .form-input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            background-color: #333;
            color: #FFF;
        }
        .login-button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            background-color: #19CAFC;
            border: none;
            color: #FFF;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }
        .login-button:hover {
            background-color: #17B0E1;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2>Green Brezze</h2>
    <form method="post" action="newpassword.php"> 
        <?php 
            if(!$valid)
            {
                echo '<p class="text">Unable to change your password</p>';
            }  
        ?>
        <label for="password"><small>Enter New password <br></small></label>
        <input type="text" class="form-input" id="password" placeholder="Enter new Password" name="password" required>
        <button type="submit" class="login-button">Submit</button>
    </form>
</div>
</body>
</html>