<?php

/**
 * All routes should start and end with one forward slash character (you could
 * get away with forgetting them, but definitely not with, say, duplicating them).
 *
 * use {param} as a placeholder for url segment parameters.
 * You must include these placeholders where you want them, with the exact number
 * of them that you want, for the route to be parsed correctly.
 *
 * Routes shouldn't contain more than 2 non-params segments, much like
 * most MVC frameworks' '/controller/action/[parameters/...]' formula.
 *
 * Examples:
 * '/' => [
 *     'controllerClass' => 'IndexController',
 *     'controllerAction' => 'index',
 * ],
 * '/shows/' => [
 *     'controllerClass' => 'ShowsController',
 *     'controllerAction' => 'index',
 * ],
 * '/shows/{param}/' => [
 *     'controllerClass' => 'ShowsController',
 *     'controllerAction' => 'details',
 * ]
 */

return [
    '/' => [
        'controllerClass' => 'IndexController',
        'controllerAction' => 'index',
    ],
];
