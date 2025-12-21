<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_kelas extends CI_Model
{
    public function countKelas()
    {
        $sql = "SELECT count(*) AS kelas FROM `a_kelas`";
        $query = $this->db->query($sql);
        return $query->row()->kelas;
    }

    public function countKelasAKL()
    {
        $sql = "SELECT count(*) AS kelas_akl FROM `a_kelas`
                WHERE kelas LIKE '%AKL%'";
        $query = $this->db->query($sql);
        return $query->row()->kelas_akl;
    }

    public function countKelasBDP()
    {
        $sql = "SELECT count(*) AS kelas_bdp FROM `a_kelas`
                WHERE kelas LIKE '%pm%'";
        $query = $this->db->query($sql);
        return $query->row()->kelas_bdp;
    }

    public function countKelasOTKP()
    {
        $sql = "SELECT count(*) AS kelas_otkp FROM `a_kelas`
                WHERE kelas LIKE '%MPLB%'";
        $query = $this->db->query($sql);
        return $query->row()->kelas_otkp;
    }

    public function countKelasTKJ()
    {
        $sql = "SELECT count(*) AS kelas_tkj FROM `a_kelas`
                WHERE kelas LIKE '%TJKT%'";
        $query = $this->db->query($sql);
        return $query->row()->kelas_tkj;
    }

    public function countKelasDKV()
    {
        $sql = "SELECT count(*) AS kelas_dkv FROM `a_kelas`
                WHERE kelas LIKE '%DKV%'";
        $query = $this->db->query($sql);
        return $query->row()->kelas_dkv;
    }

    public function dataKelasMaster()
    {
        $sql = "SELECT  a_kelas.id AS id_kelas,a_kelas.*,a_jurusan.* FROM `a_kelas`
                INNER JOIN a_jurusan
                ON a_kelas.kode=a_jurusan.kode;;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function dataKelas()
    {
        $sql = "SELECT a_kelas.id AS id_kelas,a_jurusan.id,a_kelas.kelas,a_jurusan.jurusan,COUNT(a_siswa.nama_siswa) AS jumlah_siswa FROM a_kelas
INNER JOIN a_siswa
ON a_kelas.id=a_siswa.kelas
INNER JOIN a_jurusan
ON a_kelas.kode=a_jurusan.kode
GROUP BY a_jurusan.id,a_kelas.id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function simpan($data = array())
    {
        $jumlah = count($data);

        if ($jumlah > 0) {
            $this->db->insert_batch('a_kelas', $data);
        }
    }
}
