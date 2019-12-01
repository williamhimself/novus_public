<?php
include 'Conexao.class.php';
class PerCadMaquina{
	private $conexao=null;
	
	public function __construct(){
		$this->conexao=Conexao::getInstancia();	
	}
	public function cadastrarMaquina($m,$cont){
		try{
			if($cont == 0){
				$stat=$this->conexao->prepare("INSERT INTO bd_novus.maquina(id_maquina,descricao,caracteristica,patrimonio,data_proxima_manutencao,data_aviso_antes,email_aviso_manutencao,data_criacao,data_atualizacao) VALUES(NULL,?,?,?,?,?,?,SYSDATE(),SYSDATE())");
				$stat->bindValue(1,$m->descricao);
				$stat->bindValue(2,$m->caracteristica);
				$stat->bindValue(3,$m->patrimonio);
				$stat->bindValue(4,$m->data_proxima_manutencao);
				$stat->bindValue(5,$m->data_aviso_antes);
				$stat->bindValue(6,$m->email_aviso_manutencao);
				$stat->execute();
			}

			$stat=$this->conexao->prepare("INSERT INTO bd_novus.arquivos(id_arquivo,id_maquina,arquivo,descricao,data_cadastro) VALUES(NULL,(SELECT MAX(id_maquina) FROM maquina),?,?,SYSDATE())");
			$stat->bindValue(1,$m->arquivo);
			$stat->bindValue(2,$m->descricaoArquivo);
			$stat->execute();

			$this->conexao=null;	
		}catch(PDOException $e){
			echo 'Erro ao cadastrar o Maquina!';
		}
	}
	public function buscarMaquinas(){
		try{
			$stat=$this->conexao->query("SELECT m.id_maquina,
												m.descricao,
												m.patrimonio,
												m.email_aviso_manutencao
											FROM bd_novus.maquina m
											ORDER BY m.id_maquina");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadMaquina');
			$this->conexao=null;
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar maquinas';
		}
	}
	public function buscarMaquinaAlteracao($id_maquina){
		try{
			$stat=$this->conexao->query("SELECT id_maquina,
												descricao,
												caracteristica,
												patrimonio,
												data_proxima_manutencao,
												data_aviso_antes,
												email_aviso_manutencao
											FROM bd_novus.maquina 
											WHERE id_maquina = $id_maquina");
			$array=array();
			$array=$stat->fetchAll(PDO::FETCH_CLASS,'ModCadMaquina');
			$this->conexao=null;
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar maquina';
		}
	}

	public function buscarArquivoAlteracao($id_maquina){
		try{
			$stat = $this->conexao->query("SELECT id_arquivo,
													arquivo,
													descricao AS descricaoArquivo
										FROM bd_novus.arquivos
										WHERE id_maquina = $id_maquina");
			$array = array();
			$array = $stat->fetchAll(PDO::FETCH_CLASS,'ModCadMaquina');
			$this->conexao = null;
			return $array;
		}catch(PDOException $e){
			echo 'Erro ao buscar arquivo';
		}
	}
	public function deletarArquivo($id_arquivo){
		try{
			$stat = $this->conexao->query("DELETE FROM bd_novus.arquivos
											WHERE id_arquivo =  $id_arquivo");
			$stat->execute();
			$this->conexao=null;
		}catch(PDOException $e){
			echo 'Erro ao deletar arquivo';
		}
	}
	public function alterarMaquina($m,$cont){
		try{
			$stat = $this->conexao->query("UPDATE  bd_novus.maquina
											SET descricao = '$m->descricao',
												caracteristica = '$m->caracteristica',
												patrimonio = '$m->patrimonio',
												data_proxima_manutencao = '$m->data_proxima_manutencao',
												data_aviso_antes = '$m->data_aviso_antes',
												email_aviso_manutencao = '$m->email_aviso_manutencao',
												data_atualizacao = SYSDATE()
											WHERE id_maquina = $m->id_maquina");
			$stat->execute();

			if($cont == 'x'){
				$stat = $this->conexao->query("UPDATE bd_novus.arquivos
												SET descricao = '$m->descricaoArquivo'
												WHERE id_arquivo = $m->id_arquivo");
				$stat->execute();
			}
			// else if($cont == 'y'){
				

			// 	$stat = $this->conexao->query("UPDATE bd_novus.arquivos
			// 									SET descricao = '$m->descricaoArquivo',
			// 										arquivo = '$m->arquivo'
			// 									WHERE id_arquivo = $m->id_arquivo");
			// 	$stat->execute();
			// }
			
			$this->conexao = null;
		}catch(PDOException $e){
			echo 'Erro ao alterar arquivo';
		}
	}
	public function cadastrarArquivo($m){
		try{
			$stat = $this->conexao->prepare("INSERT INTO bd_novus.arquivos(id_arquivo,id_maquina,arquivo,descricao,data_cadastro) VALUES(NULL,?,?,?,SYSDATE())");
			$stat->bindValue(1,$m->id_maquina);
			$stat->bindValue(2,$m->arquivo);
			$stat->bindValue(3,$m->descricaoArquivo);
			$stat->execute();
			
			$this->conexao = null;
		}catch(PDOException $e){
			echo 'Erro ao cadastrar arquivo';
		}
	}
	public function buscarCaminhoArquivo($id_maquina){
		try{
			$stat = $this->conexao->query("SELECT arquivo FROM bd_novus.arquivos WHERE id_maquina = $id_maquina");
			$array = array();
			$array = $stat->fetchAll(PDO::FETCH_CLASS,'ModCadMaquina');
			$this->conexao = null;
			return $array;
			
		}catch(PDOException $e){
			echo 'Erro ao buscar caminho do arquivo';
		}
	}
	public function deletarMaquina($id_maquina){
		try{
			$stat = $this->conexao->query("DELETE FROM bd_novus.arquivos WHERE id_maquina = $id_maquina");
			$stat->execute();
			
			$stat = $this->conexao->query("DELETE FROM bd_novus.maquina WHERE id_maquina = $id_maquina");
			$stat->execute();
			
			$this->conexao = null;
		}catch(PDOException $e){
			echo 'Erro ao deletar maquina';
		}
	}
}
?>