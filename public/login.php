<?php

require_once 'init.php';

include_once 'sidebar_data.php';

$data = [];

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 1:
            $data['error'] = 'User not found';
            break;
        case 2:
            $data['error'] = 'Password is incorrect';
            break;
        default:
            $data['error'] = 'Unknown error';
            break;
    }
}

echo $twig->render('login.html.twig', $data);
