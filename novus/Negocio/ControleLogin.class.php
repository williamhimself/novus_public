<?php
include_once '../Persistencia/UsuarioDao.class.php';
class ControleLogin{
	public static function logar($u){
		$uDAO = new UsuarioDao();
		$usuario = $uDAO->verificarUsuario($u);
		if($usuario && !is_null($usuario)){
			$_SESSION['privateUser']=serialize($usuario);
			header('location:../index_old.php');	
		}else{
			$_SESSION['mensagem']='usuario ou senha inválidos';
			header('location:../Interface/GuiResposta.php');	
		}
	}
	public static function deslogar(){
		unset($_SESSION['privateUser']);
		$_SESSION['mensagem']='você foi deslogado';
		header('location:../Interface/GuiResposta.php');
	}
	public static function verificarAcesso(){
		if(!isset($_SESSION['privateUser'])){
			$_SESSION['mensagem']='você precisa estar logado para acessar o conteudo desta página!';
			header('location:../Interface/GuiResposta.php');
		}
	}
}
?>