<html>
<head>
    <title>Update Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            text-align: center;
            background-color: #fff;
            width: 80%;
            max-width: 500px;
            margin: 20px auto;
            padding: 40px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .post {
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 35px;
        }
        h1 {
            color: #333;
        }
        form {
            text-align: left;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
        }
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            margin-top: 10px;
            margin-left: 180px;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
        .success-message {
            color: green;
            font-size: 30px;
            font-weight: bold;
        }
        .no-results {
            color: red;
            font-size: 20px;
        }
    </style>
    <script>
    function validateForm() {
    var phone = document.getElementById("phone").value;
    var email = document.getElementById("email").value;

    // Regular expressions for email and phone number validation
    var phonePattern = /^\d{10}$/; // Assuming a 10-digit phone number
    var emailPattern = /^[a-zA-Z0-9._%+-]+@gmail.com$/;

    if (!phone.match(phonePattern)) {
        alert("Please enter a valid 10-digit phone number.");
        return false;
    }

    if (!email.match(emailPattern)) {
        alert("Please enter a valid email address.");
        return false;
    }

    return true;
}
</script>
</head>
<body>
<?php
$phone = "";
$email = "";
$address = "";
$successMessage = "";
$noChangeMessage = "";

session_start();
include_once "alumdasbnavbar.html";
require("connection.php");

$username = $_SESSION["username"];

if (isset($_POST["Update"])) {
    // Get the updated values from the form
    $newPhone = $_POST["phone"];
    $newEmail = $_POST["email"];
    $newAddress = $_POST["address"];

    // Fetch existing data to compare
    $fetchSql = "SELECT al_phno, al_email, al_address FROM alumni_table WHERE username = '$username'";
    $result = mysqli_query($conn, $fetchSql);

    if ($result) {
        $userData = mysqli_fetch_assoc($result);

        if ($newPhone == $userData['al_phno'] && $newEmail == $userData['al_email'] && $newAddress == $userData['al_address']) {
            $noChangeMessage = "No changes were made to your profile.";
        } else {
            $updateSql = "UPDATE alumni_table SET al_phno = '$newPhone', al_email = '$newEmail', al_address = '$newAddress' WHERE username = '$username'";
            
            if (mysqli_query($conn, $updateSql)) {
                $successMessage = "Profile updated successfully.";
            } else {
                echo "<p>Error updating profile: " . mysqli_error($conn) . "</p>";
            }
        }
    } else {
        echo "<p>Error fetching user data: " . mysqli_error($conn) . "</p>";
    }
}

// Fetch user data to pre-fill the form
$fetchSql = "SELECT al_phno, al_email, al_address FROM alumni_table WHERE username = '$username'";
$result = mysqli_query($conn, $fetchSql);

if ($result) {
    $userData = mysqli_fetch_assoc($result);
    $phone = $userData['al_phno'];
    $email = $userData['al_email'];
    $address = $userData['al_address'];
} else {
    echo "<p>Error fetching user data: " . mysqli_error($conn) . "</p>";
}
?>
    <div class="container">
        <h1>Update Profile</h1>
        <div class="post">
        <form method="POST" onsubmit="return validateForm()" >
            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" id="phone" value="<?php echo $phone; ?>">

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>">

            <label for="address">Address:</label>
            <textarea name="address" id="address" rows="4"><?php echo $address; ?></textarea>

            <input type="submit" name="Update" value="Update">
        </form>
    </div>
        <?php
        if (!empty($successMessage)) {
            echo "<p class='success-message'>$successMessage</p>";
        }
        if (!empty($noChangeMessage)) {
            echo "<p class='no-results'>$noChangeMessage</p>";
        }
        ?>
    </div>
</body>
</html>



