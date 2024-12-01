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
		$this->load->view('auth/login');
	}

	public function login()
	{
		$this->load->view('auth/login');
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
				$this->session->set_flashdata('success', 'Registration successful! You can now log in.');
				redirect('auth/login');
			} else {
				$this->session->set_flashdata('error', 'Registration failed! Please try again.');
				redirect('auth/register');
			}
		}

		$data['validation_errors'] = validation_errors();

		$this->load->view('templates/header');
		$this->load->view('auth/register', $data);
		$this->load->view('templates/footer');
	}
}
