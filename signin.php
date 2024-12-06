<?php
        session_start();
        $_SESSION['loggedin']=false; 
$valid_cred = true;
require "_dbconnect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    $name = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM details WHERE name='$name' AND password = '$password'";
    $res = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($res);
    if ($rows >= 1) 
    {
        $det = mysqli_fetch_assoc($res);
        $logged = ++$det['numofloggedin'];
        $sql = "UPDATE details SET numofloggedin = '$logged' WHERE name='$name'";
        $res = mysqli_query($conn, $sql);
        session_set_cookie_params(0);

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $name;
        $_SESSION['loggedtimes']=$logged;
        $_SESSION['login_time'] = time();
        header("location: airhome.php");
        exit;   
    } 
    else 
    {
        $valid_cred = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Brezze Login</title>
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
        .register-link {
            display: block;
            margin-top: 20px;
            font-size: 16px;
            color: #19CAFC;
            text-decoration: none;
        }
        .register-link:hover {
            text-decoration: underline;
        }
        ::placeholder {
            color: #999;
        }
        .error
        {
            color:red;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Green Brezze Login</h2>
        <form action="signin.php" method="post">
            <?php
            if(!$valid_cred)
            {
                echo" <p class='error'>*Invalid Credentials*</p>";
            }
            ?>
            <input type="text" class="form-input" placeholder="Username" name="username" required>
            <input type="password" class="form-input" placeholder="Password" name="password" required>
            <input type="submit" class="login-button" value="Login">
        </form>
        
        <a href="signup.php" class="register-link">If new user, register here</a>
        <a href="forgotpassword.php" class="register-link">Forgot password?</a>
    </div>
</body>
</html>
