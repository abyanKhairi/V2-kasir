<?php

$id_user = $_GET['id'];

$pdo = Koneksi::connect();
$crudUser = new user($pdo);
$crudUser->delete($id_user);

if ($crudUser->delete($id_user) == true) {
?><script>
        window.location.href = "index.php?page=user"
    </script>
<?php
}
Koneksi::disconnect();
