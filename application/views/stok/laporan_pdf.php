<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head><body>
<center>
  <h1>
  <?php 
  if($stts == "pperhari"){
    echo ($title . "<br>"); 
    echo ("<h5> (" . date('d-m-Y') . ")</h5>"); 
  }
  else if ($stts == "pperbulan"){
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
    echo ("<h5> (" . $month . " " . $tahun . ")</h5>");
  }
  else if ($stts == "pperbulantanpatahun"){
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
    if($awal == $akhir){
      echo ($title . "<br>");
      echo ("<h5> (" . $month . " " . $awal . ") </h5>");
    }
    else {
      echo ($title . "<br>");
      echo ("<h5> (" . $month . " " . $awal . " sampai " . $month . " " . $akhir . ") </h5>");
    }
  }
  else if ($stts == "ppertanggal"){
    if($start == $end){
      echo ($title . "<br>");
      $startt = DateTime::createFromFormat('Y-m-d', $start);
      $formattedStart = $startt->format('d-m-Y');
      echo ("<h5> (" . $formattedStart . ") </h5>");
    }
    else {
      echo ($title . "<br>");
      $startt = DateTime::createFromFormat('Y-m-d', $start);
      $formattedStart = $startt->format('d-m-Y');
      $endd = DateTime::createFromFormat('Y-m-d', $end);
      $formattedEnd = $endd->format('d-m-Y');
      echo ("<h5> (" . $formattedStart . " sampai " . $formattedEnd . ") </h5>");
    }
  }

  else if($stts == 'pAll'){
  echo ($title."<br>");
  }
  
  
if($statkurir == -1 || $statkurir == 0){
  echo ("<h4>".$stat."</h5>");
}
else{
foreach ($stat as $i) {
    echo ("<h4>".$i['kurir_nama']."</h5>");}}
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
                  <th>Ekspedisi</th>
                  <th>Status Ekspedisi</th>
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
                  $hp =  wordwrap($i['pemesanan_hp'], 13, '<br>', true); 
                  $alamat = wordwrap($i['pemesanan_alamat'], 13, '<br>', true); 
                  $email = wordwrap($i['email_pemesan'], 13, '<br>', true); 
                  $kurir_id = $i['kurir_id'];
                  $resi = wordwrap($i['no_resi'], 10, '<br>', true); 
                  $ongkir = $i['biaya_ongkir'];
                  $mp_id1 = $i['mp_id'];
                  $mp_nama = $i['mp_nama'];
                  $level = $i['status_customer'];
                  $kurir_nama = $i['kurir_nama'];
                  $resi = $i['no_resi'];
                  $at_id = $i['at_id'];
                  $at_nama = $i['at_nama'];
                  $status = $i['status_eks'];
                  $biaya_admin = $i['biaya_admin'];
                  $diskon = $i['diskon'];
                  $uang = $i['uang_kembalian'];
                  $note = $i['note'];
                  if($i['status_eks'] == 0)
                  $status = "Belum Bayar";
                  elseif($i['status_eks'] == 1)
                  $status = "Dibayar";
                  elseif($i['status_eks'] == 2)
                  $status = "Dikirim";
                  elseif($i['status_eks'] == 3)
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
                    <td><?php echo $kurir_nama ?></td>
                    <td><?php echo $status ?></td>
                    <td><?php echo rupiah($ongkir) ?></td>
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
                <th colspan="12">
                  <center>Jumlah</center>
                </th>
                <th><?php echo rupiah($total) ?></th>
                <th><?php echo rupiah($tot_omset) ?></th>
                <th><?php echo rupiah($tot_modal) ?></th>
                <th><?php echo rupiah($tot_untung) ?></th>
              </tr>
            
  
            </table>
</body></html>