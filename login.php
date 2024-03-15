<html>
<head>
    <title>Login</title>
<style>
.form {
  position:relative;
  background: #FFFFFF;
  max-width: 360px;
  margin: 20px auto;
  padding: 45px;
  text-align: center;
  background-color: 00a3a3;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.body{
  text-align: center;
  padding: 50px;
  
}
#s1{
  background-color:black; 
  border: none;
  color: white;
  padding: 4px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 15px;
  margin: 4px 2px;
  cursor:pointer;
}
#s1:hover{
  color:lightblue;
}
.no-results {
    text-align: center;
    color: red; 
    font-size: 30px;
}
</style>
</head>
<body>
    <div class="body">
        <div class="form">
            <h1>Sign in</h1>
            <br><br>
            <form method="POST">
                <input type="text" placeholder="username" name="username" required></br></br>
                <input type="password" placeholder="password" name="password" required></br></br>
                <input type="radio" name="usertype" value="alumni" required>Alumni
                <input type="radio" name="usertype" value="admin" required>Admin</br></br>
                <input type="submit" id="s1" name="login" value="Login"></br>
            </form>
            Don’t have an account?<a href="Registration.php">Register</a></br></br>
        </div>
    </div>
    <?php
    include_once"navbar.html";
session_start();
require("connection.php");
if (isset($_POST["login"])) {
    $n = $_POST['username'];
    $p = $_POST['password'];
    $q = $_POST['usertype'];
    $sql = "SELECT * FROM login_table WHERE username='$n' AND password='$p' AND status='Approved' AND usertype='$q'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the name from the alumni_tab for the logged-in user
        $row = mysqli_fetch_assoc($result);
        if ($q == "alumni"){
        $alumniSql = "SELECT al_name FROM alumni_table WHERE username='$n'";
        $alumniResult = mysqli_query($conn, $alumniSql);

        if ($alumniResult && mysqli_num_rows($alumniResult) > 0) {
            $alumniRow = mysqli_fetch_assoc($alumniResult);
            $_SESSION['username'] = $n; // Store the username in the session
            $_SESSION['al_name'] = $alumniRow['al_name']; // Store the name in the session
                header('Location: alumnihome.php');
                exit();

            }
        } 
        else {
                $_SESSION['username'] = $n;
                header('Location: adminhome.php');
                exit();
        }
    } else {
        echo "<p class='no-results'>Record not found.</p>";
    }
}
?>
</body>
</html>
