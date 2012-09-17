

<div style="position: absolute; left:8%">
	<h3>Você escolheu as seguintes disciplinas, clique em continuar para confirmar sua escolha</h3>
</div>


<div style="position: relative; left:8%;top:10%;">
	<h3>
	<?php
		$disciplinas = explode ("|", $data);
		$conta = count($disciplinas);
		for ($i=0;$i<$conta;$i++)
		{
			$this->db->select('nome');
			$this->db->from('disciplina');
			$this->db->where('codigo',$disciplinas[$i]);
			$query = $this->db->get();
			foreach ($query->result() as $row)
			{
				echo $row->nome."<br>";
			}
		}
?>
</h3>
</div>


<div style="position:absolute;left: 70%;top:32%;">
	<button name="mybutton" type="button" onclick="location.reload()" class="btn btn-danger">Voltar</button>
</div>

<div style="position: absolute; left: 76%; top:32%">
	<?php
		echo form_open('sistema/segunda_parte');
		echo form_hidden('discilinas',$data);
		$atributos = 'class="btn btn-success" id="botaoContinuar"' ;
		echo form_submit('mysubmit','Continuar',$atributos);
		echo form_close();
		?>
</div>

