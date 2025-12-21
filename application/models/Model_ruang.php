<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ruang extends CI_Model
{


    public function dataRuang()
    {
        $sql = "SELECT *,COUNT(*) AS jumlah_siswa FROM `a_ruang`
                INNER JOIN a_siswa
                ON a_ruang.id_ruang=a_siswa.ruangan
                GROUP BY a_ruang.id_ruang;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
