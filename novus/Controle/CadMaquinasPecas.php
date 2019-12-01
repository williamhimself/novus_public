<?php
session_start();
session_unset();
include '../Modelo/ModCadMaquinasPecas.php';
// include '../util/Validacao.class.php';
include '../Persistencia/PerCadMaquinasPecas.php';

if(isset($_GET['op'])){
	switch($_GET['op']){
		case 'consultar':
			$m = new PerCadMaquinasPecas();
			$m2 = new PerCadMaquinasPecas();
		
			$listaMaquinas = $m->buscarMaquinas();
			$listaPecasReposicao = $m2->buscarPecasReposicao();
		
			$_SESSION['listaMaquinas'][0] = serialize($listaMaquinas);
			$_SESSION['listaMaquinas'][1] = serialize($listaPecasReposicao);
			
			header('location:../Interface/IntCadMaquinasPecas.php');
			
		break;
        case 'cadastrar':
			if(isset($_POST['id_maquina'])&&
				  isset($_POST['id_peca'])&&
				  isset($_POST['qtd_minimo'])){
	
				$erros=array();
				
				if(count($erros)==0){
					$m = new ModCadMaquinasPecas();
					$m->id_maquina = $_POST['id_maquina'];
					$m->id_peca = $_POST['id_peca'];
					$m->qtd_minimo = $_POST['qtd_minimo'];
	
					$Perm = new PerCadMaquinasPecas();
					$Perm->cadastrarMaquinasPecas($m); 
					$_SESSION['m']=serialize($m);
					header('location:../Interface/IntConsMaquinasPecas.php');
				}else{
					$_SESSION['erros']=$erros;
					header('location:../Interface/IntConsMaquinasPecas.php');
				}
			}else{
				header('location:../Interface/IntConsMaquinasPecas.php');	
			}
		break;
		case 'buscarMaquinasPecas':
			$m = new PerCadMaquinasPecas();
			$listaMaquinasPecas = array();
            $listaMaquinasPecas = $m->buscarMaquinasPecas();
		
			$_SESSION['listaMaquinasPecas'] = serialize($listaMaquinasPecas);
			header('location:../Interface/IntConsMaquinasPecas.php');
		break;
		case 'buscaAlterar':
			$m = new PerCadMaquinasPecas();
			$listaMaquinasPecas = $m->buscarMaquinasPecasAlteracao($_GET['id']);
			
			$_SESSION['listaMaquinasPecas'] = serialize($listaMaquinasPecas);
			
			header('location:../Interface/IntAlterarMaquinasPecas.php');
			
		break;
		case 'alterar':
			$pm = new PerCadMaquinasPecas();
			
			$erros=array();
		 	if(count($erros)==0){
				$m = new ModCadMaquinasPecas();
				$m->id_maquinas_pecas = $_GET['id'];
				$m->qtd_minimo = $_POST['qtd_minimo'];

				$pm->alterarMaquinasPecas($m);
				
				header('location:../Interface/IntConsMaquinasPecas.php');
			}else{
				$_SESSION['erros'] = $erros;
				header('location:../Interface/IntConsMaquinasPecas.php');
			}
		break;
		case 'deletar':
			
			$m = new PerCadMaquinasPecas();
			$m->deletarMaquinasPecas($_GET['id']);
			// $_SESSION['erros'] = 'maquina deletada';
			header('location:../Interface/IntConsMaquinasPecas.php');
		break;
	}
}
?>