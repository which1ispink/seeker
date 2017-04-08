<?php
namespace App\TemplateEngine\Factory;

/**
 * Interface for template engine adapter factories
 */
interface TemplateEngineFactoryInterface
{
    /**
     * Creates an instance of a template engine object
     *
     * @return mixed
     */
    public static function create();
}
