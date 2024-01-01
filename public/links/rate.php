<?php

require_once '../init.php';

if (!is_logged_in()) {
    header('Location: /index.php');
    exit;
}

$linkEngine = new \AmigaSource\Data\LinkEngine($db);
$linkRatingEngine = new \AmigaSource\Data\LinkRatingEngine($db);

if (isset($_GET['id'])) {
    $linkId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $link = $linkEngine->fetch($linkId);
} else {
    header('Location: /links.php');
    exit;
}

$ratingData = $linkRatingEngine->fetchRatingForLinkAndUser($linkId, $commonData['user_id']);

if (isset($ratingData['rating'])) {
    $rating = $ratingData['rating'];
} else {
    $rating = 0;
}

include_once '../sidebar_data.php';

$data = [
    'link' => $link,
    'rating' => $rating,
];

$data = array_merge($data, $commonData);
$data = array_merge($data, $sidebarData);

echo $twig->render('links/rate.html.twig', $data);
