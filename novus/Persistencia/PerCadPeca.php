<?php
include 'Conexao.class.php';
class PerCadPeca{
	private $conexao=null;
	
	public function __construct(){
		$this->conexao=Conexao::getInstancia();	
    }

	public function cadastrarPeca($m){
		try{
			$stat=$this->conexao->prepare("INSERT INTO bd_novus.pecas_reposicao(id_peca,descricao,qtd_estoque,data_criacao,data_atualizacao)VALUES(NULL,?,?,SYSDATE(),SYSDATE())");
			$stat->bindValue(1,$m->descricao);
			$stat->bindValue(2,$m->qtd_estoque);
			$stat->execute();

			$this->conexao=null;	
		}catch(PDOException $e){
			echo 'Erro ao cadastrar o Peça!';
		}
	}
	public function buscarPecas(){
		try{
			$stat=$this->conexao->query("SELECT id_peca,descricao,qtd_estoque FROM bd_novus.pecas_reposicao");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadPeca');
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar Peças';
		}
	}
	public function buscarPecaAlteracao($id_peca){
		try{
			$stat=$this->conexao->query("SELECT id_peca,
                                                descricao,
                                                qtd_estoque
										
										FROM bd_novus.pecas_reposicao
												
										WHERE id_peca = $id_peca");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadPeca');
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar Peça';
		}
	}

	public function alterarPeca($m){
		try{
			$stat = $this->conexao->query("UPDATE bd_novus.pecas_reposicao
											SET descricao = '$m->descricao',
												qtd_estoque = '$m->qtd_estoque',
												data_atualizacao = SYSDATE()
												
											WHERE id_peca = $m->id_peca");
			$stat->execute();
			
			$this->conexao = null;
		}catch(PDOException $e){
			echo 'Erro ao alterar peça';
		}
	}
	public function deletarPeca($id_peca){
		try{
			$stat = $this->conexao->query("DELETE FROM  bd_novus.pecas_reposicao	
											WHERE id_peca = $id_peca");
			$stat->execute();
			$this->conexao = null;
		}catch(PDOException $e){
			echo 'Erro ao deletar peca';
		}
	}
}	
?>