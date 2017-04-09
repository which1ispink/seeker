<?php
namespace Seeker;

use Seeker\Standard\ConfigurationReader;
use Seeker\Standard\Router;
use Seeker\HTTP\Route;
use Seeker\Standard\Dispatcher;
use Seeker\HTTP\Request;
use Seeker\HTTP\Response;
use Seeker\Standard\Context;
use Seeker\Standard\FrontController;
use Seeker\View\View;

/**
 * Class responsible for bootstrapping the application
 */
class Bootstrap
{
    /**
     * Start the application bootstrapping process
     *
     * @return void
     */
    public static function start()
    {
        // Instantiate the config class with the main config file
        $configArray = include(CONFIG_PATH . '/config.php');
        ConfigurationReader::setConfigArray($configArray);

        // Include all core global helper files with functions used globally
        $coreHelpersDir = __DIR__ . '/Helper/Global';
        $coreHelpers = array_diff(scandir($coreHelpersDir), ['..', '.']);
        foreach ($coreHelpers as $helperFile) {
            include($coreHelpersDir . '/' . $helperFile);
        }

        // Include the constants file
        include(CONFIG_PATH . '/constants.php');

        // Include the routes file
        $routes = include(CONFIG_PATH . '/routes.php');

        // Initialize the router with the application routes
        $router = new Router();
        foreach ($routes as $path => $routeDetails) {
            $router->addRoute(new Route($path, $routeDetails['controllerClass'], $routeDetails['controllerAction']));
        }

        // Initialize the dispatcher
        $dispatcher = new Dispatcher();

        // Initialize the request with the current request url
        $requestUrl = getBaseUrl() . $_SERVER['REQUEST_URI'];
        $request = new Request($requestUrl);

        // Initialize the response
        $response = new Response();

        // Initialize the view component (or a template engine adapter as one)
        $defaultTemplateEngine = ConfigurationReader::get('default_template_engine');
        if (! $defaultTemplateEngine) {
            $view = new View();
        } else {
            $adapterName = ucfirst(strtolower($defaultTemplateEngine));
            $adapter = ConfigurationReader::get('template_engine_adapters_namespace') . $adapterName;
            $factory = ConfigurationReader::get('template_engine_factories_namespace') . $adapterName;
            $templateEngineInstance = $factory::create();
            if (! class_exists($adapter)) {
                throw new \Exception(
                    "The default template engine adapter class '$adapter' could not be found."
                );
            }
            $view = new $adapter($templateEngineInstance);
        }

        // Initialize the context, which is a layer that encapsulates vital objects
        $context = new Context($request, $response, $view);

        // Initialize the front controller and run it
        $frontController = new FrontController($router, $dispatcher);
        $frontController->run($context);
    }
}
