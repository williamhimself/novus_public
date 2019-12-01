<?php
include_once  '../modelo/Contato.class.php';
class Email{
	
	private $para;
	private $assunto;
	private $mensagem;
	
	public function __construct($c){
		$this->para = 'leonard-matos@hotmail.com';
		$this->assunto = 'Mensagem do cliente';	
		$this->mensagem = $c->nome."\n".$c->email."\n".$c->telefone."\n \n".$c->mensagem;
	}
	
	public function enviarEmail(){
		return mail($this->para,$this->assunto,$this->mensagem);
	}
}
?>