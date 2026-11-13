<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjual extends CI_Controller
{

    #[Override]
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Penjual_model');
    }

    // HALAMAN AWAL
    public function index()
    {
        $id_user = $this->ion_auth->get_user_id();

        $penjual = $this->Penjual_model->get_status_jualan($id_user);

        $data = [
            'user' => $id_user,
            'status_jualan' => $penjual,
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('penjual/index', $data);
        $this->load->view('templates/footer');
    }


    // LOGIN
    public function login()
    {
        if ($this->input->method() === 'post') {

            // Nangkep inputan (bisa email atau no wa)
            $identity = $this->input->post('identity', TRUE);
            $password = $this->input->post('password');

            // Cari user dari email kalo g no wa
            $this->db->group_start();
            $this->db->where('email', $identity);
            $this->db->or_where('phone', $identity);
            $this->db->group_end();
            $user = $this->db->get('users')->row();

            // Verifikasi password
            if ($user && password_verify($password, $user->password)) {

                $this->session->set_userdata([
                    'id_user'    => $user->id,
                    'first_name' => $user->first_name,
                    'email'      => $user->email,
                    'phone'      => $user->phone,
                    'login'      => TRUE
                ]);

                redirect('penjual/index');
            } else {
                $data['error'] = 'Email/No WA atau Password Anda salah!';
                $this->load->view('penjual/login', $data);
                return;
            }
        }

        $this->load->view('penjual/login');
    }

    public function register()
    {
        $this->load->view('penjual/register');
    }

    // REGISTER
    public function proses_register()
    {
        if ($this->input->method() === 'post') {

            $this->form_validation->set_rules('first_name', 'Nama Penjual', 'required');
            $this->form_validation->set_rules('store_name', 'Nama Toko', 'required');
            $this->form_validation->set_rules('phone', 'Nomor HP', 'required|is_unique[users.phone]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('penjual/register');
            } else {

                $data = array(
                    'first_name' => $this->input->post('first_name', TRUE),
                    'store_name' => $this->input->post('store_name', TRUE),
                    'phone'      => $this->input->post('phone', TRUE),
                    'email'      => $this->input->post('email', TRUE),
                    'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),

                    'ip_address' => $this->input->ip_address(),
                    'created_on' => time(),
                    'active'     => 1
                );

                $this->db->insert('users', $data);

                redirect('penjual/login');
            }
        } else {
            redirect('penjual/register');
        }

        // Tampilan registrasi
        $this->load->view('penjual/register');
    }

    // DATA DAGANGAN
    public function data_dagangan()
    {
        // if (!$this->session->userdata('login')) {
        //     redirect('penjual/login');
        //     return;
        // }

        $this->load->view('templates/header');
        $this->load->view('penjual/data_dagangan');
        $this->load->view('templates/footer');
    }

    // TAMBAH MENU
    public function tambah_menu()
    {
        // if (!$this->session->userdata('login')) {
        //     redirect('penjual/login');
        //     return;
        // }

        if ($this->input->method() !== 'post') {
            redirect('penjual/menu_dagangan');
            return;
        }

        // Fitur tambah menu belum dihubungkan ke database.
        redirect('penjual/menu_dagangan');
    }

    // HAPUS MENU
    public function hapus_menu($id = NULL)
    {
        // if (!$this->session->userdata('login')) {
        //     redirect('penjual/login');
        //     return;
        // }

        // Fitur hapus menu belum dihubungkan ke database.
        redirect('penjual/menu_dagangan');
    }

    // UBAH STATUS JUALAN
    public function ubah_status()
    {
        if ($this->input->method() !== 'post') {
            if ($this->input->is_ajax_request()) {
                return $this->output->set_content_type('application/json')->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Akses tidak sah.'
                ]));
            }
            return;
        }

        $id_user = $this->ion_auth->get_user_id();

        $penjual = $this->Penjual_model->get_status_jualan($id_user);

        if (!$penjual) {
            $this->session->set_flashdata(
                'error',
                'Data pengguna tidak ditemukan.'
            );

            redirect('penjual/index');
            return;
        }

        $status_baru = ($penjual['active_selling'] == 1) ? 0 : 1;

        $this->Penjual_model->ubah_status_jualan($id_user, $status_baru);

        redirect('penjual/index');
    }

    public function menu_dagangan()
    {
        $this->load->view('templates/header');
        $this->load->view('penjual/menu_dagangan');
        $this->load->view('templates/footer');
    }
}
