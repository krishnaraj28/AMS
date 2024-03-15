<html>
<head>
    <title>Event Posting</title>
    <style>
        #save-success {
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

    <div id="save-success" style="display: none;">
        <h1>Posted Successfully</h1>
    </div>
    <p id="home"><a href="adminhome.php">BACK</a></p>

    <?php
    session_start();
    require("connection.php");

    if (isset($_POST["event"])) {
        if (isset($_SESSION['username'])) {
            $Uname = $_SESSION['username'];
            $Ev_name = $_REQUEST['event_name'];
            $Ev_date = $_REQUEST['event_date'];
            $Ev_time = $_REQUEST['event_time'];
            $Ev_loca = $_REQUEST['event_location'];
            $Ev_desc = mysqli_real_escape_string($conn, $_REQUEST['event_description']);

            $sql = "SELECT * FROM login_table WHERE username='$Uname'";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                die("Error in SELECT query: " . mysqli_error($conn));
            }

            if (mysqli_num_rows($result) > 0) {
                $insertSql = "INSERT INTO event_tab (user_name,event_name,event_date,event_time,event_venue,event_description) VALUES('$Uname','$Ev_name','$Ev_date','$Ev_time','$Ev_loca','$Ev_desc')";

                if (mysqli_query($conn, $insertSql)) {
                    echo '<script>document.getElementById("save-success").style.display = "block";</script>';
                } else {
                    echo "Error in INSERT query: " . mysqli_error($conn);
                }
            } else {
                echo "User not found in login_table";
            }
        } else {
            echo "User is not logged in. Please log in first.";
        }
    }
    ?>
</body>
</html>
