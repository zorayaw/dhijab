<?php

/**
 * 
 */
class Pemesanan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE || ($this->session->userdata('akses') != 2 && $this->session->userdata('akses') !=1)) {
			$url = base_url('Login');
			redirect($url);
		};
		$this->load->library('pdf');
		$this->load->model('M_pemesanan');
		$this->load->model('M_barang');
		$this->load->model('m_list_barang');
		$this->load->library('upload');
	}

	function index()
	{
			$y['title'] = "Seluruh Pemesanan";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesanan();
			$this->load->view('v_header', $y);
			if($this->session->userdata('akses') == 2){
				$this->load->view('admin/v_sidebar');
			}
			else if($this->session->userdata('akses') == 1){
				$this->load->view('owner/v_sidebar');
			}
			
			$this->load->view('admin/v_pemesanan', $x);
	}


	// function index()
	// {
	// 	$tahun = intVal($this->input->post('thn'));

	// 	if ($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true) {
	// 		$y['title'] = "Pemesanan";
	// 		$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
	// 		$x['kurir'] = $this->M_pemesanan->getAllkurir();
	// 		$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
	// 		$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
	// 		$x['produksi'] = $this->M_barang->getdataProduksi();
	// 		$x['reseller'] = $this->M_barang->getAllBarangR();
	// 		$x['datapesanan'] = $this->M_pemesanan->getPemesananSesuaiTahun($tahun);
	// 		$this->load->view('v_header', $y);
	// 		$this->load->view('admin/v_sidebar');
	// 		$this->load->view('admin/v_pemesanan', $x);
	// 	} else {
	// 		redirect('Login');
	// 	}
	// }

	function convertPDF(){
		$doc = $this->input->get('doc');
		$statusc = $this->input->get('status');
		$x['numstat'] = $statusc;
			if($statusc==0){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi";
				}
				$x['stts'] = "pAll";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesanan();
			}
			else if($statusc==1){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan Customer";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi Customer";
				}
				$x['stts'] = "pAll";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomer();
			}
			else if($statusc==2){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan Reseller";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi Reseller";
				}
				$x['stts'] = "pAll";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananreseller();
			}
			else if($statusc==3){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan Produksi";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi Produksi";
				}
				$x['stts'] = "pAll";
				$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananproduksi();
			}		
			
			$this->pdf->setPaper('legal', 'landscape');
			$this->pdf->filename = "laporan_pdf.pdf";
			if($doc==2)
			$this->pdf->load_view('admin/laporan_pdf', $x);
			elseif($doc==1)
			$this->pdf->load_view('admin/laporanP_pdf', $x);
	}

	function convertPDFPBerjalan(){
		$doc = $this->input->get('doc');
				if($doc == 1){
					$x['title'] = "Pemesanan Berjalan";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Berjalan";
				}
				$x['stts'] = "pTransaksi";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananKonfirmasi();

				$this->pdf->setPaper('legal', 'landscape');
				$this->pdf->filename = "laporan_pdf.pdf";
				if($doc == 2)
				$this->pdf->load_view('admin/laporan_pdf', $x);
				else
				$this->pdf->load_view('admin/laporanP_pdf', $x);

	}

	function convertPDFPerhari(){
		$doc = $this->input->get('doc');
		$statusc = $this->input->get('status');
		$x['numstat'] = $statusc;
			if($statusc==0){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi";
				}
				$x['stts'] = "pperhari";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananCurdate();
			}
			else if($statusc==1){
				if($doc == 1){
					$x['title'] = "Pemesanan Customer";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Customer";
				}
				$x['stts'] = "pperhari";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerCurdate();
			}
			else if($statusc==2){
				if($doc == 1){
					$x['title'] = "Pemesanan Reseller";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Reseller";
				}
				$x['stts'] = "pperhari";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerCurdate();
			}
			else if($statusc==3){
				if($doc == 1){
					$x['title'] = "Pemesanan Produksi";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Produksi";
				}
				$x['stts'] = "pperhari";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksiCurdate();
			}		
			$this->pdf->setPaper('legal', 'landscape');
			$this->pdf->filename = "laporan_pdf.pdf";
			if($doc==2)
			$this->pdf->load_view('admin/laporan_pdf', $x);
			elseif($doc==1)
			$this->pdf->load_view('admin/laporanP_pdf', $x);
	}	

	function convertPDFPerbulan(){
		$doc = $this->input->get('doc');
		$statusc = $this->input->get('status');
		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');
		$x['numstat'] = $statusc;
		$x['bulan'] = $bulan;
		$x['tahun'] = $tahun;
		if($statusc==0){
			if($doc == 1){
				$x['title'] = "Seluruh Pemesanan";
			}
			else if($doc == 2) {
				$x['title'] = "Seluruh Transaksi";
			}
			$x['stts'] = "pperbulan";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananByBulan($bulan,$tahun);
		}
		else if($statusc==1){
			if($doc == 1){
				$x['title'] = "Pemesanan Customer";
			}
			else if($doc == 2) {
				$x['title'] = "Transaksi Customer";
			}
			$x['stts'] = "pperbulan";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerByBulan($bulan,$tahun);
			}
		else if($statusc==2){
			if($doc == 1){
				$x['title'] = "Pemesanan Reseller";
			}
			else if($doc == 2) {
				$x['title'] = "Transaksi Reseller";
			}
			$x['stts'] = "pperbulan";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerByBulan($bulan, $tahun);
		}
		else if($statusc==3){
			if($doc == 1){
				$x['title'] = "Pemesanan Produksi";
			}
			else if($doc == 2) {
				$x['title'] = "Transaksi Produksi";
			}
			$x['stts'] = "pperbulan";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksiByBulan($bulan, $tahun);
		}	
		$this->pdf->setPaper('legal', 'landscape');
			$this->pdf->filename = "laporan_pdf.pdf";
			if($doc==2)
			$this->pdf->load_view('admin/laporan_pdf', $x);
			elseif($doc==1)
			$this->pdf->load_view('admin/laporanP_pdf', $x);	
	}

	function convertPDFByBulanTanpaTahun(){
		$doc = $this->input->get('doc');
		$statusc = $this->input->get('status');
		$bulan = $this->input->get('bulan');
		$awal = $this->input->post('start_year');
		$akhir = $this->input->post('end_year');
		$x['numstat'] = $statusc;
		$x['bulan'] = $bulan;
		$x['awal'] = $awal;
		$x['akhir'] = $akhir;

		if($statusc==0){
			if($doc == 1){
				$x['title'] = "Seluruh Pemesanan";
			}
			else if($doc == 2) {
				$x['title'] = "Seluruh Transaksi";
			}
			$x['stts'] = "pperbulantanpatahun";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananByBulanTanpaTahun($bulan,$awal, $akhir);
		}
		else if($statusc==1){
			if($doc == 1){
				$x['title'] = "Pemesanan Customer";
			}
			else if($doc == 2) {
				$x['title'] = "Transaksi Customer";
			}
			$x['stts'] = "pperbulantanpatahun";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerByBulanTanpaTahun($bulan,$awal, $akhir);
			}
		else if($statusc==2){
			if($doc == 1){
				$x['title'] = "Pemesanan Reseller";
			}
			else if($doc == 2) {
				$x['title'] = "Transaksi Reseller";
			}
			$x['stts'] = "pperbulantanpatahun";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerByBulanTanpaTahun($bulan,$awal, $akhir);
		}
		else if($statusc==3){
			if($doc == 1){
				$x['title'] = "Pemesanan Produksi";
			}
			else if($doc == 2) {
				$x['title'] = "Transaksi Produksi";
			}
			$x['stts'] = "pperbulantanpatahun";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksiByBulanTanpaTahun($bulan,$awal, $akhir);
		}
		$this->pdf->setPaper('legal', 'landscape');
			$this->pdf->filename = "laporan_pdf.pdf";
			if($doc==2)
			$this->pdf->load_view('admin/laporan_pdf', $x);
			elseif($doc==1)
			$this->pdf->load_view('admin/laporanP_pdf', $x);
	}

	function convertPDFPerTanggal(){
		$doc = $this->input->get('doc');
		$statusc = $this->input->get('status');
		$start = $this->input->post('start_date');
		$end = $this->input->post('end_date');
		$x['numstat'] = $statusc;
		$x['start'] = $start;
		$x['end'] = $end;
		
		if($statusc==0){
			if($doc == 1){
				$x['title'] = "Seluruh Pemesanan";
			}
			else if($doc == 2) {
				$x['title'] = "Seluruh Transaksi";
			}
			$x['stts'] = "ppertanggal";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananByTanggal($start, $end);
		}
		else if($statusc==1){
			if($doc == 1){
				$x['title'] = "Pemesanan Customer";
			}
			else if($doc == 2) {
				$x['title'] = "Transaksi Customer";
			}
			$x['stts'] = "ppertanggal";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerByTanggal($start, $end);
		}
		else if($statusc==2){
			if($doc == 1){
				$x['title'] = "Pemesanan Reseller";
			}
			else if($doc == 2) {
				$x['title'] = "Transaksi Reseller";
			}
			$x['stts'] = "ppertanggal";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerByTanggal($start, $end);
		}
		else if($statusc==3){
			if($doc == 1){
				$x['title'] = "Pemesanan Produksi";
			}
			else if($doc == 2) {
				$x['title'] = "Transaksi Produksi";
			}
			$x['stts'] = "ppertanggal";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksiByTanggal($start, $end);
		}
		$this->pdf->setPaper('legal', 'landscape');
			$this->pdf->filename = "laporan_pdf.pdf";
			if($doc==2)
			$this->pdf->load_view('admin/laporan_pdf', $x);
			elseif($doc==1)
			$this->pdf->load_view('admin/laporanP_pdf', $x);
	}
	

	function convertWord(){
		$doc = $this->input->get('doc');
		$statusc = $this->input->get('status');
		$x['numstat'] = $statusc;
			if($statusc==0){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi";
				}
				$x['stts'] = "wAll";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesanan();
			}
			else if($statusc==1){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan Customer";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi Customer";
				}
				$x['stts'] = "wAll";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomer();
			}
			else if($statusc==2){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan Reseller";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi Reseller";
				}
				$x['stts'] = "wAll";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananreseller();
			}
			else if($statusc==3){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan Produksi";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi Produksi";
				}
				$x['stts'] = "wAll";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananproduksi();
			}
			if($doc==2)
				$this->load->view('admin/laporan_word', $x);
				elseif($doc==1)
				$this->load->view('admin/laporanP_word', $x);
		
	}

	function convertWordPBerjalan(){
		$doc = $this->input->get('doc');
		if($doc == 1){
			$x['title'] = "Pemesanan Berjalan";
		}
		else if($doc == 2) {
			$x['title'] = "Transaksi Berjalan";
		}
		$x['stts'] = "wTransaksi";
		$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
		$x['kurir'] = $this->M_pemesanan->getAllkurir();
		$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
		$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
		$x['produksi'] = $this->M_barang->getdataProduksi();
		$x['reseller'] = $this->M_barang->getAllBarangR();
		$x['datapesanan'] = $this->M_pemesanan->getPemesananKonfirmasi();
		if ($doc==2)
		$this->load->view('admin/laporan_word', $x);
		else
		$this->load->view('admin/laporanP_word', $x);

	}

	function convertWordPerhari(){
		$doc = $this->input->get('doc');
		$statusc = $this->input->get('status');
		$x['numstat'] = $statusc;
			if($statusc==0){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi";
				}
				$x['stts'] = "wperhari";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananCurdate();
			}
			else if($statusc==1){
				if($doc == 1){
					$x['title'] = "Pemesanan Customer";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Customer";
				}
				$x['stts'] = "wperhari";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerCurdate();
			}
			else if($statusc==2){
				if($doc == 1){
					$x['title'] = "Pemesanan Reseller";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Reseller";
				}
				$x['stts'] = "wperhari";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerCurdate();
			}
			else if($statusc==3){

				if($doc == 1){
					$x['title'] = "Pemesanan Produksi";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Produksi";
				}
				$x['stts'] = "wperhari";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksiCurdate();
			}
			if($doc==2)
				$this->load->view('admin/laporan_word', $x);
				elseif($doc==1)
				$this->load->view('admin/laporanP_word', $x);
		
	}

	function convertWordPerbulan(){
		$doc = $this->input->get('doc');
			$statusc = $this->input->get('status');
			$bulan = $this->input->get('bulan');
			$tahun = $this->input->get('tahun');
			$x['numstat'] = $statusc;
			$x['bulan'] = $bulan;
			$x['tahun'] = $tahun;
			if($statusc==0){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi";
				}
				$x['stts'] = "wperbulan";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananByBulan($bulan,$tahun);
			}
			else if($statusc==1){
				if($doc == 1){
					$x['title'] = "Pemesanan Customer";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Customer";
				}
				$x['stts'] = "wperbulan";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerByBulan($bulan,$tahun);
				}
			else if($statusc==2){
				if($doc == 1){
					$x['title'] = "Pemesanan Reseller";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Reseller";
				}
				$x['stts'] = "wperbulan";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerByBulan($bulan, $tahun);
			}
			else if($statusc==3){
				if($doc == 1){
					$x['title'] = "Pemesanan Produksi";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Produksi";
				}
				$x['stts'] = "wperbulan";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksiByBulan($bulan, $tahun);
			}
			if($doc==2)
				$this->load->view('admin/laporan_word', $x);
				elseif($doc==1)
				$this->load->view('admin/laporanP_word', $x);
	}

	function ConvertWordByBulanTanpaTahun(){
		$doc = $this->input->get('doc');
		$statusc = $this->input->get('status');
		$bulan = $this->input->get('bulan');
		$awal = $this->input->post('start_year');
		$akhir = $this->input->post('end_year');
		$x['numstat'] = $statusc;
		$x['bulan'] = $bulan;
		$x['awal'] = $awal;
		$x['akhir'] = $akhir;
		
		if($statusc==0){
			if($doc == 1){
				$x['title'] = "Seluruh Pemesanan";
			}
			else if($doc == 2) {
				$x['title'] = "Seluruh Transaksi";
			}
			$x['stts'] = "wperbulantanpatahun";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananByBulanTanpaTahun($bulan, $awal, $akhir);
		}
		else if($statusc==1){
			if($doc == 1){
				$x['title'] = "Pemesanan Customer";
			}
			else if($doc == 2) {
				$x['title'] = "Transaksi Customer";
			}
			$x['stts'] = "wperbulantanpatahun";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerByBulanTanpaTahun($bulan, $awal, $akhir);
		}
		else if($statusc==2){
			if($doc == 1){
				$x['title'] = "Pemesanan Reseller";
			}
			else if($doc == 2) {
				$x['title'] = "Transaksi Reseller";
			}
			$x['stts'] = "wperbulantanpatahun";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerByBulanTanpaTahun($bulan, $awal, $akhir);
		}
		else if($statusc==3){
			if($doc == 1){
				$x['title'] = "Pemesanan Produksi";
			}
			else if($doc == 2) {
				$x['title'] = "Transaksi Produksi";
			}
			$x['stts'] = "wperbulantanpatahun";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksiByBulanTanpaTahun($bulan, $awal, $akhir);
		}
		if($doc==2)
				$this->load->view('admin/laporan_word', $x);
				elseif($doc==1)
				$this->load->view('admin/laporanP_word', $x);
	}

	function convertWordPertanggal(){
		$doc = $this->input->get('doc');
		$statusc = $this->input->get('status');
			$start = $this->input->post('start_date');
			$end = $this->input->post('end_date');
			$x['numstat'] = $statusc;
			$x['start'] = $start;
			$x['end'] = $end;
			
			if($statusc==0){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi";
				}
				$x['stts'] = "wpertanggal";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananByTanggal($start, $end);
			}
			else if($statusc==1){
				if($doc == 1){
					$x['title'] = "Pemesanan Customer";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Customer";
				}
				$x['stts'] = "wpertanggal";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerByTanggal($start, $end);
			}
			else if($statusc==2){
				if($doc == 1){
					$x['title'] = "Pemesanan Reseller";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Reseller";
				}
				$x['stts'] = "wpertanggal";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerByTanggal($start, $end);
			}
			else if($statusc==3){
				if($doc == 1){
					$x['title'] = "Pemesanan Produksi";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Produksi";
				}
				$x['stts'] = "wpertanggal";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksiByTanggal($start, $end);
			}
			if($doc==2)
			$this->load->view('admin/laporan_word', $x);
			elseif($doc==1)
			$this->load->view('admin/laporanP_word', $x);
	}

	function convertExcel(){
		$doc = $this->input->get('doc');
		$statusc = $this->input->get('status');
		$x['numstat'] = $statusc;
			if($statusc==0){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi";
				}
				$x['stts'] = "eAll";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesanan();
				
			}
			else if($statusc==1){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan Customer";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi Customer";
				}
				$x['stts'] = "eAll";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomer();
			}
			else if($statusc==2){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan Reseller";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi Reseller";
				}
				$x['stts'] = "eAll";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananreseller();
			}
			else if($statusc==3){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan Produksi";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi Produksi";
				}
				$x['stts'] = "eAll";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananproduksi();
			}
			if($doc==2)
				$this->load->view('admin/laporan_excel', $x);
				elseif($doc==1)
				$this->load->view('admin/laporanP_excel', $x);
		
	}

	function convertExcelPBerjalan(){
		$doc = $this->input->get('doc');
				if($doc == 1){
					$x['title'] = "Pemesanan Berjalan";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Berjalan";
				}
				$x['stts'] = "eTransaksi";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananKonfirmasi();
				if($doc==2)
				$this->load->view('admin/laporan_excel', $x);
				else
				$this->load->view('admin/laporanP_excel', $x);

			}

	function convertExcelPerhari(){
		$doc = $this->input->get('doc');
		$statusc = $this->input->get('status');
		$x['numstat'] = $statusc;
			if($statusc==0){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi";
				}
				$x['stts'] = "eperhari";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananCurdate();
			}
			else if($statusc==1){
				if($doc == 1){
					$x['title'] = "Pemesanan Customer";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Customer";
				}
				$x['stts'] = "eperhari";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerCurdate();
			}
			else if($statusc==2){
				if($doc == 1){
					$x['title'] = "Pemesanan Reseller";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Reseller";
				}
				$x['stts'] = "eperhari";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerCurdate();
			}
			else if($statusc==3){
				if($doc == 1){
					$x['title'] = "Pemesanan Produksi";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Produksi";
				}
				$x['stts'] = "eperhari";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksiCurdate();
			}
			if($doc==2)
				$this->load->view('admin/laporan_excel', $x);
			elseif($doc==1)
				$this->load->view('admin/laporanP_excel', $x);
					
	}	

	function convertExcelPerbulan(){
		$doc = $this->input->get('doc');
			$statusc = $this->input->get('status');
			$bulan = $this->input->get('bulan');
			$tahun = $this->input->get('tahun');
			$x['numstat'] = $statusc;
			$x['bulan'] = $bulan;
			$x['tahun'] = $tahun;
			if($statusc==0){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi";
				}
				$x['stts'] = "eperbulan";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananByBulan($bulan,$tahun);
			}
			else if($statusc==1){
				if($doc == 1){
					$x['title'] = "Pemesanan Customer";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Customer";
				}
				$x['stts'] = "eperbulan";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerByBulan($bulan,$tahun);
				}
			else if($statusc==2){
				if($doc == 1){
					$x['title'] = "Pemesanan Reseller";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Reseller";
				}
				$x['stts'] = "eperbulan";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerByBulan($bulan, $tahun);
			}
			else if($statusc==3){
				if($doc == 1){
					$x['title'] = "Pemesanan Produksi";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Produksi";
				}
				$x['stts'] = "eperbulan";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksiByBulan($bulan, $tahun);
			}
			if($doc==2)
				$this->load->view('admin/laporan_excel', $x);
				elseif($doc==1)
				$this->load->view('admin/laporanP_excel', $x);
	}

	function ConvertExcelByBulanTanpaTahun(){
		$doc = $this->input->get('doc');
		$statusc = $this->input->get('status');
		$bulan = $this->input->get('bulan');
		$awal = $this->input->post('start_year');
		$akhir = $this->input->post('end_year');
		$x['numstat'] = $statusc;
		$x['bulan'] = $bulan;
		$x['awal'] = $awal;
		$x['akhir'] = $akhir;
		
		if($statusc==0){
			if($doc == 1){
				$x['title'] = "Seluruh Pemesanan";
			}
			else if($doc == 2) {
				$x['title'] = "Seluruh Transaksi";
			}
			$x['stts'] = "eperbulantanpatahun";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananByBulanTanpaTahun($bulan, $awal, $akhir);
		}
		else if($statusc==1){
			if($doc == 1){
				$x['title'] = "Pemesanan Customer";
			}
			else if($doc == 2) {
				$x['title'] = "Transaksi Customer";
			}
			$x['stts'] = "eperbulantanpatahun";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerByBulanTanpaTahun($bulan, $awal, $akhir);
		}
		else if($statusc==2){
			if($doc == 1){
				$x['title'] = "Pemesanan Reseller";
			}
			else if($doc == 2) {
				$x['title'] = "Transaksi Reseller";
			}
			$x['stts'] = "eperbulantanpatahun";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerByBulanTanpaTahun($bulan, $awal, $akhir);
		}
		else if($statusc==3){
			if($doc == 1){
				$x['title'] = "Pemesanan Produksi";
			}
			else if($doc == 2) {
				$x['title'] = "Transaksi Produksi";
			}
			$x['stts'] = "eperbulantanpatahun";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksiByBulanTanpaTahun($bulan, $awal, $akhir);
		}
		if($doc==2)
				$this->load->view('admin/laporan_excel', $x);
				elseif($doc==1)
				$this->load->view('admin/laporanP_excel', $x);
	}

	function convertExcelByTanggal(){
		$doc = $this->input->get('doc');
		$statusc = $this->input->get('status');
			$start = $this->input->post('start_date');
			$end = $this->input->post('end_date');
			$x['numstat'] = $statusc;
			$x['start'] = $start;
			$x['end'] = $end;
			
			if($statusc==0){
				if($doc == 1){
					$x['title'] = "Seluruh Pemesanan";
				}
				else if($doc == 2) {
					$x['title'] = "Seluruh Transaksi";
				}
				$x['stts'] = "epertanggal";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananByTanggal($start, $end);
			}
			else if($statusc==1){
				if($doc == 1){
					$x['title'] = "Pemesanan Customer";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Customer";
				}
				$x['stts'] = "epertanggal";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerByTanggal($start, $end);
			}
			else if($statusc==2){
				if($doc == 1){
					$x['title'] = "Pemesanan Reseller";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Reseller";
				}
				$x['stts'] = "epertanggal";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerByTanggal($start, $end);
	
			}
			else if($statusc==3){
				if($doc == 1){
					$x['title'] = "Pemesanan Produksi";
				}
				else if($doc == 2) {
					$x['title'] = "Transaksi Produksi";
				}
				$x['stts'] = "epertanggal";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksiByTanggal($start, $end);
			}
			if($doc==2)
			$this->load->view('admin/laporan_excel', $x);
			elseif($doc==1)
			$this->load->view('admin/laporanP_excel', $x);
	}



	function customer()
	{
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomer();
			$this->load->view('v_header', $y);
			if($this->session->userdata('akses') == 2){
				$this->load->view('admin/v_sidebar');
			}
			else if($this->session->userdata('akses') == 1){
				$this->load->view('owner/v_sidebar');
			}
			$this->load->view('admin/v_pemesanan_customer', $x);
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
		if($resi == null){
			$resi = "-";
		}
		else{
			$resi = $this->input->post('no_resi');
		}
		$username = $this->input->post('username');
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
		$pemesanan_id = $this->M_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $resi,$username, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);



		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barang($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->M_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/Pemesanan/customer');
	}

	function hapus_pesananCustomer()
	{ 
		$pemesanan_id = $this->input->post('pemesanan_id');
		$this->M_pemesanan->hapus_pesanan($pemesanan_id);
		echo $this->session->set_flashdata('msg', 'hapus');
		redirect('admin/Pemesanan/customer');
	}

	function statusCustomer()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$status_pemesanan = $this->input->post('status_pemesanan');
		$jumlah = $this->input->post('jumlah');
		if ($status_pemesanan == 0) {
			$status_pemesanan = 1;
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 1) {
			$status_pemesanan = 2;
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 2) {
			$status_pemesanan = 3;
			$this->M_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		}
		redirect('admin/Pemesanan/customer');
	}

	function reseller()
	{
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananreseller();
			$this->load->view('v_header', $y);
			if($this->session->userdata('akses') == 2){
				$this->load->view('admin/v_sidebar');
			}
			else if($this->session->userdata('akses') == 1){
				$this->load->view('owner/v_sidebar');
			}
			$this->load->view('admin/v_pemesanan_reseller', $x);
		
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
		if($resi == null){
			$resi = "-";
		}
		else{
			$resi = $this->input->post('no_resi');
		}
		$username = $this->input->post('username');
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
		$pemesanan_id = $this->M_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $resi,$username, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);


		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barangR($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->M_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/Pemesanan/reseller');
	}

	function hapus_pesananreseller()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$this->M_pemesanan->hapus_pesanan($pemesanan_id);
		echo $this->session->set_flashdata('msg', 'hapus');
		redirect('admin/Pemesanan/reseller');
	}

	function statusreseller()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$status_pemesanan = $this->input->post('status_pemesanan');
		$jumlah = $this->input->post('jumlah');
		if ($status_pemesanan == 0) {
			$status_pemesanan = 1;
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 1) {
			$status_pemesanan = 2;
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 2) {
			$status_pemesanan = 3;
			$this->M_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		}
		redirect('admin/Pemesanan/reseller');
	}

	function produksi()
	{
		
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananproduksi();
			$this->load->view('v_header', $y);
			if($this->session->userdata('akses') == 2){
				$this->load->view('admin/v_sidebar');
			}
			else if($this->session->userdata('akses') == 1){
				$this->load->view('owner/v_sidebar');
			}
			$this->load->view('admin/v_pemesanan_produksi', $x);
		
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
		$username = $this->input->post('username');
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

		$pemesanan_id = $this->M_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir,$resi, $username, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);

		$size = sizeof($barang_id);
		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barangP($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->M_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}
		$a = $this->m_list_barang->SUMLBNR($pemesanan_id)->row_array();
		$jumlah = $a['total_keseluruhan'];
		$this->M_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/Pemesanan/produksi');
	}

	function hapus_pesananproduksi()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$this->M_pemesanan->hapus_pesanan($pemesanan_id);
		echo $this->session->set_flashdata('msg', 'hapus');
		redirect('admin/Pemesanan/produksi');
	}

	function statusproduksi()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$status_pemesanan = $this->input->post('status_pemesanan');
		$jumlah = $this->input->post('jumlah');
		if ($status_pemesanan == 0) {
			$status_pemesanan = 1;
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 1) {
			$status_pemesanan = 2;
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 2) {
			$status_pemesanan = 3;
			$this->M_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		}
		redirect('admin/Pemesanan/produksi');
	}


	function konfirmasi_pesanan()
	{
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananKonfirmasi();
			$this->load->view('v_header', $y);
			if($this->session->userdata('akses') == 2){
				$this->load->view('admin/v_sidebar');
			}
			else if($this->session->userdata('akses') == 1){
				$this->load->view('owner/v_sidebar');
			}
			$this->load->view('admin/v_pemesanan_konfirmasi_pesanan', $x);
		
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
		$pemesanan_id = $this->M_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);


		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barang($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->M_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/Pemesanan/konfirmasi_pesanan');
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
		$pemesanan_id = $this->M_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);

		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barangR($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->M_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/Pemesanan/konfirmasi_pesanan');
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
		$pemesanan_id = $this->M_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);
		$size = sizeof($barang_id);
		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barangP($pemesanan_id, $qty[$i], $barang_id[$i], $level);
		}
		$a = $this->m_list_barang->SUMLBNR($pemesanan_id)->row_array();
		$jumlah = $a['total_keseluruhan'];
		$this->M_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/Pemesanan/konfirmasi_pesanan');
	}

	function hapus_pesanankonfirmasi_pesanan()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$this->M_pemesanan->hapus_pesanan($pemesanan_id);
		echo $this->session->set_flashdata('msg', 'hapus');
		redirect('admin/Pemesanan/konfirmasi_pesanan');
	}

	function statuskonfirmasi_pesanan()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$status_pemesanan = $this->input->post('status_pemesanan');
		$jumlah = $this->input->post('jumlah');
		
		if ($status_pemesanan == 0) {
			$status_pemesanan = 1;
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 1) {
			$status_pemesanan = 2;
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 2) {
			$status_pemesanan = 3;
			$this->M_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		}
		redirect('admin/Pemesanan/konfirmasi_pesanan');
	}


	function savepemesananNR()
	{
		$nama_pemesan = $this->input->post('nama_pemesan');
		$nama_akun_pemesan = "-";
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = $this->input->post('at');
		$kurir = $this->input->post('kurir');
		$resi = $this->input->post('no_resi');
		if($resi == null){
			$resi = "-";
		}
		else{
			$resi = $this->input->post('no_resi');
		}
		$username = $this->input->post('username');
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
		$pemesanan_id = $this->M_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $resi, $username, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);

		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barang($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->M_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/Pemesanan');
	}

	function tambahpesananNR()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$lvl = $this->input->post('lvl');
		$level = 2;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');

		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barang($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->M_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect("admin/Pemesanan/list_barang/$pemesanan_id/$lvl");
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
			$this->M_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect("admin/Pemesanan/list_barang/$pemesanan_id/$level");
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
		$this->M_pemesanan->hapus_pesanan($pemesanan_id);
		echo $this->session->set_flashdata('msg', 'hapus');
		redirect('admin/Pemesanan');
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
		if($resi == null){
			$resi = "-";
		}
		else{
			$resi = $this->input->post('no_resi');
		}
		$username = $this->input->post('username');
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
		$pemesanan_id = $this->M_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $resi,$username, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);


		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barangR($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->M_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/Pemesanan');
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
		$username = $this->input->post('username');
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
		$pemesanan_id = $this->M_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $resi,$username, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);

		$size = sizeof($barang_id);
		for ($i = 0; $i < $size; $i++) {
			$this->m_list_barang->save_list_barangP($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->M_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}
		$a = $this->m_list_barang->SUMLBNR($pemesanan_id)->row_array();
		$jumlah = $a['total_keseluruhan'];
		$this->M_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/Pemesanan');
	}

	function edit_pesanan()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$nama_pemesan = $this->input->post('nama_pemesan');
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = $this->input->post('at');
		$kurir = $this->input->post('kurir');
		$username = $this->input->post('username');
		$resi = $this->input->post('no_resi');
		if($resi == null){
			$resi = "-";
		}
		else{
			$resi = $this->input->post('no_resi');
		}
		$metode_pembayaran = $this->input->post('mp');
		// $tanggal = $this->input->post('tanggal');
		$this->M_pemesanan->edit_pesanan($pemesanan_id, $nama_pemesan, $no_hp, $alamat, $kurir, $resi,$username, $asal_transaksi, $metode_pembayaran);

		echo $this->session->set_flashdata('msg', 'update');
		redirect('admin/Pemesanan');
	}

	function edit_pesanankonfPesanan(){
		$pemesanan_id = $this->input->post('pemesanan_id');
		$nama_pemesan = $this->input->post('nama_pemesan');
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = $this->input->post('at');
		$kurir = $this->input->post('kurir');
		$username = $this->input->post('username');
		$resi = $this->input->post('no_resi');
		if($resi == null){
			$resi = "-";
		}
		else{
			$resi = $this->input->post('no_resi');
		}
		$metode_pembayaran = $this->input->post('mp');
		// $tanggal = $this->input->post('tanggal');
		$this->M_pemesanan->edit_pesanan($pemesanan_id, $nama_pemesan, $no_hp, $alamat, $kurir, $resi,$username, $asal_transaksi, $metode_pembayaran);

		echo $this->session->set_flashdata('msg', 'update');
		redirect('admin/Pemesanan/konfirmasi_pesanan');
	}

	function list_barang($pemesanan_id)
	{
			$level = $this->uri->segment(5);
			$y['title'] = "List Barang Pemesan";
			$x['p_id'] = $pemesanan_id;
			$x['lvl'] = $level;
			$x['listbarang'] = $this->m_list_barang->get_list_barang($pemesanan_id);
			$a = $this->m_list_barang->SUMLBNR($pemesanan_id)->row_array();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['jumlah'] = $a['total_keseluruhan'];
			$this->load->view('v_header', $y);
			if($this->session->userdata('akses') == 2){
				$this->load->view('admin/v_sidebar');
			}
			else if($this->session->userdata('akses') == 1){
				$this->load->view('owner/v_sidebar');
			}
			$this->load->view('admin/v_list_barang', $x);
	}

	function Cetak_Invoice($pemesanan_id) 
	{
		$level = $this->uri->segment(5);
		if ($level == 1) {
			$y['title'] = "Cetak Invoice id: " . $pemesanan_id;
			$x['p_id'] = $pemesanan_id;
			$x['lvl'] = $level;
			$x['listbarang'] = $this->m_list_barang->get_list_barang($pemesanan_id);
			$x['pemesan'] = $this->M_pemesanan->getIdbyid($pemesanan_id);
			$a = $this->M_pemesanan->getIdbyid($pemesanan_id)->row_array();
			$x['kurir'] = $a['kurir_nama'];
			$x['mp_nama'] = $a['mp_nama'];
			$x['nama'] = $this->session->userdata('nama');
			$this->load->view('admin/v_cetak_invoice', $x);
		} elseif ($level == 2) {
			$y['title'] = "Cetak Invoice id: " . $pemesanan_id;
			$x['p_id'] = $pemesanan_id;
			$x['lvl'] = $level;
			$x['listbarang'] = $this->m_list_barang->get_list_barang($pemesanan_id);
			$x['pemesan'] = $this->M_pemesanan->getIdbyid($pemesanan_id);
			$a = $this->M_pemesanan->getIdbyid($pemesanan_id)->row_array();
			$x['kurir'] = $a['kurir_nama'];
			$x['mp_nama'] = $a['mp_nama'];
			$x['nama'] = $this->session->userdata('nama');
			$this->load->view('admin/v_cetak_invoice', $x);
		}
	}

	function asal_transaksi()
	{
		
			$y['title'] = "Asal Transaksi";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$this->load->view('v_header', $y);
			if($this->session->userdata('akses') == 2){
				$this->load->view('admin/v_sidebar');
			}
			else if($this->session->userdata('akses') == 1){
				$this->load->view('owner/v_sidebar');
			}
			$this->load->view('admin/v_asal_transaksi', $x);
	}

	function saveAT()
	{
		$at_nama = $this->input->post('at_nama');
		$this->M_pemesanan->save_at($at_nama);
		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/Pemesanan/asal_transaksi');
	}

	function updateAT()
	{
		$id = $this->input->post('at_id');
		$at_nama = $this->input->post('at_nama');
		$this->M_pemesanan->update_at($id, $at_nama);
		echo $this->session->set_flashdata('msg', 'update');
		redirect('admin/Pemesanan/asal_transaksi');
	}

	function hapusAT()
	{
		$id = $this->input->post('at_id');
		$this->M_pemesanan->hapus_at($id);
		echo $this->session->set_flashdata('msg', 'delete');
		redirect('admin/Pemesanan/asal_transaksi');
	}

	function kurir()
	{
			$y['title'] = "Kurir";
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$this->load->view('v_header', $y);
			if($this->session->userdata('akses') == 2){
				$this->load->view('admin/v_sidebar');
			}
			else if($this->session->userdata('akses') == 1){
				$this->load->view('owner/v_sidebar');
			}
			$this->load->view('admin/v_kurir', $x);
		
	}

	function savekurir()
	{
		$kurir_nama = $this->input->post('kurir_nama');
		$this->M_pemesanan->save_kurir($kurir_nama);
		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/Pemesanan/kurir');
	}

	function updatekurir()
	{
		$id = $this->input->post('kurir_id');
		$kurir_nama = $this->input->post('kurir_nama');
		$this->M_pemesanan->update_kurir($id, $kurir_nama);
		echo $this->session->set_flashdata('msg', 'update');
		redirect('admin/Pemesanan/kurir');
	}

	function hapuskurir()
	{
		$id = $this->input->post('kurir_id');
		$this->M_pemesanan->hapus_kurir($id);
		echo $this->session->set_flashdata('msg', 'delete');
		redirect('admin/Pemesanan/kurir');
	}

	function metode_pembayaran()
	{
		
			$y['title'] = "Metode Pembayaran";
			$x['metpem'] = $this->M_pemesanan->getAllMetpem();
			$this->load->view('v_header', $y);
			if($this->session->userdata('akses') == 2){
				$this->load->view('admin/v_sidebar');
			}
			else if($this->session->userdata('akses') == 1){
				$this->load->view('owner/v_sidebar');
			}
			$this->load->view('admin/v_metode_pembayaran', $x);
		
	}

	function saveMetodePembayaran()
	{
		$metpem_nama = $this->input->post('mp_nama');
		$this->M_pemesanan->save_Metpem($metpem_nama);
		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/Pemesanan/metode_pembayaran');
	}

	function updateMetodePembayaran()
	{
		$id = $this->input->post('mp_id');
		$metpem_nama = $this->input->post('mp_nama');
		$this->M_pemesanan->update_Metpem($id, $metpem_nama);
		echo $this->session->set_flashdata('msg', 'update');
		redirect('admin/Pemesanan/metode_pembayaran');
	}

	function hapusMetodePembayaran()
	{
		$id = $this->input->post('mp_id');
		$this->M_pemesanan->hapus_Metpem($id);
		echo $this->session->set_flashdata('msg', 'delete');
		redirect('admin/Pemesanan/metode_pembayaran');
	}
	function status()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$status_pemesanan = $this->input->post('status_pemesanan');
		$jumlah = $this->input->post('jumlah');
		
		if ($status_pemesanan == 0) {
			$status_pemesanan = 1;
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 1) {
			$status_pemesanan = 2;
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 2) {
			$status_pemesanan = 3;
			$this->M_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		}
		redirect('admin/pemesanan');
	}

	function statusByBulan()
	{
		
	$bulan = $this->input->get('bulan');
		$pemesanan_id = $this->input->post('pemesanan_id');
		$status_pemesanan = $this->input->post('status_pemesanan');
		$jumlah = $this->input->post('jumlah');
		if ($status_pemesanan == 0) {
			$status_pemesanan = 1;
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 1) {
			$status_pemesanan = 2;
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 2) {
			$status_pemesanan = 3;
			$this->M_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		}
		redirect('admin/Pemesanan/viewPemesananByBulan/'.$bulan);
	}

	function viewPemesananByBulan($bulan){
		
			switch ($bulan){
				case 1 : $x['namaBulan'] = "Januari"; $x['tanggalAkhir'] = 31; break;
				case 2 : $x['namaBulan'] =  "Februari"; 
				switch(date('Y')%4) {
					case 0 : $x['tanggalAkhir'] = 29; break;
					default : $x['tanggalAkhir'] = 28; break;
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
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			 $x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananbyBulanSemuaTahun($bulan);
			$this->load->view('v_header',$y);
			if($this->session->userdata('akses') == 2){
				$this->load->view('admin/v_sidebar');
			}
			else if($this->session->userdata('akses') == 1){
				$this->load->view('owner/v_sidebar');
			}
			$this->load->view('admin/v_pemesanan_all_by_bulan',$x);
		 
	   }
	   
	function pemesananByTahun(){
		$tahun = intVal($this->input->post('thn'));
		$x ['stsp'] = 0;
		$x['bulan'] = 0;
		$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
		$x['kurir'] = $this->M_pemesanan->getAllkurir();
		$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
		$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
		 $x['produksi'] = $this->M_barang->getdataProduksi();
		$x['reseller'] = $this->M_barang->getAllBarangR();
		if ($tahun == 0){
			$x['datapesanan'] = $this->M_pemesanan->getPemesanan();
		}
		else
			$x['datapesanan'] = $this->M_pemesanan->getPemesananbyTahun2($tahun);
		$this->load->view('admin/v_pemesanan_by_tahun', $x);
		
	   }

	   function pemesananByTanggal(){
		$start = $this->input->post('startt');
		$end = $this->input->post('endd');
		$x ['stsp'] = 0;
		$x['bulan'] = 0;
		$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
		$x['kurir'] = $this->M_pemesanan->getAllkurir();
		$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
		$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
		 $x['produksi'] = $this->M_barang->getdataProduksi();
		$x['reseller'] = $this->M_barang->getAllBarangR();
		$x['datapesanan'] = $this->M_pemesanan->getPemesananByTanggal($start, $end);
		$this->load->view('admin/v_pemesanan_by_tahun', $x);
		
	   }

	}



