<?php 
	/**
	 * 
	 */
	class Pemesanan extends CI_Controller
	{
		
		function __construct()
	  	{
		    parent:: __construct();
			if ($this->session->userdata('masuk') != TRUE || ($this->session->userdata('akses') != 3 && $this->session->userdata('akses') != 1)) {
				$url = base_url('Login');
				redirect($url);
			};

			$this->load->library('pdf');
		    $this->load->model('M_pemesanan');
		    $this->load->model('M_barang');	
		    $this->load->model('m_list_barang');
		    $this->load->library('upload');
	  	}

	  	
	  	function index(){
			$this->kurir();
		}

 	  	function Cetak_Invoice($pemesanan_id){
 	  		$level = $this->uri->segment(5);
 	  		   if($level == 1){
 	  		   	$y['title'] = "List Barang Pemesan";
 	  		   	   $x['p_id'] = $pemesanan_id;
 	  		   	   $x['lvl'] =$level;	
	 	  		   $x['listbarang'] = $this->m_list_barang->getLBRbyid($pemesanan_id);	
	 	  		   $x['pemesan'] = $this->M_pemesanan->getIdbyid($pemesanan_id);
	 	  		    $a = $this->M_pemesanan->getIdbyid($pemesanan_id)->row_array();
 	  		   	   $x['kurir'] = $a['kurir_nama'];
 	  		   	   $x['mp_nama'] = $a['mp_nama'];
 	  		  	   $x['nama'] = $this->session->userdata('nama');
			       $this->load->view('stok/v_cetak_invoice',$x);
 	  		   }elseif($level == 3){
 	  		   	   $y['title'] = "List Barang Pemesan";
 	  		   	   $x['p_id'] = $pemesanan_id;
 	  		   	   $x['lvl'] =$level;	
 	  		   	   $x['listbarang'] = $this->m_list_barang->getLBNRbyid($pemesanan_id);
 	  		   	   $x['pemesan'] = $this->M_pemesanan->getIdbyid($pemesanan_id);
 	  		   	   $a = $this->M_pemesanan->getIdbyid($pemesanan_id)->row_array();
 	  		   	   $x['kurir'] = $a['kurir_nama'];
 	  		   	   $x['mp_nama'] = $a['mp_nama'];
 	  		   	   $x['nama'] = $this->session->userdata('nama');
			       $this->load->view('stok/v_cetak_invoice',$x);
 	  		   }
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
			   if($resi == null){
				   $resi = "-";
			   }
			   else{
				   $resi = $this->input->post('no_resi');
			   }
			   $metode_pembayaran = $this->input->post('mp');
			   // $tanggal = $this->input->post('tanggal');
	   
			   $this->M_pemesanan->edit_pesanan($pemesanan_id, $nama_pemesan, $no_hp, $alamat, $kurir, $resi, $asal_transaksi, $metode_pembayaran);
			   echo $this->session->set_flashdata('msg', 'update');
			   redirect('stok/Pemesanan/kurir');
		   }


	  	function kurir(){
	  		$y['title'] = "Kurir";
			   $x['datapesanan'] = $this->M_pemesanan->getPemesananEkspedisi();
			   $x['kurir'] = $this->M_pemesanan->getAllkurir();
			   $this->load->view('v_header',$y);
			   if($this->session->userdata('akses') == 3){
				$this->load->view('stok/v_sidebar');
			}
			else if($this->session->userdata('akses') == 1){
				$this->load->view('owner/v_sidebar');
			}
		       $this->load->view('stok/v_kurir',$x);
	  	}

	  	function savekurir(){
	  		$kurir_nama = $this->input->post('kurir_nama');
	  		$this->M_pemesanan->save_kurir($kurir_nama);
	  		echo $this->session->set_flashdata('msg','success');
	       	redirect('stok/Pemesanan/kurir');
	  	}

	  	function updatekurir(){
	  		$id = $this->input->post('kurir_id');
	  		$kurir_nama = $this->input->post('kurir_nama');
	  		$this->M_pemesanan->update_kurir($id,$kurir_nama);
	  		echo $this->session->set_flashdata('msg','update');
	       	redirect('stok/Pemesanan/kurir');
	  	}

	  	function hapuskurir(){
	  		$id = $this->input->post('kurir_id');
	  		$this->M_pemesanan->hapus_kurir($id);
	  		echo $this->session->set_flashdata('msg','delete');
	       	redirect('stok/Pemesanan/kurir');
	  	}

		  function status(){
            $pemesanan_id = $this->input->post('pemesanan_id');
            $status_eks=$this->input->post('status_eks');
			if ($status_eks == 0) {
				$status_eks = 1;
				$this->M_pemesanan->status_eks($pemesanan_id, $status_eks);
			} else if ($status_eks == 1) {
				$status_eks = 2;
				$this->M_pemesanan->status_eks($pemesanan_id, $status_eks);
			} else if ($status_eks == 2) {
				$status_eks = 3;
				$this->M_pemesanan->status_eks($pemesanan_id, $status_eks);
			} 
            redirect('stok/Pemesanan/Kurir');	
		}

		function convertWordBerjalan(){
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananEkspedisi();
			$this->load->view('stok/laporan_word', $x);
		}
	
		function convertPDFBerjalan(){
		$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananEkspedisi();

				$this->pdf->setPaper('legal', 'landscape');
				$this->pdf->filename = "laporan_pdf.pdf";
				$this->pdf->load_view('stok/laporan_pdf', $x);
		}
	
		function convertExcelBerjalan(){
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananEkspedisi();
			$this->load->view('stok/laporan_excel', $x);
		}
		
		function convertWordPBerjalan(){
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananEkspedisi();
			$this->load->view('stok/laporanP_word', $x);
		}
	
		function convertPDFPBerjalan(){
		$y['title'] = "Pemesanan";
				$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
				$x['kurir'] = $this->M_pemesanan->getAllkurir();
				$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['produksi'] = $this->M_barang->getdataProduksi();
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$x['datapesanan'] = $this->M_pemesanan->getPemesananEkspedisi();

				$this->pdf->setPaper('legal', 'landscape');
				$this->pdf->filename = "laporan_pdf.pdf";
				$this->pdf->load_view('stok/laporanP_pdf', $x);
		}
	
		function convertExcelPBerjalan(){
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananEkspedisi();
			$this->load->view('stok/laporanP_excel', $x);
		}

		function cetakTransaksiBerjalan(){

			$x['data'] = $this->M_pemesanan->getPemesananEkspedisi();
			$a = $this->M_pemesanan->getPemesananEkspedisi();
			$modal = 0;
			$total_u = 0;
			$total_o = 0;
	
			$total_untung = 0;
			$total_omset =0;
	
	
			
			foreach ($a->result_array() as $i) {
				$pemesanan_id = $i['pemesanan_id'];
				$level = $i['status_customer'];
				$b = $this->M_pemesanan->getHargaModal($pemesanan_id, $level);
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
			$this->load->view('v_cetakP_ekspedisi', $x);
		}

		function cetakTransaksiTBerjalan(){

			$x['data'] = $this->M_pemesanan->getPemesananEkspedisi();
			$a = $this->M_pemesanan->getPemesananEkspedisi();
			$modal = 0;
			$total_u = 0;
			$total_o = 0;
	
			$total_untung = 0;
			$total_omset =0;
	
	
			
			foreach ($a->result_array() as $i) {
				$pemesanan_id = $i['pemesanan_id'];
				$level = $i['status_customer'];
				$b = $this->M_pemesanan->getHargaModal($pemesanan_id, $level);
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
			$this->load->view('v_cetak_ekspedisi', $x);
		}


}
	