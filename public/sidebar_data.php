<?php

$categoryEngine = new \AmigaSource\Data\CategoryEngine($db);

$categories = $categoryEngine->fetchAll();

$categoryData = [];

$subCategoryEngine = new \AmigaSource\Data\SubCategoryEngine($db);

foreach ($categories as $category) {
    $entry = [
        'id' => $category['cat_main_id'],
        'title' => $category['cat_main_title'],
        'sub' => $subCategoryEngine->fetchByParent($category['cat_main_id']),
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
