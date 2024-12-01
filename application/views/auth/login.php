<style>
	body {
		background-color: #f4f4f4;
		/* Light background color */
	}

	.card {
		width: 500px;
		padding: 15px;
	}
</style>

<div class="container d-flex justify-content-center align-items-center vh-100">
	<div class="card">
		<div class="card-header">
			<h1>Login</h1>
		</div>
		<?php if ($this->session->flashdata('successRegister')): ?>
			<div class="alert alert-success mt-3">
				<?php echo $this->session->flashdata('successRegister'); ?>
			</div>
		<?php endif; ?>
		<?php if ($this->session->flashdata('errorLogin')): ?>
			<div class="alert alert-danger mt-3">
				<?php echo $this->session->flashdata('errorLogin'); ?>
			</div>
		<?php endif; ?>
		<div class="card-body">
			<form action="" method="POST">
				<div class="mb-3">
					<label for="username" class="form-label">Username</label>
					<input type="text" class="form-control" id="username" name="username">
					<div class="form-text text-danger">
						<?php echo form_error('username'); ?>
					</div>
				</div>
				<div class="mb-3">
					<label for="password" class="form-label">Password</label>
					<input type="password" class="form-control" id="password" name="password">
					<div class="form-text text-danger">
						<?php echo form_error('password'); ?>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Login</button>
				<p class="form-text">Don't have an account? <a href="<?php echo site_url('auth/register'); ?>">Register here</a></p>
			</form>
		</div>
	</div>
</div>
