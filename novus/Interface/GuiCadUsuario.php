<?php
	session_start(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Keyboard 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20120915

-->
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/modelo.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Keyborad by FCT</title>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="wrapper">
	<div id="header-wrapper">
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="#">Site exemplo </a></h1>
			</div>
			<div id="menu">
				<ul>
					<li class="current_page_item"><a href="../index.php">Homepage</a></li>
                    
					<li><a href="GuiCadUsuario.php">cadastro</a></li>                
				</ul>
			</div>
		</div>
		<div id="banner">
			<div class="content"><img src="../imagens/img02.jpg" width="1000" height="140" alt="" /></div>
		</div>
	</div>
	<!-- end #header -->
	
	<div id="page">
		<div id="content">
        
		  <div class="post">
				<!-- InstanceBeginEditable name="conteúdo" -->

<?php
	if(isset($_SESSION['erros'])){
		foreach($_SESSION['erros'] as $e){
			echo '<p>'.$e.'</p>';
		}
		unset($_SESSION['erros']);
	}
?>
               
<form name="cadusu" id="cadusu" action="../Controle/ControleUsuario.php?op=cadastrar" method="post">				

	<fieldset><legend>cadastro</legend>
		<p>* campos obrigatórios</p>
    	<label>login
        <input type="text" name="txtlogin" id="txtlogin" placeholder="deve ser email" /> *</label> <br />
        
        <label>senha
        <input type="password" name="txtsenha" id="txtsenha" placeholder="entre 6 e 12 caracteres" /> *</label>   <br />
        
        <label>Escolha um tipo
        	<select name="seltipo" id="seltipo">
            	<option value="selecione">selecione</option>  
                <option value="admin">admin</option>
            	<option value="chinelao">chinelao</option>
            	<option value="glee">glee</option>
            </select>
        * </label>
    </fieldset>
    
	<fieldset><legend>ações</legend>
    	<input type="submit" name="btncadastrar" id="btncadastrar" value="cadastrar" />
    	<input type="reset" name="btnlimpar" id="btnlimpar" value="limpar" />        
    </fieldset>    
</form>               
				<!-- InstanceEndEditable -->

			</div>
		</div>
		<!-- end #content -->
        <?php
        	if(!isset($_SESSION['privateUser'])){
        ?>
		<form name="formlogin" id="formlogin" action="../Controle/ControleAcesso.php?op=logar" method="post">
        	<label>login</label>
            <input type="text" name="txtlogin" id="txtlogin" />
            <br />
            <label>senha</label>
            <input type="password" name="txtsenha" id="txtsenha" />
            <br />
            <input type="submit" name="btnlogar" id="btnlogar" value="Logar" />
            <input type="reset" name="btnlimpar" id="btnlimpar" value="Limpar" />
       </form>
            <?php
            	}else{
            ?>
        <div id="sidebar">
			<ul>
				<li>
					<h2>Categorias</h2>
					<ul>
						<li><a href="../Controle/ControleAcesso.php?op=deslogar">deslogar</a></li>
						<li><a href="../Controle/ControleUsuario.php?op=consultar">consulta</a></li>
     					<li><a href="GuiDelUsuario.php">excluir</a></li>                        
					</ul>
				</li>
                
			</ul>
		</div>
        <?php
        	}
        ?>
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page --> 
</div>
<div id="footer">
	<p>Copyright (c) 2012 Sitename.com. All rights reserved. Design by <a href="http://www.freecsstemplates.org">FCT</a>. Photos by <a href="http://fotogrph.com/">Fotogrph</a>.</p>
</div>
<!-- end #footer -->
</body>
<!-- InstanceEnd --></html>
