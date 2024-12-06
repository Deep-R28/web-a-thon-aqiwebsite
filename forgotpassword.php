<?php
require "_dbconnect.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer.php';
require 'smtp.php';
require 'Exception.php';
$exists = true;
function generateOTP($length = 6) {
    return random_int(100000, 999999);
} 

function sendOTP($to_email, $otp) {
    $subject = "Your OTP Code is valid for 5 minutes";
    $message = "Your OTP code is: " . $otp;

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'pedellijashwanth@gmail.com';
    $mail->Password = 'nfoy ibna ymjs sbsh';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('pedellijashwanth@gmail.com', 'GreenBrezze Solutions');
    $mail->addAddress($to_email);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
        $uemail = $_POST["usermail"];
        $sql = "SELECT * FROM details WHERE email = '$uemail'";
        $res = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($res);
        if ($rows > 0) 
        {
            $exists = false; 
            session_start();
            $otp = generateOTP();
            $_SESSION['otp'] = $otp;
            $_SESSION['email']=$uemail;
            $_SESSION['otp_expiration'] = time() + 300;
            $_SESSION['otp_sent'] = false;
            if (sendOTP($uemail, $otp)) 
            {
                $_SESSION['otp_sent'] = true;
                header("Location: resetpassword.php"); 
                exit;
            } else 
            {
                $_SESSION['otp_sent'] = false;
            }
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
    <form method="post" action="forgotpassword.php">
        <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST" && $exists) {
                echo '<p>Email does not exist</p>';
                echo '<a href="signup.php">Click here to create an account</a>';
            }
        ?>
        <label for="mail"><small>Enter your registered email</small></label>
        <input type="text" class="form-input" id="mail" placeholder="Enter your registered email" name="usermail" required>
        <button type="submit" class="login-button">Send OTP</button>
    </form>
</div>
</body>
</html>
