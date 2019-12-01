<?php
session_start();
include_once '../Modelo/Usuario.class.php';
include_once '../Negocio/Validacao.class.php';
include_once '../Negocio/ControleLogin.class.php';

if(isset($_GET['op'])){
	switch($_GET['op']){
		case 'logar':
			if(isset($_POST['txtlogin'])&&
			   isset($_POST['txtsenha'])){
			   	$erros = array();
				if(!Validacao::validarLogin($_POST['txtlogin']))
				$erros[] = 'login invalido! O login deve ser email';
		
				if(!Validacao::validarSenha($_POST['txtsenha']))
				$erros[] = 'senha invalida! entre 6 e 12 caracteres';
					
				
				if(count($erros)==0){
					$u = new Usuario();
					$u->login = $_POST['txtlogin'];
					$u->senha = $_POST['txtsenha'];
					
					ControleLogin::logar($u);
				}else{
					$_SESSION['mensagem'] = 'login ou senha invalidos';
					header('location:../Interface/GuiResposta.php');
				}
			}
		break;
		
		case 'deslogar':
			ControleLogin::deslogar();
		break;	
	}
}
?>