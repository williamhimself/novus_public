<?php
session_start();
session_unset();
include '../Modelo/ModCadHistoricoManutencao.php';
// include '../util/Validacao.class.php';
include '../Persistencia/PerCadHistoricoManutencao.php';

if(isset($_GET['op'])){
	switch($_GET['op']){
		case 'consultar':
			$m = new PerCadHistoricoManutencao();
		
			$listaMaquinas = $m->buscarMaquinas();
		
			$_SESSION['listaMaquinas'] = serialize($listaMaquinas);
			
			header('location:../Interface/IntCadHistoricoManutencao.php');
			
		break;
        case 'cadastrar':
			if(isset($_POST['descricao'])&&
				  isset($_POST['tipo'])&&
				  isset($_POST['id_maquina'])){
	
				$erros=array();
				
				if(count($erros)==0){
					$m = new ModCadHistoricoManutencao();
					$m->data_realizacao_manutencao = $_POST['data_realizacao_manutencao'];
					$m->descricao = $_POST['descricao'];
					$m->id_maquina = $_POST['id_maquina'];
					$m->titulo = $_POST['titulo'];
					$m->tipo = $_POST['tipo'];
	
					$Perm = new PerCadHistoricoManutencao();
					$Perm->cadastrarHistoricoManutencao($m); 
					$_SESSION['m']=serialize($m);
					header('location:../Interface/IntConsHistoricoManutencao.php');
				}else{
					$_SESSION['erros']=$erros;
					header('location:../Interface/IntConsHistoricoManutencao.php');
				}
			}else{
				header('location:../Interface/IntConsHistoricoManutencao.php');	
			}
		break;
		case 'buscarHistoricos':
			$m = new PerCadHistoricoManutencao();
			$listaHistoricos = array();
			$listaHistoricos = $m->buscarHistoricos();
		
			$_SESSION['listaHistoricos'] = serialize($listaHistoricos);
			header('location:../Interface/IntConsHistoricoManutencao.php');
		break;
		case 'buscaAlterar':
			
			$m = new PerCadHistoricoManutencao();
			$listaHistoricos = $m->buscarHistoricosAlteracao($_GET['id']);

			$_SESSION['listaHistoricos'] = serialize($listaHistoricos);
			
			header('location:../Interface/IntAlterarHistoricoManutencao.php');
			
		break;
		case 'alterar':
			$pm = new PerCadHistoricoManutencao();
			
			$erros=array();
		 	if(count($erros)==0){
				$m = new ModCadHistoricoManutencao();
				$m->id_historico_manutencao = $_GET['id'];
				$m->descricao = $_POST['tipo'];
				$m->data_realizacao_manutencao = $_POST['data_realizacao_manutencao'];
				$m->titulo = $_POST['titulo'];
				$m->descricao = $_POST['descricao'];

				$pm->alterarHistorico($m);
				
				header('location:../Interface/IntConsHistoricoManutencao.php');
			}else{
				$_SESSION['erros'] = $erros;
				header('location:../Interface/IntConsHistoricoManutencao.php');
			}
		break;
		case 'deletar':
			
			$m = new PerCadHistoricoManutencao();
			$m->deletarHistorico($_GET['id']);
			// $_SESSION['erros'] = 'maquina deletada';
			header('location:../Interface/IntConsHistoricoManutencao.php');
		break;
	}
}
?>