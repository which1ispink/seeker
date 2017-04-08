<?php
namespace Seeker\Standard;

/**
 * Configuration reader class, giving quick access to application config options
 */
class ConfigurationReader
{
    /**
     * @var array
     */
    private static $configArray = [];

    /**
     * Sets the config array
     *
     * @param array $configArray
     */
    public static function setConfigArray(array $configArray)
    {
        if (! is_array($configArray)) {
            throw new \InvalidArgumentException(
                "Config must be an array."
            );
        } else {
            if (empty($configArray)) {
                throw new \InvalidArgumentException(
                    "Config array can't be empty."
                );
            }

            self::$configArray = $configArray;
        }
    }

    /**
     * Returns a config option given its key
     *
     * @param mixed $configKey
     * @return mixed
     */
    public static function get($configKey)
    {
        if (! array_key_exists($configKey, self::$configArray)) {
            throw new \InvalidArgumentException(
                "The config key '$configKey' is not set."
            );
        }
        return self::$configArray[$configKey];
    }
}
