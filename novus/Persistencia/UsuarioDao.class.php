<?php
include  'Conexao.class.php';
class UsuarioDao{

	private $conexao = null;
	
	public function __construct(){
		$this->conexao = Conexao::getInstancia();
	}
	
	public function cadastrarUsuario($u){
		try{
	$stat = $this->conexao->prepare("INSERT into usuario
									(id_usuario, login, senha, tipo)
									values(null,?,?,?)");
			
			$stat->bindValue(1,$u->login);
			$stat->bindValue(2,$u->senha);
			$stat->bindValue(3,$u->tipo);									
			$stat->execute();
			$this->conexao = null;													
		}catch(PDOException $e){
			echo 'Erro ao cadastrar usuario';
		}
	}
	
	public function buscarUsuarios(){
		try{
			
			$stat = $this->conexao->query("select * from usuario");
			$array = array();
			$array = $stat->fetchAll(PDO::FETCH_CLASS,'Usuario');
			$this->conexao = null;
			return $array;
			
		}catch(PDOException $e){
			echo 'Erro ao buscar usuario';
		}
	}
	
	public function deletarUsuario($codigo){
		try{
			$stat = $this->conexao->prepare("delete from usuario
										     where id_usuario = ?");
			
			$stat->bindValue(1,$codigo);										   			
			$stat->execute();
			$this->conexao = null;
			
		}catch(PDOException $e){
			echo 'Erro ao deletar usuario';
		}
	}
	public function verificarUsuario($u){
		try{
			$stat = $this->conexao->query("SELECT * from usuario where login = '$u->login' and senha = '$u->senha'");
			$usuario = $stat->fetchObject('usuario');
			return $usuario;
		}catch(PDOException $e){
			echo 'erro ao verificar usuario no banco';
		}
	}
}
?>