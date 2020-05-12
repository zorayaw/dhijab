<?php 
	/**
	 * 
	 */
	class Keuangan extends CI_Controller
	{
		
		function __construct()
	  	{
		    parent:: __construct();
		    if($this->session->userdata('masuk') !=TRUE){
		      $url=base_url('Login');
		      redirect($url);
		    };

			$this->load->model('M_pemesanan');
			$this->load->model('M_barang');
		    $this->load->library('upload');
	  	}

	  	function index(){
			  $statusc = $this->input->get('status');
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
				  $x['st'] = $statusc;
                $y['title'] = "Data Keuangan";
                $x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
                $x['kurir'] = $this->M_pemesanan->getAllkurir();
                $x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
                $x['nonreseller'] = $this->M_barang->getDataNonReseller1();
                $x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				if($statusc==0){
					$x['datapesanan'] = $this->M_pemesanan->getPemesananbyTahun2(date('Y'));
					$x['stat'] = "Seluruh";
				}
				else if($statusc==1){
					$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerbyTahun2(date('Y'));
					$x['stat'] = "Customer";
				}
				else if($statusc==2){
					$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerbyTahun2(date('Y'));
					$x['stat'] = "Reseller";
				}
				else if($statusc==3){
					$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksibyTahun2(date('Y'));
					$x['stat'] = "Produksi";
				}
                
                $this->load->view('v_header', $y);
                    $this->load->view('owner/v_sidebar');
		       $this->load->view('owner/LapKeu/v_lapKeuAll',$x);
		    }
		    else
		       redirect('Login');
	  	}

	  	function Cari(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
		       $y['title'] = "Transaksi";
		       $dari = $this->input->post('daritgl');
		       $ke = $this->input->post('ketgl');
		       $x['dari'] = $dari;
		       $x['ke'] = $ke;
		       $x['datapesanan'] = $this->M_pemesanan->getPemesananMonth($dari,$ke);
		       $a = $this->M_pemesanan->getPemesananMonth($dari,$ke);
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
		  
		  function pemesananByTahun(){
			  $statusc=$this->input->get('status');
			$tahun = intVal($this->input->post('thn'));
			$x ['stsp'] = 0;
			$x['bulan'] = 0;
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			 $x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			if($statusc==0){
				$x['datapesanan'] = $this->M_pemesanan->getPemesananbyTahun2($tahun);
			}
			else if($statusc==1){
				$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerbyTahun2($tahun);
			}
			else if($statusc==2){
				$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerbyTahun2($tahun);
			}
			else if($statusc==3){
				$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksibyTahun2($tahun);
			}
			$this->load->view('owner/LapKeu/v_lapKeu_by_tahun', $x);
			
		   }


	  		}
	

?>