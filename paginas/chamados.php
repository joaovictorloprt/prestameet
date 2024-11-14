<?php

$contas = select("contas", "WHERE login = '" . $_COOKIE['email'] . "' AND senha = '" . $_COOKIE['password'] . "'");



if ($contas['novato'] != 1) {

?>

    <section class="content-header">

        <h1>

            Chamados

            <small>Todos os Chamados</small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>

            <li class="active">Chamados</li>

        </ol>



    </section>

<?php } ?>

<style>
    #map {

        height: 200px;

        width: 100%;

    }
</style>



<section class="content row">

    <div class="col-md-12">

        <div class="sidebar-form">

            <div class="input-group">

                <input type="text" name="campo_pesquisa" id="campo_pesquisa" class="form-control" placeholder="Pesquisar Serviço...">

                <span class="input-group-btn">

                    <button type="button" name="busca" id="busca" class="btn btn-flat"><i class="fa fa-search"></i></button>

                </span>

            </div>

        </div>



        <div id="resultado">
            <?php
            $sql_chamados = "SELECT * FROM chamados WHERE ativo = '1' ORDER BY id";
            $result_chamados = $db->query($sql_chamados);
            foreach ($result_chamados->fetchAll() as $chamados) {
                $casa = select("casa", " WHERE id_cliente = " . $chamados['id_cliente'] . " AND id = " . $chamados['id_casa']);
            ?>

                <div class="row bg-purple">
                    <div class="col-md-12 small-box">
                        <!-- small box -->
                        <div class="inner">
                            <p>
                            <h4>
                                <b>Serviço: </b>
                                <?php
                                $result = $db->query("SELECT * FROM servicos_prestados");
                                foreach ($result->fetchAll() as $servico) {
                                    if (encontrarValor($chamados['id_servicos'], $servico['id'])) {
                                ?>
                                        <?php echo ($servico['nome']); ?><br />
                                <?php }
                                } ?>
                                <b>Data & Hora: </b> <?php echo $chamados['data_aberto']; ?><br />
                            </h4>
                            <h5><?php echo ($casa['estado'] . " - " . $casa['cidade'] . ", " . $casa['bairro']); ?><br />
                                <?php echo ($casa['rua'] . ", n " . $casa['numero']); ?><br /></h5>
                            </p>

                        </div>
                        <div class="icon">
                            <i class="fa fa-bullhorn"></i>
                        </div>
                        <a href="?page=perfil_chamado&id=<?php echo $chamados['id']; ?>" style="text-align:center" class="small-box-footer">
                            <h4><i class="fa fa-map-marker"></i> VER CHAMADO</h4>
                        </a>
                    </div>
                </div><br>
            <?php } ?>

        </div>

    </div>

</section>