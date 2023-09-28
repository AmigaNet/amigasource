<?php

require_once 'init.php';

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_URL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_URL);

if (isset($username) && isset($password)) {
    $userEngine = new \AmigaSource\Auth\UserEngine($db);
    try {
        $user = $userEngine->login($username, $password);
    } catch (\AmigaSource\Auth\UserNotFoundException $e) {
        header('Location: login.php?error=1');
        exit;
    } catch (\AmigaSource\Auth\PasswordException $e) {
        header('Location: login.php?error=2');
        exit;
    } catch (\Exception $e) {
        header('Location: login.php?error=3');
        exit;
    }

    if ($user) {
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit;
    } else {
        header('Location: login.php?error=3');
        exit;
    }
}
