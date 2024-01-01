<?php

require_once '../init.php';

$newsEngine = new \AmigaSource\Data\NewsEngine($db);

if (!is_admin()) {
    header('Location: /index.php');
    exit;
}

include_once '../sidebar_data.php';

$data = [];

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('news/create.html.twig', $data);
