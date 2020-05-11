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
          <?php if($numstat == 0) : ?>
            <center><h1>Laporan <?=$stat?> Transaksi</h1></center>
            <?php else :?>
              <center><h1>Laporan Transaksi <?=$stat?></h1></center>
              <?php endif?>
            <center><h4>(<?=date("d-m-Y", strtotime($start))?> hingga <?= date("d-m-Y", strtotime($end)) ?>)</h4></center>
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
                  $tot_omset = 0;
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
                    $q = $this->db->query("SELECT a.lb_qty, a.harga, a.pemesanan_id, SUM(a.lb_qty * a.harga) as Total_keseluruhan, (SUM(a.lb_qty * a.harga))-(SUM(a.lb_qty * $modal)) AS total from list_barang a, pemesanan b WHERE a.pemesanan_id = $pemesanan_id AND b.pemesanan_id = $pemesanan_id");
                    $c=$q->row_array();
                    $omset = $c['Total_keseluruhan'];
                    $untung = $c['total'];
                 
                    
                  $tot_omset = $tot_omset + $omset;

                      
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
                      <th><?php echo rupiah($tot_omset)?></th>
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
