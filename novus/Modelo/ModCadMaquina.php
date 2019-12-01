<?php
class ModCadMaquina{
	private $id_maquina;
	private $descricao;
	private $caracteristica;
	private $patrimonio;
    private $data_proxima_manutencao;
    private $data_aviso_antes;
    private $email_aviso_manutencao;
	private $id_arquivo;
	private $arquivo;
	private $descricaoArquivo;
	private $nomeTemporario;

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