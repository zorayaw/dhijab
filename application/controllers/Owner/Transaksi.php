<?php 
	/**
	 * 
	 */
	class Transaksi extends CI_Controller
	{
		
		function __construct()
	  	{
		    parent:: __construct();
		    if($this->session->userdata('masuk') !=TRUE){
		      $url=base_url('Login');
		      redirect($url);
		    };

		    $this->load->model('m_pemesanan');
		    $this->load->library('upload');
	  	}

	  	function index(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
		       $y['title'] = "Transaksi";
		       $x['datapesanan'] = $this->m_pemesanan->getPemesanan();
		       $a = $this->m_pemesanan->getPemesanan();
		       $total_u = 0;
		       $total_o = 0;
		       foreach ($a->result_array() as $i) {
		       	$pemesanan_id = $i['pemesanan_id'];
		       	$level = $i['level'];
		       	if($level == 1){
		       		$t = $this->db->query("SELECT SUM(a.lb_qty * d.br_harga) AS total_omset, (SUM(a.lb_qty * d.br_harga))-(SUM(a.lb_qty * c.barang_harga_modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.lb_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
              		$d=$t->row_array();
               		$total_untung = $d['total_untung'];
               		$total_omset = $d['total_omset'];
		       	}elseif($level == 2){
		       		$t = $this->db->query("SELECT SUM(a.lb_qty * d.bnr_harga) AS total_omset, (SUM(a.lb_qty * d.bnr_harga))-(SUM(a.lb_qty * c.barang_harga_modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
              		$d=$t->row_array();
               		$total_untung = $d['total_untung'];
               		$total_omset = $d['total_omset'];
		       	}

		       		$total_u = $total_u + $total_untung;
		       		$total_o = $total_o + $total_omset;
		       }
		       
               $total_untung = $total_u;
               $total_omset = $total_o;
               $x['total_untung'] = $total_untung;
               $x['total_omset'] = $total_omset;
		       $this->load->view('v_header',$y);
		       $this->load->view('owner/v_sidebar');
		       $this->load->view('owner/v_transaksi',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function Cari(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
		       $y['title'] = "Transaksi";
		       $dari = $this->input->post('daritgl');
		       $ke = $this->input->post('ketgl');
		       $x['dari'] = $dari;
		       $x['ke'] = $ke;
		       $x['datapesanan'] = $this->m_pemesanan->getPemesananMonth($dari,$ke);
		       $a = $this->m_pemesanan->getPemesananMonth($dari,$ke);
		       $total_u = 0;
		       $total_o = 0;
		       foreach ($a->result_array() as $i) {
		       	$pemesanan_id = $i['pemesanan_id'];
		       	$level = $i['level'];
		       	if($level == 1){
		       		$t = $this->db->query("SELECT SUM(a.lb_qty * d.br_harga) AS total_omset, (SUM(a.lb_qty * d.br_harga))-(SUM(a.lb_qty * c.barang_harga_modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.lb_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
              		$d=$t->row_array();
               		$total_untung = $d['total_untung'];
               		$total_omset = $d['total_omset'];
		       	}elseif($level == 2){
		       		$t = $this->db->query("SELECT SUM(a.lb_qty * d.bnr_harga) AS total_omset, (SUM(a.lb_qty * d.bnr_harga))-(SUM(a.lb_qty * c.barang_harga_modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
              		$d=$t->row_array();
               		$total_untung = $d['total_untung'];
               		$total_omset = $d['total_omset'];
		       	}

		       		$total_u = $total_u + $total_untung;
		       		$total_o = $total_o + $total_omset;
		       }
               $total_untung = $total_u;
               $total_omset = $total_o;
               $x['total_untung'] = $total_untung;
               $x['total_omset'] = $total_omset;
		       $this->load->view('v_header',$y);
		       $this->load->view('owner/v_sidebar');
		       $this->load->view('owner/v_cari_transaksi',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	// function cetak_transaksiTanggal(){
	  	// 	$dari = $this->input->post('daritgl');
		//     $ke = $this->input->post('ketgl');
		//     $x['dari'] = $dari;
		//     $x['ke'] = $ke;
		//     $x['data'] = $this->m_pemesanan->getPemesananMonth($dari,$ke);
	  	// 	$a = $this->m_pemesanan->getPemesananMonth($dari,$ke);
		//        $total_u = 0;
		//        $total_o = 0;
		//        foreach ($a->result_array() as $i) {
		//        	$pemesanan_id = $i['pemesanan_id'];
		//        	$level = $i['level'];
		//        	if($level == 1){
		//        		$t = $this->db->query("SELECT SUM(a.lb_qty * d.br_harga) AS total_omset, (SUM(a.lb_qty * d.br_harga))-(SUM(a.lb_qty * c.barang_harga_modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.lb_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
        //       		$d=$t->row_array();
        //        		$total_untung = $d['total_untung'];
        //        		$total_omset = $d['total_omset'];
		//        	}elseif($level == 2){
		//        		$t = $this->db->query("SELECT SUM(a.lb_qty * d.bnr_harga) AS total_omset, (SUM(a.lb_qty * d.bnr_harga))-(SUM(a.lb_qty * c.barang_harga_modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
        //       		$d=$t->row_array();
        //        		$total_untung = $d['total_untung'];
        //        		$total_omset = $d['total_omset'];
		//        	}

		//        		$total_u = $total_u + $total_untung;
		//        		$total_o = $total_o + $total_omset;
		//        }
		       
        //        $total_untung = $total_u;
        //        $total_omset = $total_o;
        //        $x['total_untung'] = $total_untung;
        //        $x['total_omset'] = $total_omset;
	  	// 	$this->load->view('v_cetak_perhari',$x);
	  	// }

	  	function cetak_transaksi(){
			  $statusc = $this->input->get('status');

			  if($statusc==0){
				$x['data'] = $this->m_pemesanan->getPemesananCurdate();
				$a = $this->m_pemesanan->getPemesananCurdate();
			}
			else if($statusc==1){
				$x['data'] = $this->m_pemesanan->getPemesananCustomerCurdate();
			$a = $this->m_pemesanan->getPemesananCustomerCurdate();
			}
			else if($statusc==2){
				$x['data'] = $this->m_pemesanan->getPemesananResellerCurdate();
			$a = $this->m_pemesanan->getPemesananResellerCurdate();
			}
			else if($statusc==3){
				$x['data'] = $this->m_pemesanan->getPemesananProduksiCurdate();
			$a = $this->m_pemesanan->getPemesananProduksiCurdate();
			}
			  $modal = 0;
		       $total_u = 0;
			   $total_o = 0;
			   $total_untung = 0;
			   $total_omset = 0;
		       foreach ($a->result_array() as $i) {
		       	$pemesanan_id = $i['pemesanan_id'];
				   $level = $i['status_customer'];
					$b = $this->m_pemesanan->getHargaModal($pemesanan_id, $level);
					foreach($b as $temp){
						$modal = $modal + $temp['harga'];
					}
		       	if($level == 1){
		       		$t = $this->db->query("SELECT SUM(a.lb_qty * d.br_harga) AS total_omset, (SUM(a.lb_qty * d.br_harga))-(SUM(a.lb_qty * $modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.lb_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
              		$d=$t->row_array();
               		$total_untung = $d['total_untung'];
               		$total_omset = $d['total_omset'];
		       	}elseif($level == 2){
		       		$t = $this->db->query("SELECT SUM(a.lb_qty * d.bnr_harga) AS total_omset, (SUM(a.lb_qty * d.bnr_harga))-(SUM(a.lb_qty * $modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
              		$d=$t->row_array();
               		$total_untung = $d['total_untung'];
               		$total_omset = $d['total_omset'];
		       	}

		       		$total_u = $total_u + $total_untung;
		       		$total_o = $total_o + $total_omset;
		       }
		       
               $total_untung = $total_u;
               $total_omset = $total_o;
               $x['total_untung'] = $total_untung;
               $x['total_omset'] = $total_omset;
	  		$this->load->view('v_cetak_perhari',$x);
	  	}
	
		  function cetakTransaksiByTanggal(){
			$statusc = $this->input->post('status');
			$start = $this->input->post('start_date');
			$end = $this->input->post('end_date');
			$x['start'] = $start;
			$x['end'] = $end;

			if($statusc==0){
				$x['data'] = $this->m_pemesanan->getPemesananByTanggal($start,$end);
				$a = $this->m_pemesanan->getPemesananByTanggal($start,$end);
			}
			else if($statusc==1){
				$x['data'] = $this->m_pemesanan->getPemesananCustomerByTanggal($start,$end);
				$a = $this->m_pemesanan->getPemesananCustomerByTanggal($start,$end);
			}
			else if($statusc==2){
				$x['data'] = $this->m_pemesanan->getPemesananResellerByTanggal($start,$end);
				$a = $this->m_pemesanan->getPemesananResellerByTanggal($start,$end);
			}
			else if($statusc==3){
				$x['data'] = $this->m_pemesanan->getPemesananProduksiByTanggal($start,$end);
				$a = $this->m_pemesanan->getPemesananProduksiByTanggal($start,$end);
			}
			$modal = 0;
			$total_u = 0;
			$total_o = 0;
	
			$total_untung = 0;
			$total_omset =0;
	
	
			
			foreach ($a->result_array() as $i) {
				$pemesanan_id = $i['pemesanan_id'];
				$level = $i['status_customer'];
				$b = $this->m_pemesanan->getHargaModal($pemesanan_id, $level);
				foreach ($b as $temp) {
					$modal = $modal + $temp['harga'];
				}
				if ($level == 1) {
					$t = $this->db->query("SELECT SUM(a.lb_qty * d.br_harga) AS total_omset, (SUM(a.lb_qty * d.br_harga))-(SUM(a.lb_qty * $modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.lb_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
					$d = $t->row_array();
					$total_untung = $d['total_untung'];
					$total_omset = $d['total_omset'];
				} elseif ($level == 2) {
					$t = $this->db->query("SELECT SUM(a.lb_qty * d.bnr_harga) AS total_omset, (SUM(a.lb_qty * d.bnr_harga))-(SUM(a.lb_qty * $modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
					$d = $t->row_array();
					$total_untung = $d['total_untung'];
					$total_omset = $d['total_omset'];
				}
	
				$total_u = $total_u + $total_untung;
				$total_o = $total_o + $total_omset;
			}
	
			$total_untung = $total_u;
			$total_omset = $total_o;
			$x['total_untung'] = $total_untung;
			$x['total_omset'] = $total_omset;
			$this->load->view('v_cetak_by_tanggal', $x);
		}

		function cetakTransaksiByBulan(){
			$statusc = $this->input->get('status');
			$bulan = $this->input->get('bulan');
			$tahun = $this->input->get('tahun');
			$x['bulan'] = $bulan;
			$x['tahun'] = $tahun;
			if($statusc==0){
				$x['data'] = $this->m_pemesanan->getPemesananByBulan($bulan, $tahun);
				$a = $this->m_pemesanan->getPemesananByBulan($bulan, $tahun);
			}
			else if($statusc==1){
				$x['data'] = $this->m_pemesanan->getPemesananCustomerByBulan($bulan, $tahun);
			$a = $this->m_pemesanan->getPemesananCustomerByBulan($bulan, $tahun);
			}
			else if($statusc==2){
				$x['data'] = $this->m_pemesanan->getPemesananResellerByBulan($bulan, $tahun);
			$a = $this->m_pemesanan->getPemesananResellerByBulan($bulan, $tahun);
			}
			else if($statusc==3){
				$x['data'] = $this->m_pemesanan->getPemesananProduksiByBulan($bulan, $tahun);
			$a = $this->m_pemesanan->getPemesananProduksiByBulan($bulan, $tahun);
			}
			
			$modal = 0;
			$total_u = 0;
			$total_o = 0;
	
			$total_untung = 0;
			$total_omset =0;
	
	
			
			foreach ($a->result_array() as $i) {
				$pemesanan_id = $i['pemesanan_id'];
				$level = $i['status_customer'];
				$b = $this->m_pemesanan->getHargaModal($pemesanan_id, $level);
				foreach ($b as $temp) {
					$modal = $modal + $temp['harga'];
				}
				if ($level == 1) {
					$t = $this->db->query("SELECT SUM(a.lb_qty * d.br_harga) AS total_omset, (SUM(a.lb_qty * d.br_harga))-(SUM(a.lb_qty * $modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.lb_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
					$d = $t->row_array();
					$total_untung = $d['total_untung'];
					$total_omset = $d['total_omset'];
				} elseif ($level == 2) {
					$t = $this->db->query("SELECT SUM(a.lb_qty * d.bnr_harga) AS total_omset, (SUM(a.lb_qty * d.bnr_harga))-(SUM(a.lb_qty * $modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
					$d = $t->row_array();
					$total_untung = $d['total_untung'];
					$total_omset = $d['total_omset'];
				}
	
				$total_u = $total_u + $total_untung;
				$total_o = $total_o + $total_omset;
			}
	
			$total_untung = $total_u;
			$total_omset = $total_o;
			$x['total_untung'] = $total_untung;
			$x['total_omset'] = $total_omset;
			$this->load->view('v_cetak_by_bulan', $x);
		}

		function cetakTransaksiByTahun(){
			$statusc = $this->input->get('status');
			$tahun = $this->input->get('tahun');
			$x['tahun'] = $tahun;

			if($statusc==0){
				$x['data'] = $this->m_pemesanan->getPemesananByTahun($tahun);
				$a = $this->m_pemesanan->getPemesananByTahun($tahun);
			}
			else if($statusc==1){
				$x['data'] = $this->m_pemesanan->getPemesananCustomerByTahun($tahun);
			$a = $this->m_pemesanan->getPemesananCustomerByTahun($tahun);
			}
			else if($statusc==2){
				$x['data'] = $this->m_pemesanan->getPemesananResellerByTahun($tahun);
			$a = $this->m_pemesanan->getPemesananResellerByTahun($tahun);
			}
			else if($statusc==3){
				$x['data'] = $this->m_pemesanan->getPemesananProduksiByTahun($tahun);
			$a = $this->m_pemesanan->getPemesananProduksiByTahun($tahun);
			}
			$modal = 0;
			$total_u = 0;
			$total_o = 0;
	
			$total_untung = 0;
			$total_omset =0;
	
	
			
			foreach ($a->result_array() as $i) {
				$pemesanan_id = $i['pemesanan_id'];
				$level = $i['status_customer'];
				$b = $this->m_pemesanan->getHargaModal($pemesanan_id, $level);
				foreach ($b as $temp) {
					$modal = $modal + $temp['harga'];
				}
				if ($level == 1) {
					$t = $this->db->query("SELECT SUM(a.lb_qty * d.br_harga) AS total_omset, (SUM(a.lb_qty * d.br_harga))-(SUM(a.lb_qty * $modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.lb_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
					$d = $t->row_array();
					$total_untung = $d['total_untung'];
					$total_omset = $d['total_omset'];
				} elseif ($level == 2) {
					$t = $this->db->query("SELECT SUM(a.lb_qty * d.bnr_harga) AS total_omset, (SUM(a.lb_qty * d.bnr_harga))-(SUM(a.lb_qty * $modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
					$d = $t->row_array();
					$total_untung = $d['total_untung'];
					$total_omset = $d['total_omset'];
				}
	
				$total_u = $total_u + $total_untung;
				$total_o = $total_o + $total_omset;
			}
	
			$total_untung = $total_u;
			$total_omset = $total_o;
			$x['total_untung'] = $total_untung;
			$x['total_omset'] = $total_omset;
			$this->load->view('v_cetak_by_Tahun', $x);
		}

		function cetakTransaksiByBulanTanpaTahun(){
			$statusc = $this->input->get('status');
			$bulan = $this->input->get('bulan');
			$awal = $this->input->post('start_year');
			$akhir = $this->input->post('end_year');
			$x['bulan'] = $bulan;
			$x['awal'] = $awal;
			$x['akhir'] = $akhir;

			if($statusc==0){
				$x['data'] = $this->m_pemesanan->getPemesananByBulanTanpaTahun($bulan, $awal, $akhir);
			$a = $this->m_pemesanan->getPemesananByBulanTanpaTahun($bulan, $awal, $akhir);
			}
			else if($statusc==1){
				$x['data'] = $this->m_pemesanan->getPemesananCustomerByBulanTanpaTahun($bulan, $awal, $akhir);
			$a = $this->m_pemesanan->getPemesananCustomerByBulanTanpaTahun($bulan, $awal, $akhir);
			}
			else if($statusc==2){
				$x['data'] = $this->m_pemesanan->getPemesananResellerByBulanTanpaTahun($bulan, $awal, $akhir);
			$a = $this->m_pemesanan->getPemesananResellerByBulanTanpaTahun($bulan, $awal, $akhir);
			}
			else if($statusc==3){
				$x['data'] = $this->m_pemesanan->getPemesananProduksiByBulanTanpaTahun($bulan, $awal, $akhir);
			$a = $this->m_pemesanan->getPemesananProduksiByBulanTanpaTahun($bulan, $awal, $akhir);
			}
			
			$modal = 0;
			$total_u = 0;
			$total_o = 0;
	
			$total_untung = 0;
			$total_omset =0;
	
	
			
			foreach ($a->result_array() as $i) {
				$pemesanan_id = $i['pemesanan_id'];
				$level = $i['status_customer'];
				$b = $this->m_pemesanan->getHargaModal($pemesanan_id, $level);
				foreach ($b as $temp) {
					$modal = $modal + $temp['harga'];
				}
				if ($level == 1) {
					$t = $this->db->query("SELECT SUM(a.lb_qty * d.br_harga) AS total_omset, (SUM(a.lb_qty * d.br_harga))-(SUM(a.lb_qty * $modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.lb_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
					$d = $t->row_array();
					$total_untung = $d['total_untung'];
					$total_omset = $d['total_omset'];
				} elseif ($level == 2) {
					$t = $this->db->query("SELECT SUM(a.lb_qty * d.bnr_harga) AS total_omset, (SUM(a.lb_qty * d.bnr_harga))-(SUM(a.lb_qty * $modal)) AS total_untung FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE b.pemesanan_id = '$pemesanan_id' AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
					$d = $t->row_array();
					$total_untung = $d['total_untung'];
					$total_omset = $d['total_omset'];
				}
	
				$total_u = $total_u + $total_untung;
				$total_o = $total_o + $total_omset;
			}
	
			$total_untung = $total_u;
			$total_omset = $total_o;
			$x['total_untung'] = $total_untung;
			$x['total_omset'] = $total_omset;
			$this->load->view('v_cetak_by_bulan_tanpa_tahun', $x);
		}
	}
	

?>