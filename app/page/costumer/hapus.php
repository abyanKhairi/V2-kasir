<?php

$id_pembeli = $_GET['id'];
$pdo = Koneksi::connect();
$costumer = new costumer($pdo);
$costumer->delete($id_pembeli);

if ($costumer->delete($id_pembeli) == true) {
?> <script>
        window.location.href = "index.php?page=costumer"
    </script> <?php

            }

            Koneksi::disconnect();
