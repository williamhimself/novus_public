<?php
session_start();
session_unset();
include '../Modelo/ModCadPeca.php';
// include '../util/Validacao.class.php';
include '../Persistencia/PerCadPeca.php';

if(isset($_GET['op'])){
	switch($_GET['op']){
        case 'cadastrar':
			if(isset($_POST['descricao'])&&
				  isset($_POST['qtd_estoque'])){
	
				$erros=array();
				
				if(count($erros)==0){

					$m = new ModCadPeca();
					$m->descricao = $_POST['descricao'];
					$m->qtd_estoque = $_POST['qtd_estoque'];
	
                    $Perm = new PerCadPeca();
					$Perm->cadastrarPeca($m); 
					$_SESSION['m']=serialize($m);
					header('location:../Interface/IntConsPeca.php');
				}else{
					$_SESSION['erros']=$erros;
					header('location:../Interface/IntConsPeca.php');
				}
			}else{
				header('location:../Interface/IntConsPeca.php');	
			}
		break;
		case 'buscarPecas':
			$m = new PerCadPeca();
			$listaPecas = array();
			$listaPecas = $m->buscarPecas();
		
			$_SESSION['listaPecas'] = serialize($listaPecas);
			header('location:../Interface/IntConsPeca.php');
		break;
		case 'buscaAlterar':
			
			$m = new PerCadPeca();
			$listaPecas = $m->buscarPecaAlteracao($_GET['id']);

			$_SESSION['listaPecas'] = serialize($listaPecas);
			
			header('location:../Interface/IntAlterarPeca.php');
			
		break;
		case 'alterar':
			$pm = new PerCadPeca();
			
			$erros=array();
		 	if(count($erros)==0){
				$m = new ModCadPeca();
				$m->id_peca = $_GET['id'];
				$m->descricao = $_POST['descricao'];
				$m->qtd_estoque = $_POST['qtd_estoque'];
				$pm->alterarPeca($m);
				
				header('location:../Interface/IntConsPeca.php');
			}else{
				$_SESSION['erros'] = $erros;
				header('location:../Interface/IntConsPeca.php');
			}
		break;
		case 'deletar':
			
			$m = new PerCadPeca();
			$m->deletarPeca($_GET['id']);
			// $_SESSION['erros'] = 'maquina deletada';
			header('location:../Interface/IntConsPeca.php');
		break;
	}
}
?>