<?php

class count
{
    private $db;


    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public function query($sql, $data, $fetch = false)
    {
        $q = $this->db->prepare($sql);
        $q->execute($data);
        return $fetch ? $q->fetch(2) : $q;
    }


    public function count($table,)
    {
        $sql = "SELECT COUNT(*) as count FROM $table";
        $result = $this->query($sql, [], true);
        return $result["count"];
    }

    public function jumlahCostumer()
    {
        return $this->count("pembeli");
    }

    public function jumlahAdmin()
    {
        return $this->count("user");
    }

    public function jumlahProduk()
    {
        return $this->count("product");
    }

    public function jumlahtransaksi()
    {
        return $this->count("transaksi");
    }
}
