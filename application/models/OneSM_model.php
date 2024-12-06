<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class One_model extends CI_Model
{
  // IMPORTANT!! TO USE THIS MODEL, PLEASE MAKE SURE THE FOLLOWING
  // 1. primary key field must be named as "id" not "user_id"
  // 2. all table must have created_by, created_at, updated_by, updated_at, deleted_by, deleted_at
  // 3.
  //
  // If multitenant, please change the org_id to co_id or whatever key to differentiate tenant
  // in insert, get, get_all etc. search for org_id

  // this features not yet available.
  // need to update in delete and select
  private $soft_delete = false;
  private $auto_timestamp = true; // must prepare created_at and updated_at in table

  public function __construct()
  {
      parent::__construct();
  }

  // Return one row or if fieldname is set, return only one field
  public function get($table, $id, $primaryfield="id", $fieldname=null, $options = array())
  {
    // if multi tenant
    if (isset($this->session->org_id)) {
      if ($this->db->field_exists('org_id', $table)){
        $org_id_field = $table.'.org_id';
        $this->db->where($org_id_field, $this->session->org_id);
      }
    }

    //get only active sessions based on session
    if (isset($this->session->sessions)) {
      if ($this->db->field_exists('sessions', $table)){
        $sessions_field = $table.'.sessions';
        $this->db->where($sessions_field, $this->session->sessions);
      }
    }

    // if soft delete enabled
    if (!isset($options['ignore_deleted'])) {
        if ($this->db->field_exists('deleted_at', $table)){
            $this->db->where($table . '.deleted_at is null'); // check not deleted
        }
    }

    $this->db->where($primaryfield,$id);
    if (isset($options['lock_row']) && ($options['lock_row'] == TRUE)) { // lock row use function FOR UPDATE
        $this->db->from($table);
        $query = $this->db->get_compiled_select();
        $q = $this->db->query($query . ' FOR UPDATE');
    } else {
        $q = $this->db->get($table);
    }

    if($q !== FALSE && $q->num_rows() > 0)
    {
      if(is_null($fieldname)){
          return $q->row();
      }
      else {
          return $q->row($fieldname);
      }
    }
    return false;
  }

  // options can be org_id, sessions, deleted_at not null etc
  public function get2($table, $id, $primaryfield="id", $fieldname=null, $options = array())
  {
    // if soft delete enabled
    if (!isset($options['ignore_deleted'])) {
        if ($this->db->field_exists('deleted_at', $table)){
            $this->db->where($table . '.deleted_at is null'); // check not deleted
        }
    }

      $this->db->where($primaryfield,$id);
      if (isset($options['lock_row']) && ($options['lock_row'] == TRUE)) { // lock row use function FOR UPDATE
        $this->db->from($table);
        $query = $this->db->get_compiled_select();
        $q = $this->db->query($query . ' FOR UPDATE');
      } else {
        $q = $this->db->get($table);
      }

      if($q !== FALSE && $q->num_rows() > 0)
      {
        if(is_null($fieldname)){
            return $q->row();
        }
        else {
            return $q->row($fieldname);
        }
      }
      return false;
  }

  // Return all records in the table
  public function get_all($table, $options = array())
  {
    // if multi tenant
    if ($this->db->field_exists('org_id', $table)){
      $org_id_field = $table.'.org_id';
      $this->db->where($org_id_field, $this->session->org_id);
    }

    //get only active sessions based on session
    if (isset($this->session->sessions)) {
      if ($this->db->field_exists('sessions', $table)){
        $sessions_field = $table.'.sessions';
        $this->db->where($sessions_field, $this->session->sessions);
      }
    }

    // if soft delete enabled
    if (!isset($options['ignore_deleted'])) {
        if ($this->db->field_exists('deleted_at', $table)){
            $this->db->where($table . '.deleted_at is null'); // check not deleted
        }
    }

    $q = $this->db->get($table);
    if($q !== FALSE && $q->num_rows() > 0)
    {
        return $q->result();
    }
    return array();
  }

  public function get_all_basic($table, $options = array())
  {
    // if soft delete enabled
    if (!isset($options['ignore_deleted'])) {
        if ($this->db->field_exists('deleted_at', $table)){
            $this->db->where($table . '.deleted_at is null'); // check not deleted
        }
    }

    $q = $this->db->get($table);
    if($q !== FALSE && $q->num_rows() > 0)
    {
        return $q->result();
    }
    return array();
  }

  public function get_ref($table, $dropdown=false, $options=array())
  {
    // value for array key
    if (isset($options['key'])) {
      $key = $options['key'];
    } else {
      $key = "id";
    }

    // value for array value (element)
    if (isset($options['value'])) {
      $value = $options['value'];
    } else {
      $value = "name";
    }

    // if multitenant
    if ($this->db->field_exists('org_id', $table)){
      if (isset($options['org_id'])) {
        $org_id = $options['org_id'];
      } else {
        $org_id = $this->session->org_id;
      }
      if ($org_id > 0) {
        $this->db->where($table.'.org_id', $org_id);
      }
    }

    // if soft delete enabled
    if (!isset($options['ignore_deleted'])) {
        if ($this->db->field_exists('deleted_at', $table)){
            $this->db->where($table . '.deleted_at is null'); // check not deleted
        }
    }
    $order_value = ($this->db->field_exists($value, $table)) ? $table.'.'.$value :$value; // cater for join query

    $this->db->select("$key,$value");
    $order_value = ($this->db->field_exists($value, $table)) ? $table.'.'.$value : $value; // cater for join query

    $this->db->from($table);
    $this->db->order_by($order_value);
    $result = $this->db->get();

    // set if the ref is dropdown, set the default dropdown
    $array = array();
    if ($dropdown) {
      if ($dropdown == 'please_select') {
        $array = array('' => lang('lbl_please_select'));
      }
      elseif ($dropdown == 'all') {
        $array = array('' => lang('lbl_all'));
      }
      elseif ($dropdown == 'exact') {
      }
      else {
        // $array[0] = '';
        // $array[''] = '';
        // $array[0] = $dropdown;
        $array[''] = $dropdown;
      }
    }

    // loop to fill up the ref in an array and return the earray
    if($result !== FALSE && $result->num_rows() > 0) {
        foreach($result->result_array() as $row) {
        $array[$row[$key]] = $row[$value];
        }
    }
    return $array;
  }

  public function insert($table,$data)
  {
    // if multi tenant
    if ($this->db->field_exists('org_id', $table) && !isset($data['org_id'])){
        $data['org_id'] = $this->session->org_id;
    }

    $data['created_at'] = date('Y-m-d H:i:s');
    $data['created_by'] = isset($data['created_by']) ? $data['created_by'] : $this->session->user_id;
    $this->db->insert($table, $data);
    $id = $this->db->insert_id();

    return $id;
  }

  public function update($table, $data, $id, $primaryfield="id")
  {
    $data['updated_at'] = date('Y-m-d H:i:s');
    $data['updated_by'] = $this->session->user_id;
    $this->db->where($primaryfield, $id);
    $q = $this->db->update($table, $data);

    return $q;
  }

  public function delete($table,$id,$primaryfield="id", $soft_delete = FALSE)
  {
    if ($soft_delete) {
      $data['deleted_at'] = date('Y-m-d H:i:s');
      $data['deleted_by'] = $this->session->user_id;
      $this->update($table,$data,$id,$primaryfield);
    } else {
      $this->db->where($primaryfield,$id);
        $this->db->delete($table);
    }
  }

  public function is_exist($value, $tabletocheck, $fieldtocheck)
  {
    $this->db->select($fieldtocheck);
    $this->db->where($fieldtocheck,$value);
    $result = $this->db->get($tabletocheck);

    if($result !== FALSE && $result->num_rows() > 0) {
        return true;
    }
    else {
        return false;
    }
  }

  // use to generate secure_id at one go for tables that use secure_id
  public function generate_secure_id($table)
  {
    $sql = "update $table
      set secure_id = concat(id, FLOOR(100 + (RAND() * 899)))
      where secure_id is null";
    $this->db->query($sql);
  }

  // generate doc number. currently to use in generating doc no in bulk for invoices
  public function generate_doc_no($doc_type)
  {
    if ($doc_type == 'invoices') {
      $sql = "update invoices
      set doc_no = concat('IV',id)
      where doc_no is null";
    }
    $this->db->query($sql);
  }

    public function insert_batch($table, $data_array)
    {
        $has_org_id = $this->db->field_exists('org_id', $table);

        $insert_array = array();

        foreach ($data_array as $data) {

            if ($has_org_id && !isset($data['org_id'])) {
                $data['org_id'] = $this->session->org_id;
            }

            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->session->user_id;

            $insert_array[] = $data;
        }

        if (!empty($insert_array)) {
            $this->db->insert_batch($table, $insert_array);
        }
    }

    public function update_batch($table, $data_array, $update_id)
    {
        $update_array = array();

        foreach ($data_array as $data) {

            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_by'] = $this->session->user_id;

            $update_array[] = $data;
        }

        if (!empty($update_array)) {
            $this->db->update_batch($table, $update_array, $update_id);
        }
    }
}
