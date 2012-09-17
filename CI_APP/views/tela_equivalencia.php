<head>
<link rel="stylesheet" href="http://localhost/code/assets/css/bootstrap.css">
<script src="http://localhost/code/assets/js/jquery.js"></script>
<script src="http://localhost/code/assets/js/bootstrap-modal.js"></script>

		<div class="menu">
			<ul>
				<li><a href="http://localhost/code/index.php/sistema/inicio">Início</a></li>
				<li><a href="http://localhost/code/index.php/sistema/exibir_disciplinas">Consultar/Cadastrar Disciplina Equivalente</a></li>
				<li><a href="http://localhost/code/index.php/sistema/cadastro_curso" id="linkEquivalencia">Consultar/Cadastrar Curso</a></li>
				<li><a href="validacao">Validação de Disciplinas</a></li>
				<li><a href="login">Sair</a></li>
			</ul>
			<br style="clear:left"/>
		</div>

</head>
		<div class="topo">
			<div>
				<img src="http://localhost/code/assets/pics/logo_ifce.png">
			</div>
			
			<div>
				<h1>Sistema de Equivalência e Validação</h1>
				<h2>Departamento de Telemática</h2>
				<h3>Consulta/Cadastro de Curso</h3>
			</div>
		</div>
		
		<div class="corpo2" onload="">	
			<form action="salva_curso"  method="POST" id="options">
				<div class="nomeCursoCadastro" id="codigo">
					<span class="label label-success">Nome do Curso: </span><br>
					<input type="text" name="curso" />
				</div>
	
				<div class="nomeFaculdadeCadastro">
					<span class="label label-success">Faculdade:</span><br>
					<input type="text" name="faculdade" />
				</div>
				
				<div class="sedeCadastro">
					<span class="label label-success">Sede:</span><br>
					<input type="text" name="sede" />
				</div>
			
				<div id="botao">
					<input type="submit" class="btn" value="Cadastrar Curso" />
				</div>
			</form>
		</div>	