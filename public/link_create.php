<?php

require_once 'init.php';

$linkEngine = new \AmigaSource\Data\LinkEngine($db);

if (!is_admin()) {
    header('Location: /index.php');
    exit;
}

include_once 'sidebar_data.php';

$data = [];

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('links/create.html.twig', $data);
