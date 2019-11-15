<?php
    ini_set("memory_limit","70000M");
    ini_set('max_execution_time', 900);
    ob_start();
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

    ############################################
    #   Database Server
    ############################################

    if($_SERVER['HTTP_HOST']=="localhost")
    {
        define("DB_NAME","pos");
        define("SERVER_NAME","localhost");
        define("USER_NAME","root");
        define("PASSWORD","");
    }
    else
    {
        define("DB_NAME","db604856788");
        define("SERVER_NAME","db604856788.db.1and1.com");
        define("USER_NAME","dbo604856788");
        define("PASSWORD","POSDBSup@2016");
    }
?>