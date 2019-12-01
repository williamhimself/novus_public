<?php
class Validacao{
	
	public static function validarLogin($login){
		if(filter_var($login,FILTER_VALIDATE_EMAIL)){
			return true;
		}else{
			return false;
		}//fecha else
	}//fecha método	
	
	public static function validarSenha($senha){
		$exp = '/^[a-zA-Z0-9]{6,12}$/';
		if(preg_match($exp,$senha)){
			return true;				
		}else{
			return false;
		}//fecha else
	}//fecha método	
	
	public static function validarTipo($tipo){
		$exp = '/^(admin|chinelao|glee)$/';
		
		if(preg_match($exp,$tipo)){
			return true;				
		}else{
			return false;
		}//fecha else
	}//fecha método	
}//fecha classe
?>