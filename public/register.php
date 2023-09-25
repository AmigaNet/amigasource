<?php

require_once 'init.php';

include_once 'sidebar_data.php';

$data = [];

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('register.html.twig', $data);
