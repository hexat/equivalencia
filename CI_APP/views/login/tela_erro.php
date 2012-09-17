<html>
<head>

<title>Programa de Disciplinas Equivalentes</title>

<link rel="stylesheet" href="http://localhost/code/assets/css/bootstrap.css">

</head>
<div class="menuLogin">
	<ul>
		<li><a>Sistema de Equivalência e Validação</a></li>
		<li><a>Departamento de Telemática</a></li>

	</ul>
	<br style="clear:left"/>
</div>

<body>

  <div id="logoLogin">
	  <center><img src='http://localhost/code/assets/pics/ITCE.JPG'></center>
  </div>
	
  <div class="loginConteudo">
  
		<form action="fazer_login" method="POST"  class="well"><center>
				<input type="radio" name="option" value="0" checked> Administrador
				<input type="radio" name="option" value="1"> Coordenador
				<input type="radio" name="option" value="2"> Bolsista<br><br>
				
				<label>Usuário</label>
				<input type="text" class="span3" name="login">
				<label>Senha</label>
				<input type="password" class="span3" name="senha">
				<br>
				
				<b><font color="red"> Login ou Senha incorretos. Tente novamente</font><br><b>
				<button type="submit" class="btn">Entrar</button></center>
		</form>
  </div>
  
</body>

<footer>
     <address><center>
		<b><i>Instituto Federal de Educação, Ciência e Tecnologia do Ceará</i><br>
        <i>Reitoria:</b> R. José Lourenço, 3000 - Joaquim Távora CEP: 60115-282 Fone: (85) 3401.2300 Fax: (85) 3401.2323</i> <br>
        <i><b>Campus Fortaleza:</b> Av. Treze de Maio, 2081 - Benfica CEP: 60040-531 - Fortaleza - CE Fone: (85) 3307.3666 Fax: (85) 3307.3711</i>
     </center></address>
</footer>
</html>