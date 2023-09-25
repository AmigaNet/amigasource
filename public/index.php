<?php

require_once 'init.php';

$newsEngine = new \AmigaSource\Data\NewsEngine($db);

$articles = $newsEngine->fetchActive(5);

include_once 'sidebar_data.php';

$data = [
    'news' => $articles,
];

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('index.html.twig', $data);
