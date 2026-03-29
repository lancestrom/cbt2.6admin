<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Session_Model');
        $this->load->helper(array('url', 'cookie'));
    }

    /**
     * Cek apakah user sudah login
     * Jika belum, redirect ke login
     */
    protected function require_login()
    {
        $session_id = get_cookie('app_session_id');

        if (!$session_id) {
            redirect('login');
        }

        // Cek session di database
        $session = $this->Session_Model->get_session($session_id);

        if (!$session) {
            delete_cookie('app_session_id');
            redirect('login');
        }

        // Update timestamp untuk keep-alive
        $this->Session_Model->update_session_timestamp($session_id);

        return $session;
    }

    /**
     * Cek apakah user sudah login (tanpa redirect)
     */
    protected function is_logged_in()
    {
        $session_id = get_cookie('app_session_id');

        if (!$session_id) {
            return false;
        }

        $session = $this->Session_Model->get_session($session_id);
        return $session ? true : false;
    }
}
