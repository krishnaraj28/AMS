<!DOCTYPE html>
<html>
<head>
    <title>Admin Approval</title>
    <style>
        body, h1 {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            background-color: #333;
            color: #fff;
            padding: 20px;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        /* Approval/Unapproval button styling */
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        .approve-button, .unapprove-button {
            background-color: #007bff; 
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .unapprove-button:hover {
            background-color: #dc3545;
        }

        .approve-button:hover {
            background-color: #28a745; 
        }
        a{
             color:black;
             text-decoration: none;
        }
        #home{
            color: white;
            font-size: 15px;
            text-align: right;
            border: 1px solid black;
            border-radius: 5px;
            margin: 5px 1400px;
            padding: 10px;
            width: 70px;
            background-color:lightgrey;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        #home:hover {
            background-color:grey;
        }

        #home{
            color: white;
            font-size: 15px;
            text-align: right;
            border: 1px solid black;
            border-radius: 5px;
            margin: 5px 1350px;
            padding: 10px;
            width: 100px;
            background-color:lightgrey;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        #home:hover {
            background-color:grey;
        }


    </style>
</head>
<body>
    
    <h1>Admin Approval <p id="home"><a href="adminhome.php">DASHBOARD</a></p></h1>
    <table>
        <tr>
            <th>Username</th>
            <th>Full Name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>DOB</th>
            <th>Course</th>
            <th>Batch</th>
            <th>Address</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php
        session_start();
        require("connection.php");

        // Fetch data from alumni_tab
        $sql = "SELECT * FROM alumni_table";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['al_name'] . "</td>";
                echo "<td>" . $row['al_gender'] . "</td>";
                echo "<td>" . $row['al_email'] . "</td>";
                echo "<td>" . $row['al_phno'] . "</td>";
                echo "<td>" . $row['al_dob'] . "</td>";
                echo "<td>" . $row['al_course'] . "</td>";
                echo "<td>" . $row['al_batch'] . "</td>";
                echo "<td>" . $row['al_address'] . "</td>";
                
                
                // Get the status from login_table
                $loginResult = mysqli_query($conn, "SELECT status FROM login_table WHERE username = '{$row['username']}'");
                $loginRow = mysqli_fetch_assoc($loginResult);
                $status = $loginRow['status'];

                echo "<td>" . $status . "</td>";

                // Approval/Unapproval buttons
                echo "<td>";
                if ($status === 'Approved') {
                    echo "<form method='POST'>";
                    echo "<input type='hidden' name='username' value='" . $row['username'] . "'>";
                    echo "<button type='submit' name='unapprove' class='unapprove-button'>Unapprove</button>";
                    echo "</form>";
                } else {
                    echo "<form method='POST'>";
                    echo "<input type='hidden' name='username' value='" . $row['username'] . "'>";
                    echo "<button type='submit' name='approve' class='approve-button'>Approve</button>";
                    echo "</form>";
                }
                echo "</td>";

                echo "</tr>";
            }
        }

       if (isset($_POST['approve'])) {
    $username = $_POST['username'];
    $newStatus = 'Approved';
} elseif (isset($_POST['unapprove'])) {
    $username = $_POST['username'];
    $newStatus = 'not approve';
}

if (isset($newStatus)) {
    // Update status in login_table
    $updateQuery = "UPDATE login_table SET status = '$newStatus' WHERE username = '$username'";
    
    if (mysqli_query($conn, $updateQuery)) {
        exit; // Terminate script execution
    } else {
        echo "Error: " . mysqli_error($conn); // Display the SQL error
    }
}

       ?>
    </table>
</body>
</html>
