<?php

require_once __DIR__ . '/../../public/init.php';

$users = [
    [
        'username' => 'admin',
        'password' => 'admin',
        'role' => 'admin',
    ],
    [
        'username' => 'user',
        'password' => 'user',
        'role' => 'user',
    ],
];

$userEngine = new \AmigaSource\Auth\UserEngine($db);

foreach ($users as $user) {
    $userEngine->register($user['username'], $user['password']);
    $userEngine->setRole($user['username'], $user['role']);
}
