<?php
namespace App\TemplateEngine\Factory;

use Seeker\Standard\ConfigurationReader;
use Philo\Blade\Blade as BladeTemplateEngine;

/**
 * Factory for creating an instance of the Blade template engine object
 */
class Blade implements TemplateEngineFactoryInterface
{
    /**
     * Creates an instance of the Blade template engine object
     *
     * @return Blade
     */
    public static function create()
    {
        $viewsPath = ConfigurationReader::get('views_path');
        $cachePath = ConfigurationReader::get('cache_path');
        return new BladeTemplateEngine($viewsPath, $cachePath);
    }
}
