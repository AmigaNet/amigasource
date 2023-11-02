<?php

require_once '../init.php';

$newsEngine = new \AmigaSource\Data\NewsEngine($db);

if (!is_admin()) {
    header('Location: /index.php');
    exit;
}

$title = htmlspecialchars($_POST['title']);
$story = $_POST['story'];
$is_active = checkbox_value('is_active');

$id = $newsEngine->insert($title, $story, $is_active);

header('Location: /news/list.php');
exit;
