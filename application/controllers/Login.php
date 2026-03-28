<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('url', 'cookie'));
    }

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

        $this->load->model('Session_Model');
        $session_id = bin2hex(random_bytes(32));
        $ipaddress = $this->input->ip_address();

        // Simpan session ke database
        if ($this->Session_Model->create_session($session_id, $username, $ipaddress)) {
            // Set cookie untuk session
            $this->input->set_cookie(array(
                'name' => 'app_session_id',
                'value' => $session_id,
                'expire' => 86400, // 24 jam
                'httponly' => TRUE,
                'secure' => FALSE // Set ke TRUE jika pakai HTTPS
            ));

            // Set session CodeIgniter
            $sess_data = array(
                'username' => $username,
                'session_id' => $session_id,
                'logged_in' => TRUE
            );
        }

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
                redirect('Dashboard_pm');
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

        if ($cek->num_rows() > 0) {
            // Generate session_id
            $this->load->model('Session_Model');
            $session_id = bin2hex(random_bytes(32));
            $ipaddress = $this->input->ip_address();

            // Simpan session ke database
            if ($this->Session_Model->create_session($session_id, $username, $ipaddress)) {
                // Set cookie untuk session
                $this->input->set_cookie(array(
                    'name' => 'app_session_id',
                    'value' => $session_id,
                    'expire' => 86400, // 24 jam
                    'httponly' => TRUE,
                    'secure' => FALSE // Set ke TRUE jika pakai HTTPS
                ));

                // Set session CodeIgniter
                $sess_data = array(
                    'username' => $username,
                    'session_id' => $session_id,
                    'logged_in' => TRUE
                );
            }
        }
    }
}
