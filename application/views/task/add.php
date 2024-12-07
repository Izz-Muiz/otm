<div class="container">
	<div class="page-inner">
		<div class="page-header">
			<h3 class="fw-bold mb-3">Task Manager</h3>
			<ul class="breadcrumbs mb-3">
				<li class="nav-home"> <a href="#"> <i class="icon-home"></i> </a> </li>
				<li class="separator"> <i class="icon-arrow-right"></i> </li>
				<li class="nav-item"> <a href="#">Tasks</a> </li>
				<li class="separator"> <i class="icon-arrow-right"></i> </li>
				<li class="nav-item"> <a href="#">Add Task</a> </li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Add New Task</div>
					</div>
					<div class="card-body">
						<form method="post">
							<input type="hidden" name="user_id" value="<?= $this->session->userdata('user_id'); ?>">
							<div class="form-group">
								<label for="title">Task Title</label>
								<input type="text" class="form-control" id="title" placeholder="Enter Task Title" name="title">
								<div class="form-text text-danger">
									<?php echo form_error('title'); ?>
								</div>
							</div>

							<div class="form-group">
								<label for="description">Description</label>
								<textarea class="form-control" id="description" rows="3" placeholder="Enter Task Description" name="description"></textarea>
								<div class="form-text text-danger">
									<?php echo form_error('description'); ?>
								</div>
							</div>

							<div class="form-group">
								<label for="due_date">Due Date</label>
								<input type="date" class="form-control" id="due_date" name="due_date">
								<div class="form-text text-danger">
									<?php echo form_error('due_date'); ?>
								</div>
							</div>

							<div class="form-group">
								<label>Priority</label><br>
								<div class="form-text text-danger">
									<?php echo form_error('priority'); ?>
								</div>
								<?php foreach ($priority_options as $option => $label) : ?>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="priority" id="priority<?= $option; ?>" value="<?= $option; ?>">
										<label class="form-check-label" for="priority<?= $option ?>"><?= $label; ?></label>
									</div>
								<?php endforeach ?>
							</div>

							<div class="form-group">
								<label>Status</label><br>
								<div class="form-text text-danger">
									<?php echo form_error('status'); ?>
								</div>
								<?php foreach ($status_options as $option => $label) : ?>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="status" id="status<?= $option; ?>" value="<?= $option; ?>">
										<label class="form-check-label" for="status<?= $option ?>"><?= $label; ?></label>
									</div>
								<?php endforeach ?>
							</div>

							<div class="form-group">
								<label for="categorySelect">Category</label>
								<div class="form-text text-danger">
									<?php echo form_error('category'); ?>
								</div>
								<select class="form-select" id="categorySelect" name="category" required onchange="toggleCustomCategoryInput()">
									<option value="" disabled selected>Select Category</option>
									<?php foreach ($category_options as $value => $label): ?>
										<option value="<?php echo $value; ?>"><?php echo $label; ?></option>
									<?php endforeach; ?>
								</select>
								<br>
								<div id="customCategoryDiv" style="display: none;">
									<label for="customCategory">Custom Category</label>
									<input type="text" class="form-control" id="customCategory" name="customCategory" placeholder="Enter custom category">
								</div>
							</div>


							<div class="card-action mt-3">
								<button type="submit" class="btn btn-success">Save Task</button>
								<button type="button" class="btn btn-danger">Cancel</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function toggleCustomCategoryInput() {
		var categorySelect = document.getElementById('categorySelect');
		var customCategoryDiv = document.getElementById('customCategoryDiv');

		if (categorySelect.value === 'custom') {
			customCategoryDiv.style.display = 'block';
		} else {
			customCategoryDiv.style.display = 'none';
		}
	}
</script>
