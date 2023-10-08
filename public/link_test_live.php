<?php

require_once 'init.php';

$linkEngine = new \AmigaSource\Data\LinkEngine($db);

if (!is_admin()) {
    header('Location: /index.php');
    exit;
}

if (isset($_GET['id'])) {
    $linkId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    try {
        $link = $linkEngine->fetch($linkId);
    } catch (\Exception $e) {
        header('Location: /links.php');
        exit;
    }
} else {
    header('Location: /links.php');
    exit;
}

$linkEngine->testForBroken($linkId);

header('Location: /links.php?id=' . $linkId);
