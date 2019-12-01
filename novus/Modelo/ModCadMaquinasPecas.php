<?php
class ModCadMaquinasPecas{
	private $id_maquinas_pecas;
	private $id_peca;
	private $id_maquina;
    private $qtd_minimo;
    private $descricaoMaquina;
    private $descricaoPeca;
    private $data_criacao;
	
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