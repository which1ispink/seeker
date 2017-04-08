<?php

use Seeker\Standard\ConfigurationReader;

/**
 * Returns a guessed base url based on $_SERVER variables. Not reliable or secure.
 * Only used if base_url config variable is not set and in a development environment.
 *
 * @return string
 */
function getGuessedBaseUrl()
{
    if (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
        $url_scheme = 'https';
    } elseif (! empty($_SERVER['REQUEST_SCHEME'])) {
        $url_scheme = $_SERVER['REQUEST_SCHEME'];
    } else {
        $url_scheme = 'http';
    }
    $baseUrl = $url_scheme . '://' . rtrim($_SERVER['HTTP_HOST'], '/');
    return $baseUrl;
}

/**
 * Returns the user-defined base_url config variable. Recommended method of getting the base url.
 * Used in production by default unless base_url is empty.
 *
 * @return string
 */
function getDefinedBaseUrl()
{
    $baseUrl = rtrim(ConfigurationReader::get('base_url'), '/');
    return $baseUrl;
}

/**
 * Returns the base url that will be used application-wide.
 * If in a development environment it will always use guessed base url for convenience.
 *
 * @return string
 */
function getBaseUrl()
{
    $baseUrl = getDefinedBaseUrl();
    if (empty($baseUrl) or (defined('ENVIRONMENT') && ENVIRONMENT == 'development')) {
        $baseUrl = getGuessedBaseUrl();
    }
    return $baseUrl;
}
