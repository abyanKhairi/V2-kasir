<?php

class Page
{

    private $db;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public function paging($query, $records_per_page)
    {
        $starting_position = 0;

        if (isset($_GET["page_no"])) {
            $starting_position = ($_GET["page_no"] - 1) * $records_per_page;
        }

        $query2 = $query . "limit $starting_position,$records_per_page";
        return $query2;
    }

    public function pagingLink($query, $records_per_page)
    {
        $self = $_SERVER['PHP_SELF'];

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $total_no_of_records = $stmt->rowCount();

        if ($total_no_of_records > 0) {
?> <div class="card-footer text-center">
                <nav class="d-inline-block">
                    <ul class="pagination mb-0">
            <?php
            $total_no_of_records = ceil($total_no_of_records / $records_per_page);

            $current_page = 1;

            if (isset($_GET["page_no"])) {
                $previous = $current_page - 1;

                echo "<li><a href='" . $self . "?page_no=1'>First</a></li>";

                echo "<li><a href='" . $self . "?page_no=" . $previous . "'>Previous</a></li>";
            }
            for ($i = 1; $i <= $total_no_of_records; $i++) {
                if ($i == $current_page) {
                    echo "<li><a href='" . $self . "?page_no=" . $i . "' style='color:red;'>" . $i . "</a></li>";
                } else {
                    echo "<li><a href='" . $self . "?page_no=" . $i . "'>" . $i . "</a></li>";
                }
            }
            if ($current_page != $total_no_of_records) {
                $next = $current_page + 1;

                echo "<li><a href='" . $self . "?page_no=" . $next . "'>Next</a></li>";

                echo "<li><a href='" . $self . "?page_no=" . $total_no_of_records . "'>Last</a></li>";
            }
        }?> </ul>
        </nav>
    </div>
     <?php
    }
}
