		<?php  
		foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php endforeach; ?>
		<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
		<?php endforeach; ?>
 
			<div>
			</div>  
			<div>
				<?php echo $output; ?>
 
			</div>
			<?php
				if(isset($dropdown_setup)) {
				$this->load->view('dependent_dropdown', $dropdown_setup);
				}
			?>
	</body>
</html>
	
	

 