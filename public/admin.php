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

$sql = "SELECT COUNT(*) AS count FROM links";
$result = $db->query($sql);
$row = $result->fetch_assoc();
$linkCount = $row['count'];

$data = [
    'link_count' => $linkCount,
];

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('admin.html.twig', $data);
