<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ujian extends CI_Model
{

    public function countUjian()
    {
        $sql = "SELECT COUNT(*) AS jadwal FROM `a_jadwal`;";
        $query = $this->db->query($sql);
        return $query->row()->jadwal;
    }

    public function countUjianAKL()
    {
        $sql = "SELECT COUNT(*) AS ujian FROM `a_jadwal`
INNER JOIN a_mapel
on a_jadwal.id_mapel=a_mapel.id_mapel
WHERE a_mapel.nama_mapel LIKE '%AKL%';";
        $query = $this->db->query($sql);
        return $query->row()->ujian;
    }

    public function countUjianMPLB()
    {
        $sql = "SELECT COUNT(*) AS ujian FROM `a_jadwal`
INNER JOIN a_mapel
on a_jadwal.id_mapel=a_mapel.id_mapel
WHERE a_mapel.nama_mapel LIKE '%MPLB%';";
        $query = $this->db->query($sql);
        return $query->row()->ujian;
    }

    public function countUjianTJKT()
    {
        $sql = "SELECT COUNT(*) AS ujian FROM `a_jadwal`
INNER JOIN a_mapel
on a_jadwal.id_mapel=a_mapel.id_mapel
WHERE a_mapel.nama_mapel LIKE '%TJKT%';";
        $query = $this->db->query($sql);
        return $query->row()->ujian;
    }

    public function countUjianPM()
    {
        $sql = "SELECT COUNT(*) AS ujian FROM `a_jadwal`
INNER JOIN a_mapel
on a_jadwal.id_mapel=a_mapel.id_mapel
WHERE a_mapel.nama_mapel LIKE '%PM%' or a_mapel.nama_mapel LIKE '%DKV%';";
        $query = $this->db->query($sql);
        return $query->row()->ujian;
    }

    public function ujian_hari_ini_akl($tanggal)
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_mapel.id_mapel,a_mapel.id_kelas,a_mapel.nama_mapel,COUNT(*) AS jumlah_siswa,a_jadwal.tanggal_mulai,a_jadwal.waktu_mulai,a_jadwal.waktu_selesai FROM `a_jadwal`
INNER JOIN a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
INNER JOIN a_kelas
ON a_mapel.id_kelas=a_kelas.id
INNER JOIN a_siswa
on a_kelas.slug=a_siswa.kelas
WHERE a_jadwal.tanggal_mulai='$tanggal' AND a_mapel.nama_mapel LIKE '%akl%'
GROUP BY a_jadwal.id_jadwal;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function ujian_hari_ini_mplb($tanggal)
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_mapel.id_mapel,a_mapel.id_kelas,a_mapel.nama_mapel,COUNT(*) AS jumlah_siswa,a_jadwal.tanggal_mulai,a_jadwal.waktu_mulai,a_jadwal.waktu_selesai FROM `a_jadwal`
INNER JOIN a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
INNER JOIN a_kelas
ON a_mapel.id_kelas=a_kelas.id
INNER JOIN a_siswa
on a_kelas.slug=a_siswa.kelas
WHERE a_jadwal.tanggal_mulai='$tanggal' AND a_mapel.nama_mapel LIKE '%mplb%'
GROUP BY a_jadwal.id_jadwal;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function ujian_hari_ini_tjkt($tanggal)
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_mapel.id_mapel,a_mapel.id_kelas,a_mapel.nama_mapel,COUNT(*) AS jumlah_siswa,a_jadwal.tanggal_mulai,a_jadwal.waktu_mulai,a_jadwal.waktu_selesai FROM `a_jadwal`
INNER JOIN a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
INNER JOIN a_kelas
ON a_mapel.id_kelas=a_kelas.id
INNER JOIN a_siswa
on a_kelas.slug=a_siswa.kelas
WHERE a_jadwal.tanggal_mulai='$tanggal' AND a_mapel.nama_mapel LIKE '%tjkt%'
GROUP BY a_jadwal.id_jadwal;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function ujian_hari_ini_pm($tanggal)
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_mapel.id_mapel,a_mapel.id_kelas,a_mapel.nama_mapel,COUNT(*) AS jumlah_siswa,a_jadwal.tanggal_mulai,a_jadwal.waktu_mulai,a_jadwal.waktu_selesai FROM `a_jadwal`
INNER JOIN a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
INNER JOIN a_kelas
ON a_mapel.id_kelas=a_kelas.id
INNER JOIN a_siswa
on a_kelas.slug=a_siswa.kelas
WHERE a_jadwal.tanggal_mulai='$tanggal' AND (a_mapel.nama_mapel LIKE '%PM%' OR a_mapel.nama_mapel LIKE '%DKV%')
GROUP BY a_jadwal.id_jadwal;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function jadwalUjian()
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_mapel.nama_mapel,a_jadwal.tanggal_mulai,a_jadwal.waktu_mulai,a_jadwal.waktu_selesai,a_jadwal.durasi AS waktu
FROM `a_jadwal`
INNER join a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function jadwalUjianAKL()
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_mapel.nama_mapel,a_jadwal.tanggal_mulai,a_jadwal.waktu_mulai,a_jadwal.waktu_selesai,a_jadwal.durasi as waktu
FROM `a_jadwal`
INNER join a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
WHERE a_mapel.nama_mapel LIKE '%AKL%';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function jadwalUjianMPLB()
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_mapel.nama_mapel,a_jadwal.tanggal_mulai,a_jadwal.waktu_mulai,a_jadwal.waktu_selesai,a_jadwal.durasi as waktu
FROM `a_jadwal`
INNER join a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
WHERE a_mapel.nama_mapel LIKE '%MPLB%';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function jadwalUjianTJKT()
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_mapel.nama_mapel,a_jadwal.tanggal_mulai,a_jadwal.waktu_mulai,a_jadwal.waktu_selesai,a_jadwal.durasi as waktu
FROM `a_jadwal`
INNER join a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
WHERE a_mapel.nama_mapel LIKE '%TJKT%';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function jadwalUjianPM()
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_mapel.nama_mapel,a_jadwal.tanggal_mulai,a_jadwal.waktu_mulai,a_jadwal.waktu_selesai,a_jadwal.durasi as waktu
FROM `a_jadwal`
INNER join a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
WHERE a_mapel.nama_mapel LIKE '%PM%' OR a_mapel.nama_mapel LIKE '%DKV%';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function uploadSoalID($id_jadwal)
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_mapel.nama_mapel,a_kelas.kelas FROM `a_jadwal`
INNER JOIN a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
INNER JOIN a_kelas
ON a_mapel.id_kelas=a_kelas.id
WHERE a_jadwal.id_jadwal='$id_jadwal';";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function detail_soal($id_jadwal)
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_mapel.nama_mapel FROM `a_jadwal`
INNER JOIN a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
WHERE a_jadwal.id_jadwal='$id_jadwal';";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function data_soal($id_jadwal)
    {
        $sql = "SELECT * FROM `soal`
WHERE id_jadwal='$id_jadwal';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function data_jadwal_siswa($sess, $jadwal)
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_mapel.nama_mapel,a_jadwal.tanggal_mulai,a_jadwal.waktu_mulai FROM `a_jadwal`
INNER JOIN a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
INNER JOIN a_kelas
ON a_mapel.id_kelas=a_kelas.id
INNER JOIN a_siswa
ON a_kelas.slug=a_siswa.kelas
WHERE a_siswa.username='$sess' AND a_jadwal.tanggal_mulai='$jadwal';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function edit_jadwal_id($id_jadwal)
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_mapel.id_mapel,a_mapel.nama_mapel,a_jadwal.tanggal_mulai,a_jadwal.waktu_mulai,a_jadwal.waktu_selesai FROM a_jadwal
INNER JOIN a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
WHERE a_jadwal.id_jadwal='$id_jadwal';";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function header_ujian_id($id_jadwal, $sess)
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_siswa.nama_siswa,a_mapel.nama_mapel FROM `a_jadwal`
INNER JOIN a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
INNER JOIN a_kelas
ON a_mapel.id_kelas=a_kelas.id
INNER JOIN a_siswa
ON a_kelas.slug=a_siswa.kelas
WHERE a_jadwal.id_jadwal='$id_jadwal' AND a_siswa.username='$sess';";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function soal_ujian_id($id_jadwal, $sess)
    {
        $sql = "SELECT soal.soal,soal.pilA,soal.pilB,soal.pilC,soal.pilD,soal.pilE FROM `a_jadwal`
INNER JOIN a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
INNER JOIN a_kelas
ON a_mapel.id_kelas=a_kelas.id
INNER JOIN a_siswa
ON a_kelas.slug=a_siswa.kelas
INNER JOIN soal
ON a_jadwal.id_jadwal=soal.id_jadwal
WHERE a_jadwal.id_jadwal='$id_jadwal' AND a_siswa.username='$sess';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function simpanBankSoalTemp()
    {
        $sql = "SELECT bank_soal_temp.id_bank_soal_temp,bank_soal_temp.nama_bank_soal,IF(COUNT(bank_soal.id_bank_soal)>0,COUNT(*),0) as jumlah_soal FROM `bank_soal`
RIGHT JOIN bank_soal_temp
ON bank_soal.id_bank_soal_temp=bank_soal_temp.id_bank_soal_temp
GROUP BY bank_soal.id_bank_soal_temp;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function HeadersimpanBankSoalTemp($id_bank_soal)
    {
        $sql = "SELECT bank_soal.id_bank_soal,bank_soal.nama_bank_soal FROM `bank_soal`
WHERE bank_soal.id_bank_soal='$id_bank_soal';";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function namaBankSoal()
    {
        $sql = "SELECT bank_soal.id_bank_soal,bank_soal.nama_bank_soal,bank_soal.jurusan,IF(COUNT(*)>0,count(soal.soal),'0') AS jumlah_soal FROM `soal`
RIGHT JOIN bank_soal
ON bank_soal.id_bank_soal=soal.id_bank_soal
GROUP BY bank_soal.id_bank_soal;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function namaBankSoalAKL()
    {
        $sql = "SELECT bank_soal.id_bank_soal,bank_soal.nama_bank_soal,bank_soal.jurusan,IF(COUNT(*)>0,count(soal.soal),'0') AS jumlah_soal FROM `soal`
RIGHT JOIN bank_soal
ON bank_soal.id_bank_soal=soal.id_bank_soal
WHERE bank_soal.jurusan LIKE '%AKL%' OR bank_soal.jurusan LIKE '%UMUM%'
GROUP BY bank_soal.id_bank_soal;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function namaBankSoalMPLB()
    {
        $sql = "SELECT bank_soal.id_bank_soal,bank_soal.nama_bank_soal,bank_soal.jurusan,IF(COUNT(*)>0,count(soal.soal),'0') AS jumlah_soal FROM `soal`
RIGHT JOIN bank_soal
ON bank_soal.id_bank_soal=soal.id_bank_soal
WHERE bank_soal.jurusan LIKE '%MPLB%' OR bank_soal.jurusan LIKE '%UMUM%'
GROUP BY bank_soal.id_bank_soal;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function namaBankSoalTJKT()
    {
        $sql = "SELECT bank_soal.id_bank_soal,bank_soal.nama_bank_soal,bank_soal.jurusan,IF(COUNT(*)>0,count(soal.soal),'0') AS jumlah_soal FROM `soal`
RIGHT JOIN bank_soal
ON bank_soal.id_bank_soal=soal.id_bank_soal
WHERE bank_soal.jurusan LIKE '%TJKT%' OR bank_soal.jurusan LIKE '%UMUM%'
GROUP BY bank_soal.id_bank_soal;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function namaBankSoalPM()
    {
        $sql = "SELECT bank_soal.id_bank_soal,bank_soal.nama_bank_soal,bank_soal.jurusan,IF(COUNT(*)>0,count(soal.soal),'0') AS jumlah_soal FROM `soal`
RIGHT JOIN bank_soal
ON bank_soal.id_bank_soal=soal.id_bank_soal
WHERE bank_soal.jurusan LIKE '%PM%' OR bank_soal.jurusan LIKE '%DKV%'  OR bank_soal.jurusan LIKE '%UMUM%'
GROUP BY bank_soal.id_bank_soal;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function headerBankSoal($id_bank_soal)
    {
        $sql = "SELECT bank_soal.id_bank_soal,bank_soal.nama_bank_soal FROM `bank_soal`
WHERE bank_soal.id_bank_soal='$id_bank_soal';";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function detailBankSoal($id_bank_soal)
    {
        $sql = "SELECT soal.* FROM `soal`
INNER JOIN bank_soal
ON bank_soal.id_bank_soal=soal.id_bank_soal
WHERE bank_soal.id_bank_soal='$id_bank_soal';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function pilihBankSoal()
    {
        $sql = "SELECT bank_soal.id_bank_soal,bank_soal.nama_bank_soal,bank_soal.jurusan,count(bank_soal.id_bank_soal) AS jumlah_soal FROM `soal`
INNER JOIN bank_soal
ON bank_soal.id_bank_soal=soal.id_bank_soal
GROUP BY bank_soal.id_bank_soal;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function pilihBankSoalAKL()
    {
        $sql = "SELECT bank_soal.id_bank_soal,bank_soal.nama_bank_soal,bank_soal.jurusan,count(bank_soal.id_bank_soal) AS jumlah_soal FROM `soal`
INNER JOIN bank_soal
ON bank_soal.id_bank_soal=soal.id_bank_soal
WHERE bank_soal.jurusan LIKE '%AKL%' OR bank_soal.jurusan LIKE '%UMUM%'
GROUP BY bank_soal.id_bank_soal;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function pilihBankSoalMPLB()
    {
        $sql = "SELECT bank_soal.id_bank_soal,bank_soal.nama_bank_soal,bank_soal.jurusan,count(bank_soal.id_bank_soal) AS jumlah_soal FROM `soal`
INNER JOIN bank_soal
ON bank_soal.id_bank_soal=soal.id_bank_soal
WHERE bank_soal.jurusan LIKE '%MPLB%' OR bank_soal.jurusan LIKE '%UMUM%'
GROUP BY bank_soal.id_bank_soal;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function pilihBankSoalTJKT()
    {
        $sql = "SELECT bank_soal.id_bank_soal,bank_soal.nama_bank_soal,bank_soal.jurusan,count(bank_soal.id_bank_soal) AS jumlah_soal FROM `soal`
INNER JOIN bank_soal
ON bank_soal.id_bank_soal=soal.id_bank_soal
WHERE bank_soal.jurusan LIKE '%TJKT%' OR bank_soal.jurusan LIKE '%UMUM%'
GROUP BY bank_soal.id_bank_soal;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function jadwalSoal_bankSoal($id_jadwal)
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_jadwal.id_mapel,jadwal_soal.id_bank_soal,a_mapel.nama_mapel,
soal.soal,soal.pilA,soal.pilB,soal.pilC,soal.pilD,soal.pilE,soal.kunci,soal.gambar
FROM `jadwal_soal`
INNER JOIN a_jadwal
ON jadwal_soal.id_jadwal=a_jadwal.id_jadwal
INNER JOIN a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
INNER JOIN bank_soal
ON jadwal_soal.id_bank_soal=bank_soal.id_bank_soal
INNER JOIN soal
ON bank_soal.id_bank_soal=soal.id_bank_soal
WHERE a_jadwal.id_jadwal='$id_jadwal';";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function rekap_nilai_mapel()
    {
        $sql = "SELECT a_kelas.id,a_mapel.id_mapel,a_jadwal.id_jadwal,a_mapel.nama_mapel
FROM `siswa_jawab`
INNER JOIN soal
ON siswa_jawab.soal_id=soal.id_soal
INNER JOIN a_siswa
ON siswa_jawab.username=a_siswa.username
INNER JOIN a_kelas
ON a_siswa.kelas=a_kelas.slug
INNER JOIN a_mapel
ON a_mapel.id_kelas=a_kelas.id
INNER JOIN a_jadwal
ON a_jadwal.id_mapel=a_mapel.id_mapel
GROUP BY a_mapel.id_mapel;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function rekap_nilai_mapelAKL()
    {
        $sql = "SELECT a_kelas.id,a_mapel.id_mapel,a_jadwal.id_jadwal,a_mapel.nama_mapel
FROM `siswa_jawab`
INNER JOIN soal
ON siswa_jawab.soal_id=soal.id_soal
INNER JOIN a_siswa
ON siswa_jawab.username=a_siswa.username
INNER JOIN a_kelas
ON a_siswa.kelas=a_kelas.slug
INNER JOIN a_mapel
ON a_mapel.id_kelas=a_kelas.id
INNER JOIN a_jadwal
ON a_jadwal.id_mapel=a_mapel.id_mapel
WHERE a_mapel.nama_mapel LIKE '%AKL%'
GROUP BY a_mapel.id_mapel;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function rekap_nilai_mapelMPLB()
    {
        $sql = "SELECT a_kelas.id,a_mapel.id_mapel,a_jadwal.id_jadwal,a_mapel.nama_mapel
FROM `siswa_jawab`
INNER JOIN soal
ON siswa_jawab.soal_id=soal.id_soal
INNER JOIN a_siswa
ON siswa_jawab.username=a_siswa.username
INNER JOIN a_kelas
ON a_siswa.kelas=a_kelas.slug
INNER JOIN a_mapel
ON a_mapel.id_kelas=a_kelas.id
INNER JOIN a_jadwal
ON a_jadwal.id_mapel=a_mapel.id_mapel
WHERE a_mapel.nama_mapel LIKE '%MPLB%'
GROUP BY a_mapel.id_mapel;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function header_print_nilai($id_jadwal)
    {
        $sql = "SELECT a_kelas.id,a_mapel.id_mapel,a_jadwal.id_jadwal,a_mapel.nama_mapel
FROM `siswa_jawab`
INNER JOIN soal
ON siswa_jawab.soal_id=soal.id_soal
INNER JOIN a_siswa
ON siswa_jawab.username=a_siswa.username
INNER JOIN a_kelas
ON a_siswa.kelas=a_kelas.slug
INNER JOIN a_mapel
ON a_mapel.id_kelas=a_kelas.id
INNER JOIN a_jadwal
ON a_jadwal.id_mapel=a_mapel.id_mapel
WHERE a_jadwal.id_jadwal='$id_jadwal'
GROUP BY a_mapel.id_mapel;";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function print_nilai($id_jadwal)
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_siswa.username,a_siswa.nama_siswa,a_kelas.kelas,
SUM(CASE WHEN siswa_jawab.jawaban=soal.kunci THEN 1 ELSE 0 END) AS benar,
SUM(CASE WHEN siswa_jawab.jawaban=soal.kunci THEN 0 ELSE 1 END) AS salah,
COUNT(soal.soal)as jumlah_soal,
FLOOR(((SUM(CASE WHEN siswa_jawab.jawaban=soal.kunci THEN 1 ELSE 0 END))/(COUNT(*)))*100) as nilai
FROM `siswa_jawab`
INNER JOIN soal
ON siswa_jawab.soal_id=soal.id_soal
INNER JOIN a_siswa
ON siswa_jawab.username=a_siswa.username
INNER JOIN a_kelas
ON a_siswa.kelas=a_kelas.slug
INNER JOIN a_mapel
ON a_mapel.id_kelas=a_kelas.id
INNER JOIN a_jadwal
ON a_jadwal.id_mapel=a_mapel.id_mapel
WHERE a_jadwal.id_jadwal='$id_jadwal'
GROUP BY a_siswa.username;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function data_status_ujian($tanggal)
    {
        $sql = "SELECT a_jadwal.id_jadwal,a_mapel.id_mapel,a_mapel.id_kelas,a_mapel.nama_mapel,COUNT(*) AS jumlah_siswa,a_jadwal.tanggal_mulai,a_jadwal.waktu_mulai,a_jadwal.waktu_selesai FROM `a_jadwal`
INNER JOIN a_mapel
ON a_jadwal.id_mapel=a_mapel.id_mapel
INNER JOIN a_kelas
ON a_mapel.id_kelas=a_kelas.id
INNER JOIN a_siswa
on a_kelas.slug=a_siswa.kelas
WHERE a_jadwal.tanggal_mulai='$tanggal'
GROUP BY a_jadwal.id_jadwal;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    function simpan($data = array())
    {
        $jumlah = count($data);

        if ($jumlah > 0) {
            $this->db->insert_batch('soal', $data);
        }
    }

    // function simpanBankSoal($data = array())
    // {
    //     $jumlah = count($data);

    //     if ($jumlah > 0) {
    //         $this->db->insert_batch('soal', $data);
    //     }
    // }
}
