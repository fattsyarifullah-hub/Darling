<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	#[Override]
	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->is_admin()) {
			redirect('pembeli/index', 'refresh');
		}

		$this->load->model('Admin_model');
	}

	public function index()
	{
		$data = array(
			'title' => 'Dashboard',
			'countPedagang' => $this->Admin_model->countPedagang(),
			'countActivePedagang' => $this->Admin_model->countActivePedagang(),
			'countAll' => $this->Admin_model->countAll(),
			'locationPedagang' => $this->Admin_model->getLocationActive()
		);

		$this->load->view('templates/header', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function pedagang()
	{
		$data = array(
			'title' => 'Data Pedagang',
			'allPedagang' => $this->Admin_model->getAllPedagang()
		);

		$this->load->view('templates/header', $data);
		$this->load->view('admin/pedagang', $data);
		$this->load->view('templates/footer', $data);
	}

	public function pembeli()
	{
		$data = array(
			'title' => 'Data Pembeli',
			'allUsers' => $this->Admin_model->getAllUsers()
		);

		$this->load->view('templates/header', $data);
		$this->load->view('admin/pembeli', $data);
		$this->load->view('templates/footer', $data);
	}

	public function kategori()
	{

		$data = array(
			'title' => 'Kategori Jajanan',
			'allCategory' => $this->Admin_model->getAllCategory()
		);

		$this->form_validation->set_rules('type', 'Nama Kategori', 'required');
		$this->form_validation->set_rules('colour_marker', 'Warna Marker', 'required');

		if ($this->form_validation->run() === FALSE) {
			
			$this->load->view('templates/header', $data);
			$this->load->view('admin/kategori', $data);
			$this->load->view('templates/footer', $data);

		} else {

			$category = [
				'type' => $this->input->post('type', TRUE),
				'colour_marker' => $this->input->post('colour_marker', TRUE)
			];

			$this->Admin_model->createCategory($category);
			
			$this->load->view('templates/header', $data);
			$this->load->view('admin/kategori', $data);
			$this->load->view('templates/footer', $data);
		}
	}

	// public function laporan()
	// {
	// 	$data = array(
	// 		'title' => 'Laporan & Keluhan'
	// 	);

	// 	$this->load->view('templates/header', $data);
	// 	$this->load->view('admin/laporan', $data);
	// 	$this->load->view('templates/footer', $data);
	// }

	public function pengaturan()
	{
		$data = array(
			'title' => 'Pengaturan Sistem'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('admin/pengaturan', $data);
		$this->load->view('templates/footer', $data);
	}

	public function locationActive()
	{
		if (!$this->input->is_ajax_request()) {
			exit();
		}

		try {
			$penjual_list = $this->Admin_model->getLocationActive();


			$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode([
					'status' => 'success',
					'data' => $penjual_list
				]));
				
		} catch (Exception $e) {
			$this->output
				->set_status_header(400)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode([
					'status' => 'success',
					'message' => 'terjadi kesalahan' . $e->getMessage()
				]));
		}
	}
}
