<html>
<head>
  <title>Laporan Ekspedisi Bulanan</title>
</head>
<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo base_url()?>assets/images/logo.png" />

<!-- Font -->
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>
<?php date_default_timezone_set("Asia/Jakarta");?>
     <div>
          
          <div class="col-xl-12">
          <center><h1>Laporan Pemesanan Ekspedisi Bulanan</h1></center>
            <?php if($numstat == -1 || $numstat == 0) : ?>
            <center><h3><?=$stat?></h3></center>
            <?php else : ?>
            <center><h3><?php foreach ($stat as $i) {
              echo $i['kurir_nama'];
            }?></h3></center>
<?php endif?>
            <center><h4>(<?php 
                  switch ($bulan){
                    case 1 : echo "Januari"; break;
                    case 2 : echo "Februari"; break;
                    case 3 : echo "Maret"; break;
                    case 4 : echo "April"; break;
                    case 5 : echo "Mei"; break;
                    case 6 : echo "Juni"; break;
                    case 7 : echo "Juli"; break;
                    case 8 : echo "Agustus"; break;
                    case 9 : echo "September"; break;
                    case 10 : echo "Oktober"; break;
                    case 11 : echo "November"; break;
                    case 12 : echo "Desember"; break;
                  }
                  ?> <?= $tahun?>) </h4></center>
          </div>
          <hr style="margin-left:10px;margin-right:10px;">
          <hr>
          <br>

<table border="1" cellpadding="7" width="100%" style="border-style: solid;border-width: thin;border-collapse: collapse;" >
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
                  <th>Status Ekspedisi</th>
                  <th>Note</th>
                  <th>Total Harga</th>
                  

                  <!-- <th>
                    <center>Aksi</center>
                  </th> -->
                </tr>
                <?php
                function rupiah($angka)
                {
                  $hasil_rupiah = "Rp" . number_format($angka, 0, ',', '.');
                  return $hasil_rupiah;
                }

                $no = 0;
                $total = 0;
                foreach ($data->result_array() as $i) :
                  $no++;

                  $pemesanan_id = $i['pemesanan_id'];
                  $pemesanan_nama = $i['pemesanan_nama'];
                  $nama_akun = $i['pemesanan_nama_akun'];
                  $tanggal = $i['tanggal'];
                  $hp =  wordwrap($i['pemesanan_hp'], 13, '<br>', true); 
                  $alamat = wordwrap($i['pemesanan_alamat'], 20, '<br>', true); 
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
                  $status = $i['status_eks'];
                  $biaya_admin = $i['biaya_admin'];
                  $diskon = $i['diskon'];
                  $uang = $i['uang_kembalian'];
                  $note = $i['note'];
                  if($status == 0)
                  $namstat = "Belum Bayar";
                  else if($status == 1)
                  $namstat = "Dibayar";
                  else if($status == 2)
                  $namstat = "Dikirim";
                  else if($status == 3)
                  $namstat = "Selesai";

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
                    $nama_barang=$nama_barang.$nomor_barang.". ".$k['barang_nama'].": ".$k['lb_qty']."<br><br>";
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
                    <td><?php echo $namstat?></td>
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
              <tr>
                <th colspan="15">
                  <center>Jumlah</center>
                </th>
                <th colspan="2"><?php echo rupiah($total) ?></th>
              </tr>
            </table>
    </div>

        </div>
      

</body>
</html>

<script type="text/javascript">
 window.print();
 window.close();
</script>
