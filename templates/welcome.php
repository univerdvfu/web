<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .bg {
            background-image: url('https://s10.stc.yc.kpcdn.net/share/i/12/12010775/wr-960.webp'); /* Замените на путь к вашей картинке */
            filter: blur(5px);
            -webkit-filter: blur(5px);
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: fixed;
            width: 100%;
            z-index: -1;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .content {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
        }
        a {
            color: #007BFF;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #f4f4f4;
            border-radius: 4px;
        }
        a:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="bg"></div>
    <div class="container">
        <div class="content">
            <h1>Welcome, <?php echo htmlspecialchars($_COOKIE['username']); ?>!</h1>
            <a href="index.php?action=logout">Logout</a>
        </div>
    </div>
</body>
</html>
