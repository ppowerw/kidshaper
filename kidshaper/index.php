<?php
//set_time_limit(60);
define ('DEBUG_STATE',1);
define('DS', DIRECTORY_SEPARATOR); //Set shortname for DIRECTORY_SEPARATOR
define('ROOT', dirname(__FILE__)); // Set root directory
define('BASE', filter_input(INPUT_SERVER, "DOCUMENT_ROOT", FILTER_SANITIZE_SPECIAL_CHARS)); // Link to siteroot with port

// Define autoloader
spl_autoload_register(function ($class_path) {
    require_once (str_replace('\\', '/', $class_path) . '.php');
});

// Including configuration
$CONFIG = \Core\Config::init(); // Define config (use: $CONFIG->VARNAME)

// Define application
$App = new Core\Builder\Application();
//var_dump(debug_backtrace());

