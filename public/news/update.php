<?php

require_once '../init.php';

$newsEngine = new \AmigaSource\Data\NewsEngine($db);

if (!is_admin()) {
    header('Location: /index.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$title = htmlspecialchars($_POST['title']);
$story = $_POST['story'];
$is_active = checkbox_value('is_active');

$newsEngine->update($id, $title, $story, $is_active);

header('Location: /news/list.php');
exit;
