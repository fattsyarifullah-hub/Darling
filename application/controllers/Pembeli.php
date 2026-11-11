<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembeli extends CI_Controller
{

    #[Override]
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Pembeli_model');
    }


    public function index()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('pembeli/login');
        }

        $id = $this->session->userdata('id');

        $this->load->view('pembeli/index', $id);
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('pembeli/login');
        } else {
            $data = [
                'email' => $this->input->post('email', TRUE),
                'password' => $this->input->post('password', TRUE),
            ];

            $user = $this->Pembeli_model->login($data['email']);

            if ($user === null) {
                $this->session->set_flashdata('failed', 'data tidak ditemukan');

                redirect('Pembeli/login');
            }

            if (password_verify($data['password'], $user->password)) {
                $data_session = array(
                    'id' => $user->id,
                    'logged_in' => TRUE
                );

                $this->session->set_userdata($data_session);

                $this->session->set_flashdata('success', 'Berhasil login');

                redirect('Pembeli/index');
            } else {
                $this->session->set_flashdata('failed', 'Password yang anda masukkan salah');

                redirect('Pembeli/login');
            }
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('no_hp', 'nomor hp', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('Pembeli/register');
        } else {
            $hashPassword = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT);

            $data = [
                "name" => $this->input->post('name', TRUE),
                "email" => $this->input->post('email', TRUE),
                "no_hp" => $this->input->post('no_hp', TRUE),
                "password" => $hashPassword,
            ];

            $this->Pembeli_model->register($data);

            $user = $this->Pembeli_model->login($data['email']);

            $data_session = array(
                'id' => $user->id,
                'logged_in' => TRUE
            );

            $this->session->set_userdata($data_session);

            $this->session->set_flashdata('success', 'Berhasil membuat akun');

            redirect('Pembeli/index');
        }
    }

    public function syncLocation()
    {   
        if (!$this->input->is_ajax_request()) {
        echo json_encode(['status' => 'error', 'message' => 'Bukan akses AJAX yang valid']);
        return;
    }
    
        $id_user = $this->session->userdata('id');
        $latitude = $this->input->post('lat');
        $longitude = $this->input->post('lng');

        if (empty($id_user)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'User tidak terdeteksi'
            ]);
            return;
        }

        if (empty($latitude) || empty($longitude)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Koordinat salah'
            ]);
            return;
        }

        $this->Pembeli_model->updateLocation($id_user, $latitude, $longitude);

        echo json_encode([
            'status' => 'success',
            'message' => 'berhasil memperbarui lokasi'
        ]);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Pembeli/login');
    }
}
