<?php

namespace Common;


class DB {

    protected $connection;

    public function __construct()
    {
        $this->connection = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->connection->set_charset('utf8');
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    }

    public function query($sql)
    {
        $result = $this->connection->query($sql);

        $data = array();

        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    public function prepare($sql) {

        $stmt = $this->connection->prepare($sql);

        return $stmt;

    }

    public function execute($sql)
    {
        $result = $this->connection->query($sql);
        return $result;
    }

    public function escape($value)
    {
        return mysqli_escape_string($this->connection, $value);
    }

} 