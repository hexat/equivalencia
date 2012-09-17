	<div class="mostraInformacoes">
			 <table class="table table-condensed">
				<tr>
					<td><b>Código</b></td></div>
					<td><b>Nome</b></td></div>
				</tr>
				<?php
				$total=(count($disciplinas,COUNT_RECURSIVE)-2)/2;
				for($i=0; $i<$total;$i++){
					echo "<tr>";
		
					echo "<td>";
					echo $disciplinas[0][$i];
					echo "</td>";
					
					echo "<td>";
					echo $disciplinas[1][$i];
					echo "</td>";
		
					echo "<td><i class='icon-search icon-remove' title='Deletar Disciplina'</i></td>";
					echo "<td><i class='icon-search icon-eye-open' title='Visualizar Inforações'></i></td>";
					echo "<td><i class='icon-search icon-wrench' title='Editar Disciplina'></i></td>";
	
					echo "</tr>";
					}
				?>
			</table>
		</div>