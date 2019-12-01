<?php
session_start();
include  '../Modelo/Usuario.class.php';
include  '../Negocio/Validacao.class.php';
include  '../Persistencia/UsuarioDao.class.php';

if(isset($_GET['op'])){
	switch($_GET['op']){
		case 'cadastrar':

			if(isset($_POST['txtlogin'])&&
				isset($_POST['txtsenha'])&&
				isset($_POST['seltipo'])){

					$erros = array();
					if(!Validacao::validarLogin($_POST['txtlogin']))
					$erros[] = 'login invalido! O login deve ser email';
		
					if(!Validacao::validarSenha($_POST['txtsenha']))
					$erros[] = 'senha invalida! entre 6 e 12 caracteres';
			
					if(!Validacao::validarTipo($_POST['seltipo']))
					$erros[] = 'tipo invalido! Escolha um tipo: admin, chinelao ou glee';	
					
					// var_dump($erros);exit;
		
					if(count($erros)==0){
						$u = new Usuario();
						$u->login = $_POST['txtlogin'];
						$u->senha = $_POST['txtsenha'];
						$u->tipo = $_POST['seltipo'];				
			
						$uDAO = new UsuarioDao();
						$uDAO->cadastrarUsuario($u);
			
						$_SESSION['u'] = serialize($u);
						header('location:../Interface/GuiResposta.php');
					}else{
						$_SESSION['erros'] = $erros;
						header('location:../Interface/GuiCadUsuario.php');	
					}
			}//fecha if do isset
		break;
		
		case  'consultar':
			$uDAO = new UsuarioDao();
			$arrayUsuarios = array();
			$arrayUsuarios = $uDAO->buscarUsuarios();
			
			$_SESSION['arrayUsuarios'] = serialize($arrayUsuarios); 			
			header('location:../Interface/GuiConsUsuario.php');	
		break;
		
		case 'deletar':
			$uDAO = new UsuarioDao();
			
			if(isset($_GET['codigo'])){
				$uDAO->deletarUsuario($_GET['codigo']);
			}else if(isset($_POST['txtcodigo'])){
				$uDAO->deletarUsuario($_POST['txtcodigo']);			
		    }else{
				header('location:../Interface/GuiConsUsuario.php');	
			}
			
			header('location:../Controle/ControleUsuario.php?op=consultar');
						
		break;
	}//fecha switch
}//fecha if do op
?>