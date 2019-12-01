<?php
class Usuario{
	private $idUsuario;
	private $login;
	private $senha;
	private $tipo;
	
	public function __construct(){
	}
	
	public function __get($a){
		return $this->$a;
	}
	public function __set($a,$v){
		$this->$a = $v;
	}
	public function __toString(){
		return   'codigo: '.$this->idUsuario.'<br />'.
					'login: '.$this->login.'<br />'.
					'senha: ******* <br />'.
					'tipo: '.$this->tipo.'<br />';
	}
}
?>