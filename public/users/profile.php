<?php

require_once '../init.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);

$userEngine = new \AmigaSource\Data\UserEngine($db);

$user = $userEngine->fetchUser($id);

$data = [
    'user' => $user,
];

include_once '../sidebar_data.php';

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('users/profile.html.twig', $data);
