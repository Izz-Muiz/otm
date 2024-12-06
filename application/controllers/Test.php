<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{
	public function index()
	{
		$this->load->helper('bootstrap');
		$this->load->view('test/index');
	}

	public function update($id)
	{
		$data['form_action'] = $this->is_quran ? 'quran/subject_update_process' : 'subject/update_process';
		$type = $this->is_quran ? SUBJECT_QURAN : SUBJECT_EXAM;


		$this->db->select('id, org_id, code, name, grade_template_id, is_quran');
		$this->db->where('type', $type);
		//    $data['record']  = $this->one_model->get('subjects', $id);
		$data['record']  = $this->one_model->get('subjects', $id, [
			'org_id' => $this->session->org_id,
			'request_field' => 'id',
			'ignore_deleted' => false
		]);


		$this->smap_model->check_same_org($data['record']->org_id);


		$this->db->where('subject_id', $id);
		$data['id_program'] = $this->one_model->get_ref('programs_subjects', '', ['key' => 'program_id', 'value' => 'program_id']);
		$data['id_program'] = $this->one_model->get_ref('programs_subjects', '', ['key' => 'program_id', 'value' => 'program_id']);


		$this->db->select('id, name');
		$this->db->where('is_active', ACTIVE);
		$this->db->order_by('name', 'asc');
		$data['program_array'] = $this->one_model->get_all('programs');


		$data['grade_array'] = $this->one_model->get_ref('grade_templates', 'please_select');
		$data['is_tuition'] = $this->is_tuition;
		$data['is_quran'] = $this->is_quran;


		$this->template->set('title', ($this->is_quran ? lang('quran_type_title') : lang('lbl_subject')) . ' - ' . lang('title_update'));
		$this->template->load('template_main_2', 'subject/form', $data);
	}
}
