<?php

    $db_user = 'xxxx';
    $db_password = 'xxx';
    $host = 'xxxx';
    $db_name = 'xxxx';

    $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $db_user, $db_password);

    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    define('APP_NAME','PHP REST API TUTORIAL');
    
