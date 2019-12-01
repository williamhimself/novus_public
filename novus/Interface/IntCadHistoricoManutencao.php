<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Painel </title>
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
                <h3 id="main-page-form-title">Historico Manutenção</h3>
                <?php
                    if(isset($_SESSION['listaMaquinas'])){        
                        include '../Modelo/ModCadHistoricoManutencao.php';
                        $lista = array();
                        $lista = unserialize($_SESSION['listaMaquinas']);
                    
                ?>
                <div class="son-form card">
                    <form name="cadHistoricoManutencao" id="cadHistoricoManutencao" enctype="multipart/form-data" action = "<?php echo '../Controle/CadHistoricoManutencao.php?op=cadastrar';?>" method="post">    
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Maquina</label>
                                <select id="id_maquina" name="id_maquina" class="form-field son-form-field form-control" placeholder="Maquinas Disponiveis">
                                    <?php
                                        foreach($lista as $p){
                                        echo '<option value="'.$p->id_maquina.'">'.$p->descricaoMaquina.'</option>';
                                    }
                                    ?>
                                </select>
                                <hr>
                            </div>
                            
                            <div class="form-group">
                                <label for="">Tipo de Manutenção</label>
                                <select name="tipo" id="tipo" class="form-field son-form-field form-control">
                                    <option value="p">Manutenção Preventiva</option>
                                    <option value="c">Manutenção Corretiva</option>
                                </select>
                            </div>
                            <hr>
                            
                            <div class="form-group">
                                <label for="">Data de Realização da Manutenção</label>
                                <input type="date" name="data_realizacao_manutencao" id="data_realizacao_manutencao" cols="30" rows="18" class="form-field form-control son-form-field" required>
                            </div>
                            <div class="form-group">
                                <label for="">Titulo</label>
                                <input type="text" name="titulo" id="titulo" cols="30" rows="18" class="form-field form-control son-form-field" required placeholder="Digite no máximo 50 caracteres" maxlength = "50">
                            </div>
                            <div class="form-group">
                                <label for="">Descrição da Manutenção</label>
                                <textarea name="descricao" id="descricao" cols="30" rows="18" class="form-field form-control son-form-field" required></textarea>
                            </div>
                            <?php
						        }else{
                                    header('location:../Controle/CadHistoricoManutencao.php?op=consultar');
							    }					
                            ?>
                            <hr>
                        </div>
                        <div class="card-footer">
                            <div class="confirm-btns">
                                <button name="btncadastrar" id="btncadastrar" value="Cadastrar" class="btn btn-primary">Confirmar Manutenção</button>
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
    <script>
        $("#menu-toggle").click(function(event) {
            event.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>
</html>