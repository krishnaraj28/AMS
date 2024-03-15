<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="register.css">
    <script>
        function validatePhoneNumber() {
            var phoneNumber = document.getElementById("phno").value;
            var phoneNumberPattern = /^\d{10}$/; // Assumes 10-digit phone number

            if (!phoneNumberPattern.test(phoneNumber)) {
                document.getElementById("phnoError").innerText = "Please enter a valid 10-digit phone number.";
                return false;
            } else {
                document.getElementById("phnoError").innerText = "";
                return true;
            }
        }

        function validateDOB() {
            var dob = new Date(document.getElementById("dob").value);
            var maxDOB = new Date("2000-01-01"); // January 1, 2000

            if (dob >= maxDOB) {
                document.getElementById("dobError").innerText = "Date of birth must be before the year 2000.";
                return false;
            } else {
                document.getElementById("dobError").innerText = "";
                return true;
            }
        }

        function validateEmail() {
            var email = document.getElementById("email").value;
            var emailPattern = /^[a-zA-Z0-9._%+-]+@gmail.com$/;

            if (!emailPattern.test(email)) {
                document.getElementById("emailError").innerText = "Please enter a valid Gmail address.";
                return false;
            } else {
                document.getElementById("emailError").innerText = "";
                return true;
            }
        }

        function validateForm() {
            var isPhoneNumberValid = validatePhoneNumber();
            var isDOBValid = validateDOB();
            var isEmailValid = validateEmail();

            return isPhoneNumberValid && isDOBValid && isEmailValid;
        }
    </script>
</head>
<body>
    <?php
        include_once"navbar.html";
    ?>
    <div id="registration-success" style="display: none;">
    <h1>Registration Successful</h1>
    <p>Thank you for registering!</p>
    </div>

<div class="body">
    <div class="form">
        <center>
            <h1>Register</h1><br>
            <p>Please fill in this form to create an account...</p>
        </center>
        <div class="post">
            <form method="POST" onsubmit="return validateForm()">
                Username: <input type="text" placeholder="Enter username" name="al_uname" required><br><br>
                Password: <input type="password" placeholder="Enter password" name="al_psw" id="psw" required><br><br>
                <input type="password" placeholder="Confirm Password" name="al_psw1" required><br><br>
                Name: <input type="text" placeholder="Enter your name" name="al_name"><br><br>
                Gender:
                <input type="radio" name="al_gender" value="female" required>Female
                <input type="radio" name="al_gender" value="male" required>Male
                <input type="radio" name="al_gender" value="other" required>Other<br><br>
                Email: <input type="email" placeholder="Enter your email" name="al_email" id="email" required><br>
                <span id="emailError" style="color: red;"></span><br>
                Phone number: <input type="text" placeholder="Enter your phone number" name="al_phno" id="phno" required><br>
                <span id="phnoError" style="color: red;"></span><br>
                DOB: <input type="date" name="dob" id="dob"><br>
                <span id="dobError" style="color: red;"></span><br>
                Course:
                <select name="al_course" required>
                <option></option>
                <option>BCA</option>
                <option>BCOM</option>
                <option>BSC CHEMISTRY</option>
                <option>BSC PHYSICS</option>
                <option>BSC MATHS</option>
                <option>BA ENGLISH</option>
                <option>BA ECONOMICS</option>
                </select><br><br>
                Batch:
                <select name="al_batch" required>
                <option></option>
                <option>2010-2013</option>
                <option>2011-2014</option>
                <option>2012-2015</option>
                <option>2013-2016</option>
                <option>2014-2017</option>
                <option>2015-2018</option>
                <option>2016-2019</option>
                <option>2017-2020</option>
                <option>2018-2021</option>
                <option>2019-2022</option>
                <option>2020-2023</option>
                </select><br><br>
                Address:<br>
                <textarea rows="5" cols="25" name="al_address" placeholder="Enter address..."></textarea><br><br>
                <input type="submit" id="s2" name="register" value="Register">
                <input type="reset" name="reset" value="Clear">
            </form>
        </div>
    </div>
   </div> 
<?php
require("connection.php");
if(isset($_POST["register"])){
    $uname=$_REQUEST['al_uname'];
    $password=$_REQUEST['al_psw'];
    $conpassword=$_REQUEST['al_psw1'];
    $name=$_REQUEST['al_name'];
    $gender=$_REQUEST['al_gender'];
    $email=$_REQUEST['al_email'];
    $phno=$_REQUEST['al_phno'];
    $dob=$_REQUEST['dob'];
    $course=$_REQUEST['al_course'];
    $batch=$_REQUEST['al_batch'];
    $address=$_REQUEST['al_address'];
    if (empty($uname) || empty($password) || empty($name) || empty($email)) {
        echo '<script>alert("Please fill in all required fields.")</script>';
    } elseif ($password != $conpassword) {
        echo '<script>alert("Passwords do not match.")</script>';
    }else{
        $sql="SELECT * FROM login_table WHERE username='$uname'";
        $p=mysqli_query($conn,$sql);
        if(mysqli_num_rows($p)>0){
            echo '<script>alert("Username already exists.\n Please choose a different username.")</script>';
        }
        else{
            mysqli_query($conn,"INSERT INTO login_table (username,password) VALUES('$uname','$password')");
            mysqli_query($conn,"INSERT INTO alumni_table (username,al_name,al_gender,al_email,al_phno,al_dob,al_course,al_batch,al_address) VALUES('$uname','$name','$gender','$email','$phno','$dob','$course','$batch','$address')");
            echo '<script>document.getElementById("registration-success").style.display = "block";</script>';
        }
    }
}
?>
</body>
</html>