<?php

require_once 'init.php';

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_URL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_URL);

if (isset($username) && isset($password)) {
    $userEngine = new \AmigaSource\Auth\UserEngine($db);
    $user = $userEngine->login($username, $password);

    if ($user) {
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit;
    } else {
        header('Location: login.php?error=1');
        exit;
    }
}
