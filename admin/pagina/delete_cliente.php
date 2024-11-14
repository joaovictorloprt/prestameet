<?php
require_once('functions.php');
if (isset($_GET['id'])){
    delete_cliente($_GET['id']);
} else {
    die("ERRO: ID não definido.");
}
?>