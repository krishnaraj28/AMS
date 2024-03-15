<!DOCTYPE html>
<html>
<head>
    <title>Batch Mate Search</title>
    <style>
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
            padding: 10px;
        }

        form {
            margin: 20px 0;
        }

        form input[type="text"],
        form select {
            padding: 10px;
            margin: 5px;
            width: 100%;
            max-width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #555;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 2px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        .no-results {
            color: red;
            font-size: 40px;
        }
    </style>
</head>
<body>
    <h1>Batch Mate Search</h1>
    <form method="POST" action="search_mates.php">
        <!-- First search criteria: Name, Batch, and Course -->
        Name: <input type="text" name="full_name" placeholder="Full Name" required>
        Course:
        <select name="course" required>
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
        <select name="batch" required>
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
        <input type="submit" name="search_criteria_1" value="Search by Name, Course, and Batch"></br></br>
    </form>

    <form method="POST" action="search_mates.php">
        <!-- Second search criteria: Username -->
        Username: <input type="text" name="username" placeholder="Username" required></br></br>
        <input type="submit" name="search_criteria_2" value="Search by Username">
    </form>

    <?php
    session_start();
    include_once "alumdasbnavbar.html";
    require("connection.php");
    $searchPerformed = false;
    // Check which search criteria was used
    if (isset($_POST['search_criteria_1'])) {
        // First search criteria: Name, Batch, and Course
        $full_name = isset($_POST['full_name']) ? mysqli_real_escape_string($conn, $_POST['full_name']) : '';
        $course = isset($_POST['course']) ? mysqli_real_escape_string($conn, $_POST['course']) : '';
        $batch = isset($_POST['batch']) ? mysqli_real_escape_string($conn, $_POST['batch']) : '';
        $searchPerformed = true;
        // Perform the search for Name, Batch, and Course
        $sql = "SELECT a.* FROM alumni_table AS a
            INNER JOIN login_table AS l ON a.username = l.username
            WHERE a.al_name = '$full_name' AND a.al_course = '$course' AND a.al_batch = '$batch' AND l.status = 'Approved'";
        $result = mysqli_query($conn, $sql);
    } elseif (isset($_POST['search_criteria_2'])) {
        // Second search criteria: Username
        $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
        $searchPerformed = true;
        // Perform the search for Username
        $sql = "SELECT a.* FROM alumni_table AS a
            INNER JOIN login_table AS l ON a.username = l.username
            WHERE l.username = '$username' AND l.status = 'Approved'";
        $result = mysqli_query($conn, $sql);
    }

    if (isset($result) && mysqli_num_rows($result) > 0) {
        echo "<h2>Search Results</h2>";
        echo "<table>
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
            </tr>";

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
            echo "</tr>";
        }
        echo "</table>";
    } 
    if (!$searchPerformed) {
        echo "<p>Enter search criteria and click 'Search' to find batch mates.</p>";
    } elseif ($searchPerformed && isset($result) && mysqli_num_rows($result) == 0) {
        echo "<p class='no-results'>No results found.</p>";
    }
    ?>
</body>
</html>
