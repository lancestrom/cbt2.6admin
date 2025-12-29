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
        // $isi['ujian_hari_ini'] = $this->Model_ujian->ujian_hari_ini_akl();

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
        redirect('Dashboard/siswa_daftar_block');
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
