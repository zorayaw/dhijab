<?php 
	/**
	 * 
	 */
	class PemesananCustomer extends CI_Controller
	{
		
		function __construct()
	  	{
		    parent:: __construct();
		    if ($this->session->userdata('masuk') != TRUE || ($this->session->userdata('akses') != 2 && $this->session->userdata('akses') != 1)) {
				$url = base_url('Login');
				redirect($url);
			};

		    $this->load->model('M_pemesanan');
		    $this->load->model('M_barang');
		    $this->load->model('m_list_barang');
		    $this->load->library('upload');
	  	}

	  	function index(){
		       $y['title'] = "Pemesanan Customer";
		       $x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
		       $x['kurir'] = $this->M_pemesanan->getAllkurir();
		       $x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
		       $x['nonreseller'] = $this->M_barang->getDataNonReseller1();
		        $x['produksi'] = $this->M_barang->getdataProduksi();
		       $x['reseller'] = $this->M_barang->getAllBarangR();
		       $x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerByTahun2(date('Y'));
		       $this->load->view('v_header',$y);
			   if($this->session->userdata('akses') == 2){
				$this->load->view('admin/v_sidebar');
			}
			else if($this->session->userdata('akses') == 1){
				$this->load->view('owner/v_sidebar');
			}
		       $this->load->view('admin/v_pemesanan_customer',$x);
	  	}

	  	function customer(){
	  			$y['title'] = "Pemesanan";
		       $x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
		       $x['kurir'] = $this->M_pemesanan->getAllkurir();
		       $x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
		       $x['nonreseller'] = $this->M_barang->getDataNonReseller1();
		        $x['produksi'] = $this->M_barang->getdataProduksi();
		       $x['reseller'] = $this->M_barang->getAllBarangR();
		       $x['datapesanan'] = $this->M_pemesanan->getPemesananCustomer();
		       $this->load->view('v_header',$y);
		       if($this->session->userdata('akses') == 2){
				$this->load->view('admin/v_sidebar');
			}
			else if($this->session->userdata('akses') == 1){
				$this->load->view('owner/v_sidebar');
			}
		       $this->load->view('admin/v_pemesanan_customer',$x); 
		  }
		  
	  	function savepemesananNR(){
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
	  		$biaya_ongkir= $this->input->post('biaya_ongkir');
	  		$email_pemesanan=$this->input->post('email_pemesanan');
	  		$note=$this->input->post('note');
	  		$status=0;
	  		$pemesanan_id=$this->M_pemesanan->save_pesanan($nama_pemesan,$tanggal,$no_hp,$alamat,$level,$kurir,$resi,$username,$asal_transaksi,$metpem,$uang,$biaya_ongkir,$email_pemesanan,$note,$status,$biaya_admin,$diskon,$nama_akun_pemesan);


	  		$size = sizeof($barang_id);

	  		for($i=0; $i < $size; $i++){
	  			$this->m_list_barang->save_list_barang($pemesanan_id,$qty[$i],$barang_id[$i],$level);
	  			$this->M_barang->saveStok($barang_id[$i], $qty[$i], 1);
	  		}

	  		echo $this->session->set_flashdata('msg','success');
	       	redirect('admin/PemesananCustomer');		  	
 	  	}

	  	function status(){
            $pemesanan_id = $this->input->post('pemesanan_id');
            $status_pemesanan=$this->input->post('status_pemesanan');
            $jumlah=$this->input->post('jumlah');
            if($status_pemesanan==0)
            {
            $status_pemesanan=1;
            $this->M_pemesanan->status_pesanan($pemesanan_id,$status_pemesanan);
            }else if($status_pemesanan==1)
            {
            $status_pemesanan=2;
            $this->M_pemesanan->status_pesanan($pemesanan_id,$status_pemesanan);
            }
            else if($status_pemesanan==2)
            {
            $status_pemesanan=3;
             $this->M_pemesanan->insert_uang_masuk($pemesanan_id,$jumlah);
            $this->M_pemesanan->status_pesanan($pemesanan_id,$status_pemesanan);
            }
             redirect('admin/PemesananCustomer');	
        }

        function edit_pesanan(){
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
			$username = $this->input->post('username');
	  		$metode_pembayaran = $this->input->post('mp');
	  		// $tanggal = $this->input->post('tanggal');
	  		$this->M_pemesanan->edit_pesanan($pemesanan_id,$nama_pemesan,$no_hp,$alamat,$kurir,$resi,$username,$asal_transaksi,$metode_pembayaran);

	  		echo $this->session->set_flashdata('msg','update');
	       	redirect('admin/PemesananCustomer');	
	  	}

	  	function hapus_pesanan(){
	  		$pemesanan_id = $this->input->post('pemesanan_id');
	  		$this->M_pemesanan->hapus_pesanan($pemesanan_id);
	  		echo $this->session->set_flashdata('msg','hapus');
	       	redirect('admin/PemesananCustomer');	
	  	}

	  	function list_barang($pemesanan_id){
 	  				$level = $this->uri->segment(5);
 	  		  		$y['title'] = "List Barang Pemesan";
 	  		   	   $x['p_id'] = $pemesanan_id;
 	  		   	   $x['lvl'] =$level;	
 	  		   	   $x['listbarang'] = $this->m_list_barang->get_list_barang($pemesanan_id);
 	  		   	   $a = $this->m_list_barang->SUMLBNR($pemesanan_id)->row_array();
 	  		   	   $x['nonreseller'] = $this->M_barang->getDataNonReseller1();
 	  		   	   $x['jumlah'] = $a['total_keseluruhan'];
			       $this->load->view('v_header',$y);
			       if($this->session->userdata('akses') == 2){
					$this->load->view('admin/v_sidebar');
				}
				else if($this->session->userdata('akses') == 1){
					$this->load->view('owner/v_sidebar');
				}
			       $this->load->view('admin/v_list_barang',$x);	
		       
		  }
		   
		function pemesananByTahun(){
			$tahun = intVal($this->input->post('thn'));
			$x['stsp'] = 1;
			$x['bulan'] = 0;
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			 $x['produksi'] = $this->M_barang->getdataProduksi();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerbyTahun2($tahun);
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
			$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerByTanggal($start, $end);
			$this->load->view('admin/v_pemesanan_by_tahun', $x);
		   }

	}

?>