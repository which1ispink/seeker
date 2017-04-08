<?php
namespace Seeker\Standard;

use Seeker\Standard\ConfigurationReader;
use Seeker\Adapter\DatabaseAdapter;
use Seeker\Adapter\Query\DatabaseQuery;

/**
 * A wrapper that abstracts away some of the operations on the database adapter
 * and could potentially be used as a base class for database-centric models
 */
class DatabaseAdapterWrapper
{
    /**
     * @var DatabaseAdapter
     */
    private static $adapter;

    /**
     * Constructor
     *
     */
    final public function __construct()
    {
        if (is_null(self::$adapter)) {
            $dbConfig = ConfigurationReader::get('Database');
            self::$adapter = new DatabaseAdapter($dbConfig);
        }
    }

    /**
     * Sends a database query to the database adapter and returns its result
     *
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function query($sql, $params)
    {
        $query = new DatabaseQuery($sql, $params);
        $result = self::$adapter->query($query);
        $rows = [];
        foreach ($result as $row) {
            $rows[] = $row;
        }
        return $rows;
    }
}
