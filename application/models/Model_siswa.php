<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_siswa extends CI_Model
{
    public function countSiswa()
    {
        $sql = "SELECT COUNT(*) as siswa FROM `a_siswa`";
        $query = $this->db->query($sql);
        return $query->row()->siswa;
    }

    public function countSiswaAKL()
    {
        $sql = "SELECT COUNT(*) AS jumlah_siswa FROM `a_siswa`
WHERE jurusan='akl';";
        $query = $this->db->query($sql);
        return $query->row()->jumlah_siswa;
    }

    public function countSiswaMPLB()
    {
        $sql = "SELECT COUNT(*) AS jumlah_siswa FROM `a_siswa`
WHERE jurusan='mplb';";
        $query = $this->db->query($sql);
        return $query->row()->jumlah_siswa;
    }

    public function countSiswaTJKT()
    {
        $sql = "SELECT COUNT(*) AS jumlah_siswa FROM `a_siswa`
WHERE jurusan='tjkt';";
        $query = $this->db->query($sql);
        return $query->row()->jumlah_siswa;
    }

    public function countSiswaPM()
    {
        $sql = "SELECT COUNT(*) AS jumlah_siswa FROM `a_siswa`
WHERE jurusan='PM' OR jurusan='DKV';";
        $query = $this->db->query($sql);
        return $query->row()->jumlah_siswa;
    }

    public function dataSiswaByTingkat($tingkat)
    {
        $sql = "SELECT a_kelas.kelas,count(a_siswa.nama_siswa) AS jumlah_siswa FROM a_kelas
INNER JOIN a_siswa
ON a_kelas.slug=a_siswa.kelas
WHERE a_kelas.kelas LIKE '%$tingkat %'
GROUP BY a_siswa.kelas;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function dataSiswaX()
    {
        return $this->dataSiswaByTingkat('X');
    }

    public function dataSiswaXI()
    {
        return $this->dataSiswaByTingkat('XI');
    }

    public function dataSiswaXII()
    {
        return $this->dataSiswaByTingkat('XII');
    }

    public function dataSiswa()
    {
        $sql = "SELECT * FROM `a_siswa`
WHERE a_siswa.status='1';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function dataSiswaAKL()
    {
        $sql = "SELECT * FROM `a_siswa`
WHERE jurusan='AKL' AND STATUS='1';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function dataSiswaMPLB()
    {
        $sql = "SELECT * FROM `a_siswa`
WHERE jurusan='MPLB' AND STATUS='1';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function dataSiswaTJKT()
    {
        $sql = "SELECT * FROM `a_siswa`
WHERE jurusan='TJKT' AND STATUS='1';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function dataSiswaPM()
    {
        $sql = "SELECT * FROM `a_siswa`
WHERE jurusan='PM' or jurusan='DKV'  AND STATUS='1';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function dataSiswaAKLBlock()
    {
        $sql = "SELECT * FROM `a_siswa`
WHERE jurusan='AKL' AND STATUS='0';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function dataSiswaMPLBBlock()
    {
        $sql = "SELECT * FROM `a_siswa`
WHERE jurusan='MPLB' AND STATUS='0';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function dataSiswaTJKTBlock()
    {
        $sql = "SELECT * FROM `a_siswa`
WHERE jurusan='TJKT' AND STATUS='0';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function dataSiswaPMBlock()
    {
        $sql = "SELECT * FROM `a_siswa`
WHERE status='0';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function dataSiswaBlock()
    {
        $sql = "SELECT * FROM `a_siswa`
WHERE a_siswa.status='0';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function dataSiswaID($sess)
    {
        $sql = "SELECT a_siswa.id,a_siswa.nama_siswa,a_kelas.kelas,a_siswa.username,a_siswa.password,a_siswa.level FROM `a_siswa`
INNER JOIN a_kelas
ON a_siswa.kelas=a_kelas.slug
WHERE a_siswa.username='$sess';";
        $query = $this->db->query($sql);
        return $query->row_array();
    }



    function simpanSiswa($data = array())
    {
        $jumlah = count($data);

        if ($jumlah > 0) {
            $this->db->insert_batch('a_siswa', $data);
        }
    }
}
