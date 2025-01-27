<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use CodeIgniter\Model;
class Departemen extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MDepartemen', 'departemen');
	}

	public function index()
	{
		$query = $this->departemen->get();
		$data = array(
				'header' => 'Tampil departemen',
				'departemen' => $query->result(),
			);

		$this->load->view('layout/header.php');
		$this->load->view('layout/menu.php');
		$this->load->view('departemen_tampil',$data);
		$this->load->view('layout/footer.php');
	}

	public function add()
	{
		$data = array(
				'header' => 'Tambah departemen'
			);
			$this->load->view('layout/header.php');
			$this->load->view('layout/menu.php');
			$this->load->view('departemen_tambah');
			$this->load->view('layout/footer.php');
	}

	public function edit($id = null)
	{
		$query = $this->departemen->get($id);
		$data = array(
				'header' => 'Edit departemen',
				'departemen' => $query->row()
			);

		$this->load->view('layout/header.php');
		$this->load->view('layout/menu.php');
		$this->load->view('departemen_edit',$data);
		$this->load->view('layout/footer.php');
		
	}

	public function proses()
	{
		if(isset($_POST['add'])) {
			$inputan = $this->input->post(null, TRUE);
			$this->departemen->add($inputan);
		} else if(isset($_POST['edit'])) {
			$inputan = $this->input->post(null, TRUE);
			$this->departemen->edit($inputan);
		}
		redirect('departemen');
	}

	public function del($id)
	{
		$this->departemen->del($id);
		redirect('departemen');
	}

}
