<!DOCTYPE html>
<html>
<head>
    <title>Event Feed</title>
    <style>
         body {
            margin: 0;
            padding: 0;
            background-color:lightgrey;
        }

        .column {
            border-radius: 5px;
            padding: 50px;
            align-items: center;
            
        }   
        h1 {
             font-family: Arial, sans-serif;
            background-color: #333;
            color: #fff;
            text-align: center;

        }

        table {
            width: 100%;
            border-collapse: collapse
            border-radius: 3px;
            margin-bottom: 50px;
            margin-left: 30px;
             padding: 30px;

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
        </style>
       
</head>
<body>
    <?php
        include_once"navbar.html";
    ?>
        <div class="column">
            <div class="event-box">
                <h1>Events</h1>
                <?php
                require("connection.php");
                $eventSql ="SELECT * FROM event_tab ORDER BY event_date DESC";
                $eventResult = mysqli_query($conn, $eventSql);

                if (mysqli_num_rows($eventResult) > 0) {
                    echo '<table>';
                    echo '<tr><th>Event Name</th><th>Date</th><th>Time</th><th>Location</th><th>Description</th></tr>';
                    while ($eventRow = mysqli_fetch_assoc($eventResult)) {
                        echo '<tr><td>' . $eventRow['event_name'] . '</td><td>' . $eventRow['event_date'] . '</td><td>' . $eventRow['event_time'] . '</td><td>' . $eventRow['event_venue'] . '</td><td>' . $eventRow['event_description'] . '</td></tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<p>No events to display.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>