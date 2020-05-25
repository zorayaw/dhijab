<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="HTML5 Template" />
  <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
  <meta name="author" content="potenzaglobalsolutions.com" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title>Cetak</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo base_url()?>assets/admin/images/dhijablogo.jpeg" />

<!-- Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<body>
  <div class="cointainer" style="display: flex">
    <div class="col-md-4" style="margin-top: 20px">
      <center><img style="width: 80px; margin-right: auto;" src="<?php echo base_url() ?>assets/admin/images/dhijablogo.jpeg"></center>
      <p style="text-align: center;margin-bottom: 0;"><b>D'hijab Afna</b></p>
      <p style="text-align: center;margin-bottom: 0;"><b>Your Best Hijab Identity</b></p>
      <p style="text-align: center;margin-bottom: 0;"><b>WA </b>: 0856-281-6868</p>
      <hr>
          <div class="col-md-6" style="float: left;">
            <p style="font-size: 15px;margin-bottom: 0;text-align: center;"><b>Tokopedia</b> : Afna Store</p>
            <p style="font-size: 15px;margin-bottom: 0;text-align: center;"><b>Shopee</b> : d_hijab_afna</p>
          </div>
          <div class="col-md-6" style="float: left;">
            <p style="font-size: 15px;margin-bottom: 0;text-align: center;"><b>Bukalapak</b> : Hijab Afna</p>
            <p style="font-size: 15px;margin-bottom: 0;text-align: center;"><b>Lazada</b> : d_hijab_afna</p>
          <br>
          </div>
    </div>
    <div class="col-md-5" style="margin-top: 20px"> 
      <h5>Kepada : </h5>
      <?php
      foreach ($pemesan->result_array() as $i) :
        $pemesanan_id = $i['pemesanan_id'];
        $pemesanan_nama = $i['pemesanan_nama'];
        $tanggal = $i['tanggal'];
        $pemesanan_alamat = $i['pemesanan_alamat'];
        $pemesanan_hp = $i['pemesanan_hp'];
      ?>
        <p style="font-size: 35px; margin-top: 20px;"><?php echo $pemesanan_nama ?></p>
        <p style="font-size: 20px; "><?php echo $pemesanan_alamat ?></p>
        <p style="font-size: 20px; "><?php echo $pemesanan_hp ?></p>

    </div>
    <div class="col-md-3" style="margin-top: 20px;">
      <p style="font-size: 20px;"><b>Order (<?php echo $tanggal ?>)</b></p>
    <?php endforeach; ?>
    <?php
    foreach ($listbarang->result_array() as $i) :
      $qty = $i['lb_qty'];
      $barang_nama = $i['barang_nama'];
    ?>
      <div class="col-md-12" style="padding-left:0;display: flex">
        <div class="col-md-10" style="padding-left:0;">
          <p style="font-size: 15px;margin-bottom: 0;"><?php echo $barang_nama ?></p>
        </div>
        <div class="col-md-6" style="padding-left:0;">
          <p style="font-size: 15px;margin-bottom: 0;"><?php echo $qty ?> item</p>
        </div>
      </div>
    <?php endforeach; ?>
    <p style="border: 2px solid;border-radius: 5px;margin-top:10px;margin-bottom: 0" class="text-center"><b><?php echo $kurir ?></b></p>
    <p style="border: 2px solid;border-radius: 5px;margin-top: 5px;margin-bottom: 0" class="text-center"><b><?php echo $mp_nama ?></b></p>
    <p style="border: 2px solid;border-radius: 5px;margin-top: 5px;" class="text-center"><b>User</b> : <?php echo $nama ?></p>

    </div>
  </div>
  <div class="row">   
      <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">
            <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered p-0">
              <thead>
                  <tr>
                      <th width="20">No</th>
                      <th>Barang Nama</th>
                      <th>Jumlah Barang</th>
                      <th>Harga per item</th>
                      <th>Total Harga</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                      $jumlah=0;
                    function rupiah($angka){
                      $hasil_rupiah = "Rp" . number_format($angka,0,',','.');
                      return $hasil_rupiah;
                    }

                    $no = 0 ; 
                    foreach($listbarang->result_array() as $i) :
                      $no++;
                      $lb_id = $i['lb_id'];
                      $pemesanan_nama = $i['pemesanan_nama'];
                      $pemesanan_id = $i['pemesanan_id'];
                      $barang_id = $i['barang_id'];
                      $qty = $i['lb_qty'];
                      $barang_nama = $i['barang_nama'];
                      $bnr_harga = $i['bnr_harga'];
                      $total = $i['total'];
                      $jumlah=$total+$jumlah;
                  ?>
                    <tr>
                     <td><center><?php echo $no?></center></td>
                      <td><?php echo $barang_nama?></td>
                      <td><?php echo $qty?></td>
                      <td><?php echo rupiah($bnr_harga)?></td>
                      <td><?php echo rupiah($total)?></td>
                    </tr>
                    <?php endforeach;?>
                    <tr>
                      <th colspan="4"><center>Jumlah</center></th>
                      <th><?php echo rupiah($jumlah)?></th>
                    </tr>
              </tbody>
           </table>
          </div>
          </div>
        </div>   
      </div>
  </div>
  <hr style="color: black;margin-top: 10px;margin-bottom: 10px; border-color: black;width: 100%;">


</body>

</html>

<script type="text/javascript">
  window.print();
  window.close();
</script>