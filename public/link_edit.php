<?php

require_once 'init.php';

$linkEngine = new \AmigaSource\Data\LinkEngine($db);

if (!is_admin()) {
    header('Location: /index.php');
    exit;
}

if (isset($_GET['id'])) {
    $linkId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $link = $linkEngine->fetch($linkId);
} else {
    header('Location: /links.php');
    exit;
}

include_once 'sidebar_data.php';

$categories = [];

foreach ($link['categories'] as $category) {
    $categories[] = $category['id'];
}

$data = [
    'link' => $link,
    'link_categories' => $categories,
];

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('links/edit.html.twig', $data);
