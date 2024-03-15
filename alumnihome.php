<html>
<head>
    <title>Alumni Dashboard</title>
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
            text-align: left;
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
                 echo 'Welcome ' . $_SESSION['al_name'];
            } else {
                echo 'You are not logged in.';
            }
            ?>    
        </h1>

    </header>
    <div class="container">
         <div class="card">
            <a href="myaccount.php">
            <h2>My Account</h2>
            <p>View Your Account</p>
        </div>
        <div class="card">
            <a href="update.php">
            <h2>Update</h2>
            <p>Update Deatils</p>
        </div>
        <div class="card">
            <a href="story.php">
            <h2>Story</h2>
            <p>Share your Story</p></a>
        </div>
        <div class="card">
            <a href="search_mates.php">
            <h2>Search</h2>
            <p>Find your Friends</p>
        </div>
         <div class="card">
            <a href="delete_story.php">
            <h2>Delete-story</h2>
            <p>Delete your story</p>
        </div>
        <div class="card">
            <a href="message.php">
            <h2>Message</h2>
            <p>Contact your Friends</p>
        </div>
       
    </div>
</body>
</html>