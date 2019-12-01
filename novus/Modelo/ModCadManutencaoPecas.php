<?php
class ModCadManutencaoPecas{
	private $id_manutencao_pecas;
	private $id_historico_manutencao;
	private $id_peca;
    private $qtd_utilizada;
    private $titulo_historico_manutencao;
    private $descricaoPeca;
    private $data_criacao;
    private $arrhistoricoManutencao = array();
    private $arrPeca = array();
	
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