<?php

/* PHP VIEW ERRORS */
define('PHP_VIEW_ERRORS', true);

/* DB CONFIG */
define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_USER', 'gu');
define('DB_PASSWORD', 'gu2017');
define('DB_NAME', 'gu');
define('DB_CHARSET', 'utf8');

/* APP VERSION */
define('APP_VERSION', time());

if (PHP_VIEW_ERRORS) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}