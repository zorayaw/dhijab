<?php

/**
 * 
 */
class PemesananResellerByBulan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE || ($this->session->userdata('akses') != 2 && $this->session->userdata('akses') != 1)) {
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
		$this->viewPemesananByBulan(date('m'));
	}

	function savepemesananNR()
	{
		$bulan = $this->input->get('bulan');
		$nama_pemesan = $this->input->post('nama_pemesan');
		$nama_akun_pemesan = "-";
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = $this->input->post('at');
		$kurir = $this->input->post('kurir');
		$username = $this->input->post('username');
		$resi = $this->input->post('no_resi');
		if ($resi == null) {
			$resi = "-";
		} else {
			$resi = $this->input->post('no_resi');
		}
		$metpem = $this->input->post('metpem');
		$tanggal = $this->input->post('tanggal');
		$diskon = $this->input->post('diskon');
		$biaya_admin = $this->input->post('biaya_admin');
		$uang = $this->input->post('uang');
		$level = 1;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');
		$biaya_ongkir = $this->input->post('biaya_ongkir');
		$email_pemesanan = $this->input->post('email_pemesanan');
		$note = $this->input->post('note');
		$status = 0;
		$pemesanan_id = $this->M_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $resi, $username, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);

		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->M_list_barang->save_list_barang($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->M_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/PemesananResellerByBulan/viewPemesananByBulan/' . $bulan);
	}

	function hapus_pesanan()
	{
		$bulan = $this->input->get('bulan');
		$pemesanan_id = $this->input->post('pemesanan_id');
		$this->M_pemesanan->hapus_pesanan($pemesanan_id);
		echo $this->session->set_flashdata('msg', 'hapus');
		redirect('admin/PemesananResellerByBulan/viewPemesananByBulan/' . $bulan);
	}

	function savepemesananR()
	{
		$bulan = $this->input->get('bulan');
		$nama_pemesan = $this->input->post('nama_pemesan');
		$nama_akun_pemesan = $this->input->post('nama_akun_pemesan');
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = $this->input->post('at');
		$kurir = $this->input->post('kurir');
		$username = $this->input->post('username');
		$resi = $this->input->post('no_resi');
		if ($resi == null) {
			$resi = "-";
		} else {
			$resi = $this->input->post('no_resi');
		}
		$metpem = $this->input->post('metpem');
		$tanggal = $this->input->post('tanggal');
		$diskon = $this->input->post('diskon');
		$biaya_admin = $this->input->post('biaya_admin');
		$uang = $this->input->post('uang');
		$level = 1;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');
		$biaya_ongkir = $this->input->post('biaya_ongkir');
		$email_pemesanan = $this->input->post('email_pemesanan');
		$note = $this->input->post('note');
		$status = 0;
		$level = 2;
		$pemesanan_id = $this->M_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $resi, $username, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);


		$size = sizeof($barang_id);

		for ($i = 0; $i < $size; $i++) {
			$this->M_list_barang->save_list_barangR($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->M_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}

		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/PemesananResellerByBulan/viewPemesananByBulan/' . $bulan);
	}


	function savepemesananP()
	{
		$bulan = $this->input->get('bulan');
		$nama_pemesan = "admin";
		$nama_akun_pemesan = "-";
		$no_hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$asal_transaksi = "6";
		$kurir = "6";
		$resi = "-";
		$username = $this->input->post('username');
		$metpem = "1";
		$tanggal = $this->input->post('tanggal');
		$uang = "0";
		$level = 3;
		$barang_id = $this->input->post('barang');
		$qty = $this->input->post('qty');
		$biaya_ongkir = "0";
		$email_pemesanan = "-";
		$note = $this->input->post('note');
		$status = 3;
		$diskon = 0;
		$biaya_admin = 0;
		$pemesanan_id = $this->M_pemesanan->save_pesanan($nama_pemesan, $tanggal, $no_hp, $alamat, $level, $kurir, $resi, $username, $asal_transaksi, $metpem, $uang, $biaya_ongkir, $email_pemesanan, $note, $status, $biaya_admin, $diskon, $nama_akun_pemesan);

		$size = sizeof($barang_id);
		for ($i = 0; $i < $size; $i++) {
			$this->M_list_barang->save_list_barangP($pemesanan_id, $qty[$i], $barang_id[$i], $level);
			$this->M_barang->saveStok($barang_id[$i], $qty[$i], 1);
		}
		$a = $this->M_list_barang->SUMLBNR($pemesanan_id)->row_array();
		$jumlah = $a['total_keseluruhan'];
		$this->M_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/PemesananResellerByBulan/viewPemesananByBulan/' . $bulan);
	}


	function edit_pesanan()
	{
		$bulan = $this->input->get('bulan');
		$status = $this->input->post('status');
		$pemesanan_id = $this->input->post('pemesanan_id');
		$username = $this->input->post('username');
		if ($status == 1) {
			$nama_pemesan = $this->input->post('nama_pemesan');
			$email = $this->input->post('email_pemesanan');
			$no_hp = $this->input->post('hp');
			$tanggal = $this->input->post('tanggal');
			$alamat = $this->input->post('alamat');
			$admin = $this->input->post('biaya_admin');
			$disc = $this->input->post('diskon');
			$kembalian = $this->input->post('uang');
			$at = $this->input->post('at');
			$kurir = $this->input->post('kurir');
			$resi = $this->input->post('no_resi');
			if ($resi == null) {
				$resi = "-";
			} else {
				$resi = $this->input->post('no_resi');
			}
			$ongkir = $this->input->post('biaya_ongkir');
			$mp = $this->input->post('mp');
			$note = $this->input->post('note');
			$this->M_pemesanan->edit_pesanan_customer($nama_pemesan, $email, $no_hp, $tanggal, $alamat, $admin, $disc, $kembalian, $at, $kurir, $resi, $ongkir, $mp, $note, $username, $pemesanan_id);
		} else if ($status == 2) {
			$nama_pemesan = $this->input->post('nama_pemesan');
			$nama_akun_pemesan = $this->input->post('nama_akun_pemesan');
			$email = $this->input->post('email_pemesanan');
			$no_hp = $this->input->post('hp');
			$tanggal = $this->input->post('tanggal');
			$alamat = $this->input->post('alamat');
			$admin = $this->input->post('biaya_admin');
			$disc = $this->input->post('diskon');
			$kembalian = $this->input->post('uang');
			$at = $this->input->post('at');
			$kurir = $this->input->post('kurir');
			$resi = $this->input->post('no_resi');
			if ($resi == null) {
				$resi = "-";
			} else {
				$resi = $this->input->post('no_resi');
			}
			$ongkir = $this->input->post('biaya_ongkir');
			$mp = $this->input->post('mp');
			$note = $this->input->post('note');
			$this->M_pemesanan->edit_pesanan_reseller($nama_pemesan, $nama_akun_pemesan, $email, $no_hp, $tanggal, $alamat, $admin, $disc, $kembalian, $at, $kurir, $resi, $ongkir, $mp, $note, $username, $pemesanan_id);
		} else if ($status == 3) {
			$no_hp = $this->input->post('hp');
			$tanggal = $this->input->post('tanggal');
			$alamat = $this->input->post('alamat');
			$note = $this->input->post('note');
			$this->M_pemesanan->edit_pesanan_produksi($no_hp, $tanggal, $alamat, $note, $username, $pemesanan_id);
		}
		echo $this->session->set_flashdata('msg', 'update');
		redirect('admin/PemesananResellerByBulan/viewPemesananByBulan/' . $bulan);
	}

	function list_barang($pemesanan_id)
	{
		$level = $this->uri->segment(5);
		$y['title'] = "List Barang Pemesan";
		$x['p_id'] = $pemesanan_id;
		$x['lvl'] = $level;
		$x['stat'] = $this->input->get('stat');
		$x['bulan'] = $this->input->get('bulan');
		$bulan = $this->input->get('bulan');
		switch ($bulan) {
			case 1:
				$x['namaBulan'] = "Januari";
				break;
			case 2:
				$x['namaBulan'] =  "Februari";
				break;
			case 3:
				$x['namaBulan'] =  "Maret";
				break;
			case 4:
				$x['namaBulan'] =  "April";
				break;
			case 5:
				$x['namaBulan'] =  "Mei";
				break;
			case 6:
				$x['namaBulan'] =  "Juni";
				break;
			case 7:
				$x['namaBulan'] =  "Juli";
				break;
			case 8:
				$x['namaBulan'] =  "Agustus";
				break;
			case 9:
				$x['namaBulan'] =  "September";
				break;
			case 10:
				$x['namaBulan'] =  "Oktober";
				break;
			case 11:
				$x['namaBulan'] =  "November";
				break;
			case 12:
				$x['namaBulan'] =  "Desember";
				break;
		}
		$x['listbarang'] = $this->M_list_barang->get_list_barang($pemesanan_id);
		$a = $this->M_list_barang->SUMLBNR($pemesanan_id)->row_array();
		$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
		$x['jumlah'] = $a['total_keseluruhan'];
		$this->load->view('v_header', $y);
		if ($this->session->userdata('akses') == 2) {
			$this->load->view('admin/v_sidebar');
		} else if ($this->session->userdata('akses') == 1) {
			$this->load->view('owner/v_sidebar');
		}
		$this->load->view('admin/v_list_barang', $x);
	}

	function Cetak_Invoice($pemesanan_id)
	{
		$level = $this->uri->segment(5);
		if ($level == 1) {
			$y['title'] = "Cetak Invoice id: " . $pemesanan_id;
			$x['p_id'] = $pemesanan_id;
			$x['lvl'] = $level;
			$x['listbarang'] = $this->M_list_barang->getLBRbyid($pemesanan_id);
			$x['pemesan'] = $this->M_pemesanan->getIdbyid($pemesanan_id);
			$a = $this->M_pemesanan->getIdbyid($pemesanan_id)->row_array();
			$x['kurir'] = $a['kurir_nama'];
			$x['mp_nama'] = $a['mp_nama'];
			$x['nama'] = $this->session->userdata('nama');
			$this->load->view('admin/v_cetak_invoice', $x);
		} elseif ($level == 2) {
			$y['title'] = "Cetak Invoice id: " . $pemesanan_id;
			$x['p_id'] = $pemesanan_id;
			$x['lvl'] = $level;
			$x['listbarang'] = $this->M_list_barang->getLBNRbyid($pemesanan_id);
			$x['pemesan'] = $this->M_pemesanan->getIdbyid($pemesanan_id);
			$a = $this->M_pemesanan->getIdbyid($pemesanan_id)->row_array();
			$x['kurir'] = $a['kurir_nama'];
			$x['mp_nama'] = $a['mp_nama'];
			$x['nama'] = $this->session->userdata('nama');
			$this->load->view('admin/v_cetak_invoice', $x);
		}
	}


	function status()
	{
		$bulan = $this->input->get('bulan');
		$pemesanan_id = $this->input->post('pemesanan_id');
		$status_pemesanan = $this->input->post('status_pemesanan');
		$jumlah = $this->input->post('jumlah');
		if ($status_pemesanan == 0) {
			$status_pemesanan = 1;
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 1) {
			$status_pemesanan = 2;
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		} else if ($status_pemesanan == 2) {
			$status_pemesanan = 3;
			$this->M_pemesanan->insert_uang_masuk($pemesanan_id, $jumlah);
			$this->M_pemesanan->status_pesanan($pemesanan_id, $status_pemesanan);
		}
		redirect('admin/PemesananResellerByBulan/viewPemesananByBulan/' . $bulan);
	}

	function viewPemesananByBulan($bulan)
	{
		switch ($bulan) {
			case 1:
				$x['namaBulan'] = "Januari";
				$x['tanggalAkhir'] = 31;
				break;
			case 2:
				$x['namaBulan'] =  "Februari";
				switch (date('Y') % 4) {
					case 0:
						$x['tanggalAkhir'] = 29;
						break;
					default:
						$x['tanggalAkhir'] = 28;
						break;
				}
				break;
			case 3:
				$x['namaBulan'] =  "Maret";
				$x['tanggalAkhir'] = 31;
				break;
			case 4:
				$x['namaBulan'] =  "April";
				$x['tanggalAkhir'] = 30;
				break;
			case 5:
				$x['namaBulan'] =  "Mei";
				$x['tanggalAkhir'] = 31;
				break;
			case 6:
				$x['namaBulan'] =  "Juni";
				$x['tanggalAkhir'] = 30;
				break;
			case 7:
				$x['namaBulan'] =  "Juli";
				$x['tanggalAkhir'] = 31;
				break;
			case 8:
				$x['namaBulan'] =  "Agustus";
				$x['tanggalAkhir'] = 31;
				break;
			case 9:
				$x['namaBulan'] =  "September";
				$x['tanggalAkhir'] = 30;
				break;
			case 10:
				$x['namaBulan'] =  "Oktober";
				$x['tanggalAkhir'] = 31;
				break;
			case 11:
				$x['namaBulan'] =  "November";
				$x['tanggalAkhir'] = 30;
				break;
			case 12:
				$x['namaBulan'] =  "Desember";
				$x['tanggalAkhir'] = 31;
				break;
		}

		$namaBulan = $x['namaBulan'];
		$x['bulan'] = $bulan;
		$y['title'] = "Pemesanan Reseller Bulan $namaBulan";
		$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
		$x['kurir'] = $this->M_pemesanan->getAllkurir();
		$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
		$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
		$x['produksi'] = $this->M_barang->getdataProduksi();
		$x['reseller'] = $this->M_barang->getAllBarangR();
		$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerByBulanSemuaTahun($bulan);
		$this->load->view('v_header', $y);
		if ($this->session->userdata('akses') == 2) {
			$this->load->view('admin/v_sidebar');
		} else if ($this->session->userdata('akses') == 1) {
			$this->load->view('owner/v_sidebar');
		}
		$this->load->view('admin/v_pemesanan_reseller_by_bulan', $x);
	}

	function pemesananByTahun()
	{
		$tahun = intVal($this->input->post('thn'));
		$bulan = $this->input->get('bulan');
		$x['stsp'] = 2;
		$x['bulan'] = $bulan;
		$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
		$x['kurir'] = $this->M_pemesanan->getAllkurir();
		$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
		$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
		$x['produksi'] = $this->M_barang->getdataProduksi();
		$x['reseller'] = $this->M_barang->getAllBarangR();
		if ($tahun == 0)
			$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerByBulanSemuaTahun($bulan);
		else
			$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerByBulan($bulan, $tahun);
		$this->load->view('admin/v_pemesanan_by_tahun', $x);
	}

	function pemesananByTanggal()
	{
		$start = $this->input->post('startt');
		$end = $this->input->post('endd');
		$bulan = $this->input->get('bulan');
		$x['stsp'] = 2;
		$x['bulan'] = $bulan;
		$x['asal_transaksi'] = $this->M_pemesanan->getAllAT();
		$x['kurir'] = $this->M_pemesanan->getAllkurir();
		$x['metode_pembayaran'] = $this->M_pemesanan->getAllMetpem();
		$x['nonreseller'] = $this->M_barang->getDataNonReseller1();
		$x['produksi'] = $this->M_barang->getdataProduksi();
		$x['reseller'] = $this->M_barang->getAllBarangR();
		$x['datapesanan'] = $this->M_pemesanan->getPemesananResellerByTanggal($start, $end);
		$this->load->view('admin/v_pemesanan_by_tahun', $x);
	}
}
