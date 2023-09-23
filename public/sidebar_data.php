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
