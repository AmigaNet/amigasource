<?php

require_once 'init.php';

$newsEngine = new \AmigaSource\Data\NewsEngine($db);

$articles = $newsEngine->fetchActive(5);

include_once 'sidebar_data.php';

echo $twig->render('index.html.twig', ['categories' => $categoryData, 'news' => $articles, 'siteTitle' => $_ENV['SITE_TITLE']]);
