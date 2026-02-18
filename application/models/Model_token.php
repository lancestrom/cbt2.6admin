<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_token extends CI_Model
{


    public function dataToken()
    {
        $sql = "SELECT * FROM `token_keluar`";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function dataTokenMasuk()
    {
        $sql = "SELECT * FROM `token_masuk`";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
