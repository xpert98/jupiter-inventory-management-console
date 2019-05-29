<?php
    $dbhost = '';
    if (isset($_SERVER['JUPITER_DB_HOST'])) {
        $dbhost = $_SERVER['JUPITER_DB_HOST'];
    }
    else {
        $dbhost = $_ENV['JUPITER_DB_HOST'];
    }

    $dbname = '';
    if (isset($_SERVER['JUPITER_DB_SCHEMA'])) {
        $dbname = $_SERVER['JUPITER_DB_SCHEMA'];
    }
    else {
        $dbname = $_ENV['JUPITER_DB_SCHEMA'];
    }

    $dbuser = '';
    if (isset($_SERVER['JUPITER_DB_USER'])) {
        $dbuser = $_SERVER['JUPITER_DB_USER'];
    }
    else {
        $dbuser = $_ENV['JUPITER_DB_USER'];
    }

    $dbpass = '';
    if (isset($_SERVER['JUPITER_DB_PASSWORD'])) {
        $dbpass = $_SERVER['JUPITER_DB_PASSWORD'];
    }
    else {
        $dbpass = $_ENV['JUPITER_DB_PASSWORD'];
    }
?>