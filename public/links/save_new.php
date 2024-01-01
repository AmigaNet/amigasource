<?php

require_once '../init.php';

$linkEngine = new \AmigaSource\Data\LinkEngine($db);

if (!is_admin()) {
    header('Location: /index.php');
    exit;
}

$name = htmlspecialchars($_POST['name'], ENT_NOQUOTES, 'UTF-8');
$url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
$author = htmlspecialchars($_POST['author'], ENT_NOQUOTES, 'UTF-8');
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$description = htmlspecialchars($_POST['description'], ENT_NOQUOTES, 'UTF-8');
$is_active = checkbox_value('is_active');
$is_dead = checkbox_value('is_dead');
$is_recommended = checkbox_value('is_recommended');
$categories = filter_input(INPUT_POST, 'categories', FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);

$duplicates = $linkEngine->testForDuplicates($url);
if (sizeof($duplicates) > 0) {
    $linkId = $duplicates[0]['id'];
    header('Location: /links.php?id=' . $linkId);
    exit;
}

$linkId = $linkEngine->insertLink($name, $url, $author, $email, $description, $is_active, $is_dead, $is_recommended, $categories);

header('Location: /links.php?id=' . $linkId);
exit;
