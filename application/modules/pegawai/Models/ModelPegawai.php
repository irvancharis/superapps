<?php
defined('BASEPATH') or exit('No direct script access allowed');

use CodeIgniter\Model;

class ModelPegawai extends CI_Controller
{
    protected $table = "pegawai";
    protected $primaryKey = "id";
    protected $allowedFields = ['nama', 'email', 'bidang', 'alamat'];

    function cari($katakunci)
    {
        $builder = $this->table("pegawai");
        $arr_katakunci = explode(" ", $katakunci);
        for ($x = 0; $x < count($arr_katakunci); $x++) {
            $builder->orLike('nama', $arr_katakunci[$x]);
            $builder->orLike('email', $arr_katakunci[$x]);
            $builder->orLike('alamat', $arr_katakunci[$x]);
        }
        return $builder;
    }
}
