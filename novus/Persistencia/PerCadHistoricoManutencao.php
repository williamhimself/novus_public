<?php
include 'Conexao.class.php';
class PerCadHistoricoManutencao{
	private $conexao=null;
	
	public function __construct(){
		$this->conexao=Conexao::getInstancia();	
    }
    
    public function buscarMaquinas(){
		try{
			$stat=$this->conexao->query("SELECT id_maquina, descricao AS descricaoMaquina FROM bd_novus.maquina");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadHistoricoManutencao');
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar maquinas';
		}
	}

	public function cadastrarHistoricoManutencao($m){
		try{
			$stat=$this->conexao->prepare("insert into bd_novus.historico_manutencao(id_historico_manutencao,id_maquina,titulo,descricao,tipo,data_realizacao_manutencao,data_criacao,data_atualizacao)values(null,?,?,?,?,?,sysdate(),sysdate())");
			$stat->bindValue(1,$m->id_maquina);
			$stat->bindValue(2,$m->titulo);
			$stat->bindValue(3,$m->descricao);
			$stat->bindValue(4,$m->tipo);
			$stat->bindValue(5,$m->data_realizacao_manutencao);
			$stat->execute();

			$this->conexao=null;	
		}catch(PDOException $e){
			echo 'Erro ao cadastrar o Manutenção!';
		}
	}
	public function buscarHistoricos(){
		try{
			$stat=$this->conexao->query("SELECT id_historico_manutencao,titulo,data_realizacao_manutencao FROM bd_novus.historico_manutencao");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadHistoricoManutencao');
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar Historicos';
		}
	}
	public function buscarHistoricosAlteracao($id_historico_manutencao){
		try{
			$stat=$this->conexao->query("SELECT hm.id_historico_manutencao,
												hm.id_maquina,
												hm.titulo,
												hm.descricao,
												hm.tipo,
												hm.data_realizacao_manutencao,
												m.descricao AS descricaoMaquina
										
										FROM bd_novus.historico_manutencao hm
												INNER JOIN maquina m ON hm.id_maquina = m.id_maquina
												
										WHERE hm.id_historico_manutencao = $id_historico_manutencao");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadHistoricoManutencao');
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar Historicos';
		}
	}

	public function alterarHistorico($m){
		try{
			$stat = $this->conexao->query("UPDATE bd_novus.historico_manutencao
											SET titulo = '$m->titulo',
												descricao = '$m->descricao',
												tipo = '$m->tipo',
												data_realizacao_manutencao = '$m->data_realizacao_manutencao',
												data_atualizacao = SYSDATE()
												
											WHERE id_historico_manutencao = $m->id_historico_manutencao");
			$stat->execute();
			
			$this->conexao = null;
		}catch(PDOException $e){
			echo 'Erro ao alterar historico';
		}
	}
	public function deletarHistorico($id_historico_manutencao){
		try{
			$stat = $this->conexao->prepare("DELETE FROM  bd_novus.historico_manutencao	
											WHERE id_historico_manutencao = $id_historico_manutencao");
			var_dump($stat);exit;
			$stat->execute();
			$this->conexao = null;
		}catch(PDOException $e){
			echo 'Erro ao deletar historico';
		}
	}
}	
?>