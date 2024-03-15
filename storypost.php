<html>
<head>
    <title>Story Posting</title>
    <style>
        #share-success {
            display: none;
            background-color: #2a3439;
            color: white;
            padding: 10px;
            margin: 10px;
            text-align: center;
        }
        #home a {
            font-size: 15px;
            text-align: center;
            border: 1px solid black;
            border-radius: 5px;
            margin: 5px auto;
            padding: 10px;
            width: 50px;
            background-color: lightgrey;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            color: black;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #home a:hover {
            background-color: grey;
        }
    </style>
</head>
<body>

    <div id="share-success" style="display: none;">
        <h1>Posted Successfully</h1>
    </div>
    <p id="home"><a href="alumnihome.php">BACK</a></p>

    <?php
    session_start();
    require("connection.php");

    if (isset($_POST["Share"])) {
        if (isset($_SESSION['username'])) {
            $Uname = $_SESSION['username'];
            $St_desc = mysqli_real_escape_string($conn, $_REQUEST['story_desc']);

            // Use the NOW() function to insert the current timestamp
            $insertSql = "INSERT INTO story_tab (user_name, story_description, story_date) VALUES ('$Uname', '$St_desc', NOW())";
            $result = mysqli_query($conn, $insertSql);

            if ($result) {
                echo '<script>document.getElementById("share-success").style.display = "block";</script>';
            } else {
                echo "Error in INSERT query: " . mysqli_error($conn);
            }
        } else {
            echo "User is not logged in. Please log in first.";
        }
    }
    ?>
</body>
</html>
