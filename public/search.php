<?php

require_once 'init.php';

include_once 'sidebar_data.php';

$query = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_URL);

$linkEngine = new \AmigaSource\Data\LinkEngine($db);

$results = $linkEngine->search($query);

echo $twig->render('search.html.twig', ['categories' => $categoryData, 'results' => $results, 'siteTitle' => $_ENV['SITE_TITLE']]);
