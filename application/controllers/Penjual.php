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
            'category' => $this->Penjual_model->get_category()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('penjual/index', $data);
        $this->load->view('templates/footer');
    }

    public function updateCategory()
    {   
        $this->form_validation->set_rules('category_id', 'Jenis Kategori', 'required');


        $category = [
            'user_id' => $this->ion_auth->get_user_id(),
            'category_id' => $this->input->post('category_id')
        ];

        $this->Penjual_model->update_category($category);

        $id_user = $this->ion_auth->get_user_id();

        $penjual = $this->Penjual_model->get_status_jualan($id_user);

        $data = [
            'user' => $id_user,
            'status_jualan' => $penjual,
            'category' => $this->Penjual_model->get_category()
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
        $id_user = $this->ion_auth->get_user_id();

        if ($this->ion_auth->in_group('penjual', $id_user)) {

            redirect('penjual/index');
        }


        $this->form_validation->set_rules('store_name', 'Nama Toko', 'required');
        $this->form_validation->set_rules('phone', 'Nomor Handphone', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('penjual/register');
        } else {

            if(empty($id_user))
                {
                    redirect('pembeli/index');
                }
                
            $data = [
                'store_name' => $this->input->post('store_name', TRUE),
                'phone' => $this->input->post('phone', TRUE)
            ];

            $this->Penjual_model->registerPedagang($id_user, $data);

            $penjual = [
                'user' => $id_user,
                'status_jualan' => $this->Penjual_model->get_status_jualan($id_user),
            ];

            $this->load->view('templates/header', $penjual);
            $this->load->view('penjual/index', $penjual);
            $this->load->view('templates/footer');
        }
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

    public function simpan_template()
    {
        $id       = $this->ion_auth->user()->row()->id;
        $template = trim($this->input->post('template_text', TRUE));

        if ($template !== '') {
            $this->Penjual_model->update_template($id, $template);
            $this->session->set_flashdata('pesan', 'Template pesan berhasil disimpan.');
        }

        redirect('penjual');
    }
}
