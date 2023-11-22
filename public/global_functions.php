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
    /**
     * Dump and die
     *
     * This function is a shortcut for dumping a variable and then calling die().
     */
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

if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        if (isset($_SESSION['username'])) {
            return true;
        }
        return false;
    }
}
