<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Task extends CI_Controller
{
	public function add()
	{
		$this->load->view('templates/header');
		$this->load->view('task/add');
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		$this->load->view('task/edit');
	}
}
