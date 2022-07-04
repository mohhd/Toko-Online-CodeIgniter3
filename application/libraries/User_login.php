<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_login
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('M_auth');
    }

    public function login($username, $password)
    {
        $cek = $this->ci->M_auth->login_user($username, $password);

        if ($cek) {
            $nama = $cek->nama;
            $username = $cek->username;
            $level_user = $cek->level_user;
            // buat session
            $this->ci->session->set_userdata('username', $username);
            $this->ci->session->set_userdata('nama', $nama);
            $this->ci->session->set_userdata('level_user', $level_user);

            redirect('admin');
        } else {
            $this->ci->session->set_flashdata('error', 'Username atau Password Anda Salah!');

            redirect('auth/login_user');
        }
    }

    public function proteksi_halaman()
    {
        if ($this->ci->session->userdata('username') == '') {
            $this->ci->session->set_flashdata('error', 'Harap Melakukan Login');
            redirect('auth/login_user');
        }
    }

    public function logout()
    {
        $this->ci->session->unset_userdata('username');
        $this->ci->session->unset_userdata('nama');
        $this->ci->session->unset_userdata('level_user');

        redirect('auth/login_user');
    }
}

/* End of file User_login.php */
