<?php

$categoryEngine = new \AmigaSource\Data\CategoryEngine($db);

$categories = $categoryEngine->fetchAll();

$categoryData = [];

foreach ($categories as $category) {
    $entry = [
        'id' => $category['id'],
        'title' => $category['name'],
        'sub' => $categoryEngine->fetchSubCategories($category['id']),
    ];
    $categoryData[] = $entry;
}

$eventEngine = new \AmigaSource\Data\EventEngine($db);
$upcomingEvents = $eventEngine->fetchUpcoming();

$magazineEngine = new \AmigaSource\Data\MagazineEngine($db);
$onlineMagazines = $magazineEngine->fetchOnline();
$printMagazines = $magazineEngine->fetchPrint();

$repairShopEngine = new \AmigaSource\Data\RepairShopEngine($db);
$repairShops = $repairShopEngine->fetchAll();

$vendorEngine = new \AmigaSource\Data\VendorEngine($db);
$vendors = $vendorEngine->fetchAll();

$sidebarData = [
    'categories' => $categoryData,
    'upcomingEvents' => $upcomingEvents,
    'onlineMagazines' => $onlineMagazines,
    'printMagazines' => $printMagazines,
    'repairShops' => $repairShops,
    'vendors' => $vendors,
];
