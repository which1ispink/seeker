<?php
namespace Seeker\Adapter;

use Seeker\Adapter\Query\DatabaseQuery;

/**
 * Interface for database adapters
 */
interface DatabaseAdapterInterface
{
    /**
     * Returns the database connection instance
     *
     * @param array $dbConfig
     * @return mixed
     */
    public static function getConnectionInstance($dbConfig);

    /**
     * Executes a database query and returns the result set
     *
     * @param DatabaseQuery $query
     * @return mixed
     */
    public function query(DatabaseQuery $query);
}
