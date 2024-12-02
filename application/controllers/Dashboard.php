<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function index()
	{
		$this->load->model('Task_model');
		$user_id = $this->session->userdata('user_id');
		$data['username'] = $this->session->userdata('username');
		$data['tasks'] = $this->Task_model->getAllTasks($user_id);
		$data['total_tasks'] = count($data['tasks']);
		$data['pending_tasks'] = $this->Task_model->getTaskCount($user_id, 1); // Status 1 = Pending
		$data['completed_tasks'] = $this->Task_model->getTaskCount($user_id, 2); // Status 2 = Completed

		// Priority and Status Labels
		$data['priority_levels'] = [1 => 'Low', 2 => 'Medium', 3 => 'High'];
		$data['status_labels'] = [1 => 'Pending', 2 => 'Completed'];

		$this->load->view('templates/header', $data);
		$this->load->view('dashboard/index', $data);
		$this->load->view('templates/footer');
	}
}
