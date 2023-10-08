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

$sql = "SELECT COUNT(*) AS dead_count FROM links WHERE is_dead = 1";
$result = $db->query($sql);
$row = $result->fetch_assoc();
$deadLinkCount = $row['dead_count'];

$sql = "SELECT COUNT(*) AS active_count FROM links WHERE is_active = 1";
$result = $db->query($sql);
$row = $result->fetch_assoc();
$activeLinkCount = $row['active_count'];

$sql = "SELECT name, value FROM system";
$result = $db->query($sql);
$systemData = [];
while ($row = $result->fetch_assoc()) {
    $systemData[$row['name']] = $row['value'];
}

$data = [
    'link_count' => $linkCount,
    'dead_link_count' => $deadLinkCount,
    'active_link_count' => $activeLinkCount,
    'system_data' => $systemData,
];

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('admin.html.twig', $data);
