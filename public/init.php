<?php

use Twig\Extra\Intl\IntlExtension;

require __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/global_functions.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twigOptions = [];

if ($_ENV['ENVIRONMENT'] === 'production') {
    $twigOptions['cache'] = __DIR__ . '/../template_cache';
}

$twig = new \Twig\Environment($loader, $twigOptions);
$twig->addExtension(new IntlExtension());

define("ABS_PATH", dirname(__FILE__));

if (!isset($_SESSION)) {
    session_start();
}

include 'login_db.php';

$commonData = [
    'siteTitle' => $_ENV['SITE_TITLE'],
];

$userData = [
    'loggedIn' => false,
];

if (isset($_SESSION['username'])) {
    $userEngine = new \AmigaSource\Auth\UserEngine($db);
    try {
        $user = $userEngine->fetchByUsername($_SESSION['username']);
        $commonData['username'] = $user['username'];
        $commonData['user_role'] = $user['role'];
        $commonData['logged_in'] = true;
    } catch (\Exception $e) {
        unset($_SESSION['username']);
        $commonData['logged_in'] = false;
    }
}
