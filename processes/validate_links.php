<?php

require_once '../init.php';

$sql = "SELECT value FROM system WHERE name = 'validating'";
$result = $db->query($sql);
$row = $result->fetch_assoc();
if ($row['value'] == 'true') {
    echo "Attempted to start validation, but validation already in progress\n";
    exit;
}

$startTime = time();

$linkEngine = new \AmigaSource\Data\LinkEngine($db);

$links = $linkEngine->fetchAll();

echo "Validating " . count($links) . " links\n";

$sql = "UPDATE system SET value = 'true' WHERE name = 'validating'";
$stmt = $db->prepare($sql);
$stmt->execute();

echo "Beginning validation...\n";

$sql = "UPDATE system SET value = NOW() WHERE name = 'validation_last_start'";
$stmt = $db->prepare($sql);
$stmt->execute();

foreach ($links as $link) {
    $linkId = $link['id'];
    $linkStartTime = time();
    echo "Validating link ID $linkId with current is_dead status '" . $link['is_dead'] . "' and current is_active status '" . $link['is_active'] . "'...\n";
    $linkEngine->testForBroken($linkId);
    $newLink = $linkEngine->fetch($linkId);
    $linkEndTime = time();
    $linkDuration = $linkEndTime - $linkStartTime;
    echo "After $linkDuration seconds, link ID $linkId now has is_dead status '" . $newLink['is_dead'] . "' and is_active status '" . $newLink['is_active'] . "'\n";
}

echo "Done validating links\n";

$sql = "UPDATE system SET value = 'false' WHERE name = 'validating'";
$stmt = $db->prepare($sql);
$stmt->execute();

$sql = "UPDATE system SET value = NOW() WHERE name = 'validation_last_end'";
$stmt = $db->prepare($sql);
$stmt->execute();

$endTime = time();

$duration = $endTime - $startTime;

echo "System database updated, validation complete after $duration seconds\n";
