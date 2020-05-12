<?php 
	/**
	 * 
	 */
	class stock extends CI_Controller
	{
		
		function __construct()
	  	{
		    parent:: __construct();
			if ($this->session->userdata('masuk') != TRUE || ($this->session->userdata('akses') != 2 && $this->session->userdata('akses') != 1)) {
				$url = base_url('Login');
				redirect($url);
			};

		    $this->load->model('m_pemesanan');
		    $this->load->model('m_barang');
		    $this->load->model('m_list_barang');
		    $this->load->library('upload');
	  	}

	  	function index(){
	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
	  			$y['title'] = "Stock";
	  			$x['stock'] = $this->m_barang->getAllBarang();
		       	$this->load->view('v_header',$y);
				   if($this->session->userdata('akses') == 2){
					$this->load->view('admin/v_sidebar');
				}
				else if($this->session->userdata('akses') == 1){
					$this->load->view('owner/v_sidebar');
				}
		       	$this->load->view('admin/v_stock',$x);
		    }
		    else{
		       redirect('Login');
		    }
	  	}

	  	function history($barang_id){
 	  		if($this->session->userdata('akses') == 2 && $this->session->userdata('masuk') == true){
 	  			$y['title'] = "Stock";
	 	  		   $x['stock'] = $this->m_barang->getHistoryStocks($barang_id);	
			       $this->load->view('v_header',$y);
				   if($this->session->userdata('akses') == 2){
					$this->load->view('admin/v_sidebar');
				}
				else if($this->session->userdata('akses') == 1){
					$this->load->view('owner/v_sidebar');
				}
			       $this->load->view('admin/v_history_stock',$x);
		       
		    }
		    else{
		       redirect('Login');
		    }
 	  	}
	}
?>