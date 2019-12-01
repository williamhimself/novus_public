<?php
class ModCadPeca{
	private $id_peca;
	private $descricao;
	private $qtd_estoque;
	
	public function __construct(){
	}			
	public function __get($a){
		return $this->$a;
	}
	public function __set($a,$v){
		$this->$a = $v;
	}
}
?>