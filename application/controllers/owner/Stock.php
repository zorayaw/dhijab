<?php 
	/**
	 * 
	 */
	class stock extends CI_Controller
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
		    $this->load->model('M_list_barang');
		    $this->load->library('upload');
	  	}

	  	function index(){
	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock";
	  			$x['stock'] = $this->M_barang->getAllBarang();
		       	$this->load->view('v_header',$y);
		       	$this->load->view('owner/v_sidebar');
		       	$this->load->view('owner/v_stock',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function history($barang_id){
 	  		if($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true){
				   $y['title'] = "Stock";
				   $x['barang'] = $this->M_barang->getBarangID($barang_id);
	 	  		   $x['stock'] = $this->M_barang->getHistoryStock($barang_id);	
			       $this->load->view('v_header',$y);
			       $this->load->view('owner/v_sidebar');
			       $this->load->view('owner/v_history_stock',$x);
		       
		    }
		    else{
		       redirect('Login');
		    }
 	  	}
	}
?>