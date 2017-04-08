<?php

/**
 * Required application config options.
 */

$config = [];

/**
 * This should REALLY be set correctly in production.
 * If not set we try to guess it from the $_SERVER variables which is not very
 * secure since it can be set by the client.
 */
$config['base_url'] = 'http://localhost:8080/';

/**
 * Namespace where application action controllers live, used to locate them.
 * Only change this if you move them to another namespace.
 */
$config['action_controllers_namespace'] = '\\App\\Controller\\';

/**
 * Path to the directory containing views, used to locate them.
 * Only change this if you physically move them to a different path.
 */
$config['views_path'] = APPLICATION_PATH . '/View';

/**
 * Name of the default template engine that should be used for views.
 * Should match the name of the adapter class created for the template engine,
 * case-insensitive.
 * Set to a falsy value if you want to use plain PHP templates instead.
 */
$config['default_template_engine'] = 'blade';

/**
 * Namespace where template engine adapters live, used to locate them.
 * Only change this if you move them to another namespace.
 */
$config['template_engine_adapters_namespace'] = '\\App\\TemplateEngine\\Adapter\\';

/**
 * Namespace where template engine factories live, used to locate them.
 * Only change this if you move them to another namespace.
 */
$config['template_engine_factories_namespace'] = '\\App\\TemplateEngine\\Factory\\';

/**
 * Path to the cache directory, used in... things that need to store cache.
 * Only change this if you physically move it to a different path.
 */
$config['cache_path'] = DATA_PATH . '/cache';

/**
 * Used in a regex that checks the url path (part after base_url) for illegal characters.
 * Application throws an exception if any other characters are found in a url path.
 * Only change this if you understand the consequences!
 */
$config['permitted_path_chars'] = 'a-zA-Z0-9_\-\/';


$globalConfig = include('global.php');
$config = array_merge($config, $globalConfig);
return $config;
