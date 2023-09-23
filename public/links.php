<?php

require_once 'init.php';

include_once 'sidebar_data.php';

$linkEngine = new \AmigaSource\Data\LinkEngine($db);

$links = [];

if (isset($_GET['category'])) {
    $categoryId = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_NUMBER_INT);
    $links = $linkEngine->fetchByCategory($categoryId);
} else {
    $links = $linkEngine->fetchAll();
}

echo $twig->render('links.html.twig', ['categories' => $categoryData, 'links' => $links, 'siteTitle' => $_ENV['SITE_TITLE']]);
