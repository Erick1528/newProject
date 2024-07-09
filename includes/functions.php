<?php

define('IMAGES_PATH', $_SERVER['DOCUMENT_ROOT'] . '/images/');

/**
 * Outputs the variable's value for debugging purposes.
 *
 * @param mixed $v The variable to be debugged.
 * @return void
 */
function debug($v)
{
    echo "<pre>";
    var_dump($v);
    echo "</pre>";
    exit;
}

/**
 * Escapes and sanitizes HTML.
 *
 * This function takes a string of HTML and escapes special characters to prevent
 * cross-site scripting (XSS) attacks. It returns the sanitized HTML string.
 *
 * @param string $html The HTML string to be sanitized.
 * @return string The sanitized HTML string.
 */
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

/**
 * Validates the ID parameter from the URL.
 *
 * @param string $url The URL to redirect to if the ID is invalid.
 * @return int The validated ID.
 */
function validateId(string $url)
{
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: {$url}");
        exit; // Ensure that the script stops executing after redirection
    }

    return $id;
}

/**
 * Formats a given date according to the specified format and locale.
 *
 * @param string $date The date to be formatted.
 * @param string $format The format to be applied to the date. Default is "MMMM d, yyyy".
 * @param string $locale The locale to be used for formatting. Default is 'en_US'.
 * @return string The formatted date.
 */
function formatDate($date, $format = "MMMM d, yyyy", $locale = 'en_US')
{
    $dateTime = new DateTime($date);

    $fmt = new IntlDateFormatter($locale, IntlDateFormatter::LONG, IntlDateFormatter::NONE);
    $fmt->setPattern($format);

    return $fmt->format($dateTime->getTimestamp());
}