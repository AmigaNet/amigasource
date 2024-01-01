<?php

require_once '../init.php';

if (!is_logged_in()) {
    header('Location: /index.php');
    exit;
}

// Accept a link ID, user ID, and a rating and update the database
$linkId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$userId = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
$rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT);

$linkRatingEngine = new \AmigaSource\Data\LinkRatingEngine($db);

$linkRatingEngine->rateLink($linkId, $userId, $rating);

header('Location: /links.php?id=' . $linkId);
