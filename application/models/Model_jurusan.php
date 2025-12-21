<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_jurusan extends CI_Model
{
    public function countJurusan()
    {
        $sql = 'SELECT COUNT(*) AS jurusan FROM `a_jurusan`';
        $query = $this->db->query($sql);
        return $query->row()->jurusan;
    }

    public function dataJurusan()
    {
        $sql = "SELECT * FROM `a_jurusan`";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
