<?php

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$pw = $_ENV['DB_PASS'];
$dbn = $_ENV['DB_NAME'];

$db = mysqli_connect($host, $user, $pw, $dbn) or die("could not connect to mysql");
mysqli_select_db($db, $dbn) or die("Could not select database!!!");
