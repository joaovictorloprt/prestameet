<?php
require_once 'config.php';
require_once 'functions.php';
require_once DBAPI;
$db = open_database();
if (!isset($_POST['pesquisa'])) {
    $pesquisa = "";
} else {
    $pesquisa = $_POST['pesquisa'];
    $sql_servicos = "SELECT * FROM servicos_prestados WHERE nome LIKE '%" . $pesquisa . "%'";
    $result_servicos = $db->query($sql_servicos);
    if ($result_servicos->rowCount() == 0) {
        echo "&nbsp;&nbsp;Não há chamados precisando deste serviço...";
    } else {
        foreach ($result_servicos->fetchAll() as $servicos) {
            $sql_chamados = "SELECT * FROM chamados WHERE id_servicos LIKE '%" . $servicos['id'] . "%' AND ativo = '1' ORDER BY id";
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
<?php }
        }
    }
} ?>