<?php
require_once('functions.php');
if (isset($_GET['id'])){
    delete_prestador($_GET['id']);
} else {
    die("ERRO: ID não definido.");
}
?>