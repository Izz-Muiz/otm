<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('profile/index');
		$this->load->view('templates/footer');
	}
}
