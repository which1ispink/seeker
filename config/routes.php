<?php

/**
 * All routes should start and end with one forward slash character (you could
 * get away with forgetting them, but definitely not with, say, duplicating them).
 *
 * use {param} to signify a url segment parameter is supposed to go there. You
 * must include these placeholders where you want them, with the exact number
 * of them that you want, for the route to be parsed correctly.
 *
 * Routes shouldn't contain more than 2 non-params segments, much like
 * most MVC frameworks' '/controller/action/[parameters/...]' formula.
 */

return [
    '/' => 'IndexController',
    '/shows/' => 'ShowsController',
    '/show/{param}/' => 'ShowController',
];
