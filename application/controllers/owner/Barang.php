<?php
/**
 * 
 */
class Barang extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('Login');
			redirect($url);
		};

		$this->load->model('M_pemesanan');
		$this->load->model('M_barang');
		$this->load->model('M_list_barang');
		$this->load->library('upload');
	}

	function index()
	{
		if ($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true) {
			$y['title'] = "Daftar Seluruh Barang";
			$x['nonreseller'] = $this->M_barang->getAllBarang();
			$x['kategori_barang'] = $this->M_barang->getkategori_barang();
			$this->load->view('v_header', $y);
			$this->load->view('owner/v_sidebar');
			$this->load->view('owner/v_seluruh_barang', $x);
		} else {
			redirect('Login');
		}
	}

	function pemesanan()
	{
		if ($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true) {
			$y['title'] = "Pemesanan";
			$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
			$x['kurir'] = $this->M_pemesanan->getAllkurir();
			$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
			$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
			$x['reseller'] = $this->M_barang->getAllBarangR();
			$x['datapesanan'] = $this->M_pemesanan->getPemesanan();
			$this->load->view('v_header', $y);
			$this->load->view('owner/v_sidebar');
			$this->load->view('owner/v_pemesanan_o', $x);
		} else {
			redirect('Login');
		}
	}

	function historyPemesanan()
	{
		$statusc = $this->input->get('status');
		if ($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true) {
			$y['title'] = "History Input Data";
			if($statusc == 0){
				$x['st'] = "$statusc";
				$x['title_view'] = "History Input Data ";
				$x['datapesanan'] = $this->M_pemesanan->getPemesananInput();
			}
			else if($statusc == 1){
				$x['st'] = "$statusc";
				$x['title_view'] = "History Input Data Customer";
				$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerInput();
			}
			else if($statusc == 2){
				$x['st'] = "$statusc";
				$x['title_view'] = "History Input Data Reseller";
				$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerInput();
			}
			else if($statusc == 3){
				$x['st'] = "$statusc";
				$x['title_view'] = "History Input Data Produksi";
				$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksiInput();
			}
			$this->load->view('v_header', $y);
			$this->load->view('owner/v_sidebar');
			$this->load->view('owner/v_history_input_data',  $x);
		} else {
			redirect('Login');
		}
	}

	function historyPemesananByTahun(){
		$tahun = intVal($this->input->post('thn'));
		$statuss = $this->input->get('stts');
		if($tahun == 0){
			if($statuss == 0){
				$x['datapesanan'] = $this->M_pemesanan->getPemesananInput();
			}
			else if($statuss == 1){
				$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerInput();
			}
			else if($statuss == 2){
				$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerInput();
			}
			else if($statuss == 3){
				$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksiInput();
			}
		}
		else {
			if($statuss == 0){
				$x['datapesanan'] = $this->M_pemesanan->getPemesananInputByTahun($tahun);
			}
			else if($statuss == 1){
				$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerInputByTahun($tahun);
			}
			else if($statuss == 2){
				$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerInputByTahun($tahun);
			}
			else if($statuss == 3){
				$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksiInputByTahun($tahun);
			}
		}
		$this->load->view('owner/v_history_input_data_bytanggal', $x);	
	}

	function historyPemesananByTanggal(){
		$start = $this->input->post('startt');
		$end = $this->input->post('endd');
		$statuss = $this->input->get('stts');
		if($statuss == 0){
			$x['datapesanan'] = $this->M_pemesanan->getPemesananInputByTanggal($start, $end);
		}
		else if($statuss == 1){
			$x['datapesanan'] = $this->M_pemesanan->getPemesananCustomerInputByTanggal($start, $end);	
		}
		else if($statuss == 2){
			$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerInputByTanggal($start, $end);
		}
		else if($statuss == 3){
			$x['datapesanan'] = $this->M_pemesanan->getPemesananProduksiInputByTanggal($start, $end);
		}
		$this->load->view('owner/v_history_input_data_bytanggal', $x);
	   }

	function tambahpesananNR()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$level = 2;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');

		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->M_list_barang->save_list_barang($pemesanan_id, $qty[$i], $barang_id[$i], $level);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect("owner/Barang/list_barang/$pemesanan_id/$level");
	}

	function hapuspesananlb()
	{
		$lb_id = $this->input->post('lb_id');
		$pemesanan_id = $this->input->post('pemesanan_id');
		$barang_id = $this->input->post('barang_id');
		$qty = $this->input->post('qty');
		$this->M_list_barang->hapus_list_barang($pemesanan_id, $lb_id, $qty, $barang_id);
		echo $this->session->set_flashdata('msg', 'delete');
		redirect($this->agent->referrer());
	}

	function tambahpesananR()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$level = 1;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');

		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->M_list_barang->save_list_barang($pemesanan_id, $qty[$i], $barang_id[$i], $level);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect("owner/Barang/list_barang/$pemesanan_id/$level");
	}



	function savepemesananNR()
	{
		$nama_pemesan = $this->input->post('nama_pemesan');
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = $this->input->post('at');
		$kurir = $this->input->post('kurir');
		$metpem = $this->input->post('metpem');
		$tanggal = $this->input->post('tanggal');
		$level = 2;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');

		$this->M_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $asal_transaksi, $metpem);
		$x = $this->M_pemesanan->getIdbyName($nama_pemesan);
		$z = $x->row_array();
		$pemesanan_id = $z['pemesanan_id'];

		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->M_list_barang->save_list_barang($pemesanan_id, $qty[$i], $barang_id[$i], $level);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect('owner/Barang/pemesanan');
	}

	function savepemesananR()
	{
		$nama_pemesan = $this->input->post('nama_pemesan');
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = $this->input->post('at');
		$kurir = $this->input->post('kurir');
		$metpem = $this->input->post('metpem');
		$level = 1;
		$tanggal = $this->input->post('tanggal');
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');

		$this->M_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $asal_transaksi, $metpem);
		$x = $this->M_pemesanan->getIdbyName($nama_pemesan);
		$z = $x->row_array();
		$pemesanan_id = $z['pemesanan_id'];

		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->M_list_barang->save_list_barang($pemesanan_id, $qty[$i], $barang_id[$i], $level);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect('owner/Barang/pemesanan');
	}

	function edit_pesanan()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$nama_pemesan = $this->input->post('nama_pemesan');
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = $this->input->post('at');
		$kurir = $this->input->post('kurir');
		$metode_pembayaran = $this->input->post('mp');
		$tanggal = $this->input->post('tanggal');

		$this->M_pemesanan->edit_pesanan1($pemesanan_id, $nama_pemesan, $tanggal, $no_hp, $alamat, $kurir, $asal_transaksi, $metode_pembayaran);
		echo $this->session->set_flashdata('msg', 'update');
		redirect('owner/Barang/pemesanan');
	}

	function hapus_pesanan()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$this->M_pemesanan->hapus_pesanan($pemesanan_id);
		echo $this->session->set_flashdata('msg', 'hapus');
		redirect('owner/Barang/pemesanan');
	}

	function list_barang($pemesanan_id)
	{
		if ($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true) {
			$level = $this->uri->segment(5);
			if ($level == 1) {
				$x['p_id'] = $pemesanan_id;
				$x['lvl'] = $level;
				$y['title'] = "List Barang Pemesan";
				$x['listbarang'] = $this->M_list_barang->getLBRbyid($pemesanan_id);
				$x['reseller'] = $this->M_barang->getAllBarangR();
				$a = $this->M_list_barang->SUMLBR($pemesanan_id)->row_array();
				$x['jumlah'] = $a['total_keseluruhan'];
				$this->load->view('v_header', $y);
				$this->load->view('admin/v_sidebar');
				$this->load->view('admin/v_list_barang1', $x);
			} elseif ($level == 2) {
				$y['title'] = "List Barang Pemesan";
				$x['p_id'] = $pemesanan_id;
				$x['lvl'] = $level;
				$x['listbarang'] = $this->M_list_barang->getLBNRbyid($pemesanan_id);
				$a = $this->M_list_barang->SUMLBNR($pemesanan_id)->row_array();
				$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
				$x['jumlah'] = $a['total_keseluruhan'];
				$this->load->view('v_header', $y);
				$this->load->view('admin/v_sidebar');
				$this->load->view('admin/v_list_barang', $x);
			}
		} else {
			redirect('Login');
		}
	}



	function Reseller()
	{
		if ($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true) {
			$y['title'] = "Barang Reseller";
			$x['barang'] = $this->M_barang->getkategori_barang();
			$this->load->view('v_header', $y);
			$this->load->view('owner/v_sidebar');
			$this->load->view('owner/v_barang_reseller', $x);
		} else {
			redirect('Login');
		}
	}

	function Harga_Reseller($barang_id)
	{
		if ($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true) {
			$y['title'] = "Harga Barang";
			$x['harga'] = $this->M_barang->getHargaReseller($barang_id);
			$this->load->view('v_header', $y);
			$this->load->view('owner/v_sidebar');
			$this->load->view('owner/v_harga_reseller', $x);
		} else {
			redirect('Login');
		}
	}

	function update_harga_reseller()
	{
		$br_id = $this->input->post('br_id');
		$barang_id = $this->input->post('barang_id');
		$harga = str_replace(".", "", $this->input->post('harga'));
		$this->M_barang->update_harga($br_id, $harga);
		echo $this->session->set_flashdata('msg', 'update');
		redirect("owner/Barang/Harga_Reseller/$barang_id");
	}

	function tambah_kategori_barang()
	{
		$nama_kategori = $this->input->post('nama_kategori');
		$berat = $this->input->post('berat');
		$harga_ecer = $this->input->post('harga_ecer');
		$harga_grosir_3_11 = $this->input->post('harga_grosir_3_11');
		$harga_grosir_12_29 = $this->input->post('harga_grosir_12_29');
		$grosir_diatas_30 = $this->input->post('grosir_diatas_30');
		$reseller = $this->input->post('reseller');
		$HPP = $this->input->post('HPP');

	

		$this->M_barang->tambah_kategori($nama_kategori,$berat,$harga_ecer,$harga_grosir_3_11,$harga_grosir_12_29,$grosir_diatas_30,$reseller,$HPP);
		echo $this->session->set_flashdata('msg', 'success');
		redirect('owner/Barang/Reseller');
	}

	function edit_kategori()
	{
		
		$barang_id = $this->input->post('barang_id');
		$nama_kategori = $this->input->post('nama_kategori');
		$berat = $this->input->post('berat');
		$harga_ecer = $this->input->post('harga_ecer');
		$harga_grosir_3_11 = $this->input->post('harga_grosir_3_11');
		$harga_grosir_12_29 = $this->input->post('harga_grosir_12_29');
		$grosir_diatas_30 = $this->input->post('grosir_diatas_30');
		$reseller = $this->input->post('reseller');
		$HPP = $this->input->post('HPP');

			$this->M_barang->update_kategori($barang_id,$nama_kategori,$berat,$harga_ecer,$harga_grosir_3_11,$harga_grosir_12_29,$grosir_diatas_30,$reseller,$HPP);
			
			echo $this->session->set_flashdata('msg', 'success_non_reseller');
			redirect('owner/Barang/Reseller');
		
	}

	function hapus_reseller()
	{
		$id_kategori_barang = $this->input->post('barang_id');
		$this->M_barang->hapus_kategori_barang($id_kategori_barang);
		echo $this->session->set_flashdata('msg', 'delete');
		redirect('owner/Barang/Reseller');
	}

	function tambah_barang()
	{
		
				
				$nama_barang = $this->input->post('nama_barang');
				$stock = $this->input->post('stock');
				$kategori = $this->input->post('kategori');
				$jenis_barang = $this->input->post('jenis_barang');

				$this->M_barang->savebarang($nama_barang, $stock, $kategori, $jenis_barang);
				

				echo $this->session->set_flashdata('msg', 'success_non_reseller');
				redirect('owner/Barang');
			
			
		
	}

	function edit_barang()
	{
		
			$stock = $this->input->post('stock');
			$barang_id = $this->input->post('barang_id');
			$this->M_barang->update_barang($barang_id, $stock);
			echo $this->session->set_flashdata('msg', 'success_non_reseller');
			redirect('owner/Barang');
		
	}

	function hapus_non_reseller()
	{
		$barang_id = $this->input->post('barang_id');
		$images = $this->input->post('barang_foto');
		$path = './assets/images/' . $images;
		unlink($path);
		$this->M_barang->hapus_barang_NR($barang_id);
		echo $this->session->set_flashdata('msg', 'delete');
		redirect('owner/Barang');
	}

	function history($barang_id)
	{
		if ($this->session->userdata('akses') == 1 && $this->session->userdata('masuk') == true) {
			$y['title'] = "History Stock";
			$x['barang'] = $this->M_barang->getBarangID($barang_id);
			$x['stock'] = $this->M_barang->getHistoryStock($barang_id, 1);
			$this->load->view('v_header', $y);
			$this->load->view('owner/v_sidebar');
			$this->load->view('owner/v_history_stock', $x);
		} else {
			redirect('Login');
		}
	}
	function status()
	{
		$pemesanan_id = $this->input->post('pemesanan_id');
		$status_pemesanan = $this->input->post('status_pemesanan');;
		if ($status_pemesanan == 0) {
			$status_pemesanan = 1;
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 1) {
			$status_pemesanan = 2;
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		}
		redirect('owner/Barang/pemesanan');
	}
}
