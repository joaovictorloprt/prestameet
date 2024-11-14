<?php

require_once('config.php');

require_once(DBAPI);



date_default_timezone_set('America/Sao_Paulo');

function encontrarValor($texto, $palavra){
	if(preg_match("%\b{$palavra}\b%", $texto))
		return true;
	else
		return false;
}

function login( $email = null , $password = null ) {

    try {
		$email = str_replace("'","", $email);
        $database = open_database();

        $found = null;

        $sql = "SELECT * FROM contas WHERE login = '" . $email . "' AND senha = MD5('" . $password . "')";

        $result = $database->query($sql);

        $contas=$result->fetch();

        if($result->rowCount() > 0) {

            $_SESSION['message'] = "LOGIN FEITO COM SUCESSO!";

            $_SESSION['type'] = 'success';

            setcookie('email', $email, time() + 3e+7);

            setcookie('password', MD5($password), time() + 3e+7);

            setcookie('tipo_conta', $contas['tipo_conta'], time() + 3e+7);

            if($contas['tipo_conta']==1) {

                header("Location: index?page=principal");

            }else{

                header("Location: index?page=principalprestador");

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



function cadastroCliente( $nome = null, $sobrenome = null, $email = null, $senha = null ) {

    $database = open_database();

    $found = null;

    try {

        $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));

        $created = $today->format("Y-m-d H:i:s");

        $sqlSelect22 = "SELECT * FROM contas WHERE login = '".$email."'";

        $result22 = $database->query($sqlSelect22);

        if($result22->rowCount() == 0){

        $sql="INSERT INTO clientes VALUES (NULL,'".$nome."','".$sobrenome."','".$email."',NULL,NULL,NULL,'0','./img/perfil/padrao.jpg')";

        if($database->query($sql)) {

            $sqlSelect = "SELECT * FROM clientes WHERE nome = '".$nome."' AND sobrenome = '".$sobrenome."' AND email = '".$email."'";

            $result = $database->query($sqlSelect);

            $cliente = $result->fetch();

            $sql2="INSERT INTO contas VALUES (NULL,'".$nome." ".$sobrenome."','".$email."',MD5('".$senha."'),'".$cliente['id']."','1','0',NOW(),'1','./img/perfil/padrao.jpg','1','...','...',null)";

            if($database->query($sql2)) {

                $_SESSION['message'] = "CADASTRO FEITO COM SUCESSO!";

                $_SESSION['type'] = 'success';

                setcookie('email', $email, time() + 3e+7);

                setcookie('password', MD5($senha), time() + 3e+7);

                setcookie('tipo_conta', "1", time() + 3e+7);

                header("Location: index?page=principal");

            }

            else{

                $_SESSION['message'] = "OCORREU UM ERRO AO CADASTRAR...";

                $_SESSION['type'] = 'danger';

            }

        }

        else{

            $_SESSION['message'] = "OCORREU UM ERRO AO CADASTRAR...";

            $_SESSION['type'] = 'danger';

        }

        }else{

            $_SESSION['message'] = "O EMAIL jÁ ESTÁ SENDO UTILIZADO...";

            $_SESSION['type'] = 'danger';

        }

    } catch (Exception $e) {

        $_SESSION['message'] = $e->GetMessage();

        $_SESSION['type'] = 'danger';

    }

    

    return $found;

}



function cadastroPrestador( $nome = null, $sobrenome = null, $email = null, $senha = null ) {

    $database = open_database();

    $found = null;

    try {

        $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));

        $created = $today->format("Y-m-d H:i:s");

        $sqlSelect22 = "SELECT * FROM contas WHERE login = '".$email."'";

        $result22 = $database->query($sqlSelect22);

        if($result22->rowCount() == 0){

        $sql="INSERT INTO prestador VALUES (NULL,'".$nome."','".$sobrenome."','".$email."',NULL,NULL,NULL,'0','./img/perfil/padrao.jpg')";

        if($database->query($sql)) {

            $sqlSelect = "SELECT * FROM prestador WHERE nome = '".$nome."' AND sobrenome = '".$sobrenome."' AND email = '".$email."'";

            $result = $database->query($sqlSelect);

            $cliente = $result->fetch();

            $sql2="INSERT INTO contas VALUES (NULL,'".$nome." ".$sobrenome."','".$email."',MD5('".$senha."'),'".$cliente['id']."','2','0',NOW(),'1','./img/perfil/padrao.jpg','1','...','...',null)";

            if($database->query($sql2)) {

                $_SESSION['message'] = "CADASTRO FEITO COM SUCESSO!";

                $_SESSION['type'] = 'success';

                setcookie('email', $email, time() + 3e+7);

                setcookie('password', MD5($senha), time() + 3e+7);

                setcookie('tipo_conta', "2", time() + 3e+7);

                header("Location: index?page=principalprestador");

            }

            else{

                $_SESSION['message'] = "OCORREU UM ERRO AO CADASTRAR...";

                $_SESSION['type'] = 'danger';

            }

        }

        else{

            $_SESSION['message'] = "OCORREU UM ERRO AO CADASTRAR...";

            $_SESSION['type'] = 'danger';

        }

        }else{

            $_SESSION['message'] = "O EMAIL jÁ ESTÁ SENDO UTILIZADO...";

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

