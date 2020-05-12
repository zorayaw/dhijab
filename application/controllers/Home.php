<?php
	/**
	 * 
	 */
	class Home extends CI_Controller
	{
		
		function __construct()
	  	{
		    parent:: __construct();
		    $this->load->model('M_barang');
	  	}

	  	function index(){
	  		$x['title'] = "MSGlow Palemabang";
	  		$x['nonreseller'] = $this->M_barang->getDataNonReseller();

	  		$this->load->view('v_home',$x);
	  	}
	}
?>