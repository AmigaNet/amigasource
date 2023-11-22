<?php

require_once '../init.php';

$linkEngine = new \AmigaSource\Data\LinkEngine($db);

$links = $linkEngine->fetchSubmitted();

include_once '../sidebar_data.php';

$data = [
    'links' => $links,
];

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('links/submitted.html.twig', $data);
