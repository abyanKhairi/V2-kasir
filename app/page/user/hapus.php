<?php

$id_user = $_GET['id'];

$crudUser->delete($id_user);

if($crudUser->delete($id_user) == true){
     ?><script> window.location.href="index.php?page=user" </script> <?php
 } 
