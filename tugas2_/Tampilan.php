<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            background-color: #333;
            justify-content: space-between;
            padding: 10px;
            align-items: center;
        }

        .navbar h1 {
            color: white;
            margin: 0;
        }

        .menu-list {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .menu-list li {
            margin-right: 20px;
        }

        .menu-list a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 8px 16px;
            transition: background-color 0.3s;
        }

        .menu-list a:hover {
            background-color: #575757;
            border-radius: 5px;
        }

        .welcome-text {
            text-align: center;
            margin-top: 150px;
            font-size: 48px;
            color: #333;
            font-family: 'Georgia', serif;
            letter-spacing: 2px;
        }

        hr {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>JOURNALS</h1>
        <ul class="menu-list">
            <li><a href="journal.php">Journals </a></li>
        <li><a href="journal_details.php">Journals Details </a></li>
            
            <li><a href="journal_details_1.php">Journals (ID = 1)</a></li>
            <li><a href="journal_1.php">Journals Details (ID = 101)</a></li>
        </ul>
    </div>

    <hr>

    <div class="welcome-text">
        Welcome to Journals
    </div>

</body>
</html>
