<?php
include 'Conexao.class.php';
class PerCadMaquinaContato{
	private $conexao=null;
	
	public function __construct(){
		$this->conexao=Conexao::getInstancia();	
    }
    
    public function buscarMaquinas(){
		try{
			$stat=$this->conexao->query("SELECT id_maquina, descricao AS descricaoMaquina FROM bd_novus.maquina");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadMaquinaContato');
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar Maquinas';
		}
	}

	public function cadastrarMaquinaContato($m){
		try{
			$stat=$this->conexao->prepare("INSERT INTO contato (id_contato,nome,email,telefone,info_adicionais,data_criacao,data_atualizacao) values (null,?,?,?,?,sysdate(),sysdate())");
				$stat->bindValue(1,$m->nome);
				$stat->bindValue(2,$m->email);
				$stat->bindValue(3,$m->telefone);   
				$stat->bindValue(4,$m->info_adicionais);
                $stat->execute();
                
            $stat=$this->conexao->prepare("INSERT INTO maquina_contato (id_maquina_contato,id_contato,id_maquina,data_criacao,data_atualizacao) values (null,(SELECT MAX(id_contato) FROM contato),?,sysdate(),sysdate())");
			$stat->bindValue(1,$m->id_maquina);
			$stat->execute();

			$this->conexao=null;	
		}catch(PDOException $e){
			echo 'Erro ao cadastrar as contato!';
		}
	}
	public function buscarMaquinaContato(){
		try{
			$stat=$this->conexao->query("SELECT c.id_contato,
                                                descricao as descricaoMaquina,
                                                c.nome,
                                                c.email,
                                                c.telefone
    
                                        FROM maquina m
                                                INNER JOIN maquina_contato mc ON m.id_maquina = mc.id_maquina
                                                INNER JOIN contato c ON c.id_contato = mc.id_contato");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadMaquinaContato');
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar maquinas contato';
		}
	}
	public function buscarMaquinaContatoAlteracao($id_contato){
		try{
			$stat=$this->conexao->query("SELECT	c.id_contato,
												m.descricao as descricaoMaquina,
												m.id_maquina,
												c.nome,
												c.email,
												c.telefone,
												c.info_adicionais
										
										FROM maquina m
												inner join maquina_contato mc on m.id_maquina = mc.id_maquina
												inner join contato c on c.id_contato = mc.id_contato
										
										WHERE c.id_contato = $id_contato");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadMaquinaContato');
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar Contato';
		}
	}

	public function alterarMaquinaContato($m){		
		try{
			$stat = $this->conexao->query("UPDATE contato
											SET nome = '$m->nome',
												email = '$m->email',
												telefone = '$m->telefone',
												info_adicionais = '$m->info_adicionais',
												data_atualizacao = SYSDATE()
												
											WHERE id_contato = $m->id_contato");
			$stat->execute();
			
			$this->conexao = null;
		}catch(PDOException $e){
			echo 'Erro ao alterar maquinas pecas';
		}
	}
	public function deletarMaquinaContato($id_contato){
		try{
			$stat = $this->conexao->query("DELETE FROM  bd_novus.maquina_contato	
											WHERE id_contato = $id_contato");
			$stat->execute();
			
			$stat = $this->conexao->query("DELETE FROM  bd_novus.contato
											WHERE id_contato = $id_contato");
			$stat->execute();
			$this->conexao = null;
		}catch(PDOException $e){
			echo 'Erro ao deletar contato';
		}
	}
}	
?>