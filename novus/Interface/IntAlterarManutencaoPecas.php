<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Painel</title>
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- SIDEBAR-->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading"><img src="resources/novus-logo.png"><span>Painel NOVUS</span></div>
            <div class="list-group list-group-flush border-right">
                <a href="../index.php" class="list-group-item list-group-item-action"><i class="fas fa-home"></i>Inicio</a>
                <a href="../Interface/IntConsMaquina.php" class="list-group-item list-group-item-action"><i class="fas fa-box-open"></i>Consulta de Maquina</a>
                <a href="../Interface/IntConsHistoricoManutencao.php" class="list-group-item list-group-item-action"><i class="fas fa-wrench"></i>Consulta de Historico de Manutenção</a>
                <a href="../Interface/IntConsPeca.php" class="list-group-item list-group-item-action"><i class="fas fa-wrench"></i>Consulta de Peças</a>
                <a href="../Interface/IntConsManutencaoPecas.php" class="list-group-item list-group-item-action"><i class="fas fa-wrench"></i>Consulta de Manutenção de Peças</a>
                <a href="../Interface/IntConsMaquinasPecas.php" class="list-group-item list-group-item-action"><i class="fas fa-wrench"></i>Consulta de Maquinas de Peças</a>
                <a href="../Interface/IntConsMaquinaContato.php" class="list-group-item list-group-item-action"><i class="fas fa-wrench"></i>Consulta de Contatos</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="far fa-chart-bar"></i>Relatórios</a>
            </div>   
        </div>
        
        <!-- CONTENT -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light" id="son-navbar">
                <span id="menu-toggle" class="mr-auto"><img src="../resources/novus.png" class="mx-auto d-block"></span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#son-navbar-collapse"
                    aria-controls="son-navbar-collapse" aria-expanded="false" aria-label="Exibe toda navbar">
                    <span class="navbar-toggler-icon"></span>
                </button>   
                <div class="collapse navbar-collapse" id="son-navbar-collapse">
                        <div id="navbar-profile" class="ml-auto">
                                <img src="../resources/download.png" alt="" srcset="">
                                <span>ADMIN</span>
                        </div>
                </div>
            </nav>
            <div id="content" class="container">
                <h3 id="main-page-form-title">Alteração de Historico</h3>
                <div class="son-form card">
                   			<?php
                       			if(isset($_SESSION['erros'])){
									foreach($_SESSION['erros'] as $erros){
										echo '<p>'.$erros.'</p>';
									}
									unset($_SESSION['erros']);
                                }
                                include '../Modelo/ModCadManutencaoPecas.php';
							    
                                $listaManutencao = unserialize($_SESSION['listaManutencao']);
                       		?>
					<form name="cadManutencaoPecas" id="cadManutencaoPecas" enctype="multipart/form-data" action="../controle/cadManutencaoPecas.php?op=alterar&id=<?php echo $listaManutencao[0]->id_manutencao_pecas;?>" method="post">
                    <div class="card-body">
                            <div class="form-group">
                                <label for="">Manuteção</label>
                                <select id="id_historico_manutencao" name="id_historico_manutencao" class="form-field son-form-field form-control" placeholder="Maquinas Disponiveis">
                                    <?php
                                        foreach($listaManutencao as $p){
                                        echo '<option value="'.$p->id_historico_manutencao.'">'.$p->titulo_historico_manutencao.'</option>';
                                    }
                                    ?>
                                </select>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label for="">Peça</label>
                                <select id="id_peca" name="id_peca" class="form-field son-form-field form-control" placeholder="Peças Disponiveis">
                                    <?php
                                        foreach($listaManutencao as $p){
                                        echo '<option value="'.$p->id_peca.'">'.$p->descricaoPeca.'</option>';
                                    }
                                    ?>
                                </select>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label for="">Quantidade Utilizada</label>
                                <input type="number" name="qtd_utilizada" id="qtd_utilizada" cols="30" rows="18" class="form-field form-control son-form-field" value="<?php echo $listaManutencao[0]->qtd_utilizada;?>" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="confirm-btns">
                                <button name="btncadastrar" id="btncadastrar" value="Cadastrar" class="btn btn-primary">Editar</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- SCRIPTS-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- JS do Bootstrap -->
    <script src="../resources/js/bootstrap.min.js"></script>
</body>
</html>