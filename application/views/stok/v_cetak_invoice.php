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
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<body>
     <div class="cointainer" style="display: flex">
        <div class="col-md-4" style="margin-top: 20px">
        <center><img style="width: 80px; margin-left: 120px; margin-right: auto;" src="<?php echo base_url() ?>assets/admin/images/dhijablogo.jpeg"></center>
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
                    foreach($pemesan->result_array() as $i) :
                      $pemesanan_id = $i['pemesanan_id'];
                      $pemesanan_nama = $i['pemesanan_nama'];
                      $tanggal = $i['tanggal'];
                      $pemesanan_alamat = $i['pemesanan_alamat'];
                      $pemesanan_hp = $i['pemesanan_hp'];
          ?>
          <p style="font-size: 35px; margin-top: 20px;"><?php echo $pemesanan_nama?></p>
          <p style="font-size: 20px; "><?php echo $pemesanan_alamat?></p>
          <p style="font-size: 20px; "><?php echo $pemesanan_hp?></p>
        
        </div>
        <div class="col-md-3" style="margin-top: 20px;" >
          <p  style="font-size: 20px;"><b>Order (<?php echo $tanggal?>)</b></p>
          <?php endforeach;?>
          <?php
            foreach($listbarang->result_array() as $i) :
              $qty = $i['lb_qty'];
              $barang_nama = $i['barang_nama'];
          ?>
          <div class="col-md-12" style="padding-left:0;display: flex">
            <div class="col-md-10" style="padding-left:0;">
              <p  style="font-size: 15px;margin-bottom: 0;"><?php echo $barang_nama?></p>
            </div>
            <div class="col-md-6" style="padding-left:0;">
              <p  style="font-size: 15px;margin-bottom: 0;"><?php echo $qty?> item</p>
            </div>
          </div>
        <?php endforeach;?>
        <p style="border: 2px solid;border-radius: 5px;margin-top:10px;margin-bottom: 0" class="text-center"><b><?php echo $kurir?></b></p>
        <p style="border: 2px solid;border-radius: 5px;margin-top: 5px;margin-bottom: 0" class="text-center"><b><?php echo $mp_nama?></b></p>
        <p style="border: 2px solid;border-radius: 5px;margin-top: 5px;" class="text-center"><b>User</b> : <?php echo $nama?></p>

        </div>        
      </div>
    <hr style="color: black;margin-top: 10px;margin-bottom: 10px; border-color: black;width: 100%;">

</body>
</html>

<script>
  var is_chrome = function () {
    return Boolean(window.chrome);
  }
  if (is_chrome) {
    window.print();
    setTimeout(function () {
      window.close();
    }, 10000);
    //give them 10 seconds to print, then close
  } else {
    window.print();
    window.close();
  }
</script>
