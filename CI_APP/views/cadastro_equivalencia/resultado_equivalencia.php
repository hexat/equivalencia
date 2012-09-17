
<?php 
echo form_open("sistema/faz_equivalencia");
echo form_hidden("DInternas",$codInternas);
echo form_hidden("DExternas",$codExternas);
?>	
	
	<div style="position: absolute; top:25%; left: 8%;">
		<h3>Você deseja confirmar a seguinte equivalencia?</h3>
	</div>

	<div style="position: absolute; top:35%; left: 12%">
		<h2>Disciplinas do IFCE</h2>
	</div>
	
<div style="position: absolute; top:40%; left:12%">
<h3>
<?php
	foreach($internas as $valor){
		echo $valor."<br>";
	}
?>
</h3>
</div>
	<div style="position: absolute; top:60%; left: 12%">
		<h2>Disciplinas Externas</h2>
	</div>

<div style="position: absolute; top:65%; left:12%">
		<h3>	
		<?php
			foreach($externas as $valor){
				echo $valor."<br>";
			}
		?>
		</h3>
</div>


<div style="position: absolute;top:27%; left:88% ">
	<?php 
		echo form_submit("mysubmit","Confirmar equivalencia","class='btn btn-success'");
	?>
</div>

<?php 
echo form_close();
?>

<?php 
echo form_open("sistema/segunda_parte");
echo form_hidden("discilinas",$codInternas);
?>	

<div style="position: absolute;top:27%; left:83% ">
	<?php 
		echo form_submit("mysubmit","Voltar","class='btn btn-danger'");
	?>
</div>

<?php 
echo form_close();
?>

