<?php
function open_database() {
    try {
        // Criação do objeto PDO
        $conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASSWORD);
        
        // Configura o modo de erro para exceções
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $conn;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return null;
    }
}

function close_database($conn) {
    try {
        // Encerra a conexão PDO
        $conn = null;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function clear_messages(){
    unset($_SESSION['message']);
    unset($_SESSION['type']);
}
?>