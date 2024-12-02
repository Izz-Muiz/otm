<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$this->login();
	}

	public function login()
	{
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run()) {
			// get input data
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			// check username exists
			$user = $this->User_model->login($username);
			if ($user) {
				// check if password matches
				if (password_verify($password, $user->password)) {
					// create user session
					$this->session->set_userdata('logged_in', true);
					$this->session->set_userdata('user_id', $user->id);
					$this->session->set_userdata('username', $user->username);

					// redirect to dashboard
					redirect('dashboard');
				} else {
					$this->session->set_flashdata('errorLogin', 'Invalid Password. PLease try again.');
				}
			} else {
				$this->session->set_flashdata('errorLogin', 'User not found. Please check your username.');
			}
		}

		$data['validation_errors'] = validation_errors();

		$this->load->view('templates/auth/header');
		$this->load->view('auth/login', $data);
		$this->load->view('templates/auth/footer');
	}


	public function register()
	{

		$this->form_validation->set_rules(
			'username',
			'Username',
			'required|min_length[5]|max_length[12]|is_unique[users.username]',
			[
				'required'      => 'You have not provided %s.',
				'is_unique'     => 'This %s already exists.'
			]
		);
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirmPassword', 'Password Confirmation', 'required|matches[password]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

		if ($this->form_validation->run()) {
			// If validation is successful, register the user
			$data = [
				'username' => $this->input->post('username'),
				'email'    => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
			];

			$result = $this->User_model->register($data);

			if ($result == true) {
				$this->session->set_flashdata('successRegister', 'Registration successful! You can now log in.');
				redirect('auth/login');
			} else {
				$this->session->set_flashdata('errorRegister', 'Registration failed! Please try again.');
				redirect('auth/register');
			}
		}

		$data['validation_errors'] = validation_errors();

		$this->load->view('templates/auth/header');
		$this->load->view('auth/register', $data);
		$this->load->view('templates/auth/footer');
	}
}
