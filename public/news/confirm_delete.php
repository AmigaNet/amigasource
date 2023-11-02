<?php

require_once '../init.php';

$newsEngine = new \AmigaSource\Data\NewsEngine($db);

if (!is_admin()) {
    header('Location: /index.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $article = $newsEngine->fetch($id);
} else {
    header('Location: /index.php');
    exit;
}

include_once '../sidebar_data.php';

$data = [
    'article' => $article,
];

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('news/confirm_delete.html.twig', $data);
