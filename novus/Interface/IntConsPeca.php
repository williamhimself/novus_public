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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
            <div id="content">
                <div class="contentbg">
				    <div class="post">
                    <h2 class="class" align="center">Peças</h2>
					    <div class="entry">
					        <?php
                            // echo '<pre>';
                            // var_dump($_SESSION);
                            // echo '</pre>';
                                if(isset($_SESSION['listaPecas'])){
							        include '../Modelo/ModCadPeca.php';
							        $lista = array();
                                    $lista = unserialize($_SESSION['listaPecas']);
                            ?>
                            <h3>Cadastrar Nova Peça</h3>
                            <a href="../Interface/IntCadPeca.php">
                                <button class="btn btn-primary">Cadastrar</button>
                            </a>
                            <div class="container">
                                <table  id="tableCons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th >id peca</th>
                                            <th >descrição</th>
                                            <th >quantidade utilizada</th>
                                            <th >Editar</th>
                                            <th >Excluir</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                        <?php
                                            foreach($lista as $p){
                                                echo '<tr align="center">';
                                                echo '<td>'.$p->id_peca.'</td>';
                                                echo '<td>'.$p->descricao.'</td>';
                                                echo '<td>'.$p->qtd_estoque.'</td>';
                                                echo '<td>
                                                        <a href="../Controle/Cadpeca.php?op=buscaAlterar&id='.$p->id_peca.'">
                                                        <i class="far fa-edit"></i>
                                                        </a>
                                                    </td>';
                                                echo '<td>
                                                        <a href="../Controle/Cadpeca.php?op=deletar&id='.$p->id_peca.'">
                                                        <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </td>';
                                                echo '</tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
							    }else{
								    header('location:../Controle/Cadpeca.php?op=buscarPecas');	
							    }					
					        ?>
                        </div>
	                </div>
                </div>
                
            </div>

            
       
        </div>
    </div>
            <?php
                include('../includes/scripts.php');
            ?>
            <script>
                $(document).ready(function () {
                    $('#tableCons').DataTable();
                    $('.dataTables_length').addClass('bs-select');
                    });
            </script>
</body>
</html>