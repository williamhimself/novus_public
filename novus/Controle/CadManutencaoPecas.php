<?php
session_start();
session_unset();
include '../Modelo/ModCadManutencaoPecas.php';
// include '../util/Validacao.class.php';
include '../Persistencia/PerCadManutencaoPecas.php';

if(isset($_GET['op'])){
	switch($_GET['op']){
		case 'consultar':
			$m = new PerCadManutencaoPecas();
			$m2 = new PerCadManutencaoPecas();
		
			$listaManutencoes = $m->buscarHistoricoManutencoes();
			$listaPecasReposicao = $m2->buscarPecasReposicao();
		
			$_SESSION['listaManutencao'][0] = serialize($listaManutencoes);
			$_SESSION['listaManutencao'][1] = serialize($listaPecasReposicao);
			
			header('location:../Interface/IntCadManutencaoPecas.php');
			
		break;
        case 'cadastrar':
			if(isset($_POST['id_historico_manutencao'])&&
				  isset($_POST['id_peca'])&&
				  isset($_POST['qtd_utilizada'])){
	
				$erros=array();
				
				if(count($erros)==0){
					$m = new ModCadManutencaoPecas();
					$m->id_historico_manutencao = $_POST['id_historico_manutencao'];
					$m->id_peca = $_POST['id_peca'];
					$m->qtd_utilizada = $_POST['qtd_utilizada'];
	
					$Perm = new PerCadManutencaoPecas();
					$Perm->cadastrarManutencaoPecas($m); 
					$_SESSION['m']=serialize($m);
					header('location:../Interface/IntConsManutencaoPecas.php');
				}else{
					$_SESSION['erros']=$erros;
					header('location:../Interface/IntConsManutencaoPecas.php');
				}
			}else{
				header('location:../Interface/IntConsManutencaoPecas.php');	
			}
		break;
		case 'buscarManutencoes':
			$m = new PerCadManutencaoPecas();
			$listaManutencoes = array();
			$listaManutencoes = $m->buscarManutencoes();
		
			$_SESSION['listaManutencoes'] = serialize($listaManutencoes);
			header('location:../Interface/IntConsManutencaoPecas.php');
		break;
		case 'buscaAlterar':
			
			$m = new PerCadManutencaoPecas();
			$listaManutencao = $m->buscarHistoricosAlteracao($_GET['id']);

			$_SESSION['listaManutencao'] = serialize($listaManutencao);
			
			header('location:../Interface/IntAlterarManutencaoPecas.php');
			
		break;
		case 'alterar':
			$pm = new PerCadManutencaoPecas();
			
			$erros=array();
		 	if(count($erros)==0){
				$m = new ModCadManutencaoPecas();
				$m->id_manutencao_pecas = $_GET['id'];
				$m->qtd_utilizada = $_POST['qtd_utilizada'];

				$pm->alterarManutencaoPecas($m);
				
				header('location:../Interface/IntConsManutencaoPecas.php');
			}else{
				$_SESSION['erros'] = $erros;
				header('location:../Interface/IntConsManutencaoPecas.php');
			}
		break;
		case 'deletar':
			
			$m = new PerCadManutencaoPecas();
			$m->deletarManutencaoPecas($_GET['id']);
			// $_SESSION['erros'] = 'maquina deletada';
			header('location:../Interface/IntConsManutencaoPecas.php');
		break;
	}
}
?>