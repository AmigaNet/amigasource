<?php

require_once 'init.php';

$linkEngine = new \AmigaSource\Data\LinkEngine($db);

$links = [];

if (isset($_GET['category'])) {
    $categoryId = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_NUMBER_INT);
    $links = $linkEngine->fetchByCategory($categoryId);
} else {
    $links = $linkEngine->fetchAll();
}

include_once 'sidebar_data.php';

$data = [
    'links' => $links,
];

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('links.html.twig', $data);
