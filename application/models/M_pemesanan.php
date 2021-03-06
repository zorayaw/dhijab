<?php
	/**
	 * 
	 */
	class M_pemesanan extends CI_Model
	{

		function save_pesanan($nama_pemesan,$tanggal,$no_hp,$alamat,$level,$kurir_id,$resi,$username,$at_id,$mp_id,$uang,$biaya_ongkir,$email_pemesanan,$note,$status,$biaya_admin,$diskon,$nama_akun_pemesan){
			$this->db->query("INSERT INTO pemesanan(pemesanan_nama,pemesanan_tanggal,pemesanan_hp,pemesanan_alamat,status_customer,kurir_id,no_resi,at_id,mp_id,uang_kembalian,biaya_ongkir,email_pemesan,note,status_pemesanan,biaya_admin,diskon,pemesanan_nama_akun, username) VALUES ('$nama_pemesan','$tanggal','$no_hp','$alamat','$level','$kurir_id','$resi','$at_id','$mp_id','$uang','$biaya_ongkir','$email_pemesanan','$note','$status','$biaya_admin','$diskon','$nama_akun_pemesan', '$username')");
			$hsl=$this->db->insert_id();
			return $hsl;
		}

		function getPemesananInput(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.username = e.user_nama and a.status_pemesanan!=4 and a.status_customer!=4 ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananInputByTahun($tahun){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e WHERE year(a.pemesanan_tanggal) = $tahun and a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.username = e.user_nama and a.status_pemesanan!=4 and a.status_customer!=4 ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananCustomerInputByTahun($tahun){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e WHERE year(a.pemesanan_tanggal) = $tahun and a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.username = e.user_nama and a.status_pemesanan!=4 and a.status_customer=1 ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananResellerInputByTahun($tahun){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e WHERE year(a.pemesanan_tanggal) = $tahun and a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.username = e.user_nama and a.status_pemesanan!=4 and a.status_customer=2 ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananProduksiInputByTahun($tahun){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e WHERE year(a.pemesanan_tanggal) = $tahun and a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.username = e.user_nama and a.status_pemesanan!=4 and a.status_customer=3 ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananInputByTanggal($start, $end){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e WHERE (a.pemesanan_tanggal BETWEEN '$start' AND '$end') and a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.username = e.user_nama and a.status_pemesanan!=4 and a.status_customer != 4 ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananCustomerInputByTanggal($start, $end){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e WHERE (a.pemesanan_tanggal BETWEEN '$start' AND '$end') and a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.username = e.user_nama and a.status_pemesanan!=4 and a.status_customer=1 ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananResellerInputByTanggal($start, $end){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e WHERE (a.pemesanan_tanggal BETWEEN '$start' AND '$end') and a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.username = e.user_nama and a.status_pemesanan!=4 and a.status_customer=2 ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananProduksiInputByTanggal($start, $end){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e WHERE (a.pemesanan_tanggal BETWEEN '$start' AND '$end') and a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.username = e.user_nama and a.status_pemesanan!=4 and a.status_customer=3 ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananResellerInput(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.username = e.user_nama and a.status_pemesanan!=4 and a.status_customer=2 ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
	
 
		function getPemesananCustomerInput(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.username = e.user_nama  and a.status_pemesanan!=4 and a.status_customer=1 ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananProduksiInput(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d, user e WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.username = e.user_nama and a.status_pemesanan!=4 and a.status_customer=3 ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananSesuaiTahun($tahun){
			$date_start = $tahun."-01-01";
			$date_end = $tahun."-12-31";
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE year(a.pemesanan_tanggal) BETWEEN '$date_start' AND '$date_end' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal DESC");
			return $hasil;
		}

		function getPemesananEkspedisi(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND (a.status_eks<3) AND  a.status_pemesanan!=4 AND a.mp_id = d.mp_id AND a.at_id = c.at_id  ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananEkspedisiByTanggal($start, $end){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE (a.pemesanan_tanggal BETWEEN '$start' AND '$end') AND a.kurir_id = b.kurir_id AND (a.status_eks<3) AND  a.status_pemesanan!=4 AND a.mp_id = d.mp_id AND a.at_id = c.at_id  ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananEkspedisiByTanggalDanKurir($start, $end, $id_kurir){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE (a.pemesanan_tanggal BETWEEN '$start' AND '$end') AND a.kurir_id = $id_kurir AND a.kurir_id = b.kurir_id AND (a.status_eks<3) AND  a.status_pemesanan!=4 AND a.mp_id = d.mp_id AND a.at_id = c.at_id  ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananEkspedisiByTahun($tahun){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE year(a.pemesanan_tanggal) = $tahun AND a.kurir_id = b.kurir_id AND (a.status_eks<3) AND  a.status_pemesanan!=4 AND a.mp_id = d.mp_id AND a.at_id = c.at_id  ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananEkspedisiByKurir($kurir){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = $kurir AND a.kurir_id = b.kurir_id AND (a.status_eks<3) AND  a.status_pemesanan!=4 AND a.mp_id = d.mp_id AND a.at_id = c.at_id  ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		
		function getPemesananEksCurdate(){
			date_default_timezone_set("Asia/Jakarta");
        	$cur_date = date("Y-m-d");
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE pemesanan_tanggal = '$cur_date' AND a.kurir_id = b.kurir_id AND (a.status_eks<3) AND  a.status_pemesanan!=4 AND a.at_id = c.at_id AND a.mp_id = d.mp_id ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananEksCurdateByKurir($kurir){
			date_default_timezone_set("Asia/Jakarta");
        	$cur_date = date("Y-m-d");
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE pemesanan_tanggal = '$cur_date' AND a.kurir_id = '$kurir' AND b.kurir_id = '$kurir' AND (a.status_eks<3) AND  a.status_pemesanan!=4 AND a.at_id = c.at_id AND a.mp_id = d.mp_id ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananEksByBulan($bulan, $tahun){
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE month(a.pemesanan_tanggal) = '$bulan' AND year(a.pemesanan_tanggal) = '$tahun' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id AND (a.status_eks<3) and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}

		function getPemesananEksByBulanKurir($bulan, $tahun,$kurir){
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE month(a.pemesanan_tanggal) = $bulan AND a.kurir_id = $kurir AND year(a.pemesanan_tanggal) = $tahun AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id AND (a.status_eks<3) and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}

		function getPemesananEksByBulanTanpaTahun($bulan, $start, $end){
			$date_start = $start."-01-01";
			$date_end = $end."-12-31";
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE month(a.pemesanan_tanggal) = $bulan AND year(pemesanan_tanggal) BETWEEN '$date_start' AND '$date_end' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id AND (a.status_eks<3) and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}

		function getPemesananEksByTanggal($start, $end){
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE (a.pemesanan_tanggal BETWEEN '$start' AND '$end') AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id AND (a.status_eks<3) and a.status_pemesanan!=4 ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}
		function getPemesananEksByTanggalByKurir($start, $end, $kurir){
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE  (a.pemesanan_tanggal BETWEEN '$start' AND '$end') AND a.kurir_id = '$kurir' AND b.kurir_id = '$kurir' AND a.at_id = c.at_id AND a.mp_id = d.mp_id AND (a.status_eks<3) and a.status_pemesanan!=4 ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}

		function getPemesananEksByTahun($awal, $akhir){
			$date_start = $awal."-01-01";
			$date_end = $akhir."-12-31";
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE year(a.pemesanan_tanggal) BETWEEN '$date_start' AND '$date_end' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id AND (a.status_eks<3) and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}

		function getPemesananEksByTahunByKurir($awal, $akhir, $kurir){
			$date_start = $awal."-01-01";
			$date_end = $akhir."-12-31";
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE year(a.pemesanan_tanggal) BETWEEN '$date_start' AND '$date_end' AND a.kurir_id = '$kurir'AND b.kurir_id = '$kurir' AND a.at_id = c.at_id AND a.mp_id = d.mp_id AND (a.status_eks<3) and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}


		function getPemesananKonfirmasi(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and (a.status_pemesanan<3) ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getKurirNama($kurir){
			$hasil = $this->db->query("SELECT kurir_nama FROM kurir WHERE kurir_id = '$kurir'");
			return $hasil;
		}

		function getPemesanan(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		

	
		function getPemesananBulanJan(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and pemesanan_tanggal BETWEEN '2020-01-01' AND '2020-01-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananBulanFeb(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and pemesanan_tanggal BETWEEN '2020-02-01' AND '2020-02-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananBulanMar(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and pemesanan_tanggal BETWEEN '2020-03-01' AND '2020-03-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananBulanApril(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and pemesanan_tanggal BETWEEN '2020-04-01' AND '2020-04-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananBulanMei(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and pemesanan_tanggal BETWEEN '2020-05-01' AND '2020-05-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananBulanJuni(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and pemesanan_tanggal BETWEEN '2020-06-01' AND '2020-06-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananBulanJuli(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and pemesanan_tanggal BETWEEN '2020-07-01' AND '2020-07-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananBulanAgustus(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and pemesanan_tanggal BETWEEN '2020-08-01' AND '2020-08-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananBulanSeptember(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and pemesanan_tanggal BETWEEN '2020-09-01' AND '2020-09-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananBulanOktober(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and pemesanan_tanggal BETWEEN '2020-10-01' AND '2020-10-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananBulanNovember(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and pemesanan_tanggal BETWEEN '2020-11-01' AND '2020-11-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananBulanDesember(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and pemesanan_tanggal BETWEEN '2020-12-01' AND '2020-12-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

	
		function getPemesananCustomer(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=1 ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananCustomerJanuari(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=1 and pemesanan_tanggal BETWEEN '2020-01-01' AND '2020-01-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananCustomerFebruari(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=1 and pemesanan_tanggal BETWEEN '2020-02-01' AND '2020-02-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananCustomerMaret(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=1 and pemesanan_tanggal BETWEEN '2020-03-01' AND '2020-03-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananCustomerApril(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=1 and pemesanan_tanggal BETWEEN '2020-04-01' AND '2020-04-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananCustomerMei(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=1 and pemesanan_tanggal BETWEEN '2020-05-01' AND '2020-05-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananCustomerJuni(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=1 and pemesanan_tanggal BETWEEN '2020-06-01' AND '2020-06-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananCustomerJuli(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=1 and pemesanan_tanggal BETWEEN '2020-07-01' AND '2020-07-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananCustomerAgustus(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=1 and pemesanan_tanggal BETWEEN '2020-08-01' AND '2020-08-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananCustomerSeptember(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=1 and pemesanan_tanggal BETWEEN '2020-09-01' AND '2020-09-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananCustomerOktober(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=1 and pemesanan_tanggal BETWEEN '2020-10-01' AND '2020-10-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananCustomerNovember(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=1 and pemesanan_tanggal BETWEEN '2020-11-01' AND '2020-11-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananCustomerDesember(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=1 and pemesanan_tanggal BETWEEN '2020-12-01' AND '2020-12-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananreseller(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=2 ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananresellerJanuari(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=2 and pemesanan_tanggal BETWEEN '2020-01-01' AND '2020-01-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananresellerFebruari(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=2 and pemesanan_tanggal BETWEEN '2020-02-01' AND '2020-02-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananresellerMaret(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=2 and pemesanan_tanggal BETWEEN '2020-03-01' AND '2020-03-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananresellerApril(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=2 and pemesanan_tanggal BETWEEN '2020-04-01' AND '2020-04-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananresellerMei(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=2 and pemesanan_tanggal BETWEEN '2020-05-01' AND '2020-05-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananresellerJuni(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=2 and pemesanan_tanggal BETWEEN '2020-06-01' AND '2020-06-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananresellerJuli(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=2 and pemesanan_tanggal BETWEEN '2020-07-01' AND '2020-07-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananresellerAgustus(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=2 and pemesanan_tanggal BETWEEN '2020-08-01' AND '2020-08-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananresellerSeptember(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=2 and pemesanan_tanggal BETWEEN '2020-09-01' AND '2020-09-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananresellerOktober(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=2 and pemesanan_tanggal BETWEEN '2020-10-01' AND '2020-10-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananresellerNovember(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=2 and pemesanan_tanggal BETWEEN '2020-11-01' AND '2020-11-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananresellerDesember(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=2 and pemesanan_tanggal BETWEEN '2020-12-01' AND '2020-12-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananproduksi(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=3 ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananproduksiJanuari(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=3 and pemesanan_tanggal BETWEEN '2020-01-01' AND '2020-01-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananproduksiFebruari(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=3 and pemesanan_tanggal BETWEEN '2020-02-01' AND '2020-02-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananproduksiMaret(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=3 and pemesanan_tanggal BETWEEN '2020-03-01' AND '2020-03-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananproduksiApril(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=3 and pemesanan_tanggal BETWEEN '2020-04-01' AND '2020-04-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananproduksiMei(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=3 and pemesanan_tanggal BETWEEN '2020-05-01' AND '2020-05-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananproduksiJuni(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=3 and pemesanan_tanggal BETWEEN '2020-06-01' AND '2020-06-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananproduksiJuli(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=3 and pemesanan_tanggal BETWEEN '2020-07-01' AND '2020-07-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananproduksiAgustus(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=3 and pemesanan_tanggal BETWEEN '2020-08-01' AND '2020-08-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananproduksiSeptember(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=3 and pemesanan_tanggal BETWEEN '2020-09-01' AND '2020-09-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananproduksiOktober(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=3 and pemesanan_tanggal BETWEEN '2020-10-01' AND '2020-10-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananproduksiNovember(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=3 and pemesanan_tanggal BETWEEN '2020-11-01' AND '2020-11-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}
		function getPemesananproduksiDesember(){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4 and a.status_customer=3 and pemesanan_tanggal BETWEEN '2020-12-01' AND '2020-12-31' ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananCurdate(){
			date_default_timezone_set("Asia/Jakarta");
        	$cur_date = date("Y-m-d");
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE pemesanan_tanggal = '$cur_date' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananCurdateByKurir($kurir){
			date_default_timezone_set("Asia/Jakarta");
        	$cur_date = date("Y-m-d");
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE pemesanan_tanggal = '$cur_date' AND a.kurir_id = '$kurir' AND b.kurir_id = '$kurir' AND a.at_id = c.at_id AND a.mp_id = d.mp_id ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananCustomerCurdate(){
			date_default_timezone_set("Asia/Jakarta");
        	$cur_date = date("Y-m-d");
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.status_customer = 1 AND pemesanan_tanggal = '$cur_date' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananResellerCurdate(){
			date_default_timezone_set("Asia/Jakarta");
        	$cur_date = date("Y-m-d");
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.status_customer = 2 AND pemesanan_tanggal = '$cur_date' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getPemesananProduksiCurdate(){
			date_default_timezone_set("Asia/Jakarta");
        	$cur_date = date("Y-m-d");
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.status_customer = 3 AND pemesanan_tanggal = '$cur_date' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getHargaModal($barang_id, $lvl){
			return $this->db->query("SELECT list_barang.harga FROM list_barang WHERE barang_id = $barang_id && lb_lvl = $lvl")->result_array();
			
		}

		function getPemesananMonth($dari,$ke){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c WHERE (a.pemesanan_tanggal BETWEEN '$dari' AND '$ke') AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id ORDER BY a.pemesanan_id DESC");
        	return $hasil;
		}

		function getIdbyName($nama_pemesan){
			$hasil=$this->db->query("SELECT * FROM pemesanan WHERE pemesanan_nama='$nama_pemesan' ORDER BY pemesanan_id DESC LIMIT 1");
        	return $hasil;
		}

		function getIdbyid($pemesanan_id){
			$hasil=$this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c,  metode_pembayaran d WHERE pemesanan_id='$pemesanan_id' AND  a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id LIMIT 1");
        	return $hasil;
		}

		function edit_pesanan_customer($nama_pemesan, $email, $no_hp, $tanggal, $alamat, $admin,$disc, $kembalian, $at, $kurir, $resi, $ongkir, $mp, $note, $username, $pemesanan_id){
			$hsl = $this->db->query("UPDATE pemesanan SET pemesanan_nama='$nama_pemesan', email_pemesan='$email', pemesanan_hp='$no_hp', pemesanan_tanggal='$tanggal', pemesanan_alamat='$alamat', biaya_admin='$admin',diskon='$disc', uang_kembalian='$kembalian', at_id='$at', kurir_id='$kurir',no_resi='$resi', mp_id='$mp', biaya_ongkir='$ongkir', note='$note', username = '$username' WHERE pemesanan_id='$pemesanan_id'");
        	return $hsl;
		}
		function edit_pesanan_reseller($nama_pemesan, $nama_akun_pemesan, $email, $no_hp, $tanggal, $alamat, $admin,$disc, $kembalian, $at, $kurir, $resi, $ongkir, $mp, $note, $username, $pemesanan_id){
			$hsl = $this->db->query("UPDATE pemesanan SET pemesanan_nama='$nama_pemesan', pemesanan_nama_akun='$nama_akun_pemesan', email_pemesan='$email', pemesanan_hp='$no_hp', pemesanan_tanggal='$tanggal', pemesanan_alamat='$alamat', biaya_admin='$admin',diskon='$disc', uang_kembalian='$kembalian', at_id='$at', kurir_id='$kurir',no_resi='$resi', biaya_ongkir='$ongkir', mp_id='$mp', note='$note', username = '$username' WHERE pemesanan_id='$pemesanan_id'");
        	return $hsl;
		}
		function edit_pesanan_produksi($no_hp, $tanggal, $alamat, $note, $username, $pemesanan_id){
			$hsl = $this->db->query("UPDATE pemesanan SET pemesanan_hp='$no_hp', pemesanan_tanggal='$tanggal', pemesanan_alamat='$alamat', note='$note', username = '$username' WHERE pemesanan_id='$pemesanan_id'");
        	return $hsl;
		}

		function edit_pesanan1($pemesanan_id,$nama,$tanggal,$no_hp,$alamat,$kurir_id,$resi,$at_id,$mp_id){
			$hsl = $this->db->query("UPDATE pemesanan SET pemesanan_nama='$nama',pemesanan_tanggal = '$tanggal',pemesanan_hp='$no_hp',pemesanan_alamat='$alamat',kurir_id='$kurir_id',no_resi='$resi',at_id='$at_id',mp_id = '$mp_id' WHERE pemesanan_id='$pemesanan_id'");
        	return $hsl;
		}

		function hapus_pesanan($pemesanan_id){ 
			$this->db->trans_start();
				$this->db->query("UPDATE pemesanan SET status_pemesanan=4 WHERE pemesanan_id='$pemesanan_id'");

				$data = $this->db->query("SELECT * FROM list_barang WHERE pemesanan_id='$pemesanan_id'");
				foreach ($data->result_array() as $i) {
					$qty = $i['lb_qty'];
					$barang_id = $i['barang_id'];
					$data_2= $this->db->query("SELECT barang_stok FROM barang WHERE barang_id='$barang_id'");
					foreach ($data_2->result_array() as $i) {
						$barang_stock_akhir=$i['barang_stok'];
					}
					$this->db->query("UPDATE barang SET barang_stok = ($barang_stock_akhir+$qty) WHERE barang_id = '$barang_id'");
					$this->db->query("INSERT INTO stok_barang(id_barang,jumlah,status) VALUES ('$barang_id', '$qty', '2')");
				}
				$this->db->query("DELETE FROM list_barang WHERE pemesanan_id='$pemesanan_id'");
	      	$this->db->trans_complete();
	        if($this->db->trans_status()==true)
	        return true;
	        else
	        return false;
		}
		
		function getAllAT(){
			$hasil=$this->db->query("SELECT * FROM asal_transaksi");
        	return $hasil;
		}

		function save_at($nama){
			$hsl = $this->db->query("INSERT INTO asal_transaksi(at_nama) VALUES ('$nama')");
        	return $hsl;
		}

		function update_at($id,$nama){
			$hsl = $this->db->query("UPDATE asal_transaksi SET at_nama='$nama' WHERE at_id='$id'");
        	return $hsl;
		}

		function hapus_at($id){
	      	$hsl = $this->db->query("DELETE FROM asal_transaksi WHERE at_id='$id'");
	      	return $hsl;
    	}

    	function getAllMetpem(){
			$hasil=$this->db->query("SELECT * FROM metode_pembayaran");
        	return $hasil;
		}

		function save_Metpem($nama){
			$hsl = $this->db->query("INSERT INTO metode_pembayaran(mp_nama) VALUES ('$nama')");
        	return $hsl;
		}

		function update_Metpem($id,$nama){
			$hsl = $this->db->query("UPDATE metode_pembayaran SET mp_nama='$nama' WHERE mp_id='$id'");
        	return $hsl;
		}

		function hapus_Metpem($id){
	      	$hsl = $this->db->query("DELETE FROM metode_pembayaran WHERE mp_id='$id'");
	      	return $hsl;
    	}

    	function getAllkurir(){
			$hasil=$this->db->query("SELECT * FROM kurir");
        	return $hasil;
		}

		function save_kurir($nama){
			$hsl = $this->db->query("INSERT INTO kurir(kurir_nama) VALUES ('$nama')");
        	return $hsl;
		}

		function update_kurir($id,$nama){
			$hsl = $this->db->query("UPDATE kurir SET kurir_nama='$nama' WHERE 	kurir_id='$id'");
        	return $hsl;
		}

		function hapus_kurir($id){
	      	$hsl = $this->db->query("DELETE FROM kurir WHERE kurir_id='$id'");
	      	return $hsl;
    	}

    	function SUMR(){
    		return $this->db->query("SELECT SUM(a.lb_qty * d.br_harga) AS total_keseluruhan FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE  a.lb_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
    	}

    	function SUMNR(){
    		return $this->db->query("SELECT SUM(a.lb_qty * d.bnr_harga) AS total_keseluruhan FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
		}

		function status_pesanan($pemesanan_id,$status_pemesanan){
		
				return $this->db->query("UPDATE pemesanan SET status_pemesanan = '$status_pemesanan' WHERE pemesanan_id = '$pemesanan_id'");
			
		}

		function insert_uang_masuk($pemesanan_id,$jumlah){
		
					$hsl = $this->db->query("INSERT INTO uang_masuk(pemesanan_id,jumlah) VALUES ('$pemesanan_id','$jumlah')");

					return $hsl;
			
		}
		function status_eks($pemesanan_id,$status_eks){
		
			return $this->db->query("UPDATE pemesanan SET status_eks = '$status_eks' WHERE pemesanan_id = '$pemesanan_id'");
		
	}

		function get_total_pemesanan($pemesanan_id){
			return $this->db->query("SELECT harga FROM list_barang WHERE pemesanan_id = $pemesanan_id")->result_array();
		}

		function getPemesananByTanggal($start, $end){
		$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE (a.pemesanan_tanggal BETWEEN '$start' AND '$end') AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
		return $hasil;
		}

		function getPemesananCustomerByTanggal($start, $end){
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.status_customer=1 AND (a.pemesanan_tanggal BETWEEN '$start' AND '$end') AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}

		function getPemesananResellerByTanggal($start, $end){
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.status_customer=2 AND (a.pemesanan_tanggal BETWEEN '$start' AND '$end') AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}

		function getPemesananProduksiByTanggal($start, $end){
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.status_customer=3 AND (a.pemesanan_tanggal BETWEEN '$start' AND '$end') AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}

		function getPemesananByBulan($bulan, $tahun){
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE month(a.pemesanan_tanggal) = $bulan AND year(a.pemesanan_tanggal) = $tahun AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}
		
		function getPemesananAllByBulan($bulan, $tahun){
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE month(a.pemesanan_tanggal) = $bulan AND year(a.pemesanan_tanggal) = $tahun AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}

		function getPemesananCustomerByBulan($bulan, $tahun){
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE month(a.pemesanan_tanggal) = $bulan AND year(a.pemesanan_tanggal) = $tahun AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id AND a.status_pemesanan!=4 AND a.status_customer=1 ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}

		function getPemesananResellerByBulan($bulan, $tahun){
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE month(a.pemesanan_tanggal) = $bulan AND year(a.pemesanan_tanggal) = $tahun AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id AND a.status_pemesanan!=4 AND a.status_customer=2 ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}

		function getPemesananProduksiByBulan($bulan, $tahun){
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE month(a.pemesanan_tanggal) = $bulan AND year(a.pemesanan_tanggal) = $tahun AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id AND a.status_pemesanan!=4 AND a.status_customer=3 ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		} 

		
		function getPemesananByTahun($awal, $akhir){
			$date_start = $awal."-01-01";
			$date_end = $akhir."-12-31";
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE year(a.pemesanan_tanggal) BETWEEN '$date_start' AND '$date_end' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}

		function getPemesananCustomerByTahun($awal, $akhir){
			$date_start = $awal."-01-01";
			$date_end = $akhir."-12-31";
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.status_customer=1 AND year(a.pemesanan_tanggal) BETWEEN '$date_start' AND '$date_end' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}

		function getPemesananResellerByTahun($awal, $akhir){
			$date_start = $awal."-01-01";
			$date_end = $akhir."-12-31";
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.status_customer=2 AND year(a.pemesanan_tanggal) BETWEEN '$date_start' AND '$date_end' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}

		function getPemesananProduksiByTahun($awal, $akhir){
			$date_start = $awal."-01-01";
			$date_end = $akhir."-12-31";
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.status_customer=3 AND year(a.pemesanan_tanggal) BETWEEN '$date_start' AND '$date_end' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}

		function getPemesananByBulanTanpaTahun($bulan, $start, $end){
			$date_start = $start."-01-01";
			$date_end = $end."-12-31";
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE month(a.pemesanan_tanggal) = '$bulan' AND year(pemesanan_tanggal) BETWEEN '$date_start' AND '$date_end' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
			}

		function getPemesananCustomerByBulanTanpaTahun($bulan, $start, $end){
			$date_start = $start."-01-01";
			$date_end = $end."-12-31";
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.status_customer=1 AND month(a.pemesanan_tanggal) = '$bulan' AND year(pemesanan_tanggal) BETWEEN '$date_start' AND '$date_end' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}
		function getPemesananResellerByBulanTanpaTahun($bulan, $start, $end){
			$date_start = $start."-01-01";
			$date_end = $end."-12-31";
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.status_customer=2 AND month(a.pemesanan_tanggal) = '$bulan' AND year(pemesanan_tanggal) BETWEEN '$date_start' AND '$date_end' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
			}
		function getPemesananProduksiByBulanTanpaTahun($bulan, $start, $end){
			$date_start = $start."-01-01";
			$date_end = $end."-12-31";
			$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.status_customer=3 AND month(a.pemesanan_tanggal) = '$bulan' AND year(pemesanan_tanggal) BETWEEN '$date_start' AND '$date_end' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
			return $hasil;
		}

		function getPemesananByBulanIni(){
				$bulan = date('m');
				$tahun = date('Y');
				$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE month(a.pemesanan_tanggal) = $bulan AND year(a.pemesanan_tanggal) = $tahun AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
				return $hasil;
				}

				function getPemesananByTahun2($tahun){
					$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE year(a.pemesanan_tanggal) = $tahun AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal DESC");
					return $hasil;
				}
		
				function getPemesananCustomerByTahun2($tahun){
					$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.status_customer=1 AND year(a.pemesanan_tanggal) = $tahun AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal DESC");
					return $hasil;
				}
		
				function getPemesananResellerByTahun2($tahun){
					$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.status_customer=2 AND year(a.pemesanan_tanggal) = $tahun AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal DESC");
					return $hasil;
				}
		
				function getPemesananProduksiByTahun2($tahun){
					$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.status_customer=3 AND year(a.pemesanan_tanggal) = $tahun AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal DESC");
					return $hasil;
				}

				function getPemesananByBulanSemuaTahun($bulan){
					$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE month(a.pemesanan_tanggal) = $bulan AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
					return $hasil;
					}
				
		
				function getPemesananCustomerByBulanSemuaTahun($bulan){
					$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE month(a.pemesanan_tanggal) = $bulan AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id AND a.status_pemesanan!=4 AND a.status_customer=1 ORDER BY a.pemesanan_tanggal ASC");
					return $hasil;
				}
		
				function getPemesananResellerByBulanSemuaTahun($bulan){
					$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE month(a.pemesanan_tanggal) = $bulan  AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id AND a.status_pemesanan!=4 AND a.status_customer=2 ORDER BY a.pemesanan_tanggal ASC");
					return $hasil;
				}
		
				function getPemesananProduksiByBulanSemuaTahun($bulan){
					$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE month(a.pemesanan_tanggal) = $bulan AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id AND a.status_pemesanan!=4 AND a.status_customer=3 ORDER BY a.pemesanan_tanggal ASC");
					return $hasil;
				} 
				
				function getHModal($pemesanan_id){
					return $this->db->query("SELECT a.HPP, d.* FROM kategori_barang a, barang b, list_barang d WHERE d.pemesanan_id = $pemesanan_id AND d.barang_id = b.barang_id AND b.id_kategori_barang = a.id_kategori_barang");
					
				}

				function getPemesananAllByTanggal($start, $end, $bulan){
					$hasil = $this->db->query("SELECT a.*,b.*,c.*,d.*,DATE_FORMAT(pemesanan_tanggal,'%d/%m/%Y') AS tanggal FROM pemesanan a, kurir b, asal_transaksi c, metode_pembayaran d WHERE a.status_customer=1 AND month(a.pemesanan_tanggal) = $bulan AND year(pemesanan_tanggal) BETWEEN '$start' AND '$end' AND a.kurir_id = b.kurir_id AND a.at_id = c.at_id AND a.mp_id = d.mp_id and a.status_pemesanan!=4  ORDER BY a.pemesanan_tanggal ASC");
					return $hasil;
				}

	}
?>