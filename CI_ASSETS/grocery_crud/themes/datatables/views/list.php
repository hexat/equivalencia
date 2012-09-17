<script type="text/javascript">
$(function () {
	//CHECK ALL BOXES
	$('.checkall').click(function () {
		$(this).parents('table:eq(0)').find(':checkbox').attr('checked', this.checked);
	});
});
function delete_selected_new()
{
	
	var x = document.getElementById("disciplinas");
	var disciplinas = x.value;
	
	var list = "";
	var i = 0;
	$('input[type=checkbox]').each(function() { 
		
		if (this.checked) {
			list += this.value + '|';
			i++;
		}
	});

	//send data to delete
	if(i==0){
		alert('Selecione pelo menos uma disciplina');
	}else

	{
	$.post('http://localhost/code/index.php/sistema/confirma_equivalencia', {selection: list, disciplinas:disciplinas}, function (data) {
		document.write(data);
	});
	}
}
function delete_selected()
{
	
	var list = "";
	var i = 0;
	$('input[type=checkbox]').each(function() { 
		
		if (this.checked) {
			list += this.value + '|';
			i++;
		}
	});
	
	//send data to delete
	if(i==0){
		alert('Selecione pelo menos uma disciplina');
	}else
	{
	$.post('http://localhost/code/index.php/sistema/delete_selection', {selection: list}, function (data) {
		document.write(data);
	});
	}
}
</script>


<?php  
	if (!defined('BASEPATH')) exit('No direct script access allowed');
?><table cellpadding="0" cellspacing="0" border="0" class="display" id="groceryCrudTable">
	<thead>
		<tr>
			<th width="20px"><input type="checkbox" class="checkall" /></th>
			<?php foreach($columns as $column){?>
				<th><?php echo $column->display_as; ?></th>
			<?php }?>
			<?php if(!$unset_delete || !$unset_edit || !empty($actions)){?>
			<th class='actions'><?php echo $this->l('list_actions'); ?></th>
			<?php }?>
		</tr>
	</thead>
	<tbody>
		<?php foreach($list as $num_row => $row){ ?>  
		<?php
		$temp_string = $row->delete_url;
		$temp_string = explode("/", $temp_string);
		$row_num = sizeof($temp_string)-1;
		$rowID = $temp_string[$row_num];
		?>
		<tr id='row-<?php echo $num_row?>'>
			  <td><input type="checkbox" name="custom_delete" value="<?=$rowID?>" /></td>
			<?php foreach($columns as $column){?>
				<td><?php echo $row->{$column->field_name}?></td>
			<?php }?>
			<?php if(!$unset_delete || !$unset_edit || !empty($actions)){?>
			<td class='actions'>
				<?php 
				if(!empty($row->action_urls)){
					foreach($row->action_urls as $action_unique_id => $action_url){ 
						$action = $actions[$action_unique_id];
				?>
						<a href="<?php echo $action_url; ?>" class="edit_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button">
							<span class="ui-button-icon-primary ui-icon <?php echo $action->css_class; ?> <?php echo $action_unique_id;?>"></span><span class="ui-button-text">&nbsp;<?php echo $action->label?></span>
						</a>		
				<?php }
				}
				?>			
				<?php if(!$unset_edit){?>
					<a href="<?php echo $row->edit_url?>" class="edit_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button">
						<span class="ui-button-icon-primary ui-icon ui-icon-pencil"></span>
						<span class="ui-button-text">&nbsp;<?php echo $this->l('list_edit'); ?></span>
					</a>
				<?php }?>
				<?php if(!$unset_delete){?>
					<a onclick = "javascript: return delete_row('<?php echo $row->delete_url?>', '<?php echo $num_row?>')" 
						href="javascript:void(0)" class="delete_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button">
						<span class="ui-button-icon-primary ui-icon ui-icon-circle-minus"></span>
						<span class="ui-button-text">&nbsp;<?php echo $this->l('list_delete'); ?></span>
					</a>
				<?php }?>
			</td>
			<?php }?>
		</tr>
		<?php }?>
	</tbody>
</table>