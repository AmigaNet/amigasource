<?php

require_once '../init.php';

if (!is_admin()) {
    header('Location: /index.php');
    exit;
}

shell_exec("/usr/bin/env php ../../processes/validate_links.php >> ../../logs/validation.log &");

header('Location: /admin/index.php');
