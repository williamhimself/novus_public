<?php
class ModCadMaquinaContato{
	private $id_maquina_contato;
	private $id_contato;
	private $id_maquina;
    private $nome;
    private $email;
    private $telefone;
    private $info_adicionais;
    private $descricaoMaquina;
	
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