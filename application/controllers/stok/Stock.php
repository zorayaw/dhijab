<?php
/**
 * 
 */
class stock extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE || ($this->session->userdata('akses') != 3 && $this->session->userdata('akses') != 1)) {
			$url = base_url('Login');
			redirect($url);
		};

		$this->load->model('M_pemesanan');
		$this->load->model('M_barang');
		$this->load->model('M_list_barang');
		$this->load->library('upload');
	}

	function index()
	{
		$y['title'] = "Stock";
			$x['stock'] = $this->M_barang->getAllBarang();
			$this->load->view('v_header', $y);
			if($this->session->userdata('akses') == 3){
				$this->load->view('stok/v_sidebar');
			}
			else if($this->session->userdata('akses') == 1){
				$this->load->view('owner/v_sidebar');
			}
			$this->load->view('stok/v_stock', $x);
	}

	function history($barang_id)
	{
		$y['title'] = "History Stock Masuk";
			$status='2';
			$x['title'] = "History Stock Masuk";
			$x['barang'] = $this->M_barang->getBarangID($barang_id);
			$x['stock'] = $this->M_barang-> getHistoryStock($barang_id,$status);
			$this->load->view('v_header', $y);
			if($this->session->userdata('akses') == 3){
				$this->load->view('stok/v_sidebar');
			}
			else if($this->session->userdata('akses') == 1){
				$this->load->view('owner/v_sidebar');
			}
			
			$this->load->view('stok/v_history_stock', $x);
	}

	function history_stok_keluar($barang_id)
	{$y['title'] = "History Stock Keluar";
			$status='1';
			$x['title'] = "History Stock Keluar";
			$x['barang'] = $this->M_barang->getBarangID($barang_id);
			$x['stock'] = $this->M_barang-> getHistoryStock($barang_id,$status);
			$this->load->view('v_header', $y);
			if($this->session->userdata('akses') == 3){
				$this->load->view('stok/v_sidebar');
			}
			else if($this->session->userdata('akses') == 1){
				$this->load->view('owner/v_sidebar');
			}
			$this->load->view('stok/v_history_stock', $x );
	}

	function tambah_stock()
	{
		$y['title'] = "Stock";
			$stock = $this->input->post('stock');
			$barang_id = $this->input->post('barang_id');
			$this->M_barang->update_stock($barang_id,$stock);
			redirect('stok/Stock');
		
	}
}
