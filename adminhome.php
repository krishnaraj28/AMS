<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header,h2 {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
        .card {
            border: 1px solid black;
            border-radius: 10px;
            margin: 10px;
            padding: 20px;
            width: 700px;
            background-color:lightgrey;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        .card:hover {
            background-color:grey;
        }
        a{
             color:black;
             text-decoration: none;
        }
        p{
           text-align: center; 
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

    </style>
</head>
<body>
    <header>
        <p id="home"><a href="logout.php">LOGOUT</a></p>
        <h1>
            <?php
            session_start();
            if (isset($_SESSION['username'])) {
                 echo 'Welcome ' . $_SESSION['username'];
            } else {
                echo 'You are not logged in.';
            }
            ?>
        </h1>
    </header>
    <div class="container">
        <div class="card">
            <a href="admin_approval.php">
            <h2>Approve/View</h2>
            <p>Approve Alumni</p>
        </div>
        <div class="card">
            <a href="event.php">
            <h2>Event</h2>
            <p>Post your Event</p></a>
        </div>
        <div class="card">
            <a href="delete_event.php">
            <h2>Delete</h2>
            <p>Delete the posted event</p></a>
        </div>
        <div class="card">
            <a href="message_admin.php">
            <h2>Message</h2>
            <p>Contact Alumni</p></a>
        </div>
        <div class="card">
            <a href="all_story.php">
            <h2>Story</h2>
            <p>Story Posted by Alumni</p></a>
        </div>
    </div>
</body>
</html>