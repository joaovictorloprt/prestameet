<?php
require_once('config.php');
require_once(DBAPI);

date_default_timezone_set('America/Sao_Paulo');


function login( $email = null , $password = null ) {
    try {
        $database = open_database();
        
        $found = null;
        $sql = "SELECT * FROM contas WHERE login = '" . $email . "' AND senha = MD5('" . $password . "')";
        $result = $database->query($sql);
        $contas=$result->fetchAll();
        if($result->rowCount() > 0) {
            if($contas['admin'] == 1) {
                $_SESSION['message'] = "LOGIN FEITO COM SUCESSO!";
                $_SESSION['type'] = 'success';
                $_SESSION['email'] = $email;
                $_SESSION['password'] = MD5($password);
                $_SESSION['admin'] = 1;
                header("Location: pagina/index");
            }else{
                $_SESSION['message'] = "ESTA CONTA NÃO É ADMINISTRADORA...";
                $_SESSION['type'] = 'info';
            }
        }
        else{
            $_SESSION['message'] = "LOGIN OU SENHA INCORRETOS...";
            $_SESSION['type'] = 'danger';
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
    
    return $found;
}


function select( $table = null, $parameters = null ) {
    $database = open_database();
    
    $found = null;
    try {
        $sql = "SELECT * FROM ". $table . " " . $parameters;
        $result = $database->query($sql);
        if($database->query($sql)) {
            $found = $result->fetch();
        }
        //else{
        //    echo "ocorreu um erro...";
        //}
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
    
    return $found;
}
