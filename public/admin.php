<?php

require_once 'init.php';

include_once 'sidebar_data.php';

$username = $_SESSION['username'];

if (isset($username)) {
    $userEngine = new \AmigaSource\Auth\UserEngine($db);

    try {
        $user = $userEngine->fetchByUsername($username);
    } catch (\Exception $e) {
        header('Location: index.php');
        exit;
    }

    if ($user['role'] != 'admin') {
        header('Location: index.php');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}

$data = [];

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('admin.html.twig', $data);
