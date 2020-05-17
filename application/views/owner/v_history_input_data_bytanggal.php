
<div class="table-responsive">
      <table id="datatable" class="table table-striped table-bordered p-0">
        <thead>
            <tr>
                <th width="10">No</th>
                <th><center>ID Pemesanan</center></th>
                <th><center>Nama Pemesan</center></th>
                <th><center>Tanggal Pemesanan</center></th>
                <th><center>Status </center></th>
                <th><center>Input Data </center></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 0;
            foreach ($datapesanan->result_array() as $i) :
              $no++;
              $pemesanan_id = $i['pemesanan_id'];
              $pemesanan_nama = $i['pemesanan_nama'];  
              $tanggal = $i['tanggal'];
              $status = $i['status_pemesanan'];
              if($status == 0){
                  $status = "Belum Bayar";
              }
              else if($status == 1){
                  $status = "Dibayar";
              }
              else if ($status == 2){
                  $status = "Dikirim";
              }
              else {
                  $status = "Selesai";
              }
              $username = $i['user_nama'];
              $id = $i['user_id'];
            ?>
            <tr>
                <td><center><?= $no?></center></td>
                <td><center><?= $pemesanan_id ?></center></td>
                <td><center><?= $pemesanan_nama ?></center></td>
                <td><center><?= $tanggal?></center></td>
                <td><center><?= $status?></center></td>
                <td><center><?= $username ?> ( ID = <?= $id ?>) </center></td>
          </tr>
              <?php endforeach;?>
        </tbody>
     </table>
    </div>
    
<!-- custom -->
<script src="<?php echo base_url()?>assets/admin/js/custom.js"></script>
 