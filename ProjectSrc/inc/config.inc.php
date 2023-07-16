<?php
//Define database constants
define("DB_HOST","localhost");
define("DB_NAME", "recipe");
define("DB_USER", "root");
define("DB_PASS","");
define("DB_PORT", 3306);

//Config error logging
define("LOGFILE","log/error_log.txt");
ini_set("log_errors", TRUE);
ini_set("error_log",LOGFILE);
?>