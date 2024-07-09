<?php

class Page
{

    private static $instance = null;

    private $db, $table, $total_records, $id, $limit = 5;

    public function __construct($db_conn, $table)
    {
        $this->db = $db_conn;
        $this->table = $table;
        $this->set_total_records($this->id);
    }

    public static function getInstance($pdo, $table)
    {
        if (self::$instance == null) {
            self::$instance = new Page($pdo, $table);
        }

        return self::$instance;
    }

    public function set_total_records($id)
    {
        $stmt = $this->db->prepare("SELECT :id FROM $this->table");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $this->total_records = $stmt->rowCount();
    }

    public function current_page()
    {
        return isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
    }

    public function get_data($keyword, $record)
    {
        $start = 0;
        if ($this->current_page() > 1) {
            $start = ($this->current_page() * $this->limit) - $this->limit;
        }
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE $record like '%$keyword%' LIMIT $start, $this->limit");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function get_pagination_number()
    {
        return ceil($this->total_records / $this->limit);
    }

    public function prev_page()
    {
        return ($this->current_page() > 1) ? $this->current_page() - 1 : 1;
    }

    public function next_page()
    {
        return ($this->current_page() < $this->get_pagination_number()) ? $this->current_page() + 1 : $this->get_pagination_number();
    }
}
