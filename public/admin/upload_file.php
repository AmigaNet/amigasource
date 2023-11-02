<?php

require_once '../init.php';
include_once '../sidebar_data.php';

if (!is_admin()) {
    header('Location: index.php');
    exit;
}

$data = [];
$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('admin/file_upload.html.twig', $data);
