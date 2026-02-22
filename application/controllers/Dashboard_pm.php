<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/spout/src/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Dashboard_pm extends CI_Controller
{


    public function index()
    {
        $this->Model_keamanan->getKeamanan();
        // $isi['admin'] = $this->db->get_where('auth', ['username' => $this->session->userdata('username')])->row_array();
        $isi['siswa'] = $this->Model_siswa->countSiswaPM();
        $isi['kelas'] = $this->Model_kelas->countKelasPM();
        $isi['ujian'] = $this->Model_ujian->countUjianPM();
        $isi['mapel'] = $this->Model_mapel->countMapelPM();

        $tanggal = date('Y-m-d');
        $isi['ujian_hari_ini'] = $this->Model_ujian->ujian_hari_ini_pm($tanggal);

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'PM/tampilan_home';
        $this->load->view('templates/header', $isi2);
        $this->load->view('PM/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function siswa_pm()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['data_siswa'] = $this->Model_siswa->dataSiswaPM();

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'PM/tampilan_siswa_pm';
        $this->load->view('templates/header', $isi2);
        $this->load->view('PM/tampilan_dashboard', $isi);
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
        redirect('Dashboard_pm/siswa_pm');
    }

    public function siswa_pm_block()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['data_siswa'] = $this->Model_siswa->dataSiswaPMBlock();

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'PM/tampilan_siswa_pm_block';
        $this->load->view('templates/header', $isi2);
        $this->load->view('PM/tampilan_dashboard', $isi);
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
        redirect('Dashboard_pm/siswa_pm_block');
    }

    public function mata_pelajaran()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['mapel'] = $this->Model_mapel->dataMapelPM();


        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'PM/tampilan_mata_pelajaran';
        $this->load->view('templates/header', $isi2);
        $this->load->view('PM/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function buat_mapel_jadwal($id_mapel)
    {
        $this->Model_keamanan->getKeamanan();
        $isi['mapel'] = $this->Model_mapel->buat_mapel_jadwal($id_mapel);


        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'PM/Ujian/tampilan_buat_jadwal';
        $this->load->view('templates/header', $isi2);
        $this->load->view('PM/tampilan_dashboard', $isi);
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
            'waktu_selesai' => $this->input->post('waktu_selesai', TRUE),
            'durasi' => $this->input->post('durasi', true)
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
        redirect('Dashboard_pm/mata_pelajaran');
    }




    public function jadwal_ujian_pm()
    {
        $this->Model_keamanan->getKeamanan();

        $isi['ujian'] = $this->Model_ujian->jadwalUjianPM();

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'PM/Ujian/tampilan_ujian';
        $this->load->view('templates/header', $isi2);
        $this->load->view('PM/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function edit_jadwal($id_jadwal)
    {
        $this->Model_keamanan->getKeamanan();
        $isi['mapel'] = $this->Model_ujian->edit_jadwal_id($id_jadwal);

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'PM/Ujian/tampilan_edit_jadwal';
        $this->load->view('templates/header', $isi2);
        $this->load->view('PM/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function simpan_edit_jadwal()
    {
        $this->Model_keamanan->getKeamanan();

        $id_jadwal = $this->input->post('id_jadwal', TRUE);
        $id_mapel = $this->input->post('id_mapel', TRUE);
        $tanggal_mulai = $this->input->post('tanggal_mulai', TRUE);
        $waktu_mulai = $this->input->post('waktu_mulai', TRUE);
        $waktu_selesal = $this->input->post('waktu_selesai', TRUE);
        $durasi = $this->input->post('durasi', TRUE);
        $data = array(
            'id_jadwal' =>  $id_jadwal,
            'id_mapel' => $id_mapel,
            'tanggal_mulai' => $tanggal_mulai,
            'waktu_mulai' => $waktu_mulai,
            'waktu_selesai' => $waktu_selesal,
            'durasi' => $durasi
        );

        $this->db->where('id_jadwal', $id_jadwal);
        $this->db->update('a_jadwal', $data);
        redirect('Dashboard_pm/jadwal_ujian_pm');
    }

    public function pilih_soal($id_jadwal)
    {
        $this->Model_keamanan->getKeamanan();
        $isi['ujian'] = $this->Model_ujian->uploadSoalID($id_jadwal);
        $isi['bank_soal'] = $this->Model_ujian->pilihBankSoalPM();

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'PM/Ujian/tampilan_pilih_soal';
        $this->load->view('templates/header', $isi2);
        $this->load->view('PM/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function simpan_pilih_soal()
    {
        $id_jadwal_soal = rand(11111111, 99999999);
        $id_jadwal = $this->input->post_get('id_jadwal');
        $id_bank_soal = $this->input->post_get('id_bank_soal');

        $data = array(
            'id_jadwal_soal' => $id_jadwal_soal,
            'id_jadwal ' => $id_jadwal,
            'id_bank_soal' => $id_bank_soal
        );

        $this->db->insert('jadwal_soal', $data);
        $this->session->set_flashdata('pesan', '<div class="row">
        <div class="col-md mt-2">
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>Jadwal Soal Berhasil Di Tambah</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        </div>
        </div>');

        redirect('Dashboard_pm/jadwal_ujian_pm');
    }

    public function detail_jadwal_soal($id_jadwal)
    {
        $this->Model_keamanan->getKeamanan();
        $isi['ujian'] = $this->Model_ujian->uploadSoalID($id_jadwal);
        $isi['jadwal_soal'] = $this->Model_ujian->jadwalSoal_bankSoal($id_jadwal);

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'PM/Ujian/tampilan_detail_jadwal_soal';
        $this->load->view('templates/header', $isi2);
        $this->load->view('PM/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function bank_soal()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['bank_soal'] = $this->Model_ujian->namaBankSoalPM();

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'PM/Ujian/tampilan_bank_soal';
        $this->load->view('templates/header', $isi2);
        $this->load->view('PM/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function hapus_banksoal($id_bank_soal_temp)
    {
        $this->Model_keamanan->getKeamanan();

        $this->db->where('id_bank_soal', $id_bank_soal_temp);
        $this->db->delete('bank_soal');

        $this->db->where('id_bank_soal', $id_bank_soal_temp);
        $this->db->delete('soal');


        $this->session->set_flashdata('pesan', '<div class="row">
        <div class="col-md mt-2">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Bank Soal Berhasil Di Hapus</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        </div>
        </div>');
        redirect('Dashboard_pm/bank_soal');
    }

    public function simpan_bank_soal()
    {
        $this->Model_keamanan->getKeamanan();

        $data = array(
            'id_bank_soal' => rand(111111, 999999),
            'nama_bank_soal' => $this->input->post('nama_bank_soal', TRUE),
            'jurusan' => $this->input->post('jurusan', TRUE)
        );

        $this->db->insert('bank_soal', $data);
        $this->session->set_flashdata('pesan', '<div class="row">
        <div class="col-md mt-2">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Bank Soal Berhasil Di Tambah</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        </div>
        </div>');
        redirect('Dashboard_pm/bank_soal');
    }

    public function upload_banksoal($id_bank_soal_temp)
    {
        $this->Model_keamanan->getKeamanan();
        $isi['header'] = $this->Model_ujian->HeadersimpanBankSoalTemp($id_bank_soal_temp);

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'PM/Ujian/tampilan_bank_soal_upload';
        $this->load->view('templates/header', $isi2);
        $this->load->view('PM/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function upload_bank_soal()
    {
        // protect the upload endpoint
        if ($this->input->post('submit', TRUE) == 'upload') {
            $config['upload_path']      = './temp_doc/';
            $config['allowed_types']    = 'xlsx|xls';
            $config['file_name']        = 'doc' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('excel')) {
                $file   = $this->upload->data();

                $reader = ReaderEntityFactory::createXLSXReader();
                $reader->open('temp_doc/' . $file['file_name']);


                foreach ($reader->getSheetIterator() as $sheet) {
                    $numRow = 1;
                    $save   = array();
                    $id_random = rand(11111111, 99999999);
                    foreach ($sheet->getRowIterator() as $row) {

                        if ($numRow > 1) {

                            $cells = $row->getCells();

                            // Extract cell values safely (cast to string and trim)
                            $data = array(
                                'id_soal'   => $cells[0],
                                'id_bank_soal' => $cells[1],
                                'soal'      => $cells[2],
                                'pilA'       => $cells[3],
                                'pilB'       => $cells[4],
                                'pilC'       => $cells[5],
                                'pilD'       => $cells[6],
                                'pilE'       => $cells[7],
                                'kunci'     => $cells[8],
                                'gambar'     => $cells[9],
                            );
                            array_push($save, $data);
                        }
                        $numRow++;
                    }
                    $this->Model_ujian->simpan($save);
                    $reader->close();

                    unlink('temp_doc/' . $file['file_name']);
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success">Soal berhasil diunggah</div>');
                    redirect('Dashboard_pm/bank_soal');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Upload error: ' . strip_tags($this->upload->display_errors()) . '</div>');
                redirect('Dashboard_pm/bank_soal');
            }
        }
    }

    public function detail_banksoal($id_bank_soal)
    {
        $this->Model_keamanan->getKeamanan();
        $isi['header'] = $this->Model_ujian->headerBankSoal($id_bank_soal);
        $isi['soal'] = $this->Model_ujian->detailBankSoal($id_bank_soal);

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'PM//Ujian/tampilan_detail_bank_soal';
        $this->load->view('templates/header', $isi2);
        $this->load->view('PM/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function status_peserta()
    {
        $this->Model_keamanan->getKeamanan();
        // $isi['ujian'] = $this->Model_ujian->uploadSoalID($id_jadwal);
        $isi['rekap'] = $this->Model_ujian->data_status_pesertaPM();

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'PM/Ujian/tampilan_status_peserta';
        $this->load->view('templates/header', $isi2);
        $this->load->view('PM/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function rekap_nilai()
    {
        $this->Model_keamanan->getKeamanan();
        // $isi['ujian'] = $this->Model_ujian->uploadSoalID($id_jadwal);
        $isi['rekap'] = $this->Model_ujian->rekap_nilai_mapelPM();

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'PM/Ujian/tampilan_rekap_nilai';
        $this->load->view('templates/header', $isi2);
        $this->load->view('PM/tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }
}
