<?php
namespace Seeker\Adapter;

use Zend\Db\Adapter\Adapter;
use Seeker\Standard\ConfigurationReader;
use Seeker\Adapter\Query\DatabaseQuery;

/**
 * Simple database adapter that uses Zend's database adapter under the hood
 */
class DatabaseAdapter implements DatabaseAdapterInterface
{
    /**
     * @var array
     */
    private $dbConfig;

    /**
     * @var array
     */
    private static $connectionResource = [];

    /**
     * Constructor.
     *
     * @param array $dbConfig
     */
    public function __construct($dbConfig)
    {
        $this->dbConfig = $dbConfig;
    }

    /**
     * Returns the adapter instance of the current database connection
     *
     * @param array $dbConfig
     * @return Adapter
     */
    public static function getConnectionInstance($dbConfig)
    {
        $databaseName = $dbConfig['databaseName'];
        if (! array_key_exists($databaseName, self::$connectionResource)) {
            $host = $dbConfig['server'];
            $username = $dbConfig['username'];
            $password = $dbConfig['password'];
            $database = $dbConfig['databaseName'];
            $driver = $dbConfig['driver'];

            self::$connectionResource[$databaseName] = new Adapter([
                'hostname' => $host,
                'database' => $database,
                'username' => $username,
                'password' => $password,
                'driver' => $driver,
                'buffer_results' => false
            ]);
            return self::$connectionResource[$databaseName];
        }
        return self::$connectionResource[$databaseName];
    }

    /**
     * Executes a database query and returns the result set
     *
     * @param DatabaseQuery $databaseQuery
     * @return Result
     */
    public function query(DatabaseQuery $databaseQuery)
    {
        $connectionResource = self::getConnectionInstance($this->dbConfig);
        $statement = $connectionResource->createStatement($databaseQuery->getSql(), $databaseQuery->getparams());
        $result = $statement->execute();
        return $result;
    }

    /**
     * Returns the raw SQL query given a prepared SQL statement and its parameters
     *
     * @param string $sql
     * @param array $params
     * @return string
     */
    private function getSql($sql, array $params)
    {
        $matches = [];
        preg_match_all("/(?P<place_holder>\?)/i", $sql, $matches, PREG_OFFSET_CAPTURE, true);
        $placeHolder = $matches["place_holder"];
        $index = 0;
        foreach ($placeHolder as $row) {
            $sql = preg_replace("/\?/", "'" . $params[$index] . "'", $sql, 1);
            $index++;
        }
        return $sql;
    }
}
