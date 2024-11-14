<?php
require_once('functions.php');
if (isset($_GET['id'])){
    delete_postagem($_GET['id']);
} else {
    die("ERRO: ID não definido.");
}
?>