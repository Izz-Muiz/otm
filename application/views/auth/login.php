<h1>INI Auth/login</h1>
<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success">
		<?php echo $this->session->flashdata('success'); ?>
	</div>
<?php endif; ?>
