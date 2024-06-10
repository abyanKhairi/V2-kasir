<?php

$id_user = $_GET['id'];

$crudUser->delete($id_user);

if($crudUser->delete($id_user) == true){
    ?> window.location.href="index.php?page=user" <?php
}
