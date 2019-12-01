<?php
	session_start();
	include '../Negocio/ControleLogin.class.php';
	ControleLogin::verificarAcesso();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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
			<div id="menu">
				<ul>                    
					<li><a href="GuiCadUsuario.php">cadastro</a></li>                
				</ul>
			</div>
		</div>
	</div>
	<!-- end #header -->
	
	<div id="page">
		<div id="content">
        
		  <div class="post">
				<!-- InstanceBeginEditable name="conteúdo" -->
            <h2 class="title">Consulta Usuário</h2>
   			<?php
				if(isset($_SESSION['arrayUsuarios'])){
				  include  '../Modelo/Usuario.class.php';
				  $array = array();
				  $array = unserialize($_SESSION['arrayUsuarios']);
					
				 
				  if(!empty($array)){
			?>
			
            <table summary="consulta de usuários" border="1">
            	<caption>Consulta de usuários</caption>

                <thead>
                	<tr>
                    	<th>código</th>
                    	<th>login</th>
                    	<th>senha</th>
                    	<th>tipo</th>
                	</tr>                    
                </thead>
                <tfoot>
                	<tr>
                    	<th>código</th>
                    	<th>login</th>
                    	<th>senha</th>
                    	<th>tipo</th>
                	</tr>                    
                </tfoot>
                
                <tbody>
                <?php
					foreach($array as $u){
	                	echo '<tr>';
						
echo '<td>'.
"<a href='../Controle/ControleUsuario.php?op=deletar&codigo=$u->idUsuario'> $u->idUsuario </a>"
	.'</td>';
							
	                    	echo '<td>'.$u->login.'</td>';
	                    	echo '<td>********</td>';
	                    	echo '<td>'.$u->tipo.'</td>';
	 	               	echo '</tr>'; 
					}
			    ?>
                </tbody>
            </table>
            
            <?php
            	  }else{
				  	echo '<p>nao ha dados cadastrados.</p>';
				  }
				}
			?>
            
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
<!-- end #footer -->
</body>
<!-- InstanceEnd --></html>
