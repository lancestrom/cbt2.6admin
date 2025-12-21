<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function index()
    {

        $isi['title'] = 'Login Administrator';
        $this->load->view('tampilan_login', $isi);
    }

    public function proses_login()
    { 
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $pass = md5($password);
        $this->load->model('Model_login');
        $cek = $this->Model_login->cek_login($username, $pass);

        if ($cek->num_rows() > 0) {
            foreach ($cek->result() as $ck) {
                $sess_data['username'] = $ck->username;
                $sess_data['level'] = $ck->level;

                $this->session->set_userdata($sess_data);
            }
            if ($sess_data['level'] == 'admin') {
                redirect('Dashboard');
            } elseif ($sess_data['level'] == 'adminakl') {
                redirect('Dashboard_akl');
            } elseif ($sess_data['level'] == 'adminbdp') {
                redirect('Dashboard_bdp');
            } elseif ($sess_data['level'] == 'adminotkp') {
                redirect('Dashboard_otkp');
            } elseif ($sess_data['level'] == 'admintkj') {
                redirect('Dashboard_tkj');
            } elseif ($sess_data['level'] == 'admindkv') {
                redirect('Dashboard_dkv');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Username dan Password salah
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
                redirect('/');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Username dan Password salah
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
            redirect('/');
        }
    }
}