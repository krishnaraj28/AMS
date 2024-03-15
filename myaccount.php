<html>
<head>
    <title>My Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-container {
            max-width:4000px;
            padding: 60px;
            background-color: #708090;
            border: 1px solid #ccc;
            border-radius: 15px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-size: 30px;
            margin: 0 0 20px;
            font-family: serif;
            text-align: center;
        }

        p {
            margin: 10px 0;
        }

        .profile-details {
            margin: 20px 0;
            font-size: 20px;
            font-family: serif;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <?php include_once "alumdasbnavbar.html"; ?>
    </div>
    <div class="profile-container">
        <h2>User Profile</h2>
        <?php
        session_start();
        require("connection.php");
            if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            // Fetch user details from the database
            $sql = "SELECT * FROM alumni_table WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $userDetails = mysqli_fetch_assoc($result);
                echo '<div class="profile-details">';
                echo "<p><strong>Username:</strong> " . $userDetails['username'] . "</p>";
                echo "<p><strong>Full Name:</strong> " . $userDetails['al_name'] . "</p>";
                echo "<p><strong>Gender:</strong> " . $userDetails['al_gender'] . "</p>";
                echo "<p><strong>Email:</strong> " . $userDetails['al_email'] . "</p>";
                echo "<p><strong>Phone Number:</strong> " . $userDetails['al_phno'] . "</p>";
                echo "<p><strong>DOB:</strong> " . $userDetails['al_dob'] . "</p>";
                echo "<p><strong>Course:</strong> " . $userDetails['al_course'] . "</p>";
                echo "<p><strong>Batch:</strong> " . $userDetails['al_batch'] . "</p>";
                echo "<p><strong>Address:</strong> " . $userDetails['al_address'] . "</p>";
                echo '</div>';
            } else {
                echo "User not found in the database.";
            }
        } else {
            echo "You are not logged in. Please log in to view your account.";
        }
        ?>
    </div>
</body>
</html>
