	<div class="container">
		<div class="page-inner">
			<div
				class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
				<div>
					<h3 class="fw-bold mb-3">Dashboard</h3>
					<h6 class="op-7 mb-2">Welcome to your dashboard, <strong><?= $username ?></strong></h6>
				</div>
				<div class="ms-md-auto py-2 py-md-0">
					<a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
					<a href="<?= base_url('task/add') ?>" class="btn btn-primary btn-round">Add Task</a>
				</div>
			</div>
		</div>
		<!-- Main Content -->
		<main class="ms-5 me-5">

			<!-- Task Statistics -->
			<div class="row">
				<div class="col-sm-6 col-md-4">
					<div class="card card-stats card-primary card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="fas fa-users"></i>
									</div>
								</div>
								<div class="col-7 col-stats">
									<div class="numbers">
										<p class="card-category">Total Tasks</p>
										<h4 class="card-title"><?= $total_tasks; ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="card card-stats card-info card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="fas fa-user-check"></i>
									</div>
								</div>
								<div class="col-7 col-stats">
									<div class="numbers">
										<p class="card-category">Pending Tasks</p>
										<h4 class="card-title"><?= $pending_tasks; ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="card card-stats card-success card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="fas fa-chart-pie"></i>
									</div>
								</div>
								<div class="col-7 col-stats">
									<div class="numbers">
										<p class="card-category">Completed Tasks</p>
										<h4 class="card-title"><?= $completed_tasks; ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Task List -->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Basic</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table
									id="basic-datatables"
									class="display table table-striped table-hover">
									<thead>
										<tr>
											<th>Task</th>
											<th>Due Date</th>
											<th>Priority</th>
											<th>Status</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php if (!empty($tasks)): ?>
											<?php foreach ($tasks as $task): ?>
												<tr>
													<td><?= $task['title']; ?></td>
													<td><?= $task['due_date']; ?></td>
													<td>
														<?= $priority_levels[$task['priority']]; ?>
													</td>
													<td>
														<?= $status_labels[$task['status']]; ?>
													</td>
													<td>
														<a href="<?= site_url('task/edit/' . $task['id']); ?>" class="btn btn-sm btn-primary">Edit</a>
														<a href="<?= site_url('task/delete/' . $task['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
													</td>
												</tr>
											<?php endforeach; ?>
										<?php else: ?>
											<tr>
												<td colspan="5" class="text-center">No tasks available.</td>
											</tr>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

		</main>
	</div>
	</div>
	</div>
	</div>
	</div>
