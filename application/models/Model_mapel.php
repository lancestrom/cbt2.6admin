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

    public function countMapelAKL()
    {
        $sql = "SELECT COUNT(*) AS mapel FROM `a_mapel`
WHERE a_mapel.nama_mapel LIKE '%AKL%';";
        $query = $this->db->query($sql);
        return $query->row()->mapel;
    }

    public function countMapelMPLB()
    {
        $sql = "SELECT COUNT(*) AS mapel FROM `a_mapel`
WHERE a_mapel.nama_mapel LIKE '%MPLB%';";
        $query = $this->db->query($sql);
        return $query->row()->mapel;
    }

    public function countMapelTJKT()
    {
        $sql = "SELECT COUNT(*) AS mapel FROM `a_mapel`
WHERE a_mapel.nama_mapel LIKE '%TJKT%';";
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

    public function dataMapelAKL()
    {
        $sql = "SELECT a_mapel.id_mapel,a_kelas.kelas,a_mapel.nama_mapel FROM `a_mapel`
INNER JOIN a_kelas
ON a_mapel.id_kelas=a_kelas.id
WHERE a_mapel.id_mapel NOT IN (SELECT a_jadwal.id_mapel FROM `a_jadwal`) AND a_mapel.nama_mapel LIKE '%akl%';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function dataMapelMPLB()
    {
        $sql = "SELECT a_mapel.id_mapel,a_kelas.kelas,a_mapel.nama_mapel FROM `a_mapel`
INNER JOIN a_kelas
ON a_mapel.id_kelas=a_kelas.id
WHERE a_mapel.id_mapel NOT IN (SELECT a_jadwal.id_mapel FROM `a_jadwal`) AND a_mapel.nama_mapel LIKE '%mplb%';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function dataMapelTJKT()
    {
        $sql = "SELECT a_mapel.id_mapel,a_kelas.kelas,a_mapel.nama_mapel FROM `a_mapel`
INNER JOIN a_kelas
ON a_mapel.id_kelas=a_kelas.id
WHERE a_mapel.id_mapel NOT IN (SELECT a_jadwal.id_mapel FROM `a_jadwal`) AND a_mapel.nama_mapel LIKE '%tjkt%';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function dataMapelPM_DKV()
    {
        $sql = "SELECT a_mapel.id_mapel,a_kelas.kelas,a_mapel.nama_mapel FROM `a_mapel`
INNER JOIN a_kelas
ON a_mapel.id_kelas=a_kelas.id
WHERE a_mapel.id_mapel NOT IN (SELECT a_jadwal.id_mapel FROM `a_jadwal`) AND a_mapel.nama_mapel LIKE '%pm_dkv%';";
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
