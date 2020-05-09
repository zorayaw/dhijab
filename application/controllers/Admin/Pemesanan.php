<?php

/**
 * 
 */
class Pemesanan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('Login');
			redirect($url);
		};

		$this->load->library('pdf');
		$this->load->model('m_pemesanan');
		$this->load->model('m_barang');
		$this->load->model('m_list_barang');
		$this->load->library('upload');
	}

	function index()
	{
		if ($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true) {
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
			$x['kurir'] = $this->m_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
			$x['produksi'] = $this->m_barang->getdataProduksi();
			$x['reseller'] = $this->m_barang->getAllBarangR();
			$x['datapesanan'] = $this->m_pemesanan->getPemesananbyTahun2(date('Y'));
			$this->load->view('v_header', $y);
			$this->load->view('admin/v_sidebar');
			$this->load->view('admin/v_pemesanan', $x);
		} else {
			redirect('Login');
		}
	}

	function convertPDF(){
		$statusc = $this->input->get('status');
		$x['numstat'] = $statusc;
			if($statusc==0){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesanan();
	
				$this->pdf->setPaper('legal', 'landscape');
				$this->pdf->filename = "laporan_pdf.pdf";
				$this->pdf->load_view('admin/laporan_pdf', $x);
			}
			else if($statusc==1){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananCustomer();
	
				$this->pdf->setPaper('legal', 'landscape');
				$this->pdf->filename = "laporan_pdf.pdf";
				$this->pdf->load_view('admin/laporan_pdf', $x);
			}
			else if($statusc==2){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananreseller();
	
				$this->pdf->setPaper('legal', 'landscape');
				$this->pdf->filename = "laporan_pdf.pdf";
				$this->pdf->load_view('admin/laporan_pdf', $x);
			}
			else if($statusc==3){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananproduksi();
	
				$this->pdf->setPaper('legal', 'landscape');
				$this->pdf->filename = "laporan_pdf.pdf";
				$this->pdf->load_view('admin/laporan_pdf', $x);
			}
	}

	function convertPDFPerhari(){
		$statusc = $this->input->get('status');
		$x['numstat'] = $statusc;
			if($statusc==0){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananCurdate();
	
				$this->pdf->setPaper('legal', 'landscape');
				$this->pdf->filename = "laporan_pdf.pdf";
				$this->pdf->load_view('admin/laporan_pdf', $x);
			}
			else if($statusc==1){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananCustomerCurdate();
	
				$this->pdf->setPaper('legal', 'landscape');
				$this->pdf->filename = "laporan_pdf.pdf";
				$this->pdf->load_view('admin/laporan_pdf', $x);
			}
			else if($statusc==2){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananResellerCurdate();
	
				$this->pdf->setPaper('legal', 'landscape');
				$this->pdf->filename = "laporan_pdf.pdf";
				$this->pdf->load_view('admin/laporan_pdf', $x);
			}
			else if($statusc==3){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananProduksiCurdate();
	
				$this->pdf->setPaper('legal', 'landscape');
				$this->pdf->filename = "laporan_pdf.pdf";
				$this->pdf->load_view('admin/laporan_pdf', $x);
			}
	}	

	function convertPDFPerbulan(){
		$statusc = $this->input->get('status');
		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');
		$x['numstat'] = $statusc;
		$x['bulan'] = $bulan;
		$x['tahun'] = $tahun;
		if($statusc==0){
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
			$x['kurir'] = $this->m_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
			$x['produksi'] = $this->m_barang->getdataProduksi();
			$x['reseller'] = $this->m_barang->getAllBarangR();
			$x['datapesanan'] = $this->m_pemesanan->getPemesananByBulan($bulan,$tahun);

			$this->pdf->setPaper('legal', 'landscape');
			$this->pdf->filename = "laporan_pdf.pdf";
			$this->pdf->load_view('admin/laporan_pdf', $x);
		}
		else if($statusc==1){
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
			$x['kurir'] = $this->m_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
			$x['produksi'] = $this->m_barang->getdataProduksi();
			$x['reseller'] = $this->m_barang->getAllBarangR();
			$x['datapesanan'] = $this->m_pemesanan->getPemesananCustomerByBulan($bulan,$tahun);

			$this->pdf->setPaper('legal', 'landscape');
			$this->pdf->filename = "laporan_pdf.pdf";
			$this->pdf->load_view('admin/laporan_pdf', $x);
			}
		else if($statusc==2){
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
			$x['kurir'] = $this->m_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
			$x['produksi'] = $this->m_barang->getdataProduksi();
			$x['reseller'] = $this->m_barang->getAllBarangR();
			$x['datapesanan'] = $this->m_pemesanan->getPemesananResellerByBulan($bulan, $tahun);

			$this->pdf->setPaper('legal', 'landscape');
			$this->pdf->filename = "laporan_pdf.pdf";
			$this->pdf->load_view('admin/laporan_pdf', $x);
		}
		else if($statusc==3){
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
			$x['kurir'] = $this->m_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
			$x['produksi'] = $this->m_barang->getdataProduksi();
			$x['reseller'] = $this->m_barang->getAllBarangR();
			$x['datapesanan'] = $this->m_pemesanan->getPemesananProduksiByBulan($bulan, $tahun);

			$this->pdf->setPaper('legal', 'landscape');
			$this->pdf->filename = "laporan_pdf.pdf";
			$this->pdf->load_view('admin/laporan_pdf', $x);
		}
	}

	function convertPDFPerTanggal(){
		$statusc = $this->input->get('status');
			$start = $this->input->post('start_date');
			$end = $this->input->post('end_date');
			$x['numstat'] = $statusc;
			$x['start'] = $start;
			$x['end'] = $end;

			if($statusc==0){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananByTanggal($start, $end);
			
				$this->pdf->setPaper('legal', 'landscape');
				$this->pdf->filename = "laporan_pdf.pdf";
				$this->pdf->load_view('admin/laporan_pdf', $x);
			}
			else if($statusc==1){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananCustomerByTanggal($start, $end);
			
				$this->pdf->setPaper('legal', 'landscape');
				$this->pdf->filename = "laporan_pdf.pdf";
				$this->pdf->load_view('admin/laporan_pdf', $x);
			}
			else if($statusc==2){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananResellerByTanggal($start, $end);
			
				$this->pdf->setPaper('legal', 'landscape');
				$this->pdf->filename = "laporan_pdf.pdf";
				$this->pdf->load_view('admin/laporan_pdf', $x);

			}
			else if($statusc==3){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananProduksiByTanggal($start, $end);
			
				$this->pdf->setPaper('legal', 'landscape');
				$this->pdf->filename = "laporan_pdf.pdf";
				$this->pdf->load_view('admin/laporan_pdf', $x);
			}
	}
	
	function convertWord(){
		$statusc = $this->input->get('status');
		$x['numstat'] = $statusc;
			if($statusc==0){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesanan();
				$this->load->view('admin/laporan_word', $x);
			}
			else if($statusc==1){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananCustomer();
				$this->load->view('admin/laporan_word', $x);
			}
			else if($statusc==2){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananreseller();
				$this->load->view('admin/laporan_word', $x);
			}
			else if($statusc==3){

				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananproduksi();
				$this->load->view('admin/laporan_word', $x);
			}
		
	}

	function convertWordPerhari(){
		$statusc = $this->input->get('status');
		$x['numstat'] = $statusc;
			if($statusc==0){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananCurdate();
				$this->load->view('admin/laporan_word', $x);
			}
			else if($statusc==1){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananCustomerCurdate();
				$this->load->view('admin/laporan_word', $x);
			}
			else if($statusc==2){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananResellerCurdate();
				$this->load->view('admin/laporan_word', $x);
			}
			else if($statusc==3){

				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananProduksiCurdate();
				$this->load->view('admin/laporan_word', $x);
			}
		
	}

	function convertWordPerbulan(){
			$statusc = $this->input->get('status');
			$bulan = $this->input->get('bulan');
			$tahun = $this->input->get('tahun');
			$x['numstat'] = $statusc;
			$x['bulan'] = $bulan;
			$x['tahun'] = $tahun;
			if($statusc==0){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananByBulan($bulan,$tahun);
				$this->load->view('admin/laporan_word', $x);
			}
			else if($statusc==1){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananCustomerByBulan($bulan,$tahun);
				$this->load->view('admin/laporan_word', $x);
				}
			else if($statusc==2){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananResellerByBulan($bulan, $tahun);
				$this->load->view('admin/laporan_word', $x);
			}
			else if($statusc==3){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananProduksiByBulan($bulan, $tahun);
				$this->load->view('admin/laporan_word', $x);
			}
	}

	function convertWordPertanggal(){
		$statusc = $this->input->get('status');
			$start = $this->input->post('start_date');
			$end = $this->input->post('end_date');
			$x['numstat'] = $statusc;
			$x['start'] = $start;
			$x['end'] = $end;
			
			if($statusc==0){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananByTanggal($start, $end);
				$this->load->view('admin/laporan_word', $x);
			}
			else if($statusc==1){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananCustomerByTanggal($start, $end);
				$this->load->view('admin/laporan_word', $x);
			}
			else if($statusc==2){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananResellerByTanggal($start, $end);
				$this->load->view('admin/laporan_word', $x);
	
			}
			else if($statusc==3){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananProduksiByTanggal($start, $end);
				$this->load->view('admin/laporan_word', $x);
			}
	
	}

	function convertExcel(){
		$statusc = $this->input->get('status');
		$x['numstat'] = $statusc;
			if($statusc==0){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesanan();
				$this->load->view('admin/laporan_excel', $x);
			}
			else if($statusc==1){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananCustomer();
				$this->load->view('admin/laporan_excel', $x);
			}
			else if($statusc==2){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananreseller();
				$this->load->view('admin/laporan_excel', $x);
			}
			else if($statusc==3){

				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananproduksi();
				$this->load->view('admin/laporan_excel', $x);
			}
		
	}

	function convertExcelPerhari(){

		$statusc = $this->input->get('status');
		$x['numstat'] = $statusc;
			if($statusc==0){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananCurdate();
				$this->load->view('admin/laporan_excel', $x);
			}
			else if($statusc==1){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananCustomerCurdate();
				$this->load->view('admin/laporan_excel', $x);
			}
			else if($statusc==2){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananResellerCurdate();
				$this->load->view('admin/laporan_excel', $x);
			}
			else if($statusc==3){

				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananProduksiCurdate();
				$this->load->view('admin/laporan_excel', $x);
			}
					
	}	

	function convertExcelPerbulan(){
			$statusc = $this->input->get('status');
			$bulan = $this->input->get('bulan');
			$tahun = $this->input->get('tahun');
			$x['numstat'] = $statusc;
			$x['bulan'] = $bulan;
			$x['tahun'] = $tahun;
			if($statusc==0){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananByBulan($bulan,$tahun);
				$this->load->view('admin/laporan_excel', $x);
			}
			else if($statusc==1){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananCustomerByBulan($bulan,$tahun);
				$this->load->view('admin/laporan_excel', $x);
				}
			else if($statusc==2){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananResellerByBulan($bulan, $tahun);
				$this->load->view('admin/laporan_excel', $x);
			}
			else if($statusc==3){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananProduksiByBulan($bulan, $tahun);
				$this->load->view('admin/laporan_excel', $x);
			}
	}

	function convertExcelByTanggal(){

		$statusc = $this->input->get('status');
			$start = $this->input->post('start_date');
			$end = $this->input->post('end_date');
			$x['numstat'] = $statusc;
			$x['start'] = $start;
			$x['end'] = $end;
			
			if($statusc==0){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananByTanggal($start, $end);
				$this->load->view('admin/laporan_excel', $x);
			}
			else if($statusc==1){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananCustomerByTanggal($start, $end);
				$this->load->view('admin/laporan_excel', $x);
			}
			else if($statusc==2){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananResellerByTanggal($start, $end);
				$this->load->view('admin/laporan_excel', $x);
	
			}
			else if($statusc==3){
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
				$x['kurir'] = $this->m_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
				$x['produksi'] = $this->m_barang->getdataProduksi();
				$x['reseller'] = $this->m_barang->getAllBarangR();
				$x['datapesanan'] = $this->m_pemesanan->getPemesananProduksiByTanggal($start, $end);
				$this->load->view('admin/laporan_excel', $x);
			}
	
	}



	function customer()
	{
		if ($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true) {
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
			$x['kurir'] = $this->m_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
			$x['produksi'] = $this->m_barang->getdataProduksi();
			$x['reseller'] = $this->m_barang->getAllBarangR();
			$x['datapesanan'] = $this->m_pemesanan->getPemesananCustomer();
			$this->load->view('v_header', $y);
			$this->load->view('admin/v_sidebar');
			$this->load->view('admin/v_pemesanan_customer', $x);
		} else {
			redirect('Login');
		}
	}

	function savepemesananCustomer()
	{
		$nama_pemesan = $this->input->post('nama_pemesan');
		$nama_akun_pemesan = "-";
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = $this->input->post('at');
		$kurir = $this->input->post('kurir');
		$resi = $this->input->post('no_resi');
		$metpem = $this->input->post('metpem');
		$tanggal = $this->input->post('tanggal');
		$diskon = $this->input->post('diskon');
		$biaya_admin = $this->input->post('biaya_admin');
		$uang = $this->input->post('uang');
		$level = 1;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');
		$biaya_ongkir = $this->input->post('biaya_ongkir');
		$email_pemesanan = $this->input->post('email_pemesanan');
		$note = $this->input->post('note');
		$status = 0;
		$pemesanan_id = $this->m_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $resi, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);


		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barang($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->m_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect('Admin/Pemesanan/customer');
	}

	function hapus_pesananCustomer()
	{ 
		$pemesanan_id = $this->input->post('pemesanan_id');
		$this->m_pemesanan->hapus_pesanan($pemesanan_id);
		echo $this->session->set_flashdata('msg', 'hapus');
		redirect('Admin/Pemesanan/customer');
	}

	function statusCustomer()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$status_pemesanan = $this->input->post('status_pemesanan');
		$jumlah = $this->input->post('jumlah');
		if ($status_pemesanan == 0) {
			$status_pemesanan = 1;
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 1) {
			$status_pemesanan = 2;
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 2) {
			$status_pemesanan = 3;
			$this->m_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		}
		redirect('Admin/Pemesanan/customer');
	}

	function reseller()
	{
		if ($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true) {
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
			$x['kurir'] = $this->m_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
			$x['produksi'] = $this->m_barang->getdataProduksi();
			$x['reseller'] = $this->m_barang->getAllBarangR();
			$x['datapesanan'] = $this->m_pemesanan->getPemesananreseller();
			$this->load->view('v_header', $y);
			$this->load->view('admin/v_sidebar');
			$this->load->view('admin/v_pemesanan_reseller', $x);
		} else {
			redirect('Login');
		}
	}

	function savepemesananreseller()
	{
		$nama_pemesan = $this->input->post('nama_pemesan');
		$nama_akun_pemesan = $this->input->post('nama_akun_pemesan');
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = $this->input->post('at');
		$kurir = $this->input->post('kurir');
		$resi = $this->input->post('no_resi');
		$metpem = $this->input->post('metpem');
		$tanggal = $this->input->post('tanggal');
		$diskon = $this->input->post('diskon');
		$biaya_admin = $this->input->post('biaya_admin');
		$uang = $this->input->post('uang');
		$level = 1;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');
		$biaya_ongkir = $this->input->post('biaya_ongkir');
		$email_pemesanan = $this->input->post('email_pemesanan');
		$note = $this->input->post('note');
		$status = 0;
		$level = 2;
		$pemesanan_id = $this->m_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $resi, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);

		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barangR($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->m_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect('Admin/Pemesanan/reseller');
	}

	function hapus_pesananreseller()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$this->m_pemesanan->hapus_pesanan($pemesanan_id);
		echo $this->session->set_flashdata('msg', 'hapus');
		redirect('Admin/Pemesanan/reseller');
	}

	function statusreseller()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$status_pemesanan = $this->input->post('status_pemesanan');
		$jumlah = $this->input->post('jumlah');
		if ($status_pemesanan == 0) {
			$status_pemesanan = 1;
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 1) {
			$status_pemesanan = 2;
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 2) {
			$status_pemesanan = 3;
			$this->m_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		}
		redirect('Admin/Pemesanan/reseller');
	}

	function produksi()
	{
		if ($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true) {
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
			$x['kurir'] = $this->m_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
			$x['produksi'] = $this->m_barang->getdataProduksi();
			$x['reseller'] = $this->m_barang->getAllBarangR();
			$x['datapesanan'] = $this->m_pemesanan->getPemesananproduksi();
			$this->load->view('v_header', $y);
			$this->load->view('admin/v_sidebar');
			$this->load->view('admin/v_pemesanan_produksi', $x);
		} else {
			redirect('Login');
		}
	}

	function savepemesananproduksi()
	{
		$nama_pemesan = "admin";
		$nama_akun_pemesan = "-";
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = "6";
		$kurir = "6";
		$resi = "-";
		$metpem = "1";
		$tanggal = $this->input->post('tanggal');
		$uang = "0";
		$level = 3;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');
		$biaya_ongkir = "0";
		$email_pemesanan = "-";
		$note = $this->input->post('note');
		$status = 3;
		$diskon = 0;
		$biaya_admin = 0;
		$pemesanan_id = $this->m_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir,$resi, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);
		$size = sizeof($barang_id);
		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barangP($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->m_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}
		$a = $this->m_list_barang->SUMLBNR($pemesanan_id)->row_array();
		$jumlah = $a['total_keseluruhan'];
		$this->m_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
		echo $this->session->set_flashdata('msg', 'success');
		redirect('Admin/Pemesanan/produksi');
	}

	function hapus_pesananproduksi()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$this->m_pemesanan->hapus_pesanan($pemesanan_id);
		echo $this->session->set_flashdata('msg', 'hapus');
		redirect('Admin/Pemesanan/produksi');
	}

	function statusproduksi()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$status_pemesanan = $this->input->post('status_pemesanan');
		$jumlah = $this->input->post('jumlah');
		if ($status_pemesanan == 0) {
			$status_pemesanan = 1;
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 1) {
			$status_pemesanan = 2;
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 2) {
			$status_pemesanan = 3;
			$this->m_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		}
		redirect('Admin/Pemesanan/produksi');
	}


	function konfirmasi_pesanan()
	{
		if ($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true) {
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
			$x['kurir'] = $this->m_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
			$x['produksi'] = $this->m_barang->getdataProduksi();
			$x['reseller'] = $this->m_barang->getAllBarangR();
			$x['datapesanan'] = $this->m_pemesanan->getPemesananKonfirmasi();
			$this->load->view('v_header', $y);
			$this->load->view('admin/v_sidebar');
			$this->load->view('admin/v_pemesanan_konfirmasi_pesanan', $x);
		} else {
			redirect('Login');
		}
	}

	function savepemesanankonfirmasi_pesananCustomer()
	{
		$nama_pemesan = $this->input->post('nama_pemesan');
		$nama_akun_pemesan = "-";
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = $this->input->post('at');
		$kurir = $this->input->post('kurir');
		$metpem = $this->input->post('metpem');
		$tanggal = $this->input->post('tanggal');
		$diskon = $this->input->post('diskon');
		$biaya_admin = $this->input->post('biaya_admin');
		$uang = $this->input->post('uang');
		$level = 1;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');
		$biaya_ongkir = $this->input->post('biaya_ongkir');
		$email_pemesanan = $this->input->post('email_pemesanan');
		$note = $this->input->post('note');
		$status = 0;
		$pemesanan_id = $this->m_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);


		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barang($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->m_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect('Admin/Pemesanan/konfirmasi_pesanan');
	}

	function savepemesanankonfirmasi_pesananReseller()
	{
		$nama_pemesan = $this->input->post('nama_pemesan');
		$nama_akun_pemesan = $this->input->post('nama_akun_pemesan');
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = $this->input->post('at');
		$kurir = $this->input->post('kurir');
		$metpem = $this->input->post('metpem');
		$tanggal = $this->input->post('tanggal');
		$diskon = $this->input->post('diskon');
		$biaya_admin = $this->input->post('biaya_admin');
		$uang = $this->input->post('uang');
		$level = 1;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');
		$biaya_ongkir = $this->input->post('biaya_ongkir');
		$email_pemesanan = $this->input->post('email_pemesanan');
		$note = $this->input->post('note');
		$status = 0;
		$level = 2;
		$pemesanan_id = $this->m_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);

		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barangR($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->m_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect('Admin/Pemesanan/konfirmasi_pesanan');
	}

	function savepemesanankonfirmasi_pesananProduksi()
	{
		$nama_pemesan = "admin";
		$nama_akun_pemesan = "-";
		$no_hp = "-";
		$alamat = "-";
		$asal_transaksi = "6";
		$kurir = "6";
		$metpem = "1";
		$tanggal = $this->input->post('tanggal');
		$uang = "0";
		$level = 3;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');
		$biaya_ongkir = "0";
		$email_pemesanan = "-";
		$note = $this->input->post('note');
		$status = 3;
		$diskon = 0;
		$biaya_admin = 0;
		$pemesanan_id = $this->m_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);
		$size = sizeof($barang_id);
		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barangP($pemesanan_id, $qty[$i], $barang_id[$i], $level);
		}
		$a = $this->m_list_barang->SUMLBNR($pemesanan_id)->row_array();
		$jumlah = $a['total_keseluruhan'];
		$this->m_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
		echo $this->session->set_flashdata('msg', 'success');
		redirect('Admin/Pemesanan/konfirmasi_pesanan');
	}

	function hapus_pesanankonfirmasi_pesanan()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$this->m_pemesanan->hapus_pesanan($pemesanan_id);
		echo $this->session->set_flashdata('msg', 'hapus');
		redirect('Admin/Pemesanan/konfirmasi_pesanan');
	}

	function statuskonfirmasi_pesanan()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$status_pemesanan = $this->input->post('status_pemesanan');
		$jumlah = $this->input->post('jumlah');
		
		if ($status_pemesanan == 0) {
			$status_pemesanan = 1;
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 1) {
			$status_pemesanan = 2;
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 2) {
			$status_pemesanan = 3;
			$this->m_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		}
		redirect('Admin/Pemesanan/konfirmasi_pesanan');
	}


	function savepemesananNR()
	{
		$nama_pemesan = $this->input->post('nama_pemesan');
		$nama_akun_pemesan = "-";
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = $this->input->post('at');
		$kurir = $this->input->post('kurir');
		$resi = $this->input->post('resi');
		$metpem = $this->input->post('metpem');
		$tanggal = $this->input->post('tanggal');
		$diskon = $this->input->post('diskon');
		$biaya_admin = $this->input->post('biaya_admin');
		$uang = $this->input->post('uang');
		$level = 1;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');
		$biaya_ongkir = $this->input->post('biaya_ongkir');
		$email_pemesanan = $this->input->post('email_pemesanan');
		$note = $this->input->post('note');
		$status = 0;
		$pemesanan_id = $this->m_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $resi, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);
		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barang($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->m_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect('Admin/Pemesanan');
	}

	function tambahpesananNR()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$level = 2;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');

		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barang($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->m_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect("Admin/Pemesanan/list_barang/$pemesanan_id/$level");
	}

	function tambahpesananR()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$level = 1;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');

		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barang($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->m_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect("Admin/Pemesanan/list_barang/$pemesanan_id/$level");
	}

	function hapuspesananlb()
	{
		$lb_id = $this->input->post('lb_id');
		$pemesanan_id = $this->input->post('pemesanan_id');
		$barang_id = $this->input->post('barang_id');
		$qty = $this->input->post('qty');
		$this->m_list_barang->hapus_list_barang($pemesanan_id, $lb_id, $qty, $barang_id);
		echo $this->session->set_flashdata('msg', 'delete');
		redirect($this->agent->referrer());
	}

	function hapus_pesanan()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$this->m_pemesanan->hapus_pesanan($pemesanan_id);
		echo $this->session->set_flashdata('msg', 'hapus');
		redirect('Admin/Pemesanan');
	}

	function savepemesananR()
	{
		$nama_pemesan = $this->input->post('nama_pemesan');
		$nama_akun_pemesan = $this->input->post('nama_akun_pemesan');
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = $this->input->post('at');
		$kurir = $this->input->post('kurir');
		$resi = $this->input->post('no_resi');
		$metpem = $this->input->post('metpem');
		$tanggal = $this->input->post('tanggal');
		$diskon = $this->input->post('diskon');
		$biaya_admin = $this->input->post('biaya_admin');
		$uang = $this->input->post('uang');
		$level = 1;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');
		$biaya_ongkir = $this->input->post('biaya_ongkir');
		$email_pemesanan = $this->input->post('email_pemesanan');
		$note = $this->input->post('note');
		$status = 0;
		$level = 2;
		$pemesanan_id = $this->m_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $resi, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);

		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barangR($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->m_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect('Admin/Pemesanan');
	}

	function savepemesananP()
	{
		$nama_pemesan = "admin";
		$nama_akun_pemesan = "-";
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = "6";
		$kurir = "6";
		$resi = "-";
		$metpem = "1";
		$tanggal = $this->input->post('tanggal');
		$uang = "0";
		$level = 3;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');
		$biaya_ongkir = "0";
		$email_pemesanan = "-";
		$note = $this->input->post('note');
		$status = 3;
		$diskon = 0;
		$biaya_admin = 0;
		$pemesanan_id = $this->m_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $resi, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);
		$size = sizeof($barang_id);
		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barangP($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->m_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}
		$a = $this->m_list_barang->SUMLBNR($pemesanan_id)->row_array();
		$jumlah = $a['total_keseluruhan'];
		$this->m_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
		echo $this->session->set_flashdata('msg', 'success');
		redirect('Admin/Pemesanan');
	}

	function edit_pesanan()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$nama_pemesan = $this->input->post('nama_pemesan');
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = $this->input->post('at');
		$kurir = $this->input->post('kurir');
		$resi = $this->input->post('no_resi');
		$metode_pembayaran = $this->input->post('mp');
		// $tanggal = $this->input->post('tanggal');

		$this->m_pemesanan->edit_pesanan($pemesanan_id, $nama_pemesan, $no_hp, $alamat, $kurir, $resi, $asal_transaksi, $metode_pembayaran);
		echo $this->session->set_flashdata('msg', 'update');
		redirect('Admin/Pemesanan');
	}

	function list_barang($pemesanan_id)
	{
		if ($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true) {
			$level = $this->uri->segment(5);
			$y['title'] = "List Barang Pemesan";
			$x['p_id'] = $pemesanan_id;
			$x['lvl'] = $level;
			$x['listbarang'] = $this->m_list_barang->get_list_barang($pemesanan_id);
			$a = $this->m_list_barang->SUMLBNR($pemesanan_id)->row_array();
			$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
			$x['jumlah'] = $a['total_keseluruhan'];
			$this->load->view('v_header', $y);
			$this->load->view('admin/v_sidebar');
			$this->load->view('admin/v_list_barang', $x);
		} else {
			redirect('Login');
		}
	}

	function Cetak_Invoice($pemesanan_id) 
	{
		$level = $this->uri->segment(5);
		if ($level == 1) {
			$y['title'] = "Cetak Invoice id: " . $pemesanan_id;
			$x['p_id'] = $pemesanan_id;
			$x['lvl'] = $level;
			$x['listbarang'] = $this->m_list_barang->get_list_barang($pemesanan_id);
			$x['pemesan'] = $this->m_pemesanan->getIdbyid($pemesanan_id);
			$a = $this->m_pemesanan->getIdbyid($pemesanan_id)->row_array();
			$x['kurir'] = $a['kurir_nama'];
			$x['mp_nama'] = $a['mp_nama'];
			$x['nama'] = $this->session->userdata('nama');
			$this->load->view('admin/v_cetak_invoice', $x);
		} elseif ($level == 2) {
			$y['title'] = "Cetak Invoice id: " . $pemesanan_id;
			$x['p_id'] = $pemesanan_id;
			$x['lvl'] = $level;
			$x['listbarang'] = $this->m_list_barang->get_list_barang($pemesanan_id);
			$x['pemesan'] = $this->m_pemesanan->getIdbyid($pemesanan_id);
			$a = $this->m_pemesanan->getIdbyid($pemesanan_id)->row_array();
			$x['kurir'] = $a['kurir_nama'];
			$x['mp_nama'] = $a['mp_nama'];
			$x['nama'] = $this->session->userdata('nama');
			$this->load->view('admin/v_cetak_invoice', $x);
		}
	}

	function asal_transaksi()
	{
		if ($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true) {
			$y['title'] = "Asal Transaksi";
			$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
			$this->load->view('v_header', $y);
			$this->load->view('admin/v_sidebar');
			$this->load->view('admin/v_asal_transaksi', $x);
		} else {
			redirect('Login');
		}
	}

	function saveAT()
	{
		$at_nama = $this->input->post('at_nama');
		$this->m_pemesanan->save_at($at_nama);
		echo $this->session->set_flashdata('msg', 'success');
		redirect('Admin/Pemesanan/asal_transaksi');
	}

	function updateAT()
	{
		$id = $this->input->post('at_id');
		$at_nama = $this->input->post('at_nama');
		$this->m_pemesanan->update_at($id, $at_nama);
		echo $this->session->set_flashdata('msg', 'update');
		redirect('Admin/Pemesanan/asal_transaksi');
	}

	function hapusAT()
	{
		$id = $this->input->post('at_id');
		$this->m_pemesanan->hapus_at($id);
		echo $this->session->set_flashdata('msg', 'delete');
		redirect('Admin/Pemesanan/asal_transaksi');
	}

	function kurir()
	{
		if ($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true) {
			$y['title'] = "Kurir";
			$x['kurir'] = $this->m_pemesanan->getAllkurir();
			$this->load->view('v_header', $y);
			$this->load->view('admin/v_sidebar');
			$this->load->view('admin/v_kurir', $x);
		} else {
			redirect('Login');
		}
	}

	function savekurir()
	{
		$kurir_nama = $this->input->post('kurir_nama');
		$this->m_pemesanan->save_kurir($kurir_nama);
		echo $this->session->set_flashdata('msg', 'success');
		redirect('Admin/Pemesanan/kurir');
	}

	function updatekurir()
	{
		$id = $this->input->post('kurir_id');
		$kurir_nama = $this->input->post('kurir_nama');
		$this->m_pemesanan->update_kurir($id, $kurir_nama);
		echo $this->session->set_flashdata('msg', 'update');
		redirect('Admin/Pemesanan/kurir');
	}

	function hapuskurir()
	{
		$id = $this->input->post('kurir_id');
		$this->m_pemesanan->hapus_kurir($id);
		echo $this->session->set_flashdata('msg', 'delete');
		redirect('Admin/Pemesanan/kurir');
	}

	function metode_pembayaran()
	{
		if ($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true) {
			$y['title'] = "Metode Pembayaran";
			$x['metpem'] = $this->m_pemesanan->getAllMetpem();
			$this->load->view('v_header', $y);
			$this->load->view('admin/v_sidebar');
			$this->load->view('admin/v_metode_pembayaran', $x);
		} else {
			redirect('Login');
		}
	}

	function saveMetodePembayaran()
	{
		$metpem_nama = $this->input->post('mp_nama');
		$this->m_pemesanan->save_Metpem($metpem_nama);
		echo $this->session->set_flashdata('msg', 'success');
		redirect('Admin/Pemesanan/metode_pembayaran');
	}

	function updateMetodePembayaran()
	{
		$id = $this->input->post('mp_id');
		$metpem_nama = $this->input->post('mp_nama');
		$this->m_pemesanan->update_Metpem($id, $metpem_nama);
		echo $this->session->set_flashdata('msg', 'update');
		redirect('Admin/Pemesanan/metode_pembayaran');
	}

	function hapusMetodePembayaran()
	{
		$id = $this->input->post('mp_id');
		$this->m_pemesanan->hapus_Metpem($id);
		echo $this->session->set_flashdata('msg', 'delete');
		redirect('Admin/Pemesanan/metode_pembayaran');
	}
	function status()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$status_pemesanan = $this->input->post('status_pemesanan');
		$jumlah = $this->input->post('jumlah');
		if ($status_pemesanan == 0) {
			$status_pemesanan = 1;
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 1) {
			$status_pemesanan = 2;
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 2) {
			$status_pemesanan = 3;
			$this->m_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		}
		redirect('Admin/pemesanan');
	}

	function statusByBulan()
	{
		
	$bulan = $this->input->get('bulan');
		$pemesanan_id = $this->input->post('pemesanan_id');
		$status_pemesanan = $this->input->post('status_pemesanan');
		$jumlah = $this->input->post('jumlah');
		if ($status_pemesanan == 0) {
			$status_pemesanan = 1;
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 1) {
			$status_pemesanan = 2;
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 2) {
			$status_pemesanan = 3;
			$this->m_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
			$this->m_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		}
		redirect('Admin/Pemesanan/viewPemesananByBulan/'.$bulan);
	}

	function viewPemesananByBulan($bulan){
		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
			switch ($bulan){
				case 1 : $x['namaBulan'] = "Januari"; $x['tanggalAkhir'] = 31; break;
				case 2 : $x['namaBulan'] =  "Februari"; 
				switch(date('Y')%4) {
					case 0 : $x['tanggalAkhir'] = 29; break;
					case 1 : $x['tanggalAkhir'] = 28; break;
				}break;
				case 3 : $x['namaBulan'] =  "Maret"; $x['tanggalAkhir'] = 31; break;
				case 4 : $x['namaBulan'] =  "April"; $x['tanggalAkhir'] = 30; break;
				case 5 : $x['namaBulan'] =  "Mei"; $x['tanggalAkhir'] = 31; break;
				case 6 : $x['namaBulan'] =  "Juni"; $x['tanggalAkhir'] = 30;break;
				case 7 : $x['namaBulan'] =  "Juli"; $x['tanggalAkhir'] = 31; break;
				case 8 : $x['namaBulan'] =  "Agustus"; $x['tanggalAkhir'] = 31; break;
				case 9 : $x['namaBulan'] =  "September"; $x['tanggalAkhir'] = 30;break;
				case 10 : $x['namaBulan'] =  "Oktober"; $x['tanggalAkhir'] = 31; break;
				case 11 : $x['namaBulan'] =  "November"; $x['tanggalAkhir'] = 30;break;
				case 12 : $x['namaBulan'] =  "Desember"; $x['tanggalAkhir'] = 31; break;
			  }

			$namaBulan = $x['namaBulan'];
			$x['bulan'] = $bulan;
			$y['title'] = "Pemesanan Bulan $namaBulan";
			$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
			$x['kurir'] = $this->m_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
			 $x['produksi'] = $this->m_barang->getdataProduksi();
			$x['reseller'] = $this->m_barang->getAllBarangR();
			$x['datapesanan'] = $this->m_pemesanan->getPemesananAllbyBulan($bulan, date('Y'));
			$this->load->view('v_header',$y);
			$this->load->view('admin/v_sidebar');
			$this->load->view('admin/v_pemesanan_all_by_bulan',$x);
		 }
		 else{
			redirect('Login');
		 }
	   }
	   
	   function pemesananByTahun(){
		$tahun = intVal($this->input->post('thn'));
		$x ['stsp'] = 0;
		$x['bulan'] = 0;
		$x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
		$x['kurir'] = $this->m_pemesanan->getAllkurir();
		$x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
		$x['nonreseller'] = $this->m_barang->getDataNonReseller1();
		 $x['produksi'] = $this->m_barang->getdataProduksi();
		$x['reseller'] = $this->m_barang->getAllBarangR();
		$x['datapesanan'] = $this->m_pemesanan->getPemesananbyTahun2($tahun);
		$this->load->view('admin/v_pemesanan_by_tahun', $x);
		
	   }

	}



