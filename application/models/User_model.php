<?php

class User_model extends CI_Model
{
	public function register($data)
	{
		$username = strtolower($data['username']);
		$email = strtolower($data['email']);
		$password = $data['password'];

		//check username exist
		$this->db->where('username', $username);
		$query = $this->db->get('users');
		$this->db->where('email', $email);
		$query2 = $this->db->get('users');

		if ($query->num_rows() > 0) {
			return false;
		}
		if ($query2->num_rows() > 0) {
			return false;
		}

		// Insert user
		$this->db->insert('users', [
			'username' => $username,
			'email' => $email,
			'password' => $password
		]);

		return true;
	}

	public function login($username)
	{
		$this->db->where('username', $username);
		$query = $this->db->get('users');

		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
}
