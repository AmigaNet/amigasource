<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twigOptions = [];

if ($_ENV['ENVIRONMENT'] === 'production') {
    $twigOptions['cache'] = __DIR__ . '/../template_cache';
}

$twig = new \Twig\Environment($loader, $twigOptions);

define("ABS_PATH", dirname(__FILE__));

if (!isset($_SESSION)) {
    session_start();
}

include 'login_db.php';

$commonData = [
    'siteTitle' => $_ENV['SITE_TITLE'],
];
