<?php
class ModCadHistoricoManutencao{
	private $id_maquina;
	private $titulo;
	private $descricao;
    private $tipo;
    private $data_realizacao_manutencao;
    private $descricaoMaquina;
    private $arrMaquina = array();
    private $id_historico_manutencao;
	
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