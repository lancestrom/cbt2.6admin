<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Token extends CI_Controller
{


    public function index()
    {
        $isi['token_keluar'] = $this->Model_token->token_keluar();
        $isi['token_masuk'] = $this->Model_token->token_masuk();
        $this->load->view('tampilan_show_token', $isi);
    }
}
