
				<div class="opcoesCurso">
					<span class="label label-success">Selecione um curso:</span><br>
					<select name "curso" id="curso" onclick="pegaInfo()">
					<?php
						$i=0;
						foreach($resultado2 as $valor)
						{
							echo "<option value=$i>$resultado2[$i]</option>";
							$i++;
						}
					?>
					</select>
				</div>
				
				

				<div class="botaoExibir">
					<input type="submit" value="Exibir Disciplinas" class="btn">
				</div>
			
			<?php 
			echo form_close() ?>
			</div>	