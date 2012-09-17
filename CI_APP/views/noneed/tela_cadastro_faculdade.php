		<?php 
			$atributos = array('class' => 'formulario', 'id' => 'formulario');
			echo form_open('sistema/exibir_disciplinas', $atributos) ?>
			
			<div class="corpo">
				<div class="opcoesFaculdade">
				<span class="label label-success">Selecione uma Universidade:</span><br>
					<select id ="faculdade" name="faculdade"  onChange="httpGet(formaUrl());">
					<option value="faculdade"> </option>
					<?php
						$i=0;
						foreach($resultado as $valor)
						{
							echo "<option value=$i>$resultado[$i]</option>";
							$i++;
						}
					?>
					
					</select>
				</div>
			<input type=hidden name="nomefacul" id="nomefaculdade" value="">
			<input type=hidden name="nomecurso" id="nomecurso" value="">
		
			
			