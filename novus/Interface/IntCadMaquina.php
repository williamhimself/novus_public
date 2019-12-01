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
                <h3 id="main-page-form-title">Cadastro de Maquina</h3>
                <div class="son-form card">
                   			<?php
                       			if(isset($_SESSION['erros'])){
									foreach($_SESSION['erros'] as $erros){
										echo '<p>'.$erros.'</p>';
									}
									unset($_SESSION['erros']);
								}
                       		?>
					<form name="cadMaquina" id="cadMaquina" enctype="multipart/form-data" action="../controle/CadMaquina.php?op=cadastrar" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Descrição</label>
                                <input type="text" name="descricao" id="descricao"  class="form-field son-form-field form-control" required>    
                                <hr>
                            </div>
                            
                            <div class="form-group">
                                <label for="">caracteristica</label>
                                <input type="text" name="caracteristica" id="caracteristica"  class="form-field son-form-field form-control" required>    
                                <hr>
                            </div>

                            <div class="form-group">
                                <label for="">patrimonio</label>
                                <input type="text" name="patrimonio" id="patrimonio"  class="form-field son-form-field form-control" required>    
                                <hr>
                            </div>

                            <div class="form-group">
                                <label for="">Data Próxima Manutenção</label>
                                <input type="date" name="data_proxima_manutencao" id="data_proxima_manutencao"  class="form-field son-form-field form-control" required>    
                                <hr>
                            </div>
                            <div class="form-group">
                                <label for="">Data Aviso Antes</label>
                                <input type="date" name="data_aviso_antes" id="data_aviso_antes"  class="form-field son-form-field form-control" required>    
                                <hr>
                            </div>

                            <div class="form-group">
                                <label for="">Email para Manutencao</label>
                                <input type="email" name="email_aviso_manutencao" id="email_aviso_manutencao"  class="form-field son-form-field form-control" required>    
                                <hr>
                            </div>
                            <div class="form-group" id="divArquivo">
                                <input class="btn btn-default btn-group-justified" name="btnAddArquivo" id="btnAddArquivo" type="button" onclick="adicionaArquivo();" value="Adicionar Arquivo">    
                                <hr>
                            </div>
                            <div class="card-footer">
                                <div class="confirm-btns">
                                    <button name="btncadastrar" id="btncadastrar" value="Cadastrar" class="btn btn-primary">Cadastrar Maquina</button>
                                </div>
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

		function adicionaArquivo(){
			$('#divArquivo').append('<br>'

			+'<div class="form-group">'
                                +'<label for="">Descricao Arquivo</label>'
                                +'<input type="text" name="descricaoArquivo[]" class="form-field son-form-field form-control" required>'
                                +'<hr>'
                            +'</div>'
				+'<span class="input-goup-addon" id="basic-addonl">selecione o Arquivo: </span>'
				+'<input id="inputArquivo" name="inputArquivo[]" type="file" class="arquivo" multiple data-show-upload="false" data-show-caption="true">'
				+'<br>'
				);

			$(".arquivo").fileinput({showCaption:false});
			$("#arrArquivo").on("change",function(){
				$("$imageUploadForm").submit();
			});
		}
    </script>
</body>
</html>