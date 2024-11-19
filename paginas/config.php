<?php

if(isset($_POST['foto_perfil'])){
	$foto = $_FILES["foto"];
	
	// Se a foto estiver sido selecionada
	if (!empty($foto["name"])) {
 
		$error = array();
 
    	// Verifica se o arquivo é uma imagem
    	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
     	   $error[1] = "Isso não é uma imagem.";
   	 	} 
	
		// Pega as dimensões da imagem
		$dimensoes = getimagesize($foto["tmp_name"]);
	
		if (count($error) == 0) {
		
			// Pega extensão da imagem
			preg_match("/\.(gif|bmp|png|jpg|jpeg|gif){1}$/i", $foto["name"], $ext);
 
        	// Gera um nome único para a imagem
        	$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
 
        	// Caminho de onde ficará a imagem
        	$caminho_imagem = "img/perfil/" . $nome_imagem;
 
			// Faz o upload da imagem para seu respectivo caminho
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
		
			// Insere os dados no banco
			$db->query("UPDATE contas SET foto = '".$caminho_imagem."' WHERE id =".$contas['id']);
			if($contas['tipo_conta'] == 1) {
				$db->query("UPDATE clientes SET foto = '".$caminho_imagem."' WHERE id = ".$contas['id_cliente']);
			} else {
				$db->query("UPDATE prestador SET foto = '".$caminho_imagem."' WHERE id = ".$contas['id_cliente']);
			}
			$_SESSION['message'] = "Alterado com sucesso...";
			$_SESSION['type'] = 'success';
		}
	
		// Se houver mensagens de erro, exibe-as
		if (count($error) != 0) {
			foreach ($error as $erro) {
				echo $erro . "<br />";
			}
		}
	}else{
		if($contas['tipo_conta'] == 1) {
			$db->query("UPDATE clientes SET foto = '".$_POST['foto_perfil']."' WHERE id = ".$contas['id_cliente']);
		} else {
			$db->query("UPDATE prestador SET foto = '".$_POST['foto_perfil']."' WHERE id = ".$contas['id_cliente']);
		}
		$_SESSION['message'] = "Alterado com sucesso...";
		$_SESSION['type'] = 'success';
	}
    
}


if(isset($_POST['email'])){
    $db->query("UPDATE contas SET login = '".$_POST['email']."' WHERE id =".$contas['id']);
    if($contas['tipo_conta'] == 1) {
        $db->query("UPDATE clientes SET email = '".$_POST['email']."' WHERE id = ".$contas['id_cliente']);
    } else {
        $db->query("UPDATE prestador SET email = '".$_POST['email']."' WHERE id = ".$contas['id_cliente']);
    }
    $_SESSION['message'] = "Alterado com sucesso...";
    $_SESSION['type'] = 'success';
}


if(isset($_POST['ant-senha']) && isset($_POST['senha']) && isset($_POST['re-senha'])){
    if($_COOKIE['password'] == MD5($_POST['ant-senha'])) {
        if($_POST['senha'] == $_POST['re-senha']){
            $db->query("UPDATE contas SET senha = MD5('".$_POST['senha']."') WHERE id = ".$contas['id_cliente']);
            $_SESSION['message'] = "Alterado com sucesso...";
            $_SESSION['type'] = 'success';
        }else{
            $_SESSION['message'] = "As senhas não são iguais...";
            $_SESSION['type'] = 'danger';
        }
    }else{
        $_SESSION['message'] = "Senha atual incorreta...";
        $_SESSION['type'] = 'danger';
    }

}

$contas = select("contas", "WHERE login = '" . $_COOKIE['email'] . "' AND senha = '" . $_COOKIE['password'] . "'");

if($contas['novato'] != 1){
    ?>
    <section class="content-header">
        <h1>
            Configurações Gerais

        </h1>
        <ol class="breadcrumb">
            <li><a href="?page=principal"><i class="fa fa-dashboard"></i> Início</a></li>
            <li class="active">Configurações</li>
        </ol>

    </section>
<?php } ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h1 class="box-title"> Configurações </h1>

                </div>

                <div class="box-body">
                    <?php if (!empty($_SESSION['message'])) : ?>
                        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                            <?php echo $_SESSION['message']; ?>
                        </div>
                        <?php clear_messages(); ?>
                    <?php endif; ?>
                    <div class="col-md-6" style="border: 1px solid #ddd; border-radius: 4px;">
                        <br>
						<div class="col-md-4">
                            <form method="post" enctype="multipart/form-data">
								<img class="img-responsive img-circle" src="<?php echo $contas['foto']; ?>" alt="Minha Foto">
                        <br>
								<div class="input-group" style="margin-left:-13%;">
									<span class="input-group-addon"><i class="fa fa-camera"></i></span>
										<span class="input-group-addon">Anexar Foto</span>
										<span id="foto" class="file-input btn btn-primary btn-file">
									<i class="fa fa-paperclip"></i>
									<input onchange="fotoInserida(this,'foto'); changeState()" id="imgfile" name="foto" type="file">
									</span>
								</div>
						</div>
                        <div class="col-md-8">
                            <form method="post">
                                <h3>Alterar Foto de Perfil</h3>
                                <div class="form-group">
                                    <label>URL da Imagem</label>
                                    <input type="text" required class="form-control" name="foto_perfil" placeholder="URL DA IMAGEM ..." value="<?php echo $contas['foto']; ?>">
                                </div>
                                <input type="submit" class="btn btn-success btn-block" value="SALVAR NOVA FOTO DE PERFIL">
                                <hr>
                            </form>
                        </div>
                        <form method="post">
                            <h3>Alterar E-Mail</h3>
                            <div class="form-group">
                                <label>E-Mail</label>
                                <input type="text" required class="form-control" name="email" placeholder="E-Mail ..." value="<?php echo $contas['login']; ?>">
                            </div>
                            <input type="submit" class="btn btn-success btn-block" value="SALVAR NOVO EMAIL">
                        </form><br>
                    </div>
                    <div class="col-md-6" style="border: 1px solid #ddd; border-radius: 4px;">

                        <form method="post">
                            <h3>Alterar Senha</h3>
                            <div class="form-group">
                                <label>Antiga Senha</label>
                                <input type="password" required class="form-control" name="ant-senha" placeholder="Antiga Senha ...">
                            </div>
                            <div class="form-group">
                                <label>Nova Senha</label>
                                <input type="password" required class="form-control" name="senha" placeholder="Nova Senha ...">
                            </div>
                            <div class="form-group">
                                <label>Repita a Nova Senha</label>
                                <input type="password" required class="form-control" name="re-senha" placeholder="Repita a Nova Senha ...">
                            </div>
                            <input type="submit" class="btn btn-success btn-block" value="SALVAR NOVA SENHA">
                        </form><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>