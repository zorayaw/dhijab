
<div id="parent">
<div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered p-0">
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
                </tr>
              </thead>
              <tbody>
                
                <?php
                function rupiah($angka)
                {
                  $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
                  return $hasil_rupiah;
                }
  
                $no = 0;
                $total = 0;
                $status = "";
                $tot_omset = 0;
                foreach ($datapesanan->result_array() as $i) :
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
               
                  
                
                  
                  $q = $this->db->query("SELECT SUM(lb_qty * harga)AS total_keseluruhan from list_barang where pemesanan_id=' $pemesanan_id'");
                  $c = $q->row_array();
                  $omset = $c['total_keseluruhan'];
                  $jumlah = $c['total_keseluruhan'] + $ongkir - ($diskon + $biaya_admin + $uang);
  
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
                    
  
                    <?php
                    $tot_omset = $tot_omset + $omset;
                    $total = $total + $jumlah;
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
              </tr>
            
            </table>
          </div>
        </div>
      </div>
    </div>
    </div>
    
    <?php
    $no = 0;
    foreach ($datapesanan->result_array() as $i) :
      $no++;
      $pemesanan_id = $i['pemesanan_id'];
      $pemesanan_nama = $i['pemesanan_nama'];
      $tanggal = $i['tanggal'];
      $hp = $i['pemesanan_hp'];
      $alamat = $i['pemesanan_alamat'];
      $kurir_id1 = $i['kurir_id'];
      $level = $i['status_customer'];
      $kurir_nama = $i['kurir_nama'];
      $resi = $i['no_resi'];
      $at_id1 = $i['at_id'];
      $at_nama = $i['at_nama'];
      $mp_id1 = $i['mp_id'];
      $mp_nama = $i['mp_nama'];
    ?>
      <!-- Modal edit Data -->
      <div class="modal" tabindex="-1" role="dialog" id="editdata<?php echo $pemesanan_id ?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <?php if($bulan==0) { ?>
                    <?php if($stsp==0) { ?>
                    <form action="<?php echo base_url() ?>Admin/Pemesanan/edit_pesanan" method="post" enctype="multipart/form-data">
                    <?php }elseif($stsp==1) { ?>
                      <form action="<?php echo base_url() ?>Admin/PemesananCustomer/edit_pesanan" method="post" enctype="multipart/form-data">
                    <?php }elseif($stsp==2) { ?>
                      <form action="<?php echo base_url() ?>Admin/PemesananReseller/edit_pesanan" method="post" enctype="multipart/form-data">
                      <?php }elseif($stsp==3) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananProduksi/edit_pesanan" method="post" enctype="multipart/form-data">
                        <?php }} else { ?>
                      <?php if($stsp==0) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananAllByBulan/edit_pesanan?bulan=<?=$bulan?>" method="post" enctype="multipart/form-data">
                        <?php } elseif($stsp==1) { ?>
                          <form action="<?php echo base_url() ?>Admin/PemesananCustomerByBulan/edit_pesanan?bulan=<?=$bulan?>" method="post" enctype="multipart/form-data">
                          <?php } elseif($stsp==2) { ?>
                            <form action="<?php echo base_url() ?>Admin/PemesananResellerByBulan/edit_pesanan?bulan=<?=$bulan?>" method="post" enctype="multipart/form-data">
                            <?php } elseif($stsp==3) { ?>
                              <form action="<?php echo base_url() ?>Admin/PemesananProduksi/edit_pesanan?bulan=<?=$bulan?>" method="post" enctype="multipart/form-data">
                              <?php }} ?>
              <div class="modal-body p-20">
                <div class="row">
                  <div class="col-md-12">
                    <label class="control-label">Nama Pemesan</label>
                    <input type="hidden" name="pemesanan_id" value="<?php echo $pemesanan_id ?>">
                    <input class="form-control form-white" type="text" name="nama_pemesan" value="<?php echo $pemesanan_nama ?>" required />
                  </div>
                  <div class="col-md-12">
                    <label class="control-label">No HP</label>
                    <input class="form-control form-white" type="number" name="hp" value="<?php echo $hp ?>" required />
                  </div>
                  <!--                                <div class="col-md-12">
                                                  <label class="control-label">Tanggal</label>
                                                  <input class="form-control form-white" type="date" name="tanggal"/>
                                              </div> -->
                  <div class="col-md-12">
                    <label class="control-label">Alamat</label>
                    <input class="form-control form-white" type="text" name="alamat" value="<?php echo $alamat ?>" required />
                  </div>
                  <div class="col-md-12">
                    <label class="control-label">Asal Transaksi</label>
                    <select class="form-control" name="at" required>
                      <option value="">Pilih</option>
                      <?php
                      foreach ($asal_transaksi->result_array() as $i) :
                        $at_id = $i['at_id'];
                        $at_nama = $i['at_nama'];
                        $at_tanggal = $i['at_tanggal'];
                        if ($at_id1 == $at_id) {
                          echo "<option selected value='$at_id'>$at_nama</option>";
                        } else {
                          echo "<option value='$at_id'>$at_nama</option>";
                        }
                      endforeach;
                      ?>
  
                    </select>
                  </div>
                  <div class="col-md-12">
                    <label class="control-label">Kurir</label>
                    <select class="form-control" name="kurir" required>
                      <option selected value="">Pilih</option>
                      <?php
                      foreach ($kurir->result_array() as $i) :
                        $kurir_id = $i['kurir_id'];
                        $kurir_nama = $i['kurir_nama'];
                        $kurir_tanggal = $i['kurir_tanggal'];
                        if ($kurir_id1 == $kurir_id) {
                          echo "<option selected value='$kurir_id'>$kurir_nama</option>";
                          $kn = $kurir_id;
                        } else {
                          echo "<option value='$kurir_id'>$kurir_nama</option>";
                        }
                      endforeach;
                      ?>
                  </select>
                  </div>
  
                  <div class="col-md-12 resi<?=$pemesanan_id?>" id="c">
                              <br>
                              <label class="control-label">Nomor Resi</label>
                              <input value="<?php echo $resi ?>" class="form-control form-white" type="text" name="no_resi" />
                              <br>
                  </div>
                  
                  <div class="col-md-12">
                    <label class="control-label">Metode Pembayaran</label>
                    <select class="form-control" name="mp" required>
                      <option selected value="">Pilih</option>
                      <?php
                      foreach ($metode_pembayaran->result_array() as $i) :
                        $mp_id = $i['mp_id'];
                        $mp_nama = $i['mp_nama'];
                        $mp_tanggal = $i['mp_tanggal'];
                        if ($mp_id1 == $mp_id) {
                          echo "<option selected value='$mp_id'>$mp_nama</option>";
                        } else {
                          echo "<option value='$mp_id'>$mp_nama</option>";
                        }
                      endforeach;
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success ripple save-category" id="simpan">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  
    <?php
    $no = 0;
    foreach ($datapesanan->result_array() as $i) :
      $no++;
      $pemesanan_id = $i['pemesanan_id'];
    ?>
  
      <div class="modal" tabindex="-1" role="dialog" id="hapusdata<?php echo $pemesanan_id ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Hapus Pesanan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body p-20">
            <?php if($bulan==0) { ?>
                    <?php if($stsp==0) { ?>
                      <form action="<?php echo base_url() ?>Admin/Pemesanan/hapus_pesanan" method="post" id="hapusd<?php echo $pemesanan_id ?>" >
                      <?php }elseif($stsp==1) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananCustomer/hapus_pesanan" method="post" id="hapusd<?php echo $pemesanan_id ?>" >
                        <?php }elseif($stsp==2) { ?>
                          <form action="<?php echo base_url() ?>Admin/PemesananReseller/hapus_pesanan" method="post" id="hapusd<?php echo $pemesanan_id ?>" >
                          <?php }elseif($stsp==3) { ?>
                            <form action="<?php echo base_url() ?>Admin/PemesananProduksi/hapus_pesanan" method="post" id="hapusd<?php echo $pemesanan_id ?>" >
                            <?php }} else { ?>
                      <?php if($stsp==0) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananAllByBulan/hapus_pesanan?bulan=<?=$bulan?>" method="post" id="hapusd<?php echo $pemesanan_id ?>" >
                        <?php } elseif($stsp==1) { ?>
                          <form action="<?php echo base_url() ?>Admin/PemesananCustomerByBulan/hapus_pesanan?bulan=<?=$bulan?>" method="post" id="hapusd<?php echo $pemesanan_id ?>" >
                          <?php } elseif($stsp==2) { ?>
                            <form action="<?php echo base_url() ?>Admin/PemesananResellerByBulan/hapus_pesanan?bulan=<?=$bulan?>" method="post" id="hapusd<?php echo $pemesanan_id ?>" >
                            <?php } elseif($stsp==3) { ?>
                              <form action="<?php echo base_url() ?>Admin/PemesananProduksiByBulan/hapus_pesanan?bulan=<?=$bulan?>" method="post" id="hapusd<?php echo $pemesanan_id ?>" >
                              <?php }} ?>
                <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" name="pemesanan_id" value="<?php echo $pemesanan_id ?>" />
                    <p>Apakah kamu yakin ingin menghapus data ini?</i></b></p>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Tidak</button>
              <button type="submit" onclick="form_submit(<?php echo $pemesanan_id ?>)" class="btn btn-success ripple save-category">Ya</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  
  
  
  <!-- Modal Status -->
  <?php
  $no = 0;
  foreach ($datapesanan->result_array() as $i) :
    $no++;
    $pemesanan_id = $i['pemesanan_id'];
    $status_pemesanan = $i['status_pemesanan'];
  ?>
  
    <div class="modal" tabindex="-1" role="dialog" id="bayar<?= $pemesanan_id ?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ganti Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body p-20">
          <?php if($bulan==0) { ?>
                    <?php if($stsp==0) { ?>
                      <form action="<?php echo base_url() ?>Admin/Pemesanan/status" id="bayarr<?= $pemesanan_id ?>" method="POST">
                      <?php }elseif($stsp==1) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananCustomer/status" id="bayarr<?= $pemesanan_id ?>" method="POST">
                        <?php }elseif($stsp==2) { ?>
                          <form action="<?php echo base_url() ?>Admin/PemesananReseller/status" id="bayarr<?= $pemesanan_id ?>" method="POST">
                        <?php }elseif($stsp==3) { ?>
                          <form action="<?php echo base_url() ?>Admin/PemesananProduksi/status" id="bayarr<?= $pemesanan_id ?>" method="POST">
                        <?php }} else { ?>
                      <?php if($stsp==0) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananAllByBulan/status?bulan=<?=$bulan?>" id="bayarr<?= $pemesanan_id ?>" method="POST">
                        <?php } elseif($stsp==1) { ?>
                          <form action="<?php echo base_url() ?>Admin/PemesananCustomerByBulan/status?bulan=<?=$bulan?>" id="bayarr<?= $pemesanan_id ?>" method="POST">
                        <?php } elseif($stsp==2) { ?>
                          <form action="<?php echo base_url() ?>Admin/PemesananResellerByBulan/status?bulan=<?=$bulan?>" id="bayarr<?= $pemesanan_id ?>" method="POST">
                        <?php } elseif($stsp==3) { ?>
                          <form action="<?php echo base_url() ?>Admin/PemesananProduksiByBulan/status?bulan=<?=$bulan?>" id="bayarr<?= $pemesanan_id ?>" method="POST">
                        <?php }} ?>
             <div class="row">
                <div class="col-md-12">
                  <input type="hidden" name="pemesanan_id" value="<?php echo $pemesanan_id ?>" />
                  <input type="hidden" name="status_pemesanan" value="<?php echo $status_pemesanan ?>" />
                  <p>Apakah kamu yakin ingin mengganti status data ini?</i></b></p>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Tidak</button>
            <button type="submit" onclick="form_submit_bayar(<?php echo $pemesanan_id ?>)" value="submit" class="btn btn-success ripple save-category">Ya</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  
  
  <div class="modal" tabindex="-1" role="dialog" id="selesai<?= $pemesanan_id ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ganti Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body p-20">
      <?php if($bulan==0) { ?>
                    <?php if($stsp==0) { ?>
                      <form action="<?php echo base_url() ?>Admin/Pemesanan/status" id="selesaii<?= $pemesanan_id ?>" method="POST">
                      <?php }elseif($stsp==1) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananCustomer/status" id="selesaii<?= $pemesanan_id ?>" method="POST">
                      <?php }elseif($stsp==2) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananReseller/status" id="selesaii<?= $pemesanan_id ?>" method="POST">
                      <?php }elseif($stsp==3) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananProduksi/status" id="selesaii<?= $pemesanan_id ?>" method="POST">
                      <?php }} else { ?>
                      <?php if($stsp==0) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananAllByBulan/status?bulan=<?=$bulan?>" id="selesaii<?= $pemesanan_id ?>" method="POST">
                      <?php } elseif($stsp==1) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananCustomerByBulan/status?bulan=<?=$bulan?>" id="selesaii<?= $pemesanan_id ?>" method="POST">
                      <?php } elseif($stsp==2) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananResellerByBulan/status?bulan=<?=$bulan?>" id="selesaii<?= $pemesanan_id ?>" method="POST">
                      <?php } elseif($stsp==3) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananProduksiByBulan/status?bulan=<?=$bulan?>" id="selesaii<?= $pemesanan_id ?>" method="POST">
                      <?php }} ?>
          <div class="row">
            <div class="col-md-12">
              <input type="hidden" name="pemesanan_id" value="<?php echo $pemesanan_id ?>" />
              <input type="hidden" name="jumlah" value="<?php echo $jumlah ?>" />
              <input type="hidden" name="status_pemesanan" value="2" />
              <p>Apakah kamu yakin ingin mengganti status data ini?</i></b></p>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Tidak</button>
        <button type="submit" onclick="form_submit_selesai(<?php echo $pemesanan_id ?>)" value="submit" class="btn btn-success ripple save-category">Ya</button>
      </div>
      </form>
    </div>
  </div>
  </div>
  <div class="modal" tabindex="-1" role="dialog" id="kirim<?= $pemesanan_id ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ganti Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body p-20">
      <?php if($bulan==0) { ?>
                    <?php if($stsp==0) { ?>
                      <form action="<?php echo base_url() ?>Admin/Pemesanan/status" id="kirimm<?= $pemesanan_id ?>" method="POST">
                      <?php }elseif($stsp==1) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananCustomer/status" id="kirimm<?= $pemesanan_id ?>" method="POST">
                      <?php }elseif($stsp==2) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananReseller/status" id="kirimm<?= $pemesanan_id ?>" method="POST">
                      <?php }elseif($stsp==3) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananProduksi/status" id="kirimm<?= $pemesanan_id ?>" method="POST">
                      <?php }} else { ?>
                      <?php if($stsp==0) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananAllByBulan/status?bulan=<?=$bulan?>" id="kirimm<?= $pemesanan_id ?>" method="POST">
                      <?php } elseif($stsp==1) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananCustomerByBulan/status?bulan=<?=$bulan?>" id="kirimm<?= $pemesanan_id ?>" method="POST">
                      <?php } elseif($stsp==2) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananResellerByBulan/status?bulan=<?=$bulan?>" id="kirimm<?= $pemesanan_id ?>" method="POST">
                      <?php } elseif($stsp==3) { ?>
                        <form action="<?php echo base_url() ?>Admin/PemesananProduksiByBulan/status?bulan=<?=$bulan?>" id="kirimm<?= $pemesanan_id ?>" method="POST">
                      <?php }} ?>
          <div class="row">
            <div class="col-md-12">
              <input type="hidden" name="pemesanan_id" value="<?php echo $pemesanan_id ?>" />
              <input type="hidden" name="jumlah" value="<?php echo $jumlah ?>" />
              <input type="hidden" name="status_pemesanan" value="1" />
              <p>Apakah kamu yakin ingin mengganti status data ini?</i></b></p>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Tidak</button>
        <button type="submit" onclick="form_submit_kirim(<?php echo $pemesanan_id ?>)" value="submit" class="btn btn-success ripple save-category">Ya</button>
      </div>
      </form>
    </div>
  </div>
  </div>
  
  <?php endforeach; ?>

  <script type="text/javascript">
    function form_submit(num) {
      $("#hapusd"+num).submit();
    }    
  </script>
<script type="text/javascript">
    function form_submit_bayar(num) {
      $("#bayarr"+num).submit();
    }    
  </script>


<script type="text/javascript">
    function form_submit_selesai(num) {
      $("#selesaii"+num).submit();
    }    
  </script>


<script type="text/javascript">
    function form_submit_kirim(num) {
      $("#kirimm"+num).submit();
    }    
  </script>

