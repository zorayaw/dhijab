<html>
<head>
  <title>Laporan Transaksi Perhari</title>
</head>
<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo base_url()?>assets/images/logo.png" />

<!-- Font -->
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>
<?php date_default_timezone_set("Asia/Jakarta");
$cur_date = date("d-m-Y");?>
     <div>
          
          <div class="col-xl-12">
            <center><h1>Laporan Transaksi</h1></center>
            <center><h4>(<?= date('d')?> <?php 
                  switch (date('m')){
                    case 1 : echo "Januari"; break;
                    case 2 : echo "Februari"; break;
                    case 3 : echo "Maret"; break;
                    case 4 : echo "April"; break;
                    case 5 : echo "May"; break;
                    case 6 : echo "Juni"; break;
                    case 7 : echo "Juli"; break;
                    case 8 : echo "Agustus"; break;
                    case 9 : echo "September"; break;
                    case 10 : echo "Oktober"; break;
                    case 11 : echo "November"; break;
                    case 12 : echo "Desember"; break;
                  }
                  ?> <?= date('Y')?>) </h4></center>
          </div>
          <hr style="margin-left:10px;margin-right:10px;">
          <hr>
          <br>

             <table border="1" cellpadding="7" width="100%" style="border-style: solid;border-width: thin;border-collapse: collapse;" >
              <tr>
                <th width="5">No</th>
                      <th>Nama Pemesan</th>
                      <th>Tanggal Pemesanan</th>
                      <th>No HP</th>
                      <th>Alamat</th>
                      <th>Kurir</th>
                      <th>Asal Transaksi</th>
                      <th>Total Omset</th>
              </tr>
                  <?php
                    function rupiah($angka){
                      $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
                      return $hasil_rupiah;
                    }

                    $no = 0 ;
                  $modal = 0;
                  $omset = 0;
                    foreach($data->result_array() as $i) :
                      $no++;
                      $pemesanan_id = $i['pemesanan_id'];
                      $pemesanan_nama = $i['pemesanan_nama'];
                      $tanggal = $i['tanggal'];
                      $hp = $i['pemesanan_hp'];
                      $alamat = $i['pemesanan_alamat'];
                      $kurir_id = $i['kurir_id'];
                      $level = $i['status_customer'];
                      $kurir_nama = $i['kurir_nama'];
                      $at_id = $i['at_id'];
                      $at_nama = $i['at_nama'];
                      $b = $this->m_pemesanan->getHargaModal($pemesanan_id, $level);
                      foreach ($b as $temp) {
                        $modal = $modal + $temp['harga'];
                    }
                      if($level == 1){
                        $q=$this->db->query("SELECT SUM(a.lb_qty * d.br_harga) AS total_keseluruhan, ((SUM(a.lb_qty * d.br_harga))-SUM(a.lb_qty *$modal)) AS total FROM list_barang a, pemesanan b, barang c, barang_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND a.lb_qty = d.br_kuantitas AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id"); 
                        $c=$q->row_array();
                        $omset = $c['total_keseluruhan'];
                        $untung = $c['total'];
                      }elseif($level == 2){
                        $q=$this->db->query("SELECT SUM(a.lb_qty * d.bnr_harga) AS total_keseluruhan, (SUM(a.lb_qty * d.bnr_harga))-(SUM(a.lb_qty * $modal)) AS total FROM list_barang a, pemesanan b, barang c, barang_non_reseller d WHERE a.pemesanan_id = '$pemesanan_id' AND a.pemesanan_id = b.pemesanan_id AND a.barang_id = c.barang_id AND a.barang_id = d.barang_id");
                        $c=$q->row_array();
                        $omset = $c['total_keseluruhan'];
                        $untung = $c['total'];


                      }

                      
                  ?>
                    <tr>
                      <td><center><?php echo $no?></center></td>
                      <td><?php echo $pemesanan_nama?></td>
                      <td><?php echo $tanggal?></td>
                      <td><?php echo $hp?></td>
                      <td><?php echo $alamat?></td>
                      <td><?php echo $kurir_nama?></td>
                      <td><?php echo $at_nama?></td>
                      <td><?php echo rupiah($omset)?></td>
                    </tr>
                  <?php endforeach;?>
                  <tfoot>
                    <tr>
                      <th colspan="7"><center>Jumlah</center></th>
                      <th><?php echo rupiah($total_omset)?></th>
                    </tr>
                  </tfoot>
             </table>
      </div>

</body>
</html>

<script type="text/javascript">
 window.print();
 window.close();
</script>
