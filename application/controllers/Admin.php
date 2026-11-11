<?php 
class Admin extends CI_Controller {
	#[Override]
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array(
			'title' => 'Dashboard'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function pedagang()
	{
		$data = array(
			'title' => 'Data Pedagang'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('admin/pedagang', $data);
		$this->load->view('templates/footer', $data);
	}

	public function pembeli()
	{
		$data = array(
			'title' => 'Data Pembeli'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('admin/pembeli', $data);
		$this->load->view('templates/footer', $data);
	}

	public function kategori()
	{
		$data = array(
			'title' => 'Kategori Jajanan'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('admin/kategori', $data);
		$this->load->view('templates/footer', $data);
	}

	public function laporan()
	{
		$data = array(
			'title' => 'Laporan & Keluhan'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('admin/laporan', $data);
		$this->load->view('templates/footer', $data);
	}

	public function pengaturan()
	{
		$data = array(
			'title' => 'Pengaturan Sistem'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('admin/pengaturan', $data);
		$this->load->view('templates/footer', $data);
	}
}
