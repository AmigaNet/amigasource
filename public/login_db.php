<?php

$host = "db";
$user = "asdb";
$pw = "asdb";
$dbn = "asdb";

$myConnection = mysqli_connect($host, $user, $pw, $dbn) or die("could not connect to mysql");
mysqli_select_db($myConnection, $dbn) or die("Could not select database!!!");
