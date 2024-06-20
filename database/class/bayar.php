<?php

class Bayar
{
    private $db;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public function struk()
    {
        try {
            $stmt = $this->db->prepare("SELECT bayar., detail_transaksi.* FROM bayar ");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
