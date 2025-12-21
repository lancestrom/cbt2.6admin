<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_mapel extends CI_Model
{
    public function countMapel()
    {
        $sql = "SELECT COUNT(*) AS mapel FROM `a_mapel`;";
        $query = $this->db->query($sql);
        return $query->row()->mapel;
    }

    public function dataMapel()
    {
        $sql = "SELECT * FROM `a_mapel`
INNER JOIN a_kelas
ON a_mapel.id_kelas=a_kelas.id
WHERE a_mapel.id_mapel NOT IN (SELECT a_jadwal.id_mapel FROM `a_jadwal`);";
        $query = $this->db->query($sql);
        return $query->result_array();
    }



    public function buat_mapel_jadwal($id_mapel)
    {
        $sql = "SELECT a_mapel.id_mapel,a_mapel.nama_mapel FROM `a_mapel`
WHERE a_mapel.id_mapel='$id_mapel';";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function simpan($data = array())
    {
        $jumlah = count($data);

        if ($jumlah > 0) {
            $this->db->insert_batch('a_mapel', $data);
        }
    }
}
