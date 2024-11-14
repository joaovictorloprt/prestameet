<?php
require_once('functions.php');
if (isset($_GET['id'])){
    delete_conta($_GET['id']);
} else {
    die("ERRO: ID não definido.");
}
?>