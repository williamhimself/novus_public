<?php
session_start();
session_unset();
include '../Modelo/ModCadMaquina.php';
// include '../util/Validacao.class.php';
include '../Persistencia/PerCadMaquina.php';

if(isset($_GET['op'])){
	switch($_GET['op']){
		case 'cadastrar':
			if(isset($_POST['descricao'])&&
   			   isset($_POST['caracteristica'])&&
			   isset($_POST['patrimonio'])&&
               isset($_POST['data_proxima_manutencao'])&&
               isset($_POST['data_aviso_antes'])&&
               isset($_POST['email_aviso_manutencao'])){
	
				$erros=array();

				if(count($erros)==0){
					$cont = 0;
					$m = new ModCadMaquina();
					$m->descricao = $_POST['descricao'];
					$m->caracteristica = $_POST['caracteristica'];
					$m->patrimonio = $_POST['patrimonio'];
					$m->data_proxima_manutencao = $_POST['data_proxima_manutencao'];
					$m->data_aviso_antes = $_POST['data_aviso_antes'];
					$m->email_aviso_manutencao = $_POST['email_aviso_manutencao'];

					for($i= 0; $i < count($_FILES['inputArquivo']['name']); $i++){
						$m->nomeTemporario = $_FILES['inputArquivo']['tmp_name'][$i];
						$m->descricaoArquivo = $_POST['descricaoArquivo'][$i];
						$m->arquivo = '../Arquivos/'.$_FILES['inputArquivo']['name'][$i];
						move_uploaded_file($m->nomeTemporario, $m->arquivo);
						$Perm=new PerCadMaquina();
						$Perm->cadastrarMaquina($m,$cont);
						$_SESSION['m']=serialize($m);
						$cont++;
					}
					header('location:../Interface/IntConsMaquina.php');
				}else{
					$_SESSION['erros']=$erros;
					header('location:../Interface/IntConsMaquina.php');
				}
			}else{
				header('location:../Interface/IntConsMaquina.php');
			}
		break;
		case 'consultar':
			$m = new PerCadMaquina();
			$listaMaquinas = array();
			$listaMaquinas = $m->buscarMaquinas();
			
			$_SESSION['listaMaquinas'] = serialize($listaMaquinas);
			header('location:../Interface/IntConsMaquina.php');
		break;
		case 'buscaAlterar':
			
			$m = new PerCadMaquina();
			$m2 = new PerCadMaquina();
			$listaMaquina = $m->buscarMaquinaAlteracao($_GET['id']);
			$listaArquivo = $m2->buscarArquivoAlteracao($_GET['id']);

			$_SESSION['listaMaquina'][0] = serialize($listaMaquina);
			$_SESSION['listaMaquina'][1] = serialize($listaArquivo);
			
			header('location:../Interface/IntAlterarMaquina.php');
			
		break;
		case 'alterar':
			$m = new PerCadMaquina();
			
			$erros=array();
			if(count($erros)==0){
				$cont = 0;
				$m = new ModCadMaquina();
				$m->id_maquina = $_GET['id'];
				$m->descricao = $_POST['descricao'];
				$m->caracteristica = $_POST['caracteristica'];
				$m->patrimonio = $_POST['patrimonio'];
				$m->data_proxima_manutencao = $_POST['data_proxima_manutencao'];
				$m->data_aviso_antes = $_POST['data_aviso_antes'];
				$m->email_aviso_manutencao = $_POST['email_aviso_manutencao'];
				
				if($_FILES['inputArquivo']['name'][0] != null){
					for($i= 0; $i < count($_FILES['inputArquivo']['name']); $i++){
						// $cont = 'y';
						$cont = 'z';
						$m->nomeTemporario = $_FILES['inputArquivo']['tmp_name'][$i];
						$m->descricaoArquivo = $_POST['descricaoArquivo'][$i];
						$m->arquivo = '../Arquivos/'.$_FILES['inputArquivo']['name'][$i];
						move_uploaded_file($m->nomeTemporario, $m->arquivo);
						$Perm = new PerCadMaquina();
						$arq = new PerCadMaquina();
						$Perm->alterarMaquina($m,$cont);
						$arq->cadastrarArquivo($m);
						$_SESSION['m']=serialize($m);
						$cont++;
					}
				}else{
					$cont = 'x';
					foreach($_POST['descricaoArquivo'] as $key => $value){
						$m->id_arquivo = $key;
						$m->descricaoArquivo = $value;
						$Perm = new PerCadMaquina();
						$Perm->alterarMaquina($m,$cont);
						$_SESSION['m']=serialize($m);
					}
				}
				if(isset($_POST['excluirArquivo'])){	
					foreach($_POST['excluirArquivo'] as $chave => $valor){
						$m = new PerCadMaquina();
						$m->deletarArquivo($chave);
						unlink($valor);
					}
				}
				header('location:../Interface/IntConsMaquina.php');
			}else{
				$_SESSION['erros'] = $erros;
				header('location:../Interface/IntConsMaquina.php');
			}
		break;

		case 'deletar':
			$m = new PerCadMaquina();
			$m2 = new PerCadMaquina();
			$listaArquivo = $m->buscarCaminhoArquivo($_GET['id']);
			
			foreach($listaArquivo as $caminho){
				unlink($caminho->arquivo);
			}
			$m2->deletarMaquina($_GET['id']);
			// $_SESSION['erros'] = 'maquina deletada';
			header('location:../Interface/IntConsMaquina.php');
		break;
	}
}
?>