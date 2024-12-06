<?php
$valid_cred = true;
require "_dbconnect.php";

$message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['username'];
    $phoneno = $_POST['phonenumber'];
    if ($name !== "" && $phoneno !== "") {
        $sql = "INSERT INTO contact (username, phonenumber) VALUES ('$name', '$phoneno')";
        $res = mysqli_query($conn, $sql);

        if ($res) {
            $message = "Our team will contact you. Please wait...";
            echo "<script>
                    setTimeout(function() 
                    {
                        window.location.href = 'airhome.php';
                    }, 2000);
                  </script>";
        } else {
            $message = "Database error. Please try again.";
        }
    } else {
        $message = "Please fill all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Breeze Login</title>
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
        }
        .form-input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
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
            cursor: pointer;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }
        .login-button:hover {
            background-color: #17B0E1;
            transform: scale(1.05);
        }
        .message {
            color: #19CAFC;
            margin-top: 15px;
            font-size: 16px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Green Breeze</h2>
        <form action="contact.php" method="post" onsubmit="return validateForm()">
            <input type="text" class="form-input" placeholder="Enter Your name" name="username" id="username" required>
            <input type="text" class="form-input" placeholder="Enter Your phone number" name="phonenumber" id="phonenumber" required>
            <span id="error-message" style="color: red; font-size: 14px;"></span><br>
            <input type="submit" class="login-button" value="Login">
        </form>

        <?php if (!empty($message)) { ?>
            <div class="message"><?php echo $message; ?></div>
        <?php } ?>
    </div>

    <script>
        function validateForm() 
        {
            const phoneNumber = document.getElementById("phonenumber").value;
            const errorMessage = document.getElementById("error-message");

            const phoneRegex = /^[0-9]{10}$/;
            if (!phoneRegex.test(phoneNumber)) 
            {
                errorMessage.textContent = "Please enter a valid 10-digit phone number.";
                return false; 
            }
            errorMessage.textContent = ""; 
            return true;
        }
    </script>
</body>
</html>
