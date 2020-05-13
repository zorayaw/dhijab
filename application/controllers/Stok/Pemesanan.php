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

}
	