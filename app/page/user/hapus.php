<?php

$id_user = $_GET['id'];

$pdo = Koneksi::connect();
$crudUser = user::getInstance($pdo);

if ($crudUser->delete($id_user) == true) {
?><script>
        window.location.href = "index.php?page=user"
    </script>
<?php
}
$pdo =  Koneksi::disconnect();
