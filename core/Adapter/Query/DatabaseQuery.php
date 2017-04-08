<?php
namespace Seeker\Adapter\Query;

class DatabaseQuery
{
    /**
     * @var string
     */
    private $sql;

    /**
     * @var array
     */
    private $params;

    /**
     * Constructor
     *
     * @param string $sql
     * @param array $params
     */
    public function __construct($sql, array $params)
    {
        $this->sql = $sql;
        $this->params = $params;
    }

    /**
     * Returns the SQL query
     *
     * @return string
     */
    public function getSql()
    {
        return $this->sql;
    }

    /**
     * Returns the SQL parameters
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}
