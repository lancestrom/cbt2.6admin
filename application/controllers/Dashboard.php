<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/spout/src/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;


class Dashboard extends CI_Controller
{


    public function index()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['jurusan'] = $this->Model_jurusan->countJurusan();
        $isi['siswa'] = $this->Model_siswa->countSiswa();

        $isi['kelas'] = $this->Model_kelas->countKelas();
        $isi['mapel'] = $this->Model_mapel->countMapel();
        $isi['ujian'] = $this->Model_ujian->countUjian();

        // Kelas
        $isi['x'] = $this->Model_siswa->dataSiswaX();
        $isi['xi'] = $this->Model_siswa->dataSiswaXI();
        $isi['xii'] = $this->Model_siswa->dataSiswaXII();

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'tampilan_home';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
        $this->load->view('templates/footer', $isi);
    }

    public function jurusan()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['jurusan'] = $this->Model_jurusan->dataJurusan();


        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'tampilan_jurusan';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function kelas()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['kelas'] = $this->Model_kelas->dataKelasMaster();


        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'tampilan_kelas';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function hapus_all_kelas()
    {
        $this->Model_keamanan->getKeamanan();
        $this->db->empty_table('a_kelas');

        redirect('Dashboard/kelas');
    }

    public function upload_kelas()
    {
        $this->Model_keamanan->getKeamanan();
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
                    foreach ($sheet->getRowIterator() as $row) {

                        if ($numRow > 1) {

                            $cells = $row->getCells();

                            $data = array(
                                'id'   => isset($cells[0]) ? trim((string)$cells[0]->getValue()) : null,
                                'kode' => isset($cells[1]) ? trim((string)$cells[1]->getValue()) : null,
                                'kelas' => isset($cells[2]) ? trim((string)$cells[2]->getValue()) : null,
                                'slug' => isset($cells[3]) ? trim((string)$cells[3]->getValue()) : null
                            );
                            array_push($save, $data);
                        }
                        $numRow++;
                    }
                    $this->Model_kelas->simpan($save);
                    $reader->close();
                    $tmpPath = 'temp_doc/' . $file['file_name'];
                    if (is_file($tmpPath)) {
                        @unlink($tmpPath);
                    }
                    $this->session->set_flashdata('pesan', 'Data Kelas Berhasil Ditambahkan');
                    redirect('Dashboard/kelas');
                }
            } else {
                $this->session->set_flashdata('pesan', 'Data Kelas Gagal Ditambahkan');
                redirect('Dashboard/kelas');
            }
        }
    }

    public function mata_pelajaran()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['mapel'] = $this->Model_mapel->dataMapel();


        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'tampilan_mata_pelajaran';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function buat_mapel_jadwal($id_mapel)
    {
        $this->Model_keamanan->getKeamanan();
        $isi['mapel'] = $this->Model_mapel->buat_mapel_jadwal($id_mapel);


        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'Master/tampilan_buat_jadwal';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
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
        redirect('Dashboard/mata_pelajaran');
    }



    public function hapus_all_mata_pelajaran()
    {
        $this->Model_keamanan->getKeamanan();
        $this->db->empty_table('a_mapel');
        $this->db->empty_table('a_jadwal');
        $this->db->empty_table('soal');
        $this->db->empty_table('bank_soal');
        $this->db->empty_table('jadwal_soal');
        $this->db->empty_table('siswa_jawab');

        $this->session->set_flashdata('pesan', '<div class="row">
        <div class="col-md mt-2">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data Mapel Ujian Berhasil Di Hapus</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        </div>
        </div>');
        redirect('Dashboard/mata_pelajaran');
    }

    public function upload_mata_peajaran()
    {
        $this->Model_keamanan->getKeamanan();
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
                    foreach ($sheet->getRowIterator() as $row) {

                        if ($numRow > 1) {

                            $cells = $row->getCells();

                            $data = array(
                                'id_mapel'  => isset($cells[0]) ? trim((string)$cells[0]->getValue()) : null,
                                'id_kelas'  => isset($cells[1]) ? trim((string)$cells[1]->getValue()) : null,
                                'nama_mapel' => isset($cells[2]) ? trim((string)$cells[2]->getValue()) : null
                            );
                            array_push($save, $data);
                        }
                        $numRow++;
                    }
                    $this->Model_mapel->simpan($save);
                    $reader->close();
                    $tmpPath = 'temp_doc/' . $file['file_name'];
                    if (is_file($tmpPath)) {
                        @unlink($tmpPath);
                    }
                    $this->session->set_flashdata(
                        'pesan',
                        '<div class="row">
        <div class="col-md mt-2">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Mapel Ujian Berhasil Di Upload</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        </div>
        </div>'
                    );
                    redirect('Dashboard/mata_pelajaran');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Upload error: ' . strip_tags($this->upload->display_errors()) . '</div>');
                redirect('Dashboard/mata_pelajaran');
            }
        }
    }


    public function siswa()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['siswa'] = $this->Model_siswa->dataSiswa();


        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'tampilan_siswa';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
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
        redirect('Dashboard/siswa');
    }

    public function siswa_daftar_block()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['siswa'] = $this->Model_siswa->dataSiswaBlock();


        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'tampilan_siswa_daftar_block';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
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
        redirect('Dashboard/siswa_daftar_block');
    }



    public function hapus_all_peserta_ujian()
    {
        $this->Model_keamanan->getKeamanan();
        $this->db->empty_table('a_siswa');
        $this->session->set_flashdata('info', '<div class="row">
        <div class="col-md mt-2">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data Peserta Ujian Berhasil Di Hapus</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        </div>
        </div>');
        redirect('Dashboard/siswa');
    }

    public function upload_peserta_ujian()
    {
        $this->Model_keamanan->getKeamanan();
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
                    foreach ($sheet->getRowIterator() as $row) {

                        if ($numRow > 1) {

                            $cells = $row->getCells();

                            $data = array(
                                'id'          => isset($cells[0]) ? trim((string)$cells[0]->getValue()) : null,
                                'no_peserta'  => isset($cells[1]) ? trim((string)$cells[1]->getValue()) : null,
                                'nama_siswa'  => isset($cells[2]) ? trim((string)$cells[2]->getValue()) : null,
                                'kelas'       => isset($cells[3]) ? trim((string)$cells[3]->getValue()) : null,
                                'jurusan'     => isset($cells[4]) ? trim((string)$cells[4]->getValue()) : null,
                                'username'    => isset($cells[5]) ? trim((string)$cells[5]->getValue()) : null,
                                'password'    => isset($cells[6]) ? trim((string)$cells[6]->getValue()) : null,
                                'level'    => isset($cells[7]) ? trim((string)$cells[7]->getValue()) : null,
                                'status'    => isset($cells[8]) ? trim((string)$cells[8]->getValue()) : null,
                            );
                            array_push($save, $data);
                        }
                        $numRow++;
                    }
                    $this->Model_siswa->simpanSiswa($save);
                    $reader->close();
                    $tmpPath = 'temp_doc/' . $file['file_name'];
                    if (is_file($tmpPath)) {
                        @unlink($tmpPath);
                    }
                    $this->session->set_flashdata('info', '<div class="alert alert-success">Data Peserta Ujian Berhasil Ditambahkan</div>');
                    redirect('Dashboard/siswa');
                }
            } else {
                $this->session->set_flashdata('info', '<div class="alert alert-danger">Upload error: ' . strip_tags($this->upload->display_errors()) . '</div>');
                redirect('Dashboard/siswa');
            }
        }
    }

    public function jadwal_ujian()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['ujian'] = $this->Model_ujian->jadwalUjian();



        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'Master/tampilan_ujian';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function pilih_soal($id_jadwal)
    {
        $this->Model_keamanan->getKeamanan();
        $isi['ujian'] = $this->Model_ujian->uploadSoalID($id_jadwal);
        $isi['bank_soal'] = $this->Model_ujian->pilihBankSoal();

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'Master/tampilan_pilih_soal';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
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

        redirect('Dashboard/jadwal_ujian');
    }

    public function hapus_all_jadwal()
    {
        $this->Model_keamanan->getKeamanan();
        $this->db->empty_table('a_jadwal');
        $this->session->set_flashdata('pesan', '<div class="row">
        <div class="col-md mt-2">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data Jadwal Berhasil Di Hapus</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        </div>
        </div>');
        redirect('Dashboard/jadwal_ujian');
    }

    public function upload_soal($id_jadwal)
    {
        $this->Model_keamanan->getKeamanan();
        $isi['ujian'] = $this->Model_ujian->uploadSoalID($id_jadwal);

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'Master/tampilan_upload_soal';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
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
                            );
                            array_push($save, $data);
                        }
                        $numRow++;
                    }
                    $this->Model_ujian->simpan($save);
                    $reader->close();

                    unlink('temp_doc/' . $file['file_name']);
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success">Soal berhasil diunggah</div>');
                    redirect('Dashboard/bank_soal');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Upload error: ' . strip_tags($this->upload->display_errors()) . '</div>');
                redirect('Dashboard/bank_soal');
            }
        }
    }

    public function detail_jadwal_soal($id_jadwal)
    {
        $this->Model_keamanan->getKeamanan();
        $isi['ujian'] = $this->Model_ujian->uploadSoalID($id_jadwal);
        $isi['jadwal_soal'] = $this->Model_ujian->jadwalSoal_bankSoal($id_jadwal);

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'Master/tampilan_detail_jadwal_soal';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function detail_soal($id_jadwal)
    {
        $this->Model_keamanan->getKeamanan();
        $isi['header'] = $this->Model_ujian->detail_soal($id_jadwal);
        $isi['soal'] = $this->Model_ujian->data_soal($id_jadwal);

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'Master/tampilan_detail_soal';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function edit_jadwal($id_jadwal)
    {
        $this->Model_keamanan->getKeamanan();
        $isi['mapel'] = $this->Model_ujian->edit_jadwal_id($id_jadwal);

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'Master/tampilan_edit_jadwal';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
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

        $data = array(
            'id_jadwal' =>  $id_jadwal,
            'id_mapel' => $id_mapel,
            'tanggal_mulai' => $tanggal_mulai,
            'waktu_mulai' => $waktu_mulai,
            'waktu_selesai' => $waktu_selesal
        );

        $this->db->where('id_jadwal', $id_jadwal);
        $this->db->update('a_jadwal', $data);
        redirect('Dashboard/jadwal_ujian');
    }

    public function bank_soal()
    {
        $this->Model_keamanan->getKeamanan();
        $isi['bank_soal'] = $this->Model_ujian->namaBankSoal();

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'Master/tampilan_bank_soal';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
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
        redirect('Dashboard/bank_soal');
    }

    public function simpan_bank_soal()
    {
        $this->Model_keamanan->getKeamanan();

        $data = array(
            'id_bank_soal' => rand(11111111, 99999999),
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
        redirect('Dashboard/bank_soal');
    }

    public function upload_banksoal($id_bank_soal_temp)
    {
        $this->Model_keamanan->getKeamanan();
        $isi['header'] = $this->Model_ujian->HeadersimpanBankSoalTemp($id_bank_soal_temp);

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'Master/tampilan_bank_soal_upload';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }



    public function detail_banksoal($id_bank_soal)
    {
        $this->Model_keamanan->getKeamanan();
        $isi['header'] = $this->Model_ujian->headerBankSoal($id_bank_soal);
        $isi['soal'] = $this->Model_ujian->detailBankSoal($id_bank_soal);

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'Master/tampilan_detail_bank_soal';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function rekap_nilai()
    {
        $this->Model_keamanan->getKeamanan();
        // $isi['ujian'] = $this->Model_ujian->uploadSoalID($id_jadwal);
        $isi['rekap'] = $this->Model_ujian->rekap_nilai_mapel();

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'Master/tampilan_rekap_nilai';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }

    public function print_nilai($id_jadwal)
    {
        $this->Model_keamanan->getKeamanan();
        $isi['header'] = $this->Model_ujian->header_print_nilai($id_jadwal);
        $isi['nilai'] = $this->Model_ujian->print_nilai($id_jadwal);
        $this->load->view('Master/tampilan_print_nilai', $isi);
    }

    public function status_ujian()
    {
        $this->Model_keamanan->getKeamanan();

        $tanggal = date('Y-m-d');
        $isi['status_ujian'] = $this->Model_ujian->data_status_ujian($tanggal);

        $isi2['title'] = 'CBT | Administrator';
        $isi['content'] = 'Master/tampilan_status_ujian';
        $this->load->view('templates/header', $isi2);
        $this->load->view('tampilan_dashboard', $isi);
        $this->load->view('templates/footer');
    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/Login');
    }
}