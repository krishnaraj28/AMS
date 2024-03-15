<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Events</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            background-color: #fff;
            width: 100%;
            max-width: 800px;
            margin: 0px auto;
            margin-top:80px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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
        <?php include_once "admdasnavbar.html"; ?>
    </div>
    <div class="container">
        <h1>Event-Delete</h1>
        <table>
            <tr>
                <th>Event Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Location</th>
                <th>Description</th>
                <th>Delete</th>
            </tr>
            <?php
            require("connection.php");
            if (isset($_POST['event_id'])) {
                $eventId = $_POST['event_id'];

                // Delete the event
                $deleteSql = "DELETE FROM event_tab WHERE event_id = $eventId";
                if (mysqli_query($conn, $deleteSql)) {
                    echo '<p class="success-message">Event deleted successfully.</p>';
                } else {
                    echo "Error deleting event: " . mysqli_error($conn);
                }
            }

            // Fetch and display events
            $sql = "SELECT * FROM event_tab ORDER BY event_date ASC";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['event_name'] . "</td>";
                echo "<td>" . $row['event_date'] . "</td>";
                echo "<td>" . $row['event_time'] . "</td>";
                echo "<td>" . $row['event_venue'] . "</td>";
                echo "<td>" . $row['event_description'] . "</td>";
                echo '<td>
                        <form method="post" action="">
                            <input type="hidden" name="event_id" value="' . $row['event_id'] . '">
                            <button type="submit" onclick="return confirm(\'Are you sure you want to delete this event?\')">Delete</button>
                        </form>
                      </td>';
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>


