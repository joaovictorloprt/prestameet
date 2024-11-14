<?php

require_once('../../config.php');

function find( $table = null, $id = null ) {
    $database = open_database();
    $found = null;
    try {
        if ($id) {
            $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
            $result = $database->query($sql);
            if ($result->rowCount() > 0) {
                $found = $result->fetchAll();
            }
        } else {
            $sql = "SELECT * FROM " . $table;
            $result = $database->query($sql);
            if ($result->rowCount() > 0) {
                $found = $result->fetch_all(MYSQLI_ASSOC);
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
    
    return $found;
}


function view($id = null) {
    global $customer;
    $customer = find('contas', $id);
}

function view_cliente($id = null) {
    global $customer;
    $customer = find('clientes', $id);
}

function view_prestador($id = null) {
    global $customer;
    $customer = find('prestador', $id);
}

function view_chamado($id = null) {
    global $customer;
    $customer = find('chamados', $id);
}

function view_postagem($id = null) {
    global $customer;
    $customer = find('postagem', $id);
}

function view_casa($id = null) {
    global $customer;
    $customer = find('casa', $id);
}

function delete_casa($id = null) {
    global $customer;
    $customer = remove('casa', $id);
    header('location: casas.php');
}

function delete_postagem($id = null) {
    global $customer;
    $customer = remove('postagem', $id);
    header('location: postagens.php');
}

function delete_chamado($id = null) {
    global $customer;
    $customer = remove('chamados', $id);
    header('location: contratos.php');
}

function delete_conta($id = null) {
    global $customer;
    $customer = remove('contas', $id);
    header('location: contas.php');
}

function delete_cliente($id = null) {
    global $customer;
    $customer = remove('clientes', $id);
    header('location: clientes.php');
}

function delete_prestador($id = null) {
    global $customer;
    $customer = remove('prestador', $id);
    header('location: prestadores.php');
}


function remove( $table = null, $id = null ) {
    $database = open_database();
    try {
        if ($id) {
            $sql = "DELETE FROM " . $table . " WHERE id = " . $id;
            $result = $database->query($sql);
            if ($result = $database->query($sql)) {
                $_SESSION['message'] = "Registro Removido com Sucesso.";
                $_SESSION['type'] = 'success';
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
    
}


function atualizar( $table = null, $parameters = null ) {
    $database = open_database();
    try {
        if ($parameters) {
            $sql = "UPDATE " . $table . " SET ". $parameters;
            $result = $database->query($sql);
            if ($result = $database->query($sql)) {
                $_SESSION['message'] = "Atualizado com Sucesso.";
                $_SESSION['type'] = 'success';
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
    
}
