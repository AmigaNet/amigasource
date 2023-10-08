<?php

// This file is for functions that should be available globally.

if (!function_exists('checkbox_value')) {
    function checkbox_value($name)
    {
        if (isset($_POST[$name])) {
            return 1;
        }
        return 0;
    }
}

if (!function_exists('dd')) {
    function dd($var)
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
        die();
    }
}

if (!function_exists('is_admin')) {
    function is_admin()
    {
        if (isset($_SESSION['username'])) {
            $userEngine = new \AmigaSource\Auth\UserEngine($GLOBALS['db']);
            try {
                $user = $userEngine->fetchByUsername($_SESSION['username']);
                if ($user['role'] == 'admin') {
                    return true;
                }
            } catch (\Exception $e) {
                return false;
            }
        }
        return false;
    }
}
