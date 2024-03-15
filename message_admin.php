<!DOCTYPE html>
<html>
<head>
    <title>Simple Messaging System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: space-between;
            background-color: #f0f0f0;
            margin-top: 60px;
        }

        .column {
            flex: 1;
        }

        h1 {
            color: #333;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            border-radius: 7px;
            margin-bottom: 40px;
            margin-left: 100px;
        }

        table, th, td {
            border: 2px solid black;
        }

        th, td {
            padding: 10px;
        }

        form {
            margin-top: 30px;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        textarea {
            width: 60%;
            padding: 20px;
            border: 2px solid black;
            border-radius: 5px;
            margin-top: 5px;
            font-family: sans-serif;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        .sented {
            color: green;
            font-size: 20px;
        }

        .error {
            color: red;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="column">
            <div class="message-box">
                <h1>Your Messages</h1>
                <h2>Send a Message</h2>
                <form method="POST" action="">
                    <label for="to_user">To User:</label>
                    <input type="text" id="to_user" name="to_user" required placeholder="Enter username">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required  placeholder="Your message"></textarea></br></br>
                    <input type="submit" name="send" value="Send">
                </form>
                <?php
                require("connection.php");
                session_start();
                include_once "admdasnavbar.html";
                if (isset($_SESSION['username'])) {
                    $loggedInUser = $_SESSION['username'];

                    // Handle message sending
                    if (isset($_POST['send'])) {
                        $toUser = $_REQUEST['to_user'];
                        $message = mysqli_real_escape_string($conn, $_REQUEST['message']);

                        // Validate if the recipient (to_user) exists, you should modify this validation as needed
                        $userCheckSql = "SELECT * FROM login_table WHERE username = '$toUser'";
                        $userCheckResult = mysqli_query($conn, $userCheckSql);
                        if (mysqli_num_rows($userCheckResult) > 0) {
                            $insertSql = "INSERT INTO msg_tab (from_user, to_user, message) VALUES ('$loggedInUser', '$toUser', '$message')";
                            if (mysqli_query($conn, $insertSql)) {
                                echo '<p class="sented">Message sent successfully.</p>';
                            } else {
                                echo "Error sending message: " . mysqli_error($conn);
                            }
                        } else {
                            echo '<p class="error">Recipient user not found. Please check the username.</p>';
                        }
                    }

                    // Retrieve and display messages
                    $retrieveSql = "SELECT * FROM msg_tab WHERE to_user = '$loggedInUser'";
                    $result = mysqli_query($conn, $retrieveSql);

                    if (mysqli_num_rows($result) > 0) {
                        echo '<table>';
                        echo '<tr><th>From User</th><th>Message</th></tr>';
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr><td>' . $row['from_user'] . '</td><td>' . $row['message'] . '</td></tr>';
                        }
                        echo '</table>';
                    } else {
                        echo '<p>No messages to display.</p>';
                    }
                    $sentMessagesSql = "SELECT * FROM msg_tab WHERE from_user = '$loggedInUser'";
                    $sentMessagesResult = mysqli_query($conn, $sentMessagesSql);
                    if (mysqli_num_rows($sentMessagesResult) > 0) {
                        echo '<table>';
                        echo '<tr><th>To User</th><th>Message</th></tr>';
                        while ($row = mysqli_fetch_assoc($sentMessagesResult)) {
                            echo '<tr><td>' . $row['to_user'] . '</td><td>' . $row['message'] . '</td></tr>';
                        }
                        echo '</table>';
                    } else {
                    echo '<p>No sent messages to display.</p>';
                    }
                } else {
                    echo '<p>You must be logged in to send and receive messages.</p>';
                }
                ?>
                
            </div>
        </div>
    </div>
</body>
</html>
