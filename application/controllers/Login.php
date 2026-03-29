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

        // Verify login credentials first
        $cek = $this->Model_login->cek_login($username, $pass);

        if ($cek->num_rows() > 0) {
            // Login successful - now create session
            $this->load->model('Session_Model');
            $session_id = bin2hex(random_bytes(32));
            $ipaddress = $this->input->ip_address();

            // Save session to database
            if ($this->Session_Model->create_session($session_id, $username, $ipaddress)) {
                // Set cookie for session
                $this->input->set_cookie(array(
                    'name' => 'app_session_id',
                    'value' => $session_id,
                    'expire' => 86400, // 24 hours
                    'httponly' => TRUE,
                    'secure' => FALSE // Set to TRUE if using HTTPS
                ));

                // Set CodeIgniter session data
                $sess_data = array(
                    'username' => $username,
                    'session_id' => $session_id,
                    'logged_in' => TRUE
                );

                // Get user level from database
                foreach ($cek->result() as $ck) {
                    $sess_data['username'] = $ck->username;
                    $sess_data['level'] = $ck->level;
                }

                // Set user data to session
                $this->session->set_userdata($sess_data);

                // Redirect based on user level
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
            }
        } else {
            // Login failed
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
