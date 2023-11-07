<?php

require_once '../init.php';

$data = [];

include_once '../sidebar_data.php';

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('search_form.html.twig', $data);
