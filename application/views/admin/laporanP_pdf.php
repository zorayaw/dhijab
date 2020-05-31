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
    echo ($title . "<br>");
    echo ("<h5> (" . $month . " " . $awal . " sampai " . $month . " " . $akhir . ") </h5>");
  }
  else if ($stts == "ppertanggal"){
    echo ($title . "<br>");
    $startt = DateTime::createFromFormat('Y-m-d', $start);
    $formattedStart = $startt->format('d-m-Y');
    $endd = DateTime::createFromFormat('Y-m-d', $end);
    $formattedEnd = $endd->format('d-m-Y');
    echo ("<h5> (" . $formattedStart . " sampai " . $formattedEnd . ") </h5>");
  }
  else if($stts == "pAll"){
    echo ($title . "<br>");
  }
  else if($stts == "pTransaksi"){
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
                  <th>Tanggal Pesanan</th>
                  <th>No HP</th>
                  <th>Alamat</th>
                  <th>Email </th>
                  <th>Ekspedisi</th>
                  <th>Nomor Resi</th>
                  <th>Asal Transaksi</th>
                  <th>Metode Pembayaran</th>
                  <th>List Barang</th>
                  <th>Status</th>
                  <th>Note</th>
                  <th>Total Harga</th>


                  <!-- <th>
                    <center>Aksi</center>
                  </th> -->
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
                foreach ($datapesanan->result_array() as $i) :
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

                  $q = $this->db->query("SELECT SUM(lb_qty * harga)AS total_keseluruhan from list_barang where pemesanan_id=' $pemesanan_id'");
                  $c = $q->row_array();
                  $jumlah = $c['total_keseluruhan'] + $ongkir - ($diskon + $biaya_admin + $uang);

                  $q = $this->db->query("SELECT SUM(lb_qty * berat)AS total_berat from list_barang where pemesanan_id=' $pemesanan_id'");
                  $c = $q->row_array();
                  $total_berat = $c['total_berat'] ;

                  $q = $this->db->query("SELECT barang_nama,lb_qty from list_barang,barang where barang.barang_id=list_barang.barang_id and  pemesanan_id=' $pemesanan_id'");
                  
                  $nama_barang="";
                  $nomor_barang=1;
                  foreach ($q->result_array() as $k) :
                    $nama_barang=$nama_barang.$nomor_barang.". ".$k['barang_nama'].": ".$k['lb_qty']."<br>";
                      $nomor_barang++; 
                  endforeach;
                

                ?>
                  <tr>
                    <td>
                      <center><?php echo $no ?></center>
                    </td>
                    <td><?php echo $pemesanan_id ?></td>
                    <td><?php echo $pemesanan_nama ?></td>
                    <td><?php echo $nama_akun ?></td>
                    <td><?php echo $tanggal ?></td>
                    <td><?php echo $hp ?></td>
                    <td><?php echo $alamat ?></td>
                    <td><?php echo $email ?></td>
                    <td><?php echo $kurir_nama ?></td>
                    <td><?php echo $resi ?></td>
                    <td><?php echo $at_nama ?></td>
                    <td><?php echo $mp_nama ?></td>
                    <td><?php echo $nama_barang ?></td>
                    <td><?php echo $status ?></td>
                    <td><?php echo $note ?></td>
                    <td><?php echo rupiah($jumlah) ?></td>

                    <?php
                    $total = $total + $jumlah;
                    ?>
                    <!-- <td>
                      <a href="#" style="margin-right: 10px; margin-left: 10px;" data-toggle="modal" data-target="#editdata<?php echo $pemesanan_id ?>"><span class="ti-pencil"></span></a>
                      <a href="#" style="margin-right: 10px" data-toggle="modal" data-target="#hapusdata<?php echo $pemesanan_id ?>"><span class="ti-trash"></span></a>
                    </td> -->
                  </tr>
                <?php endforeach; ?>

              </tbody>
              <tr>
                <th colspan="15">
                  <center>Jumlah</center>
                </th>
                <th colspan="2"><?php echo rupiah($total) ?></th>
              </tr>
            </table>