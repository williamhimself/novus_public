<?php
include 'Conexao.class.php';
class PerCadManutencaoPecas{
	private $conexao=null;
	
	public function __construct(){
		$this->conexao=Conexao::getInstancia();	
    }
    
    public function buscarHistoricoManutencoes(){
		try{
			$stat=$this->conexao->query("SELECT id_historico_manutencao,titulo AS titulo_historico_manutencao FROM bd_novus.historico_manutencao");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadManutencaoPecas');
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar Historico de Manutenções';
		}
	}
    public function buscarPecasReposicao(){
		try{
			$stat=$this->conexao->query("SELECT id_peca,descricao AS descricaoPeca FROM bd_novus.pecas_reposicao");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadManutencaoPecas');
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar Peças de Reposição';
		}
	}

	public function cadastrarManutencaoPecas($m){
		try{
			$stat=$this->conexao->prepare("INSERT INTO bd_novus.manutencao_pecas(id_manutencao_pecas,id_historico_manutencao,id_peca,qtd_utilizada,data_criacao,data_atualizacao)VALUES(NULL,?,?,?,SYSDATE(),SYSDATE())");
			$stat->bindValue(1,$m->id_historico_manutencao);
			$stat->bindValue(2,$m->id_peca);
			$stat->bindValue(3,$m->qtd_utilizada);
			$stat->execute();

			$this->conexao=null;	
		}catch(PDOException $e){
			echo 'Erro ao cadastrar o Manutenção de Peças!';
		}
	}
	public function buscarManutencoes(){
		try{
			$stat=$this->conexao->query("SELECT id_manutencao_pecas,qtd_utilizada,data_criacao FROM bd_novus.manutencao_pecas");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadManutencaoPecas');
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar Historicos';
		}
	}
	public function buscarHistoricosAlteracao($id_manutencao_pecas){
		try{
			$stat=$this->conexao->query("SELECT mp.id_manutencao_pecas,
                                                mp.qtd_utilizada,
                                                pr.id_peca,
                                                pr.descricao AS descricaoPeca,
                                                hm.id_historico_manutencao,
                                                hm.titulo AS titulo_historico_manutencao
    
                                            FROM  bd_novus.manutencao_pecas mp
                                                    INNER JOIN bd_novus.pecas_reposicao pr on pr.id_peca = mp.id_peca
                                                    INNER JOIN bd_novus.historico_manutencao hm on hm.id_historico_manutencao = mp.id_historico_manutencao
                                                    
                                            WHERE mp.id_manutencao_pecas =  $id_manutencao_pecas");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadManutencaoPecas');
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar Manutenção';
		}
	}

	public function alterarManutencaoPecas($m){
		try{
			$stat = $this->conexao->query("UPDATE bd_novus.manutencao_pecas
                                            SET qtd_utilizada = '$m->qtd_utilizada',
                                            data_atualizacao = SYSDATE()
                
                                            WHERE id_manutencao_pecas = $m->id_manutencao_pecas");
			$stat->execute();
			
			$this->conexao = null;
		}catch(PDOException $e){
			echo 'Erro ao alterar manutencao pecas';
		}
	}
	public function deletarManutencaoPecas($id_manutencao_pecas){
		try{
			$stat = $this->conexao->query("DELETE FROM  bd_novus.manutencao_pecas	
											WHERE id_manutencao_pecas = $id_manutencao_pecas");
			$stat->execute();
			$this->conexao = null;
		}catch(PDOException $e){
			echo 'Erro ao deletar manutencao';
		}
	}
}	
?>