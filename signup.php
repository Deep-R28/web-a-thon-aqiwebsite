<?php 
    $invalid = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    require "_dbconnect.php"; 
    $name = $_POST['sname'];
    $date_ob = $_POST['dob'];
    $email_id = $_POST['email'];  
    $user_gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : "";
    $temp_add = $_POST['taddr'];
    $per_address = isset($_POST['tpaddr']) ? $temp_add : $_POST['paddr'];
    $user_phoneno = $_POST['phnum'];
    $user_password  = $_POST['password'];
    $sql = "SELECT * FROM details WHERE Email = '$email_id'";
    $res = mysqli_query($conn, $sql);

    if (!$res) {
        die("we are unable to connect with server");
    }
    $rows = mysqli_num_rows($res);
    if ($rows >= 1) {
       $invalid = true;
    } else {
        $sql = "INSERT INTO details (name, dob, Email, Gender, Tempadd, peradd, Phonenumber,password) VALUES ('$name', '$date_ob', '$email_id', '$user_gender', '$temp_add', '$per_address', '$user_phoneno','$user_password')";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            header("location: signin.php");
            exit;
        } else {
            echo "<script>alert('Unable to create account');</script>";
            die("We are sorry for inconvience");
        }
        $invalid = false;
    }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #FFF;
            position: relative;
            overflow: hidden;
            background-color: #000;
            
        }

        /* Removed overlay class */

        .container {
            background: rgba(255, 255, 255, 0.1); 
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
            max-width: 600px;
            width: 90%;
            text-align: center;
            color: #FFF;
            animation: fadeIn 1s ease-out;
        }

        .container h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        table {
            width: 85%;
            margin: 0 auto;
        }

        table td {
            padding: 10px;
        }

        label {
            display: block;
            text-align: left;
            font-size: 16px;
            margin-bottom: 5px;
        }
        .error
        {
            color:red;
        }
        .container input[type="text"],
        .container input[type="number"],
        .container input[type="email"],
        .container input[type="tel"],
        .container input[type="password"],
        .container textarea,
        .container select {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.8);
            color: #333;
        }

        .container input[type="checkbox"] {
            margin-top: 12px;
        }

        input.submit 
        {
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

        input.submit:hover 
        {
            background-color: #17B4D9;
            transform: scale(1.05);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    <script type="text/javascript">
        function validateaddr() {
            var tempaddr = document.registration.taddr;
            var praddr = document.registration.paddr;
            var tpaddr = document.registration.tpaddr;
            if (tpaddr.checked) {
                praddr.value = tempaddr.value;
                praddr.disabled = true;
            } else {
                praddr.disabled = false;
                praddr.value = ''; 
            }
        }

        function formvalidate() {
            var sname = document.registration.sname;
            var regno = document.registration.regno;
            var dob = document.registration.dob;
            var email = document.registration.email;
            var tempaddr = document.registration.taddr;
            var phnum = document.registration.phnum;

            if (snamevalidate(sname) && 
                dobval(dob) &&
                emailval(email) &&
                phnumvalidate(phnum)  && password_validation() ) 
                {
                // alert("Form submitted successfully!");
                return true;
            }
            return false;
        }

        function snamevalidate(valobj) {
            var len = valobj.value.length;
            var p1 = /^[A-Za-z\s]+$/;
            if (len === 0 || len > 30) {
                alert("Name should not be empty and length must be less than 30");
                valobj.focus();
                return false;
            } else if (valobj.value.match(p1)) {
                return true;
            } else {
                alert("Invalid Name");
                valobj.focus();
                return false;
            }
        }

        function phnumvalidate(valobj) {
            var patt = /^\d{10}$/;
            if (!valobj.value.match(patt)) {
                alert("Phone Number should be 10 digits long");
                valobj.focus();
                return false;
            }
            return true;
        }

        function dobval(valobj) {
            var patt = /^\d{2}-\d{2}-\d{2}$/; // dd-mm-yy
            if (!valobj.value.match(patt)) {
                alert("DOB should be in the format dd-mm-yy");
                valobj.focus();
                return false;
            }
            return true;
        }

        function emailval(valobj) {
            var patt = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!valobj.value.match(patt)) {
                alert("Incorrect Email ID");
                valobj.focus();
                return false;
            }
            return true;
        }
        function password_validation() {
    let pass = document.getElementById("password").value;
    let cpass = document.getElementById("cpassword").value;
    if (pass !== cpass) {
        alert("Passwords don't match");
        return false;
    }
    let patt = /^.{12,}$/;
    if (!patt.test(pass)) {    
        alert("Invalid password");
        return false;
    }
    return true;
}
    </script>
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        <form name="registration" action="signup.php" method="post" onsubmit="return formvalidate()">
            <table>
                <?php 
                if($invalid){
                    echo ' <tr>
                    <td></td>
                    <td class="error">*Email already exists</td>
                    </tr>
                    <tr>
                    <td></td>
                    <td><a href="signin.php">Click me to Sign in</td>
                    </tr>
                    ';
                }
                ?> 
                <tr>
                    <td><label for="sname">Name:</label></td>
                    <td><input type="text" name="sname" required></td>
                </tr>
                <tr>
                    <td><label for="dob">DOB (dd-mm-yy):</label></td>
                    <td><input type="text" name="dob" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" name="email" required></td>
                </tr>
                <tr>
                    <td><label>Gender:</label></td>
                    <td>
                        <input type="radio" name="gender" value="Male"> Male
                        <input type="radio" name="gender" value="Female"> Female
                    </td>
                </tr>
                <tr>
                    <td><label for="taddr">Temporary Address:</label></td>
                    <td><input type="text" name="taddr" required></td>
                </tr>
                <tr>
                    <td><label>Permanent Address is same as Temporary:</label></td>
                    <td><input type="checkbox" name="tpaddr" onchange="validateaddr();"></td>
                </tr>
                <tr>
                    <td><label for="paddr">Permanent Address:</label></td>
                    <td><input type="text" name="paddr"></td>
                </tr>
                <tr>
                    <td><label for="phnum">Phone Number:</label></td>
                    <td><input type="tel" name="phnum" required></td>
                </tr>
                <tr>
                    <td> <label for="password">Enter password <br> <small>Password should be of minimum 12 letters<small></label></td>
                    <td><input type="password" name="password" id="password"></td>
                </tr>
                <tr>
                    <td><label for="cpassword">Re-enter Password </label></td>
                    <td><input type="password" name="cpassword" id="cpassword"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="submit" class="submit" value="Login">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>