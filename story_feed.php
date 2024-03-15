<!DOCTYPE html>
<html>
<head>
    <title>Home-story</title>
    <style>
        body {
            background-color: lightgrey;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .navbar {
            background-color: #333;
            color: #fff;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-top: 20px;
            color: #333;
        }

        .story-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 60px;
        }

        .story-card {
            border: 3px solid black;
            border-radius: 8px;
            padding: 10px;
            background-color: 445c54;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .story-title {
            font-size: 19px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .story-description {
            font-size: 14px;
            text-align: justify;
            font-family:cursive;
        }
        .story-date {
            font-size: 10px;
            text-align: right;
            font-family:cursive;
            margin-bottom:10px;
        }

    </style>
</head>
<body>
    <div class="navbar">
        <?php include_once "navbar.html"; ?>
    </div>

    <h1>Stories</h1>

    <div class="story-container">
        <?php
        require("connection.php");
        $sql = "SELECT * FROM story_tab ORDER BY story_date";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="story-card">';
            echo '<div class="story-date">' . $row['story_date'] . '</div>';
            echo '<div class="story-title">' . $row['user_name'] . ' said:</div>';
            echo '<div class="story-description">' . $row['story_description'] . '</div>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>

