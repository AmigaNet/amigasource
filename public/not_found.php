<?php

require_once 'init.php';

include_once 'sidebar_data.php';

$data = [];

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

http_response_code(404);
echo $twig->render('errors/404.html.twig', $data);
