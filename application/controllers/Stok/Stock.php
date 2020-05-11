<?php
/**
 * 
 */
class stock extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE || ($this->session->userdata('akses') != 2 && $this->session->userdata('akses') != 1)) {
			$url = base_url('Login');
			redirect($url);
		};

		$this->load->model('m_pemesanan');
		$this->load->model('m_barang');
		$this->load->model('m_list_barang');
		$this->load->library('upload');
	}

	function index()
	{
		$y['title'] = "Stock";
			$x['stock'] = $this->m_barang->getAllBarang();
			$this->load->view('v_header', $y);
			$this->load->view('stok/v_sidebar');
			$this->load->view('stok/v_stock', $x);
	}

	function history($barang_id)
	{
		$y['title'] = "Stock Masuk";
			$status='2';
			$x['stock'] = $this->m_barang-> getHistoryStock($barang_id,$status);
			$this->load->view('v_header', $y);
			$this->load->view('stok/v_sidebar');
			$this->load->view('stok/v_history_stock', $x);
	}

	function history_stok_keluar($barang_id)
	{$y['title'] = "Stock Keluar";
			$status='1';
			$x['stock'] = $this->m_barang-> getHistoryStock($barang_id,$status);
			$this->load->view('v_header', $y);
			$this->load->view('stok/v_sidebar');
			$this->load->view('stok/v_history_stock', $x );
	}

	function tambah_stock()
	{
		$y['title'] = "Stock";
			$stock = $this->input->post('stock');
			$barang_id = $this->input->post('barang_id');
			$this->m_barang->update_stock($barang_id,$stock);
			redirect('Stok/Stock');
		
	}
}
