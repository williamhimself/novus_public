<?php
include 'Conexao.class.php';
class PerCadMaquinasPecas{
	private $conexao=null;
	
	public function __construct(){
		$this->conexao=Conexao::getInstancia();	
    }
    
    public function buscarMaquinas(){
		try{
			$stat=$this->conexao->query("SELECT id_maquina, descricao AS descricaoMaquina FROM bd_novus.maquina");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadMaquinasPecas');
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar Maquinas';
		}
	}
    public function buscarPecasReposicao(){
		try{
			$stat=$this->conexao->query("SELECT id_peca,descricao AS descricaoPeca FROM bd_novus.pecas_reposicao");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadMaquinasPecas');
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar pPeças de Reposição';
		}
	}

	public function cadastrarMaquinasPecas($m){
		try{
			$stat=$this->conexao->prepare("INSERT INTO bd_novus.maquinas_pecas(id_maquinas_pecas,id_peca,id_maquina,qtd_minimo,data_criacao,data_atualizacao)VALUES(NULL,?,?,?,SYSDATE(),SYSDATE())");
			$stat->bindValue(1,$m->id_peca);
			$stat->bindValue(2,$m->id_maquina);
			$stat->bindValue(3,$m->qtd_minimo);
			$stat->execute();

			$this->conexao=null;	
		}catch(PDOException $e){
			echo 'Erro ao cadastrar as maquinas Peças!';
		}
	}
	public function buscarMaquinasPecas(){
		try{
			$stat=$this->conexao->query("SELECT id_maquinas_pecas,qtd_minimo,data_criacao FROM bd_novus.maquinas_pecas");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadMaquinasPecas');
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar maquinas pecas';
		}
	}
	public function buscarMaquinasPecasAlteracao($id_maquinas_pecas){
		try{
			$stat=$this->conexao->query("SELECT mp.id_maquinas_pecas,
                                                mp.id_peca,
                                                mp.id_maquina,
                                                mp.qtd_minimo,
                                                pr.descricao AS descricaoPeca,
                                                m.descricao AS descricaoMaquina
                                        
                                        FROM bd_novus.maquinas_pecas mp
                                                INNER JOIN bd_novus.pecas_reposicao pr ON mp.id_peca = pr.id_peca
                                                INNER JOIN bd_novus.maquina m ON m.id_maquina = mp.id_maquina
                                        WHERE mp.id_maquinas_pecas = $id_maquinas_pecas");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadMaquinasPecas');
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar Maquinas Pecas';
		}
	}

	public function alterarMaquinasPecas($m){		
		try{
			$stat = $this->conexao->query("UPDATE bd_novus.maquinas_pecas
                                            SET qtd_minimo = '$m->qtd_minimo',
                                            data_atualizacao = SYSDATE()
                
                                            WHERE id_maquinas_pecas = $m->id_maquinas_pecas");
			$stat->execute();
			
			$this->conexao = null;
		}catch(PDOException $e){
			echo 'Erro ao alterar maquinas pecas';
		}
	}
	public function deletarMaquinasPecas($id_maquinas_pecas){
		try{
			$stat = $this->conexao->query("DELETE FROM  bd_novus.maquinas_pecas	
											WHERE id_maquinas_pecas = $id_maquinas_pecas");
			$stat->execute();
			$this->conexao = null;
		}catch(PDOException $e){
			echo 'Erro ao deletar maquinas';
		}
	}
}	
?>