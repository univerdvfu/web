<?php
session_start();

// Создание базы данных и таблицы пользователей
function init_db() {
    $db = new SQLite3('users.db');
    $db->exec('CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL
    )');
    $db->close();
}

init_db();

// Маршруты и логика
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action']) && $_GET['action'] === 'logout') {
        setcookie('username', '', time() - 3600);
        header('Location: index.php');
        exit();
    }

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($page === 'login') {
            include('templates/login.php');
        } elseif ($page === 'register') {
            include('templates/register.php');
        } elseif ($page === 'welcome') {
            if (isset($_COOKIE['username'])) {
                include('templates/welcome.php');
            } else {
                header('Location: index.php?page=login');
                exit();
            }
        }
    } else {
        header('Location: index.php?page=login');
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        if ($action === 'login') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $db = new SQLite3('users.db');
            $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = $db->query($query);
            $user = $result->fetchArray(SQLITE3_ASSOC);
            $db->close();
            if ($user) {
                setcookie('username', $username, time() + 3600);
                header('Location: index.php?page=welcome');
                exit();
            } else {
                echo 'Неверное имя пользователя или пароль';
            }
        } elseif ($action === 'register') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $db = new SQLite3('users.db');
            $query = "SELECT * FROM users WHERE username = '$username'";
            $result = $db->query($query);
            $existing_user = $result->fetchArray(SQLITE3_ASSOC);
            if ($existing_user) {
                echo 'Пользователь уже существует';
            } else {
                $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
                $db->exec($query);
                $db->close();
                header('Location: index.php?page=login');
                exit();
            }
        }
    }
}
?>
