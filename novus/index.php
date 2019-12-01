<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/modelo.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Keyborad by FCT</title>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
<link href="estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="wrapper">
	<div id="header-wrapper">
		<div id="banner">
			<div class="content"><img src="imagens/img02.jpg" width="1000" height="140" alt="" /></div>
		</div>
	</div>
	<!-- end #header -->
	
	<div id="page">
		<div id="content">
		</div>
		<!-- end #content -->
        <?php
        	if(!isset($_SESSION['privateUser'])){
        ?>
		<form name="formlogin" id="formlogin" action="Controle/ControleAcesso.php?op=logar" method="post">
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
