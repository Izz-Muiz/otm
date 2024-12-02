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
						<form>
							<div class="form-group">
								<label for="taskTitle">Task Title</label>
								<input type="text" class="form-control" id="taskTitle" placeholder="Enter Task Title" required>
							</div>

							<div class="form-group">
								<label for="taskDescription">Description</label>
								<textarea class="form-control" id="taskDescription" rows="3" placeholder="Enter Task Description" required></textarea>
							</div>

							<div class="form-group">
								<label for="dueDate">Due Date</label>
								<input type="date" class="form-control" id="dueDate" required>
							</div>

							<div class="form-group">
								<label>Priority</label><br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="priority" id="priorityLow" value="low">
									<label class="form-check-label" for="priorityLow">Low</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="priority" id="priorityMedium" value="medium" checked>
									<label class="form-check-label" for="priorityMedium">Medium</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="priority" id="priorityHigh" value="high">
									<label class="form-check-label" for="priorityHigh">High</label>
								</div>
							</div>

							<div class="form-group">
								<label>Status</label><br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="statusPending" value="pending" checked>
									<label class="form-check-label" for="statusPending">Pending</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="statusCompleted" value="completed">
									<label class="form-check-label" for="statusCompleted">Completed</label>
								</div>
							</div>

							<div class="form-group">
								<label for="categorySelect">Category</label>
								<select class="form-select" id="categorySelect" required>
									<option value="" disabled selected>Select Category</option>
									<option value="work">Work</option>
									<option value="personal">Personal</option>
									<option value="custom">Custom</option>
								</select>
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
