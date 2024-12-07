<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Task extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Task_model');
		$this->load->library('form_validation');
	}
	public function add()
	{

		$data['priority_options'] = [
			1 => 'Low',
			2 => 'Medium',
			3 => 'High'
		];

		$data['status_options'] = [
			1 => 'Pending',
			2 => 'Completed'
		];

		$data['category_options'] = [
			'work' => 'Work',
			'personal' => 'Personal',
			'custom' => 'Custom'
		];

		//set validation rules
		$this->form_validation->set_rules('title', 'Task Title', 'required');
		$this->form_validation->set_rules('description', 'Description', '');
		$this->form_validation->set_rules('due_date', 'Due Date', '');
		$this->form_validation->set_rules('priority', 'Priority', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');

		if ($this->form_validation->run() == TRUE) {

			// Validation successfull. Save task
			$data = [
				'user_id' => $this->input->post('user_id'),
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'due_date' => $this->input->post('due_date'),
				'priority' => $this->input->post('priority'),
				'status' => $this->input->post('status'),
				'category' => strtolower($this->input->post('category') === 'custom' ? $this->input->post('customCategory') : $this->input->post('category'))
			];

			$this->Task_model->addTask($data);
			redirect('dashboard');
		}

		$this->load->view('templates/header');
		$this->load->view('task/add', $data);
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		$this->load->view('task/edit');
	}
}
