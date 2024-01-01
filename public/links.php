<?php

require_once 'init.php';

$linkEngine = new \AmigaSource\Data\LinkEngine($db);

$links = [];

if (isset($_GET['category'])) {
    $categoryId = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_NUMBER_INT);
    $links = $linkEngine->fetchByCategory($categoryId);
} elseif (isset($_GET['id'])) {
    $linkId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    try {
        $links[] = $linkEngine->fetch($linkId);
    } catch (Exception $ex) {
        if ($ex->getMessage() === 'Link not found') {
            header('Location: /not_found.php');
            exit;
        }
    }
} else {
    $links = $linkEngine->fetchAll();
}

include_once 'sidebar_data.php';

$data = [
    'links' => $links,
];

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('links/list.html.twig', $data);
