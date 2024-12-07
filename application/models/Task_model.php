<?php

class Task_model extends CI_Model
{
	public function getAllTasks($id)
	{
		$this->db->where('user_id', $id);
		$query = $this->db->get('tasks');
		return $query->result_array();
	}

	public function getTaskCount($id, $status)
	{
		$this->db->where('status', $status);
		$this->db->where('user_id', $id);
		$query = $this->db->get('tasks');
		return $query->num_rows();
	}

	public function addTask($data)
	{
		return $this->db->insert('tasks', $data);
	}
	public function updateTask($id) {}
}
