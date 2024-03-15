<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <style>
        /* Style for the container */
.container {
    width: 100%;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f0f0f0;
}

/* Style for the login container */
.login-container {
    width: 300px;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    text-align: center;
}

/* Style for the form */
form {
    text-align: left;
}

/* Style for the form elements */
.form-group {
    margin: 10px 0;
}

/* Style for the "Update" button */
button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
}

/* Style for the links */
a {
    text-decoration: none;
    color: #007bff;
}

/* Style for the "Go back" link */
a[href="homepage.php"] {
    margin-right: 20px;
}

/* Center the "Not a user?" message */
center {
    margin-top: 20px;
}
</style>>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <form method="POST">
                <a href="home.html">Back to home</a>
                <center><h1>Forgot Password</h1></center><br>
                <div class="form-group">
                    Username:<input type="text" name="uname" placeholder="Enter your Username">
                    Email: <input type="email" name="email" placeholder="Enter your Email" required>
                </div>
                <div class="form-group">
                    New Password: <input type="password" name="password" placeholder="New Password" required>
                </div>
                <button type="submit" name="update">Update</button><br>
                <center>Not a user? <a href="homepage.html">Sign Up</a><br>
            </form>
            <?php
                if (isset($_POST["update"])) {
                 require("connection.php"); 
                $username = mysqli_real_escape_string($conn, $_POST['uname']); 
                 $email = mysqli_real_escape_string($conn, $_POST['email']);
                $password = mysqli_real_escape_string($conn, $_POST['password']); 
                $username_sql = "SELECT username FROM login_table WHERE username = '$username'";
                $username_result = mysqli_query($conn, $username_sql);
                $alumni_sql = "SELECT al_email FROM alumni_tab WHERE username = '$username'";
                $alumni_result = mysqli_query($conn, $alumni_sql);

                if (mysqli_num_rows($alumni_result) > 0 && mysqli_num_rows($username_result) > 0) {
                    $row = mysqli_fetch_assoc($alumni_result);
                     $email = $row['al_email'];
                     $update_sql = "UPDATE login_table SET password = '$password' WHERE username = '$username'";
                    if (mysqli_query($conn, $update_sql)) {
    echo "Password updated for $username ($email). You can now log in with your new password.";
} else {
    echo "Error updating password: " . mysqli_error($conn);
}

                } else {
                     echo "Enter a correct username or the username and email do not match.";
                }
            }

            ?>
        </div>
    </div>
</body>
</html>