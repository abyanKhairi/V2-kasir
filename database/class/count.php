<?php

class count
{
    private $db;


    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public function count($table)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM $table");
        $stmt->execute();
        return  $stmt->fetch(PDO::FETCH_COLUMN);
    }
}
