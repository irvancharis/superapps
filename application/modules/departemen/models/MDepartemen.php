<?php
defined('BASEPATH') or exit('No direct script access allowed');

use CodeIgniter\Model;
class MDepartemen extends CI_Model {

	public function get($id = null)
	{
		// $query = $this->db->query("SELECT * FROM tb_buku");
		$this->db->select('*');
		$this->db->from('SFA_DEPARTEMENT');
		if($id != null) {
			$this->db->where('ID_DEPARTEMENT', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function add($data)
	{
		$param = array(
			'ID_DEPARTEMENT' => $data['ID_DEPARTEMENT'],
			'NAMA_DEPARTEMENT' => $data['NAMA_DEPARTEMENT'],
		);
		$this->db->insert('SFA_DEPARTEMENT', $param);
	}
	
	public function edit($data)
	{
		$param = array(
			'ID_DEPARTEMENT' => $data['ID_DEPARTEMENT'],
			'NAMA_DEPARTEMENT' => $data['NAMA_DEPARTEMENT'],
		);
		$this->db->set($param);
		$this->db->where('ID_DEPARTEMENT', $data['ID_DEPARTEMENT']);
		$this->db->update('SFA_DEPARTEMENT');
	}

	public function del($id)
	{
		$this->db->where('ID_DEPARTEMENT', $id);
		$this->db->delete('SFA_DEPARTEMENT');
	}

}