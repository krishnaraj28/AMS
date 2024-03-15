<!DOCTYPE html>
<html>
<head>
    <title>Stories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 80px auto 20px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 20px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        button {
            background-color: #f44336;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .success-message {
            color: red;
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <?php 
            include_once"admdasnavbar.html";
        ?>
    </div>
    <div class="container">
        <h1>Stories</h1>
        <?php
        session_start();
        require("connection.php");
        $loggedInUser = $_SESSION['username'];

        if (isset($_POST['story_id'])) {
            $storyId = $_POST['story_id'];

            // Delete the story
            $deleteSql = "DELETE FROM story_tab WHERE story_id = $storyId";
            if (mysqli_query($conn, $deleteSql)) {
                echo '<p class="success-message">Story deleted successfully.</p>';
            } else {
                echo "Error deleting story: " . mysqli_error($conn);
            }
        }

        // Fetch and display the user's stories
        $sql = "SELECT * FROM story_tab";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<table>
                <tr>
                    <th>Description</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                </tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['story_description'] . "</td>";
                echo "<td>" . $row['story_date'] . "</td>";
                echo '<td>
                        <form method="POST" action="">
                            <input type="hidden" name="story_id" value="' . $row['story_id'] . '">
                            <button type="submit" onclick="return confirm(\'Are you sure you want to delete this story?\')">Delete</button>
                        </form>
                      </td>';
                echo "</tr>";
            }
            echo '</table>';
        } else {
            echo "No stories found.";
        }
        ?>
    </div>
</body>
</html>
