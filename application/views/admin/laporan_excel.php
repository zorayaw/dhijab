<?php
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=Transaksi_Excel.xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 ?>
 
<center>
  <h1>
  <?php 
  if($stts == "eperhari"){
    echo ($title . "<br>"); 
    echo ("<h2> (" . date('d-m-Y') . ")</h2>"); 
  }
  else if ($stts == "eperbulan"){
    switch ($bulan){
      case 1 : $month =  "Januari"; break;
      case 2 : $month =  "Februari"; break;
      case 3 : $month =  "Maret"; break;
      case 4 : $month =  "April"; break;
      case 5 : $month =  "Mei"; break;
      case 6 : $month =  "Juni"; break;
      case 7 : $month =  "Juli"; break;
      case 8 : $month =  "Agustus"; break;
      case 9 : $month =  "September"; break;
      case 10 : $month =  "Oktober"; break;
      case 11 : $month =  "November"; break;
      case 12 : $month =  "Desember"; break;
    }
    echo ($title . "<br>");
    echo ("<h2> (" . $month . " " . $tahun . ")</h2>");
  }
  else if ($stts == "eperbulantanpatahun"){
    switch ($bulan){
      case 1 : $month = "Januari"; break;
      case 2 : $month = "Februari"; break;
      case 3 : $month = "Maret"; break;
      case 4 : $month = "April"; break;
      case 5 : $month = "Mei"; break;
      case 6 : $month = "Juni"; break;
      case 7 : $month = "Juli"; break;
      case 8 : $month = "Agustus"; break;
      case 9 : $month = "September"; break;
      case 10 : $month = "Oktober"; break;
      case 11 : $month = "November"; break;
      case 12 : $month = "Desember"; break;
    }
    echo ($title . "<br>");
    echo ("<h2> (" . $month . " " . $awal . " sampai " . $month . " " . $akhir . ") </h2>");
  }
  else if ($stts == "epertanggal"){
    echo ($title . "<br>");
    $startt = DateTime::createFromFormat('Y-m-d', $start);
    $formattedStart = $startt->format('d-m-Y');
    $endd = DateTime::createFromFormat('Y-m-d', $end);
    $formattedEnd = $endd->format('d-m-Y');
    echo ("<h2> (" . $formattedStart . " sampai " . $formattedEnd . ") </h2>");
  }
  else if($stts == "eAll"){
    echo ($title . "<br>");
  }
  else if($stts == "eTransaksi"){
    echo ($title . "<br>");
  }
  ?>
  </h1>
</center>


        <table border="2">
              <thead>
              <tr>
                  <th>No</th>
                  <th>Nomor Order</th>
                  <th>Nama Pemesan</th>
                  <th>Nama Akun</th>
                  <th>Tanggal Pemesanan</th>
                  <th>Metode Pembayaran</th>
                  <th>Status Pemesanan</th>
                  <th>Biaya Ongkir</th>
                  <th>Biaya Admin</th>
                  <th>Diskon</th>
                  <th>Uang Kembalian</th>
                  <th>Total Harga</th>
                  <th>Omset</th>
                  <th>Modal</th>
                  <th>Untung</th>
                </tr>
              </thead>
              <tbody>
              <?php
                function rupiah($angka)
                {
                  $hasil_rupiah = "Rp" . number_format($angka, 0, ',', '.');
                  return $hasil_rupiah;
                }
  
                $no = 0;
                $total = 0;
                $status = "";
                $tot_omset = 0;
                $untung = 0;
                $tot_modal = 0;
                $tot_untung = 0;
                foreach ($datapesanan->result_array() as $i) :
                  $m = 0;
                  $no++;
  
                  $pemesanan_id = $i['pemesanan_id'];
                  $pemesanan_nama = $i['pemesanan_nama'];
                  $nama_akun = $i['pemesanan_nama_akun'];
                  $tanggal = $i['tanggal'];
                  $hp = $i['pemesanan_hp'];
                  $alamat = $i['pemesanan_alamat'];
                  $email = $i['email_pemesan'];
                  $kurir_id = $i['kurir_id'];
                  $ongkir = $i['biaya_ongkir'];
                  $mp_id1 = $i['mp_id'];
                  $mp_nama = $i['mp_nama'];
                  $level = $i['status_customer'];
                  $kurir_nama = $i['kurir_nama'];
                  $resi = $i['no_resi'];
                  $at_id = $i['at_id'];
                  $at_nama = $i['at_nama'];
                  $status = $i['status_pemesanan'];
                  $biaya_admin = $i['biaya_admin'];
                  $diskon = $i['diskon'];
                  $uang = $i['uang_kembalian'];
                  $note = $i['note'];
                  if($i['status_pemesanan'] == 0)
                  $status = "Belum Bayar";
                  elseif($i['status_pemesanan'] == 1)
                  $status = "Dibayar";
                  elseif($i['status_pemesanan'] == 2)
                  $status = "Dikirim";
                  elseif($i['status_pemesanan'] == 3)
                  $status = "Selesai";
               
                  $q = $this->M_pemesanan->getHModal($pemesanan_id)->result_array();

                  foreach($q as $key){
                    $modal = $key['HPP'];
                    $br_id = $key['barang_id'];
                    $z =  $this->db->query("SELECT *,lb_qty * $modal AS total from list_barang where barang_id = $br_id AND pemesanan_id=' $pemesanan_id'");
                    $c = $z->row_array();
                  $m = $m + $c['total'];
                  }

                  
                  $q = $this->db->query("SELECT SUM(lb_qty * harga)AS total_keseluruhan from list_barang where pemesanan_id=' $pemesanan_id'");
                  $c = $q->row_array();
                  $omset = $c['total_keseluruhan'];
                  $jumlah = $c['total_keseluruhan'] + $ongkir - ($diskon + $biaya_admin + $uang);
                  $untung = $jumlah - $m;
  
                ?>
  
                  <tr>
                    <td>
                      <center><?php echo $no ?></center>
                    </td>
                    <td><?php echo $pemesanan_id ?></td>
                    <td><?php echo $pemesanan_nama ?></td>
                    <td><?php echo $nama_akun ?></td>
                    <td><?php echo $tanggal ?></td>
                    <td><?php echo $mp_nama ?></td>
                    <td><?php echo $status ?></td>
                    <td><?php echo $ongkir ?></td>
                    <td><?php echo rupiah($biaya_admin) ?></td>
                    <td><?php echo rupiah($diskon) ?></td>
                    <td><?php echo rupiah($uang) ?></td>
                    <td><?php echo rupiah($jumlah) ?></td>
                    <td><?php echo rupiah($omset) ?></td>
                    <td><?php echo rupiah($m) ?></td>
                    <td><?php echo rupiah($untung) ?></td>
                    
                    
  
                    <?php
                    $tot_omset = $tot_omset + $omset;
                    $total = $total + $jumlah;
                    $tot_modal = $tot_modal + $m;
                    $tot_untung = $tot_untung + $untung;
                    ?>
                  </tr>
                <?php endforeach; ?>
              
              </tbody>
              <tr>
                <th colspan="11">
                  <center>Jumlah</center>
                </th>
                <th><?php echo rupiah($total) ?></th>
                <th><?php echo rupiah($tot_omset) ?></th>
                <th><?php echo rupiah($tot_modal) ?></th>
                <th><?php echo rupiah($tot_untung) ?></th>
              </tr>
            
  
            </table>