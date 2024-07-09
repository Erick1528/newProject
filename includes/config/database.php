<?php

function connectDB(): mysqli
{
    /**
     * Connects to the database using the provided environment variables.
     *
     * @param string $_ENV['DB_HOST'] The database host.
     * @param string $_ENV['DB_USER'] The database username.
     * @param string $_ENV['DB_PASS'] The database password.
     * @param string $_ENV['DB_NAME'] The database name.
     * @return mysqli|false The database connection object or false on failure.
     */
    $db = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
    $db->set_charset('utf8');

    if ($db->connect_error) {
        echo "Error could not connect: " . $db->connect_error;
        exit;
    }
    return $db;
}
