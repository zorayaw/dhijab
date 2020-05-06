<?php 
	/**
	 * 
	 */
	class PemesananResellerSeptember extends CI_Controller
	{
		
		function __construct()
	  	{
		    parent:: __construct();
		    if($this->session->userdata('masuk') !=TRUE){
		      $url=base_url('Login');
		      redirect($url);
		    };

		    $this->load->model('m_pemesanan');
		    $this->load->model('m_barang');
		    $this->load->model('m_list_barang');
		    $this->load->library('upload');
	  	}

	  	function index(){
	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
		       $y['title'] = "Pemesanan";
		       $x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
		       $x['kurir'] = $this->m_pemesanan->getAllkurir();
		       $x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
		       $x['nonreseller'] = $this->m_barang->getDataNonReseller1();
		        $x['produksi'] = $this->m_barang->getdataProduksi();
		       $x['reseller'] = $this->m_barang->getAllBarangR();
		       $x['datapesanan'] = $this->m_pemesanan->getPemesananresellerSeptember();
		       $this->load->view('v_header',$y);
		       $this->load->view('admin/v_sidebar');
		       $this->load->view('admin/v_pemesanan_reseller_September',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function reseller(){
	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
		       $y['title'] = "Pemesanan";
		       $x['asal_transaksi'] = $this->m_pemesanan->getAllAT();
		       $x['kurir'] = $this->m_pemesanan->getAllkurir();
		       $x['metode_pembayaran'] = $this->m_pemesanan->getAllMetpem();
		       $x['nonreseller'] = $this->m_barang->getDataNonReseller1();
		        $x['produksi'] = $this->m_barang->getdataProduksi();
		       $x['reseller'] = $this->m_barang->getAllBarangR();
		       $x['datapesanan'] = $this->m_pemesanan->getPemesananresellerSeptember();
		       $this->load->view('v_header',$y);
		       $this->load->view('admin/v_sidebar');
		       $this->load->view('admin/v_pemesanan_reseller_September',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function savepemesananreseller(){
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
	  		$biaya_ongkir= $this->input->post('biaya_ongkir');
	  		$email_pemesanan=$this->input->post('email_pemesanan');
	  		$note=$this->input->post('note');
	  		$status=0;
	  		$level = 2;
	  		$pemesanan_id=$this->m_pemesanan->save_pesanan($nama_pemesan,$tanggal,$no_hp,$alamat,$level,$kurir,$resi,$asal_transaksi,$metpem,$uang,$biaya_ongkir,$email_pemesanan,$note,$status,$biaya_admin,$diskon,$nama_akun_pemesan);
			
	  		$size = sizeof($barang_id);

	  		for($i=0; $i < $size; $i++){
	  			$this->m_list_barang->save_list_barangR($pemesanan_id,$qty[$i],$barang_id[$i],$level);
	  			$this->m_barang->saveStok($barang_id[$i], $qty[$i], 1);
	  		}

	  		echo $this->session->set_flashdata('msg','success');
	       	redirect('Admin/PemesananResellerSeptember');		  	
 	  	}

 	  	function hapus_pesananreseller(){
	  		$pemesanan_id = $this->input->post('pemesanan_id');
	  		$this->m_pemesanan->hapus_pesanan($pemesanan_id);
	  		echo $this->session->set_flashdata('msg','hapus');
	       	redirect('Admin/PemesananResellerSeptember');	
	  	}

	  	function statusreseller(){
            $pemesanan_id = $this->input->post('pemesanan_id');
            $status_pemesanan=$this->input->post('status_pemesanan');
            $jumlah=$this->input->post('jumlah');
            if($status_pemesanan==0)
            {
            $status_pemesanan=1;
            $this->m_pemesanan->status_pesanan($pemesanan_id,$status_pemesanan);
            }else if($status_pemesanan==1)
            {
            $status_pemesanan=2;
            $this->m_pemesanan->status_pesanan($pemesanan_id,$status_pemesanan);
            }
            else if($status_pemesanan==2)
            {
            $status_pemesanan=3;
             $this->m_pemesanan->insert_uang_masuk($pemesanan_id,$jumlah);
            $this->m_pemesanan->status_pesanan($pemesanan_id,$status_pemesanan);
            }
             redirect('Admin/PemesananResellerSeptember');	
        }

        function edit_pesanan(){
 	  		$pemesanan_id = $this->input->post('pemesanan_id');
 	  		$nama_pemesan = $this->input->post('nama_pemesan');
	  		$no_hp = $this->input->post('hp');
	  		$alamat = $this->input->post('alamat');
	  		$asal_transaksi = $this->input->post('at');
			  $kurir = $this->input->post('kurir');
			  $resi = $this->input->post('no_resi');
	  		$metode_pembayaran = $this->input->post('mp');
	  		// $tanggal = $this->input->post('tanggal');

	  		$this->m_pemesanan->edit_pesanan($pemesanan_id,$nama_pemesan,$no_hp,$alamat,$kurir,$resi,$asal_transaksi,$metode_pembayaran);
	  		echo $this->session->set_flashdata('msg','update');
	       	redirect('Admin/PemesananResellerSeptember');	
	  	}

	  	function hapus_pesanan(){
	  		$pemesanan_id = $this->input->post('pemesanan_id');
	  		$this->m_pemesanan->hapus_pesanan($pemesanan_id);
	  		echo $this->session->set_flashdata('msg','hapus');
	       	redirect('Admin/PemesananResellerSeptember');	
	  	}

	  	function list_barang($pemesanan_id){
 	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
 	  		   $level = $this->uri->segment(5);
 	  		  		$y['title'] = "List Barang Pemesan";
 	  		   	   $x['p_id'] = $pemesanan_id;
 	  		   	   $x['lvl'] =$level;	
 	  		   	   $x['listbarang'] = $this->m_list_barang->get_list_barang($pemesanan_id);
 	  		   	   $a = $this->m_list_barang->SUMLBNR($pemesanan_id)->row_array();
 	  		   	   $x['nonreseller'] = $this->m_barang->getDataNonReseller1();
 	  		   	   $x['jumlah'] = $a['total_keseluruhan'];
			       $this->load->view('v_header',$y);
			       $this->load->view('admin/v_sidebar');
			       $this->load->view('admin/v_list_barang',$x);	
		       
		    }
		    else{
		       redirect('Login');
		    }
 	  	}
	}
?>