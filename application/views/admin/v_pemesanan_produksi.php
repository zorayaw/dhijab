<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

<div class="content-wrapper">
  <div class="page-title">
    <div class="row">
      <div class="col-sm-6">
        <h4 class="mb-0">Data Pemesanan Produksi</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
          <li class="breadcrumb-item"><a href="<?php echo base_url() ?>Admin/PemesananProduksi" class="default-color">Home</a></li>
          <li class="breadcrumb-item active">Daftar Barang</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- main body -->
  <div class="row">
    <div class="col-xl-12 mb-30">
      <div class="card card-statistics h-100">
        <div class="card-body">
        <div class="col-xl-12 mb-10">
        <h6 class="mb-0">Tambah Pemesanan: </h6>
      </div>
          <div class="col-xl-12 mb-10" style="display: flex">
            <!-- <div class="col-md-6">
              <a href="" data-toggle="modal" data-target="#tambah-pesanan-non-reseller" class="btn btn-primary btn-block ripple m-t-10">
                <i class="fa fa-plus pr-2"></i>Pemesanan Customer
              </a>
            </div> -->
            <!-- <div class="col-md-6">
              <a href="" data-toggle="modal" data-target="#reseller" class="btn btn-primary btn-block ripple m-t-10">
                <i class="fa fa-plus pr-2"></i>Pemesanan Reseller
              </a>
            </div> -->

            <div class="col-md-4">
              <a href="" data-toggle="modal" data-target="#produksi" class="btn btn-primary btn-block ripple m-t-20">
                <i class="fa fa-plus pr-2"></i>Pemesanan Produksi
              </a>
            </div>
            <div class="col-md-4">
              <a href="" data-toggle="modal" data-target="#Cetak-Pesanan" class="btn btn-success btn-block ripple m-t-20">
                <i class="fa fa-print pr-2"></i> Cetak
              </a>
            </div>  

<!-- convert -->

            <div class="col-md-4">
              <a href="<?= base_url() ?>admin/Pemesanan/convertExcel" data-toggle="modal" data-target="#pilihan"  class="btn btn-dark btn-block ripple m-t-20">
                <i class="fa fa-print pr-2"></i> Convert
              </a>
            </div>
          </div>
          
          <!-- Modal -->
          <div class="modal fade" id="pilihan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Pilihan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <div class="col-md-12 mt-4">
                        <a href="" target="_blank" class="btn btn-warning btn-block ripple m-t-10" id="excel" data-toggle="modal" data-target="#export" >
                          <i class="fa fa-file-excel-o pr-2"></i>Convert Excel
                        </a>
                </div>
                <div class="col-md-12 mt-4">
                        <a href="" target="_blank" class="btn btn-warning btn-block ripple m-t-10" id="pdf" data-toggle="modal" data-target="#exportpdf">
                          <i class="fa fa-file-pdf-o pr-2"></i>Convert PDF
                        </a>
                </div>
                <div class="col-md-12 mt-4 mb-4">
                        <a href="" target="_blank" class="btn btn-warning btn-block ripple m-t-10" id="words" data-toggle="modal" data-target="#word" >
                          <i class="fa fa-file-word-o pr-2"></i>Convert Word
                        </a>
                </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

        <!-- Modal Excel -->
              <div class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Convert Data Pemesanan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <div class="row">

                    <div class="col-md-12">
                        <a href="<?= base_url() ?>admin/Pemesanan/convertExcel" target="_blank" class="btn btn-success btn-block ripple m-t-10">
                          <i class="fa fa-print pr-2"></i>Convert Seluruh Pemesanan</a>
                        </a>
                      </div>

                      <div class="col-md-12 mt-4">
                        <a href="<?= base_url() ?>admin/Pemesanan/convertExcelPerhari" target="_blank" class="btn btn-success btn-block ripple m-t-10">
                          <i class="fa fa-print pr-2"></i>Convert Pemesanan Hari Ini (<?= date('d')?> <?php 
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
                            ?>
                            <?= date('Y')?>)
                          </a>
                        </a>
                      </div>

                      <div class="col-md-12 mt-4">
                        <a href="<?= base_url() ?>admin/Pemesanan/convertExcelPerbulan" target="_blank" class="btn btn-success btn-block ripple m-t-10">
                          <i class="fa fa-print pr-2"></i>Convert Pemesanan Bulan Ini (<?php 
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
                            ?>
                            <?= date('Y')?>)
                          </a>
                        </a>
                      </div>
                      <div class="col-md-12 mt-4"><h6>Convert Berdasarkan Tanggal:</h6></div>
                        <form action="<?php echo base_url() ?>admin/Pemesanan/convertExcelBytanggal" target="_blank" method="post" enctype="multipart/form-data">
                      <div class="modal-body p-20">
                        <div class="row">
                        <div class="col-md-4">
                          <label class="control-label">Start date:</label>
                          <input class="form-control form-white" type="date" name="start_date" required/>
                        </div>
                        <div class="col-md-4">
                          <label class="control-label">End date:</label>
                          <input class="form-control form-white" type="date" name="end_date" required/>
                        </div>
                        <div class="col-md-4">
                        <button type="submit" class="btn btn-info btn-block ripple m-t-10">
                            <i class="fa fa-print pr-2"></i>Convert<br>Pemesanan</a>
                      </div>
                        </div>
                      </div>
                        </form>
                    </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
         <!-- end modal excel -->

         <!-- modal word -->
            <div class="modal fade" id="word" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Convert Data Pemesanan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <div class="row">

                    <div class="col-md-12">
                        <a href="<?= base_url() ?>admin/Pemesanan/convertWord" target="_blank" class="btn btn-success btn-block ripple m-t-10">
                          <i class="fa fa-print pr-2"></i>Convert Seluruh Pemesanan</a>
                        </a>
                      </div>

                      <div class="col-md-12 mt-4">
                        <a href="<?= base_url() ?>admin/Pemesanan/convertWordPerhari" target="_blank" class="btn btn-success btn-block ripple m-t-10">
                          <i class="fa fa-print pr-2"></i>Convert Pemesanan Hari Ini (<?= date('d')?> <?php 
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
                            ?>
                            <?= date('Y')?>)
                          </a>
                        </a>
                      </div>

                      <div class="col-md-12 mt-4">
                        <a href="<?= base_url() ?>admin/Pemesanan/convertWordPerbulan" target="_blank" class="btn btn-success btn-block ripple m-t-10">
                          <i class="fa fa-print pr-2"></i>Convert Pemesanan Bulan Ini (<?php 
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
                            ?>
                            <?= date('Y')?>)
                          </a>
                        </a>
                      </div>
                      <div class="col-md-12 mt-4"><h6>Convert Berdasarkan Tanggal:</h6></div>
                        <form action="<?php echo base_url() ?>admin/Pemesanan/convertWordPertanggal" target="_blank" method="post" enctype="multipart/form-data">
                      <div class="modal-body p-20">
                        <div class="row">
                        <div class="col-md-4">
                          <label class="control-label">Start date:</label>
                          <input class="form-control form-white" type="date" name="start_date" required/>
                        </div>
                        <div class="col-md-4">
                          <label class="control-label">End date:</label>
                          <input class="form-control form-white" type="date" name="end_date" required/>
                        </div>
                        <div class="col-md-4">
                        <button type="submit" class="btn btn-info btn-block ripple m-t-10">
                            <i class="fa fa-print pr-2"></i>Convert<br>Pemesanan</a>
                      </div>
                        </div>
                      </div>
                        </form>
                    </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
                            
         <!-- end modal word -->

        <!-- modal pdf -->
				<div class="modal fade" id="exportpdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
					aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Convert Data Pemesanan</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="row">

									<div class="col-md-12">
										<a href="<?= base_url() ?>admin/Pemesanan/convertPDF?status=3" target="_blank"
											class="btn btn-success btn-block ripple m-t-10">
											<i class="fa fa-print pr-2"></i>Convert Seluruh Pemesanan</a>
										</a>
									</div>

									<div class="col-md-12 mt-4">
										<a href="<?= base_url() ?>admin/Pemesanan/convertPDFPerhari?status=3" target="_blank"
											class="btn btn-success btn-block ripple m-t-10">
											<i class="fa fa-print pr-2"></i>Convert Pemesanan Hari Ini (<?= date('d')?> <?php 
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
                            ?>
											<?= date('Y')?>)
										</a>
										</a>
									</div>

									<div class="col-md-12 mt-4">
										<a href="<?= base_url() ?>admin/Pemesanan/convertPDFPerbulan?status=3&bulan=<?= date('m')?>&tahun=<?= date("Y")?>" target="_blank"
											class="btn btn-success btn-block ripple m-t-10">
											<i class="fa fa-print pr-2"></i>Convert Pemesanan Bulan Ini (<?php 
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
                            ?>
											<?= date('Y')?>)
										</a>
										</a>
									</div>
									<div class="col-md-12 mt-4">
										<h6>Convert Berdasarkan Tanggal:</h6>
									</div>
									<form action="<?php echo base_url() ?>admin/Pemesanan/convertPDFPertanggal?status=3" target="_blank"
										method="post" enctype="multipart/form-data">
										<div class="modal-body p-20">
											<div class="row">
												<div class="col-md-4">
													<label class="control-label">Start date:</label>
													<input class="form-control form-white" type="date" name="start_date" required />
												</div>
												<div class="col-md-4">
													<label class="control-label">End date:</label>
													<input class="form-control form-white" type="date" name="end_date" required />
												</div>
												<div class="col-md-4">
													<button type="submit" class="btn btn-info btn-block ripple m-t-10">
														<i class="fa fa-print pr-2"></i>Convert<br>Pemesanan</a>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
				<!-- end modal pdf -->

<!-- end convert -->



          <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered p-0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nomor Order</th>
                  <th>Nama Pemesan</th>
                  <th>Nama Akun</th>
                  <th>Tanggal Pemesanan</th>
                  <th>No HP</th>
                  <th>Alamat</th>
                  <th>Email </th>
                  <th>Ekspedisi</th>
                  <th>Nomor Resi</th>
                  <th>Biaya Ongkir</th>
                  <th>Asal Transaksi</th>
                  <th>Metode Pembayaran</th>
                  <th>List Barang</th>
                  <th>Status</th>
                  <th>Note</th>
                  <th>Biaya Admin</th>
                  <th>Diskon</th>
                  <th>Uang Kembalian</th>
                  <th>Total Harga</th>

                  <th>
                    <center>Aksi</center>
                  </th>
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
                  $resi = $i['no_resi'];
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

                  $q = $this->db->query("SELECT SUM(lb_qty * harga)AS total_keseluruhan from list_barang where pemesanan_id=' $pemesanan_id'");
                  $c = $q->row_array();
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
                    <td><?php echo $hp ?></td>
                    <td><?php echo $alamat ?></td>
                    <td><?php echo $email ?></td>
                    <td><?php echo $kurir_nama ?></td>
                    <td><?php echo $resi ?></td>
                    <td><?php echo $ongkir ?></td>
                    <td><?php echo $at_nama ?></td>
                    <td><?php echo $mp_nama ?></td>

                    <td><a href="<?php echo base_url() ?>Admin/PemesananProduksi/list_barang/<?php echo $pemesanan_id ?>/<?php echo $level ?>" target="_blank" class="btn btn-primary">List Barang</a></td>
                    <td>

                      <?php
                      if ($status == 0) { ?>
                        <button type="submit" class="btn btn-warning" data-toggle="modal" data-target="#bayar<?= $pemesanan_id ?>" style="margin-right: 20px">Belum Bayar</button>
                      <?php } elseif ($status == 1) {
                      ?>
                        <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#kirim<?= $pemesanan_id ?>" style="margin-right: 20px">Dibayar </button>
                      <?php } elseif ($status == 2) {
                      ?>
                        <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#selesai<?= $pemesanan_id ?>" style="margin-right: 20px">Dikirim </button>
                      <?php } else {
                      ?>
                        <button class="btn btn-success" style="margin-right: 20px">Selesai</button>
                      <?php
                      }
                      ?>
                    </td>
                    <td><?php echo $note ?></td>
                    <td><?php echo rupiah($biaya_admin) ?></td>
                    <td><?php echo rupiah($diskon) ?></td>
                    <td><?php echo rupiah($uang) ?></td>
                    <td><?php echo rupiah($jumlah) ?></td>

                    <?php
                    $total = $total + $jumlah;
                    ?>
                    <td>
                      <a href="#" style="margin-right: 10px; margin-left: 10px;" data-toggle="modal" data-target="#editdata<?php echo $pemesanan_id ?>"><span class="ti-pencil"></span></a>
                      <a href="#" style="margin-right: 10px" data-toggle="modal" data-target="#hapusdata<?php echo $pemesanan_id ?>"><span class="ti-trash"></span></a>
                    </td>
                  </tr>
                <?php endforeach; ?>

              </tbody>
              <tr>
                <th colspan="18">
                  <center>Jumlah</center>
                </th>
                <th colspan="2"><?php echo rupiah($total) ?></th>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>

 <!-- Modal Cetak-->
 <?php date_default_timezone_set("Asia/Jakarta");
    ?>

    <div class="modal" tabindex="-1" role="dialog" id="Cetak-Pesanan">
      <div class="modal-dialog modal-lg-10">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Cetak Pemesanan Produksi</h5>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <a href="<?= base_url() ?>Owner/Transaksi/cetak_transaksi?status=3" target="_blank" class="btn btn-success btn-block ripple m-t-10">
                  <i class="fa fa-print pr-2"></i>Cetak Pemesanan Hari Ini (<?= date('d')?> <?php 
                  switch (date('m')){
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
                  ?>
                  <?= date('Y')?>)
                </a>
                <br>
              </div>

              <div class="col-md-12">
                <a href="<?= base_url() ?>Owner/Transaksi/cetakTransaksiByBulan?status=3&bulan=<?= date('m')?>&tahun=<?= date("Y")?>" target="_blank" class="btn btn-success btn-block ripple m-t-10">
                  <i class="fa fa-print pr-2"></i>Cetak Pemesanan Bulan Ini (<?php 
                  switch (date('m')){
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
                  ?> <?= date('Y')?>) 
                </a>
                <br>
              </div>

              <form action="<?php echo base_url() ?>Owner/Transaksi/cetakTransaksiByTahun?status=3" target="_blank" method="post" enctype="multipart/form-data">
              <div class="col-md-12"><h6>Cetak Pemesanan Berdasarkan Tahun: </h6></div>
               
            <div class="modal-body p-20">
              <div class="row">
              <div class="col-lg-6">
              <label class="control-label">Dari tahun:</label>
              <select class="form-control" name="start_year" required>
                    <option selected value="">Pilih</option>
                    <?php
                for ($x = 2017; $x <= date('Y'); $x++) :
                ?>
                    <option value="<?php echo $x ?>"><?php echo $x ?></option>
                <?php endfor ?>
              </select>
              </div>
              
              <div class="col-lg-6">
              <label class="control-label">Sampai tahun:</label>
              <select class="form-control" name="end_year" required>
                    <option selected value="">Pilih</option>
                    <?php
                for ($x = 2017; $x <= date('Y'); $x++) :
                ?>
                    <option value="<?php echo $x ?>"><?php echo $x ?></option>
                <?php endfor ?>
              </select>
               </div> 
              </div>
            </div>
              </div>
               
               <div class="col-md-12">
               <button type="submit" class="btn btn-success btn-block ripple m-t-10">
                  <i class="fa fa-print pr-2"></i>Cetak Pemesanan</button>
                  <br>
                   </div>
                  </form>

              <div class="col-md-12"><h6>Cetak Berdasarkan Tanggal:</h6></div>
               <form action="<?php echo base_url() ?>Owner/Transaksi/cetakTransaksiBytanggal?status=3" target="_blank" method="post" enctype="multipart/form-data">
            <div class="modal-body p-20">
              <div class="row">
              <div class="col-md-4">
                <label class="control-label">Dari tanggal:</label>
                <input class="form-control form-white" type="date" name="start_date" required/>
              </div>
              <div class="col-md-4">
                <label class="control-label">Sampai tanggal:</label>
                <input class="form-control form-white" type="date" name="end_date" required/>
              </div>
              <div class="col-md-4">
               <button type="submit" class="btn btn-success btn-block ripple m-t-10">
                  <i class="fa fa-print pr-2"></i>Cetak<br>pemesanan</a>
            </div>
              </div>
            </div>
               </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
</div>
  </div>
</div>
    <!-- Modal Pesanan NonReseller-->
    <!-- <div class="modal" tabindex="-1" role="dialog" id="tambah-pesanan-non-reseller">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Pesanan Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <form action="<?php echo base_url() ?>Admin/PemesananProduksi/savepemesananNR" method="post" enctype="multipart/form-data">
            <div class="modal-body p-20">
              <div class="row">
                <div class="col-md-12">
                  <label class="control-label">Nama Pemesan</label>
                  <input class="form-control form-white" type="text" name="nama_pemesan" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">Email Pemesan</label>
                  <input class="form-control form-white" type="text" name="email_pemesanan" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">No HP</label>
                  <input class="form-control form-white" type="number" name="hp" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">Tanggal</label>
                  <input class="form-control form-white" type="date" name="tanggal" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">Alamat</label>
                  <input class="form-control form-white" type="text" name="alamat" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">Biaya Admin</label>
                  <input class="form-control form-white" type="text" name="biaya_admin" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">Diskon</label>
                  <input class="form-control form-white" type="text" name="diskon" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">Uang Kembalian</label>
                  <input class="form-control form-white" type="text" name="uang" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">Asal Transaksi</label>
                  <select class="form-control" name="at" required>
                    <option selected value="">Pilih</option>
                    <?php
                    foreach ($asal_transaksi->result_array() as $i) :
                      $at_id = $i['at_id'];
                      $at_nama = $i['at_nama'];
                      $at_tanggal = $i['at_tanggal'];
                    ?>
                      <option value="<?php echo $at_id ?>"><?php echo $at_nama ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-12">
                  <label class="control-label">Jenis Ekspedisi</label>
                  <select class="form-control" name="kurir" required>
                    <option selected value="">Pilih</option>
                    <?php
                    foreach ($kurir->result_array() as $i) :
                      $kurir_id = $i['kurir_id'];
                      $kurir_nama = $i['kurir_nama'];
                      $kurir_tanggal = $i['kurir_tanggal'];
                    ?>
                      <option value="<?php echo $kurir_id ?>"><?php echo $kurir_nama ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-md-12">
                  <label class="control-label">Biaya Ongkir</label>
                  <input class="form-control form-white" type="text" name="biaya_ongkir" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">Jenis Pembayaran</label>
                  <select class="form-control" name="metpem" required>
                    <option selected value="">Pilih</option>
                    <?php
                    foreach ($metode_pembayaran->result_array() as $i) :
                      $mp_id = $i['mp_id'];
                      $mp_nama = $i['mp_nama'];
                      $mp_tanggal = $i['mp_tanggal'];
                    ?>
                      <option value="<?php echo $mp_id ?>"><?php echo $mp_nama ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-12">
                  <label class="control-label">Note</label>
                  <input class="form-control form-white" type="text" name="note" required />
                </div>


                <div class="form-group col-md-12 mt-10" id="dynamic_field">
                  <div class="row">
                    <div class="col-md-8">
                      <label class="control-label">Barang</label>
                      <select class="form-control" name="barang[]" required>
                        <option selected value="">Pilih</option>
                        <?php
                        foreach ($nonreseller->result_array() as $i) :
                          $barang_id = $i['barang_id'];
                          $barang_nama = $i['barang_nama'];
                        ?>
                          <option value="<?php echo $barang_id ?>"><?php echo $barang_nama ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <label class="control-label" for="harga">Kuantitas</label>
                      <input class="form-control" type="number" name="qty[]" min = 1 required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 mt-30">
                  <input class="button" value="Add new" id="add" />
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
    </div> -->

    <!-- Modal Pesanan Reseller-->
    <!-- <div class="modal" tabindex="-1" role="dialog" id="reseller">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Pesanan Reseller</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <form action="<?php echo base_url() ?>Admin/PemesananProduksi/savepemesananR" method="post" enctype="multipart/form-data">
            <div class="modal-body p-20">
              <div class="row">
                <div class="col-md-12">
                  <label class="control-label">Nama Pemesan</label>
                  <input class="form-control form-white" type="text" name="nama_pemesan" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">Nama Akun Pemesan</label>
                  <input class="form-control form-white" type="text" name="nama_akun_pemesan" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">Email Pemesan</label>
                  <input class="form-control form-white" type="text" name="email_pemesanan" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">No HP</label>
                  <input class="form-control form-white" type="number" name="hp" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">Tanggal</label>
                  <input class="form-control form-white" type="date" name="tanggal" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">Alamat</label>
                  <input class="form-control form-white" type="text" name="alamat" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">Biaya Admin</label>
                  <input class="form-control form-white" type="text" name="biaya_admin" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">Diskon</label>
                  <input class="form-control form-white" type="text" name="diskon" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">Uang Kembalian</label>
                  <input class="form-control form-white" type="text" name="uang" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">Asal Transaksi</label>
                  <select class="form-control" name="at" required>
                    <option selected value="">Pilih</option>
                    <?php
                    foreach ($asal_transaksi->result_array() as $i) :
                      $at_id = $i['at_id'];
                      $at_nama = $i['at_nama'];
                      $at_tanggal = $i['at_tanggal'];
                    ?>
                      <option value="<?php echo $at_id ?>"><?php echo $at_nama ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-12">
                  <label class="control-label">Jenis Ekspedisi</label>
                  <select class="form-control" name="kurir" required>
                    <option selected value="">Pilih</option>
                    <?php
                    foreach ($kurir->result_array() as $i) :
                      $kurir_id = $i['kurir_id'];
                      $kurir_nama = $i['kurir_nama'];
                      $kurir_tanggal = $i['kurir_tanggal'];
                    ?>
                      <option value="<?php echo $kurir_id ?>"><?php echo $kurir_nama ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-12">
                  <label class="control-label">Biaya Ongkir</label>
                  <input class="form-control form-white" type="text" name="biaya_ongkir" required />
                </div>
                <div class="col-md-12">
                  <label class="control-label">Jenis Pembayaran</label>
                  <select class="form-control" name="metpem" required>
                    <option selected value="">Pilih</option>
                    <?php
                    foreach ($metode_pembayaran->result_array() as $i) :
                      $mp_id = $i['mp_id'];
                      $mp_nama = $i['mp_nama'];
                      $mp_tanggal = $i['mp_tanggal'];
                    ?>
                      <option value="<?php echo $mp_id ?>"><?php echo $mp_nama ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-12">
                  <label class="control-label">Note</label>
                  <input class="form-control form-white" type="text" name="note" required />
                </div>


                <div class="form-group col-md-12 mt-10" id="dynamic_field1">
                  <div class="row">
                    <div class="col-md-8">
                      <label class="control-label">Barang</label>
                      <select class="form-control" name="barang[]" required>
                        <option selected value="">Pilih</option>
                        <?php
                        foreach ($nonreseller->result_array() as $i) :
                          $barang_id = $i['barang_id'];
                          $barang_nama = $i['barang_nama'];
                        ?>
                          <option value="<?php echo $barang_id ?>"><?php echo $barang_nama ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <label class="control-label" for="harga">Kuantitas</label>
                      <input class="form-control" type="number" name="qty[]" min = 1 required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 mt-30">
                  <input class="button" value="Add new" id="add1" />
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
    </div> -->


    <!-- Modal Pesanan Produksi-->
    <div class="modal" tabindex="-1" role="dialog" id="produksi">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Pesanan Produksi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <form action="<?php echo base_url() ?>Admin/PemesananProduksi/savepemesananP" method="post" enctype="multipart/form-data">
            <div class="modal-body p-20">
              <div class="row">


                <div class="col-md-12">
                  <label class="control-label">Tanggal</label>
                  <input class="form-control form-white" type="date" name="tanggal" required />
                </div>


                <div class="col-md-12">
                  <label class="control-label">Note</label>
                  <input class="form-control form-white" type="text" name="note" required />
                </div>


                <div class="form-group col-md-12 mt-10" id="dynamic_field2">
                  <div class="row">
                    <div class="col-md-8">
                      <label class="control-label">Barang</label>
                      <select class="form-control" name="barang[]" required id="select-state" placeholder="Pick a state...">
                        <option selected value="">Pilih</option>
                        <?php
                        foreach ($produksi->result_array() as $i) :
                          $barang_id = $i['barang_id'];
                          $barang_nama = $i['barang_nama'];
                        ?>
                          <option value="<?php echo $barang_id ?>"><?php echo $barang_nama ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <label class="control-label" for="harga">Kuantitas</label>
                      <input class="form-control" type="number" name="qty[]" min = 1 required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 mt-30">
                  <input class="button" value="Add new" id="add3" />
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
      $resi = $i['no_resi'];
      $level = $i['status_customer'];
      $kurir_nama = $i['kurir_nama'];
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
            <form action="<?php echo base_url() ?>Admin/PemesananProduksi/edit_pesanan" method="post" enctype="multipart/form-data">
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
                        } else {
                          echo "<option value='$kurir_id'>$kurir_nama</option>";
                        }
                      endforeach;
                      ?>
                    </select>
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
              <form action="<?php echo base_url() ?>Admin/PemesananProduksi/hapus_pesanan" method="post">
                <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" name="pemesanan_id" value="<?php echo $pemesanan_id ?>" />
                    <p>Apakah kamu yakin ingin menghapus data ini?</i></b></p>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger ripple" data-dismiss="modal">Tidak</button>
              <button type="submit" class="btn btn-success ripple save-category">Ya</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>

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
            <form action="<?php echo base_url() ?>Admin/PemesananProduksi/status" method="POST">
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
            <button type="submit" class="btn btn-success ripple save-category">Ya</button>
          </div>
          </form>
        </div>
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
        <form action="<?php echo base_url() ?>Admin/PemesananProduksi/status" method="POST">
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
        <button type="submit" class="btn btn-success ripple save-category">Ya</button>
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
        <form action="<?php echo base_url() ?>Admin/PemesananProduksi/status" method="POST">
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
        <button type="submit" class="btn btn-success ripple save-category">Ya</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php endforeach; ?>






<!--=================================
 footer -->

<footer class="bg-white p-4">
  <div class="row">
    <div class="col-md-6">
      <div class="text-center text-md-left">
        <p class="mb-0"> &copy; Copyright <span id="copyright">
            <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>
          </span>. <a href="#"> Webmin </a> All Rights Reserved. </p>
      </div>
    </div>
    <div class="col-md-6">
      <ul class="text-center text-md-right">
        <li class="list-inline-item"><a href="#">Terms & Conditions </a> </li>
        <li class="list-inline-item"><a href="#">API Use Policy </a> </li>
        <li class="list-inline-item"><a href="#">Privacy Policy </a> </li>
      </ul>
    </div>
  </div>
</footer>
</div>
</div>
</div>
</div>


<!--=================================
 footer -->



<!--=================================
 jquery -->

<!-- plugins-jquery -->
<script src="<?php echo base_url() ?>assets/admin/js/plugins-jquery.js"></script>

<!-- plugin_path -->
<script>
  var plugin_path = '<?php echo base_url() ?>assets/admin/js/';
</script>

<!-- chart -->
<script src="<?php echo base_url() ?>assets/admin/js/chart-init.js"></script>

<!-- calendar -->
<script src="<?php echo base_url() ?>assets/admin/js/calendar.init.js"></script>

<!-- charts sparkline -->
<script src="<?php echo base_url() ?>assets/admin/js/sparkline.init.js"></script>

<!-- charts morris -->
<script src="<?php echo base_url() ?>assets/admin/js/morris.init.js"></script>

<!-- datepicker -->
<script src="<?php echo base_url() ?>assets/admin/js/datepicker.js"></script>

<!-- sweetalert2 -->
<script src="<?php echo base_url() ?>assets/admin/js/sweetalert2.js"></script>

<!-- toastr -->
<script src="<?php echo base_url() . 'assets/admin/js/jquery.toast.min.js' ?>"></script>

<!-- validation -->
<script src="<?php echo base_url() ?>assets/admin/js/validation.js"></script>

<!-- lobilist -->
<script src="<?php echo base_url() ?>assets/admin/js/lobilist.js"></script>

<!-- custom -->
<script src="<?php echo base_url() ?>assets/admin/js/custom.js"></script>

<!-- mask -->
<script src="<?php echo base_url() ?>assets/admin/js/jquery.mask.min.js"></script>

</body>

</html>

<script type="text/javascript">
  $("#excel").click(function(){
    $("#pilihan").modal('hide');
  });
</script>

<script type="text/javascript">
  $("#words").click(function(){
    $("#pilihan").modal('hide');
  });
</script>

<script type="text/javascript">
  $("#pdf").click(function(){
    $("#pilihan").modal('hide');
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('select').selectize({
      sortField: 'text'
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    // Format mata uang.
    $('.money').mask('000.000.000.000.000', {
      reverse: true
    });

  })
</script>

<script type="text/javascript">
  $(document).ready(function() {
    var i = 1;
    $('#add').click(function() {
        i++;
        $('#dynamic_field').append('<div class="row" id="row' + i + '"><div class="col-md-8"><label class="control-label">Barang</label><select class="form-control" name="barang[]"><option selected value="">Pilih</option><?php foreach ($nonreseller->result_array() as $i) : $barang_id = $i['barang_id'];$barang_nama = $i['barang_nama']; ?> <option value="<?php echo $barang_id ?>"><?php echo $barang_nama ?></option><?php endforeach; ?> </select></div><div class="col-md-2"><label class="control-label" for="harga">Jumlah</label><input class="form-control" type="number" name="qty[]" ></div><div class="col-md-2 mt-30"><button type="button" id="' + i + '" class="btn btn-danger btn-block btn_remove">Delete</button></div></div>');
        $('select').selectize({
          sortField: 'text'
        });
      }


    );
    $('select').selectize({
      sortField: 'text'
    });

    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
      $('#row' + button_id + '').remove();
    });

  });
</script>

<script type="text/javascript">
  $(document).ready(function() {

    var i = 1;
    $('#add1').click(function() {
      i++;
      $('#dynamic_field1').append('<div class="row" id="roww' + i + '"><div class="col-md-8"><label class="control-label">Barang</label><select class="form-control" name="barang[]"><option selected value="">Pilih</option><?php foreach ($reseller->result_array() as $i) : $barang_id = $i['barang_id'];$barang_nama = $i['barang_nama']; ?><option value="<?php echo $barang_id ?>"><?php echo $barang_nama ?></option><?php endforeach; ?></select></div><div class="col-md-2"><label class="control-label" for="harga">Jumlah</label><input class="form-control" type="number" name="qty[]" ></div><div class="col-md-2 mt-30"><button type="button" id="' + i + '" class="btn btn-danger btn-block btn_remove1">Delete</button></div></div>');
      $('select').selectize({
        sortField: 'text'
      });
    });

    $(document).on('click', '.btn_remove1', function() {
      var button_id = $(this).attr("id");
      $('#roww' + button_id + '').remove();
    });


  });
</script>

<script type="text/javascript">
  $(document).ready(function() {

    var i = 1;
    $('#add3').click(function() {
      i++;
      $('#dynamic_field2').append('<div class="row" id="rowww' + i +
        '"><div class="col-md-8"><label class="control-label">Barang</label><select class="form-control" name="barang[]"><option selected value="">Pilih</option><?php foreach ($produksi->result_array() as $i) : $barang_id = $i['barang_id']; $barang_nama = $i['barang_nama']; ?><option value="<?php echo $barang_id ?>"><?php echo $barang_nama ?></option><?php endforeach; ?> </select></div><div class="col-md-2"><label class="control-label" for="harga">Jumlah</label><input class="form-control" type="number" name="qty[]" ></div><div class="col-md-2 mt-30"><button type="button" id="' + i + '" class="btn btn-danger btn-block btn_remove1">Delete</button></div></div>');
      $('select').selectize({
        sortField: 'text'
      });
    });

    $(document).on('click', '.btn_remove1', function() {
      var button_id = $(this).attr("id");
      $('#rowww' + button_id + '').remove();
    });


  });
</script>

<?php if ($this->session->flashdata('msg') == 'update') : ?>
  <script type="text/javascript">
    $.toast({
      heading: 'Update',
      text: "Data Diupdate.",
      showHideTransition: 'slide',
      icon: 'success',
      loader: true, // Change it to false to disable loader
      loaderBg: '#ffffff',
      position: 'top-right',
      bgColor: '#00C9E6'
    });
  </script>
<?php elseif ($this->session->flashdata('msg') == 'success') : ?>
  <script type="text/javascript">
    $.toast({
      heading: 'Success',
      text: "Berhasil tambah data",
      showHideTransition: 'slide',
      icon: 'info',
      loader: true, // Change it to false to disable loader
      loaderBg: '#ffffff',
      position: 'top-right',
      bgColor: '#7EC857'
    });
  </script>
<?php elseif ($this->session->flashdata('msg') == 'warning') : ?>
  <script type="text/javascript">
    $.toast({
      heading: 'Warning',
      text: "Data gagal dimasukkan kedalam database",
      showHideTransition: 'slide',
      icon: 'info',
      loader: true, // Change it to false to disable loader
      loaderBg: '#ffffff',
      position: 'top-right',
      bgColor: '#orange'
    });
  </script>
<?php elseif ($this->session->flashdata('msg') == 'error') : ?>
  <script type="text/javascript">
    $.toast({
      heading: 'Error',
      text: "Data gagal dimasukkan kedalam database",
      showHideTransition: 'slide',
      icon: 'error',
      loader: true, // Change it to false to disable loader
      loaderBg: '#ffffff',
      position: 'top-right',
      bgColor: '#orange'
    });
  </script>
<?php elseif ($this->session->flashdata('msg') == 'success_non_reseller') : ?>
  <script type="text/javascript">
    $.toast({
      heading: 'Success',
      text: "Berhasil tambah data barang Produksi",
      showHideTransition: 'slide',
      icon: 'info',
      loader: true, // Change it to false to disable loader
      loaderBg: '#ffffff',
      position: 'top-right',
      bgColor: '#7EC857'
    });
  </script>
<?php elseif ($this->session->flashdata('msg') == 'hapus') : ?>
  <script type="text/javascript">
    $.toast({
      heading: 'Delete',
      text: "Data berhasil didelete",
      showHideTransition: 'slide',
      icon: 'info',
      loader: true, // Change it to false to disable loader
      loaderBg: '#ffffff',
      position: 'top-right',
      bgColor: 'red'
    });
  </script>
<?php else : ?>
<?php endif; ?>