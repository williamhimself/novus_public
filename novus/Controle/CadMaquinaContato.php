<?php
session_start();
session_unset();
include '../Modelo/ModCadMaquinaContato.php';
// include '../util/Validacao.class.php';
include '../Persistencia/PerCadMaquinaContato.php';

if(isset($_GET['op'])){
	switch($_GET['op']){
		case 'consultar':
			$m = new PerCadMaquinaContato();
			$m2 = new PerCadMaquinaContato();
		
			$listaMaquinas = $m->buscarMaquinas();
		
			$_SESSION['listaMaquinas'] = serialize($listaMaquinas);
			
			header('location:../Interface/IntCadMaquinaContato.php');
			
		break;
        case 'cadastrar':
			if(isset($_POST['id_maquina'])&&
				  isset($_POST['nome'])&&
				  isset($_POST['email'])&&
				  isset($_POST['telefone'])&&
				  isset($_POST['info_adicionais'])){
	
				$erros=array();
				
				if(count($erros)==0){
					$m = new ModCadMaquinaContato();
					$m->id_maquina = $_POST['id_maquina'];
					$m->nome = $_POST['nome'];
					$m->email = $_POST['email'];
					$m->telefone = $_POST['telefone'];
					$m->info_adicionais = $_POST['info_adicionais'];
	
					$Perm = new PerCadMaquinaContato();
					$Perm->cadastrarMaquinaContato($m); 
					$_SESSION['m']=serialize($m);
					header('location:../Interface/IntConsMaquinaContato.php');
				}else{
					$_SESSION['erros']=$erros;
					header('location:../Interface/IntConsMaquinaContato.php');
				}
			}else{
				header('location:../Interface/IntConsMaquinaContato.php');	
			}
		break;
		case 'buscarMaquinaContato':
			$m = new PerCadMaquinaContato();
			$listaMaquinaContato = array();
            $listaMaquinaContato = $m->buscarMaquinaContato();
		
			$_SESSION['listaMaquinaContato'] = serialize($listaMaquinaContato);
			header('location:../Interface/IntConsMaquinaContato.php');
		break;

		case 'buscaAlterar':
			$m = new PerCadMaquinaContato();
			$listaMaquinaContato = $m->buscarMaquinaContatoAlteracao($_GET['id']);
			
			$_SESSION['listaMaquinaContato'] = serialize($listaMaquinaContato);
			
			header('location:../Interface/IntAlterarMaquinaContato.php');
			
		break;
		case 'alterar':
			$pm = new PerCadMaquinaContato();
			
			$erros=array();
		 	if(count($erros)==0){
				$m = new ModCadMaquinaContato();
				$m->id_contato = $_GET['id'];
				$m->nome = $_POST['nome'];
				$m->email = $_POST['email'];
				$m->telefone = $_POST['telefone'];
				$m->info_adicionais = $_POST['info_adicionais'];

				$pm->alterarMaquinaContato($m);
				
				header('location:../Interface/IntConsMaquinaContato.php');
			}else{
				$_SESSION['erros'] = $erros;
				header('location:../Interface/IntConsMaquinaContato.php');
			}
		break;
		case 'deletar':
			
			$m = new PerCadMaquinaContato();
			$m->deletarMaquinaContato($_GET['id']);
			// $_SESSION['erros'] = 'maquina deletada';
			header('location:../Interface/IntConsMaquinaContato.php');
		break;
	}
}
?>