<?php

// This file is the main application file.
// It sets up the necessary dependencies and configurations for the application to run.

use Model\ActiveRecord;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

/**
 * This file is responsible for including necessary files and initializing the application.
 */

require 'functions.php'; // Include the functions.php file which contains various helper functions.
require 'config/database.php'; // Include the database.php file which sets up the database connection.

// DB connection
$db = connectDB();

ActiveRecord::setDB($db);
