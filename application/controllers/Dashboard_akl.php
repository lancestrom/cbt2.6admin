<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_akl extends CI_Controller
{


    public function index()
    {
        $this->Model_keamanan->getKeamanan();
        // $isi['admin'] = $this->db->get_where('auth', ['username' => $this->session->userdata('username')])->row_array();
        $isi['siswa'] = $this->Model_siswa->countSiswaAKL();
        $isi['kelas'] = $this->Model_kelas->countKelasAKL();
        $isi['ujian'] = $this->Model_ujian->countUjianAKL();
        $isi['mapel'] = $this->Model_mapel->countMapelAKL();

        $tanggal = date('Y-m-d');
        $isi['ujian_hari_ini'] = $this->Model_ujian->ujian_hari_ini_akl($tanggal);

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'AKL/tampilan_home';
        $this->load->view('templates/header', $isi2);
        $this->load->view('AKL/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function mata_pelajaran_akl()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['data_mapel_akl'] = $this->Model_mapel->dataMapelAKL();

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'AKL/tampilan_mata_pelajaran_akl';
        $this->load->view('templates/header', $isi2);
        $this->load->view('AKL/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function siswa_akl()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['data_siswa'] = $this->Model_siswa->dataSiswaAKL();

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'AKL/tampilan_siswa_akl';
        $this->load->view('templates/header', $isi2);
        $this->load->view('AKL/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function siswa_block()
    {
        $data = array(
            'id' => $this->input->post('id'),
            'no_peserta' => $this->input->post('no_peserta'),
            'nama_siswa' => $this->input->post('nama_siswa'),
            'kelas' => $this->input->post('kelas'),
            'jurusan' => $this->input->post('jurusan'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'level' => $this->input->post('level'),
            'status' => 0,
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('a_siswa', $data);
        redirect('Dashboard_akl/siswa_akl');
    }

    public function siswa_akl_block()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['data_siswa'] = $this->Model_siswa->dataSiswaAKLBlock();

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'AKL/tampilan_siswa_akl_block';
        $this->load->view('templates/header', $isi2);
        $this->load->view('AKL/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function siswa_buka_block()
    {
        $data = array(
            'id' => $this->input->post('id'),
            'no_peserta' => $this->input->post('no_peserta'),
            'nama_siswa' => $this->input->post('nama_siswa'),
            'kelas' => $this->input->post('kelas'),
            'jurusan' => $this->input->post('jurusan'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'level' => $this->input->post('level'),
            'status' => 1,
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('a_siswa', $data);
        redirect('Dashboard_akl/siswa_akl_block');
    }

    public function mata_pelajaran()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['mapel'] = $this->Model_mapel->dataMapelAKL();


        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'AKL/tampilan_mata_pelajaran';
        $this->load->view('templates/header', $isi2);
        $this->load->view('AKL/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function buat_mapel_jadwal($id_mapel)
    {
        $this->Model_keamanan->getKeamanan();
        $isi['mapel'] = $this->Model_mapel->buat_mapel_jadwal($id_mapel);


        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'AKL/Ujian/tampilan_buat_jadwal';
        $this->load->view('templates/header', $isi2);
        $this->load->view('AKL/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function simpan_jadwal()
    {
        $this->Model_keamanan->getKeamanan();

        $data = array(
            'id_jadwal' => rand(11111111, 99999999),
            'id_mapel' => $this->input->post('id_mapel', TRUE),
            'tanggal_mulai' => $this->input->post('tanggal_mulai', TRUE),
            'waktu_mulai' => $this->input->post('waktu_mulai', TRUE),
            'waktu_selesai' => $this->input->post('waktu_selesai', TRUE)
        );

        $this->db->insert('a_jadwal', $data);
        $this->session->set_flashdata('pesan', '<div class="row">
        <div class="col-md mt-2">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Jadwal Berhasil Di Tambah</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        </div>
        </div>');
        redirect('Dashboard_akl/mata_pelajaran');
    }




    public function jadwal_ujian_akl()
    {
        $this->Model_keamanan->getKeamanan();

        $isi['ujian_akl'] = $this->Model_ujian->jadwalUjianAKL();

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'AKL/Ujian/tampilan_ujain';
        $this->load->view('templates/header', $isi2);
        $this->load->view('AKL/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function status_peserta_akl()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['status'] = $this->Model_ujian->statusPesertaAKL();

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'AKL/Ujian/tampilan_status_peserta';
        $this->load->view('templates/header', $isi2);
        $this->load->view('AKL/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function filter_status_peserta()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['status'] = $this->Model_ujian->FilterstatusPesertaAKL();


        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'AKL/Ujian/filter_tampilan_status_peserta';
        $this->load->view('templates/header', $isi2);
        $this->load->view('AKL/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function rekap_nilai_akl()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['rekap_akl'] = $this->Model_ujian->rekap_nilai_akl();

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'AKL/Ujian/tampilan_rekap_nilai';
        $this->load->view('templates/header', $isi2);
        $this->load->view('AKL/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function print_nilai_akl($id_course)
    {
        $this->Model_keamanan->getKeamanan();
        $isi['header'] = $this->Model_ujian->print_nilai_header($id_course);
        $isi['rekap'] = $this->Model_ujian->print_nilai_rekap($id_course);

        $isi2['title'] = 'CBT | Administrator';
        $this->load->view('Ujian/tampilan_print_nilai', $isi);
    }
}
