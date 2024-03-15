<html>
<head>
    <title>Post Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }
        .post {
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            box-sizing: border-box;
            margin-top: 40px;
        }

        h1 {
            text-align: center;
        }

        form {
            margin-top: 40px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            height: 150px;
        }

        input[type="submit"] {
            text-align:center;
            background-color:#333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color:grey;
        }
    </style>
</head>
<body>
    <?php
        include_once"admdasnavbar.html";
    ?>
    <div class="container">
          <h1>Post Your Event</h1>
        <div class="post">
        <form action="eventpost.php" method="POST">
            
            <label for="event_name">Event Name:</label>
            <input type="text" id="event_name" name="event_name" required>

            <label for="event_date">Event Date:</label>
            <input type="date" id="event_date" name="event_date" required>
            <label for="event_date">Event Time:</label>
            <input type="time" id="event_time" name="event_time" required>

            <label for="event_location">Event Location:</label>
            <input type="text" id="event_location" name="event_location" required>

            <label for="event_description">Event Description:</label>
            <textarea id="event_description" name="event_description" required></textarea>
             <input type="submit" value="Add Event" name="event">
        </form>
    </div>
    </div>
</body>
</html>