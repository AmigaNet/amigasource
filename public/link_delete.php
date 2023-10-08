<?php

require_once 'init.php';

$linkEngine = new \AmigaSource\Data\LinkEngine($db);

if (!is_admin()) {
    header('Location: /index.php');
    exit;
}

$linkId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

$linkEngine->delete($linkId);

header('Location: /links.php');
exit;
