<?php

require_once 'init.php';

$query = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_URL);

$linkEngine = new \AmigaSource\Data\LinkEngine($db);

$results = $linkEngine->search($query);

$data = [
    'query' => $query,
    'results' => $results,
];

include_once 'sidebar_data.php';

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('search.html.twig', $data);
