<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Session_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Buat session baru di database
     */
    public function create_session($session_id, $username, $ipaddress)
    {
        // Hapus session lama jika ada untuk user yang sama
        $this->delete_user_sessions($username);

        $data = array(
            'session_id' => $session_id,
            'username' => $username,
            'ipaddress' => $ipaddress,
            'timestamp' => date('Y-m-d H:i:s')
        );

        return $this->db->insert('sessions', $data);
    }

    /**
     * Get session berdasarkan session_id
     */
    public function get_session($session_id)
    {
        $this->db->where('session_id', $session_id);
        $query = $this->db->get('sessions');

        if ($query->num_rows() == 1) {
            return $query->row();
        }
        return false;
    }

    /**
     * Cek apakah session valid
     */
    public function is_session_valid($session_id)
    {
        $session = $this->get_session($session_id);
        return $session ? true : false;
    }

    /**
     * Hapus session berdasarkan session_id
     */
    public function delete_session($session_id)
    {
        $this->db->where('session_id', $session_id);
        return $this->db->delete('sessions');
    }

    /**
     * Hapus semua session untuk user tertentu
     */
    public function delete_user_sessions($username)
    {
        $this->db->where('username', $username);
        return $this->db->delete('sessions');
    }

    /**
     * Update timestamp session
     */
    public function update_session_timestamp($session_id)
    {
        $data = array(
            'timestamp' => date('Y-m-d H:i:s')
        );

        $this->db->where('session_id', $session_id);
        return $this->db->update('sessions', $data);
    }

    /**
     * Get user dari session
     */
    public function get_session_user($session_id)
    {
        $this->db->select('username');
        $this->db->where('session_id', $session_id);
        $query = $this->db->get('sessions');

        if ($query->num_rows() == 1) {
            return $query->row()->username;
        }
        return false;
    }

    /**
     * Hapus expired sessions (lebih dari 24 jam)
     */
    public function delete_expired_sessions($hours = 24)
    {
        $expired_time = date('Y-m-d H:i:s', strtotime("-$hours hours"));
        $this->db->where('timestamp <', $expired_time);
        return $this->db->delete('sessions');
    }

    public function dataLoginAdmin()
    {
        $sql = "SELECT auth.id,auth.username,auth.nama,auth.level,sessions.ipaddress,sessions.timestamp FROM `sessions`
INNER JOIN auth
ON sessions.username=auth.username;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function dataLoginSiswa()
    {
        $sql = "SELECT a_siswa.id,a_siswa.username,a_siswa.nama_siswa,a_siswa.kelas,sessions.ipaddress,sessions.timestamp FROM `sessions`
INNER JOIN a_siswa
ON sessions.username=a_siswa.username;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
