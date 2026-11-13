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
            if (!$this->ion_auth->logged_in()) {
                if (strtolower((string) $this->router->fetch_method()) === 'synclocation') {
                    $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(401)
                        ->set_output(json_encode([
                            'status' => 'error',
                            'message' => 'Silakan login terlebih dahulu'
                        ]));
                    exit;
                }

                redirect('auth/login', 'refresh');
                
                }
                
                $id_user = $this->ion_auth->get_user_id();
                $data['user'] = $this->Pembeli_model->getOneUser($id_user);
                
                $this->load->view('Pembeli/index', $data);

        }

    public function register()
    {
        $this->form_validation->set_rules('first_name', 'first_name', 'required');
        $this->form_validation->set_rules('last_name', 'last_name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('phone', 'nomor hp', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('Pembeli/register');
        } else {
            $hashPassword = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT);

            $data = [
                "first_name" => $this->input->post('first_name', TRUE),
                "last_name" => $this->input->post('last_name', TRUE),
                "email" => $this->input->post('email', TRUE),
                "phone" => $this->input->post('phone', TRUE),
                "password" => $hashPassword,
                "active" => 1
            ];

            $this->Pembeli_model->register($data);

            $id_user = $this->ion_auth->get_user_id();
            $data['user'] = $this->Pembeli_model->getOneUser($id_user);

            $this->load->view('Pembeli/index', $data);
        }
    }

    public function syncLocation()
    {
        if ($this->input->method(TRUE) !== 'POST') {
            $this->jsonResponse(405, [
                'status' => 'error',
                'message' => 'Metode request tidak diizinkan'
            ]);
            return;
        }

        $id_user = $this->ion_auth->get_user_id();
        if (!is_numeric($id_user) || (int) $id_user <= 0) {
            $this->jsonResponse(401, [
                'status' => 'error',
                'message' => 'Silakan login terlebih dahulu'
            ]);
            return;
        }

        $latitude = filter_var($this->input->post('latitude'), FILTER_VALIDATE_FLOAT);
        $longitude = filter_var($this->input->post('longitude'), FILTER_VALIDATE_FLOAT);

        if (
            $latitude === FALSE || $longitude === FALSE
            || $latitude < -90 || $latitude > 90
            || $longitude < -180 || $longitude > 180
        ) {
            $this->jsonResponse(400, [
                'status' => 'error',
                'message' => 'Koordinat latitude atau longitude tidak valid'
            ]);
            return;
        }

        if (!$this->Pembeli_model->updateLocation((int) $id_user, $latitude, $longitude)) {
            $this->jsonResponse(500, [
                'status' => 'error',
                'message' => 'Lokasi gagal disimpan'
            ]);
            return;
        }

        $this->jsonResponse(200, [
            'status' => 'success',
            'message' => 'Lokasi berhasil diperbarui'
        ]);
    }

    private function jsonResponse($statusCode, $data)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_status_header($statusCode)
            ->set_output(json_encode($data));
    }

    public function getPenjualTerdekat()
    {
        if (!$this->input->is_ajax_request()) {
            exit();
        }

        $id_pembeli = $this->ion_auth->get_user_id();

        if (empty($id_pembeli)) {
            $this->jsonResponse(400, [
                'status' => 'failed',
                'message' => 'Data tidak valid'
            ]);
        }

        try {
            $radius = 500;
            $penjual_list = $this->Pembeli_model->getRadiusPenjual($id_pembeli, $radius);

            $this->jsonResponse(200, [
                'status' => 'success',
                'data' => $penjual_list
            ]);
        } catch (Exception $e) {
            $this->jsonResponse(400, [
                'status' => 'failed',
                'message' => 'terjadi kesalahan' . $e->getMessage()
            ]);
        }
    }
}
