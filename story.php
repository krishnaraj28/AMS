<html>
<head>
    <title>Post Story</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
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
            margin-top: 50px;
        }

        h1 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="timestamp"],
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
        include_once"alumdasbnavbar.html";
  ?>
    <div class="container">
          <h1>Share Your Story</h1>
        <div class="post">
        <form method="POST" action="storypost.php">
            <label for="story_desc">Story Description:</label>
            <textarea id="story_desc" name="story_desc" required></textarea>
            <input type="submit" name="Share" value="Share">
        </form>
        </div>
    </div>
</body>
</html>