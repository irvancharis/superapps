<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_SETTING');
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        $data['setting'] = $this->M_SETTING->get_setting();
        $this->load->view('layout/navbar') .
            $this->load->view('layout/sidebar', $data) .
            $this->load->view('setting', $data);
    }

    public function update()
    {
        // Hapus seluruh blok validasi
        $data = array(
            'GM' => $this->input->post('gm'),
            'HEAD' => $this->input->post('head'),
            'TOKEN_WA' => $this->input->post('token_wa')
        );

        if ($this->M_SETTING->update_setting($data)) {
            $this->session->set_flashdata('success', 'Data setting berhasil diperbarui');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data setting');
        }

        redirect('setting');
    }
}
