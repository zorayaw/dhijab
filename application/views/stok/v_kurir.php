<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
	integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
	integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<div class="content-wrapper">
	<div class="page-title">
		<div class="row">
			<div class="col-sm-6">
				<h4 class="mb-0">Data Kurir
				<span id="thun">
				</span>
				</h4>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
					<li class="breadcrumb-item">Kurir
					</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl-12 mb-30">
			<div class="card card-statistics h-100">
				<div class="card-body">
					<div class="col-xl-12 mb-20" style="display: flex">

						<div class="btn-group col-md-6">
							<button type="button" class="btn btn-success dropdown-toggle m-t-20 col-md-12"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
									class="fa fa-print pr-2"></i>
								Cetak Dokumen
							</button>
							<center>
							<div class="dropdown-menu">
								<a class="dropdown-item" style="width: 420px"  href="" data-toggle="modal" data-target="#Cetak-Pesanan"><center>Data Pemesanan</center></a>
								<a class="dropdown-item" style="width: 420px"  href="" data-toggle="modal" data-target="#Cetak-Transaksi"><center>Data Keuangan</center></a>
							</div>
							</center>
						</div>
						
						<div class="btn-group col-md-6">
							<button type="button" class="btn btn-dark dropdown-toggle m-t-20 col-md-12" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false"><i class="fa fa-save pr-2"></i>
								Convert Dokumen
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href=""  style="width: 420px" data-toggle="modal" data-target="#Conv-Pemesanan"><center>Data Pemesanan</center></a>
								<a class="dropdown-item" href="" style="width: 420px" data-toggle="modal" data-target="#Conv-Transaksi"><center>Data Keuangan</center></a>
							</div>
						</div>
						
					</div>
					<div class="col-xl-12 mb-20" style="display: flex">
					
					<!-- filter tgl -->
						<div class="container" >
							<h7 class="mb-0">Cari Berdasarkan Tanggal :  </h7>
							<br>
							<form id="formsearch" method="post">
								<input class="sd" style="width:142px;" min="" max="" type="date" name="start"  class="form-control" id="s"  >
								<input class="ed" style="width:142px;" min="" max="" type="date" name="end"  class="form-control" id="e" >
								<button type="submit" class="btn btn-secondary"><i class="fa fa-search" aria-hidden="true"></i></button>
							</form>
							</div>
					<!--end filter tgl -->

					<!-- filter tahun -->
						<div class="btn-group mt-4">
							<button type="button" class="btn btn-info dropdown-toggle mb-4 ml-4" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false">
								Filter Tahun
							</button>
							<?php 
							$curyear = date('Y');
							$earlyyear = $curyear-10;
							?>
							<div class="dropdown-menu">
							<a class="dropdown-item" onclick="cyear(<?= 0 ?>)" id="changeYear<?= 0 ?>">Seluruh Data</a>
								<?php foreach(range($curyear, $earlyyear) as $r ) : ?>
								<a class="dropdown-item" onclick="cyear(<?= $r ?>)"
									id="changeYear<?= $r ?>"><?= $r ?></a>
								<?php endforeach; ?>
							</div>
						</div>
					<!--end filter tahun -->

					<!-- filter kurir -->
							<div class="btn-group mt-4">
							<button type="button" class="btn btn-primary dropdown-toggle mb-4 ml-4 mr-4" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false">
								Filter Kurir
							</button>
							<div class="dropdown-menu">
							<a class="dropdown-item" onclick="ckurir(<?= -1 ?>)" id="changeKurir<?= -1 ?>">Seluruh Kurir</a>
								<?php foreach($kurir->result_array() as $i ) : 
									$kurir_id = $i['kurir_id'];
                      				$kurir_nama = $i['kurir_nama'];
									  $kurir_tanggal = $i['kurir_tanggal'];
									  ?>
								<a class="dropdown-item" onclick="ckurir(<?= $kurir_id ?>)" id="changeKurir<?= $kurir_id ?>"><?= $kurir_nama ?></a>
								<?php endforeach; ?>
							</div>
						</div>
					<!--end filter kurir -->
					</div>

<div id="parent">
	<div class="table-responsive">
		<table id="datatable" class="table table-striped table-bordered p-0">
			<thead>
				<tr>
					<th width="5">No</th>
					<th>No order</th>
					<th>Nama Pemesan</th>
					<th width="10">Tanggal Pemesanan</th>
					<th>No HP</th>
					<th>Ekspedisi</th>
					<th>Nomor Resi</th>
					<th>Status Ekspedisi</th>
					<th>Ongkos kirim</th>
					<th>Total Harga</th>

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
$total=0;
foreach ($datapesanan->result_array() as $i) :
  $no++;

  $pemesanan_id = $i['pemesanan_id'];
  $pemesanan_nama = $i['pemesanan_nama'];
  $tanggal = $i['tanggal'];
  $hp = $i['pemesanan_hp'];
  $alamat = $i['pemesanan_alamat'];
  $kurir_id = $i['kurir_id'];
  $ongkir = $i['biaya_ongkir'];
  $mp_id1 = $i['mp_id'];
  $mp_nama = $i['mp_nama'];
  $level = $i['status_customer'];
  $kurir_nama = $i['kurir_nama'];
  $resi = $i['no_resi'];
  $at_id = $i['at_id'];
  $status = $i['status_eks'];
  $biaya_admin = $i['biaya_admin'];
  $diskon = $i['diskon'];
  $uang = $i['uang_kembalian'];
  $note = $i['note'];
  if($status==0)
  $namstat = "Belum Lunas";
  elseif($status==1)
  $namstat = "Lunas";
  elseif($status==2)
  $namstat = "Dikirim";
  elseif($status==3)
  $namstat = "Selesai";

  $q = $this->db->query("SELECT SUM(lb_qty * harga)AS total_keseluruhan from list_barang where pemesanan_id=' $pemesanan_id'");
  $c = $q->row_array();
  $jumlah = $c['total_keseluruhan'] + $ongkir - ($diskon + $biaya_admin + $uang);
  
  
  ?>
				<tr>
					<td>
						<center><?php echo $no ?></center>
					</td>
					</td>
					<td>
						<center><?php echo $pemesanan_id ?></center>
					</td>
					<td><?php echo $pemesanan_nama ?></td>
					<td><?php echo $tanggal ?></td>
					<td><?php echo $hp ?></td>
					<td><?php echo $kurir_nama ?></td>
					<td><?php echo $resi ?></td>
					<?php if($this->session->userdata('akses')==3) : ?>
					<td>
						<?php
	  if ($status == 0) { ?>
						<button type="submit" class="btn btn-warning" data-toggle="modal"
							data-target="#lunas<?= $pemesanan_id ?>" style="margin-right: 20px">Belum
							Lunas</button>
						<?php } elseif ($status == 1) {
	  ?>
						<button type="submit" class="btn btn-primary" data-toggle="modal"
							data-target="#kirim<?= $pemesanan_id ?>" style="margin-right: 20px">Lunas
						</button>
						<?php } elseif ($status == 2) {
	  ?>
						<button type="submit" class="btn btn-primary" data-toggle="modal"
							data-target="#selesai<?= $pemesanan_id ?>"
							style="margin-right: 20px">Dikirim </button>
						<?php } else {
	  ?>
						<button class="btn btn-success" style="margin-right: 20px">Selesai</button>
						<?php
	  }
	  ?>
					</td>
					<?php else : ?>
							<td><?php echo $namstat ?></td>
					<?php endif; ?>

					<td><?php echo rupiah($ongkir) ?></td>
					<td><?php echo rupiah($jumlah) ?></td>
					<?php 
	$total=$total+$jumlah;
	?>
				</tr>
				<?php endforeach; ?>

			</tbody>
		</table>
	</div>
</div>
				</div>
			</div>
		</div>
	</div>

		<!-- Modal Cetak Pemesanan-->
	<?php date_default_timezone_set("Asia/Jakarta");
    ?>

	<div class="modal fade" tabindex="-1" role="dialog" id="Cetak-Pesanan">
		<div class="modal-dialog modal-lg-10">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Cetak Seluruh Pemesanan</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<button type="button" class="btn btn-info dropdown-toggle ripple m-t-10 mb-4" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false" style="width: 470px">
								<span id="krrp">
									Filter Kurir
								</span>
							</button>
							<div class="dropdown-menu">
							<center><a class="dropdown-item" onclick="ckrP(<?= -1 ?>)" id="ckrP<?= -1 ?>" style="width: 470px">
							Seluruh Kurir
							</a>
								<?php foreach($kurir->result_array() as $i ) : 
									$kurir_id = $i['kurir_id'];
                      				$kurir_nama = $i['kurir_nama'];
									  $kurir_tanggal = $i['kurir_tanggal'];
									  ?>
								<a class="dropdown-item" onclick="ckrP(<?= $kurir_id ?>)" id="ckrP<?= $kurir_id ?>"><?= $kurir_nama ?></a>
								<?php endforeach; ?>
							</center>
							</div>
						</div>
					
						<div class="col-md-12">
							<a href="<?= base_url() ?>owner/Transaksi/cetak_transaksi?doc=1" target="_blank"
								class="btn btn-success btn-block ripple m-t-10">
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
							<a href="<?= base_url() ?>owner/Transaksi/cetakTransaksiByBulan?doc=1&bulan=<?= date('m')?>&tahun=<?= date("Y")?>"
								target="_blank" class="btn btn-success btn-block ripple m-t-10">
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

						<form action="<?php echo base_url() ?>owner/Transaksi/cetakTransaksiByTahun?doc=1"
							target="_blank" method="post" enctype="multipart/form-data">
							<div class="col-md-12">
								<h6>Cetak Pemesanan Berdasarkan Tahun: </h6>
							</div>

							<div class="modal-body p-20">
								<div class="row">
									<div class="col-lg-6">
										<label class="control-label">Dari tahun:</label>
										<select class="form-control" id="syear" name="start_year" required>
											<option selected value="">Pilih</option>
											<?php
                for ($x = date('Y')-10; $x <= date('Y'); $x++) :
                ?>
											<option id="enddate" value="<?php echo $x ?>"><?php echo $x ?></option>
											<?php endfor ?>
										</select>
									</div>

									<div class="col-lg-6">
										<label class="control-label">Sampai tahun:</label>
										<select class="form-control" id="eyear" name="end_year" required>
											<option selected value="">Pilih</option>
											<?php
                for ($x = date('Y')-10; $x <= date('Y'); $x++) :
                ?>
											<option id="endyear" value="<?php echo $x ?>"><?php echo $x ?></option>
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


					<div class="col-md-12">
						<h6>Cetak Berdasarkan Tanggal:</h6>
					</div>
					<form action="<?php echo base_url() ?>owner/Transaksi/cetakTransaksiBytanggal?doc=1"
						target="_blank" method="post" enctype="multipart/form-data">
						<div class="modal-body p-20">
							<div class="row">
								<div class="col-md-4">
									<label class="control-label">Dari tanggal:</label>
									<input class="form-control form-white sd" type="date" id="startdatecetak"
										name="start_date" required />
								</div>
								<div class="col-md-4">
									<label class="control-label">Sampai tanggal:</label>
									<input class="form-control form-white ed" type="date" id="enddatecetak"
										name="end_date" required />
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

	<!-- Modal Cetak Transaksi-->
	<?php date_default_timezone_set("Asia/Jakarta");
    ?>

	<div class="modal fade" tabindex="-1" role="dialog" id="Cetak-Transaksi">
		<div class="modal-dialog modal-lg-10">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Cetak Seluruh Transaksi</h5>
				</div>
				<div class="modal-body">
					<div class="row">

					<div class="col-md-12">
							<button type="button" class="btn btn-info dropdown-toggle ripple m-t-10 mb-4" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false" style="width: 470px">
								Filter Kurir
							</button>
							<div class="dropdown-menu">
							<center><a class="dropdown-item" onclick="ckurir(<?= -1 ?>)" id="changeKurir<?= -1 ?>" style="width: 470px">Seluruh Kurir</a>
								<?php foreach($kurir->result_array() as $i ) : 
									$kurir_id = $i['kurir_id'];
                      				$kurir_nama = $i['kurir_nama'];
									  $kurir_tanggal = $i['kurir_tanggal'];
									  ?>
								<a class="dropdown-item" onclick="ckurir(<?= $kurir_id ?>)" id="changeKurir<?= $kurir_id ?>"><?= $kurir_nama ?></a>
								<?php endforeach; ?>
							</center>
							</div>
						</div>

						<div class="col-md-12">
							<a href="<?= base_url() ?>owner/Transaksi/cetak_transaksi?doc=2" target="_blank"
								class="btn btn-success btn-block ripple m-t-10">
								<i class="fa fa-print pr-2"></i>Cetak Transaksi Hari Ini (<?= date('d')?> <?php 
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
							<a href="<?= base_url() ?>owner/Transaksi/cetakTransaksiByBulan?doc=2&bulan=<?= date('m')?>&tahun=<?= date("Y")?>"
								target="_blank" class="btn btn-success btn-block ripple m-t-10">
								<i class="fa fa-print pr-2"></i>Cetak Transaksi Bulan Ini (<?php 
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

						<form action="<?php echo base_url() ?>owner/Transaksi/cetakTransaksiByTahun?doc=2"
							target="_blank" method="post" enctype="multipart/form-data">
							<div class="col-md-12">
								<h6>Cetak Transaksi Berdasarkan Tahun: </h6>
							</div>

							<div class="modal-body p-20">
								<div class="row">
									<div class="col-lg-6">
										<label class="control-label">Dari tahun:</label>
										<select class="form-control" id="syear" name="start_year" required>
											<option selected value="">Pilih</option>
											<?php
                for ($x = date('Y')-10; $x <= date('Y'); $x++) :
                ?>
											<option id="enddate" value="<?php echo $x ?>"><?php echo $x ?></option>
											<?php endfor ?>
										</select>
									</div>

									<div class="col-lg-6">
										<label class="control-label">Sampai tahun:</label>
										<select class="form-control" id="eyear" name="end_year" required>
											<option selected value="">Pilih</option>
											<?php
                for ($x = date('Y')-10; $x <= date('Y'); $x++) :
                ?>
											<option id="endyear" value="<?php echo $x ?>"><?php echo $x ?></option>
											<?php endfor ?>
										</select>
									</div>
								</div>
							</div>
					</div>

					<div class="col-md-12">
						<button type="submit" class="btn btn-success btn-block ripple m-t-10">
							<i class="fa fa-print pr-2"></i>Cetak Transaksi</button>
						<br>
					</div>
					</form>


					<div class="col-md-12">
						<h6>Cetak Berdasarkan Tanggal:</h6>
					</div>
					<form action="<?php echo base_url() ?>owner/Transaksi/cetakTransaksiBytanggal?doc=2"
						target="_blank" method="post" enctype="multipart/form-data">
						<div class="modal-body p-20">
							<div class="row">
								<div class="col-md-4">
									<label class="control-label">Dari tanggal:</label>
									<input class="form-control form-white sd" type="date" id="startdatecetak"
										name="start_date" required />
								</div>
								<div class="col-md-4">
									<label class="control-label">Sampai tanggal:</label>
									<input class="form-control form-white ed" type="date" id="enddatecetak"
										name="end_date" required />
								</div>
								<div class="col-md-4">
									<button type="submit" class="btn btn-success btn-block ripple m-t-10">
										<i class="fa fa-print pr-2"></i>Cetak<br>Transaksi</a>
								</div>
							</div>
						</div>
					</form>

					<div class="btn-group col-md-12">
						<button type="button" class="btn btn-success dropdown-toggle col-md-12"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
								class="fa fa-print pr-2"></i>
							Cetak Berdasarkan Kurir
						</button>
						<center>
						<div class="dropdown-menu">
							<center><a class="dropdown-item" >Seluruh Kurir</a></center>
							<?php foreach($kurir->result_array() as $i ) : 
								$kurir_nama = $i['kurir_nama'];				
							?>
							<center><a class="dropdown-item" style="width: 420px"><?= $kurir_nama ?></a></center>
							<?php endforeach; ?>
						</div>
						</center>
					</div>		

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger ripple" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- convert  -->
	<div class="modal fade" id="Conv-Pemesanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="margin-right: 5px">
					<h5 class="modal-title" id="exampleModalLabel">Pilihan</h5>
				</div>
				<div class="modal-body">
					<div class="col-md-12 mt-4">
						<a href="" target="_blank" class="btn btn-warning btn-block ripple m-t-10" id="excel" data-toggle="modal" data-target="#exportP">
							<i class="fa fa-file-excel-o pr-2"></i>Convert Excel
						</a>
					</div>
					<div class="col-md-12 mt-4">
						<a href="" target="_blank" class="btn btn-warning btn-block ripple m-t-10" id="pdf" data-toggle="modal" data-target="#exportpdfP">
							<i class="fa fa-file-pdf-o pr-2"></i>Convert PDF
						</a>
					</div>
					<div class="col-md-12 mt-4 mb-4">
						<a href="" target="_blank"  class="btn btn-warning btn-block ripple m-t-10" id="words" data-toggle="modal" data-target="#wordP">
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
		<div class="modal fade" id="exportP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Convert Data Pemesanan (Excel)</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">

					<div class="col-md-12">
<!-- form start -->
					<form action="<?= base_url() ?>stok/Pemesanan/convertExcel?doc=1" method="post" id="excelall">
					<div class="col-md-12">
						<input type="submit" onclick="submitexcelsemua()"
						target="_blank" class="btn btn-success btn-block ripple m-t-10" value="Convert Seluruh Pemesanan">
					</div>


					<form action="<?= base_url() ?>stok/Pemesanan/convertExcelPerbulan?doc=1&bulan=<?= date('m')?>&tahun=<?= date("Y")?>" method="post" id="excelperbulann">

					<div class="col-md-12 mt-4">
					<input type="submit" onclick="submitexcelperbulan()"
									target="_blank" class="btn btn-success btn-block ripple m-t-10" value="Convert Pemesanan Bulan Ini (<?php 
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
									<?= date('Y')?>)"
				>
				</div>


<!-- end form -->
						<label for="kurir">Filter Kurir</label>
						<select id="kurir" name="kurir">
						<option class="dropdown-item" value="<?= -1 ?>">Seluruh Kurir</option>
						<?php foreach($kurir->result_array() as $i ) : 
									$kurir_id = $i['kurir_id'];
                      				$kurir_nama = $i['kurir_nama'];
									  $kurir_tanggal = $i['kurir_tanggal'];
									  ?>
								<option class="dropdown-item" value="<?=$kurir_id?>"><?= $kurir_nama ?></option>
						<?php endforeach; ?>
						</select>
					</form>
					</form>

							<!-- <button type="button" class="btn btn-info dropdown-toggle ripple m-t-10 mb-4" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false" style="width: 470px">
								<span id="krrpexcel">
									Filter Kurir
								</span>
							</button>
							<div class="dropdown-menu">
							<center><a class="dropdown-item" style="width: 470px">Seluruh Kurir</a>
								<?php foreach($kurir->result_array() as $i ) : 
									$kurir_id = $i['kurir_id'];
                      				$kurir_nama = $i['kurir_nama'];
									  $kurir_tanggal = $i['kurir_tanggal'];
									  ?>
								<a class="dropdown-item"><?= $kurir_nama ?></a>
								<?php endforeach; ?>
							</center>
							</div> -->
						</div>

														<div class="col-md-12 mt-4">
								<a href="<?= base_url() ?>stok/Pemesanan/convertExcelPerhari?doc=1"
									target="_blank" class="btn btn-success btn-block ripple m-t-10">
									<i class="fa fa-print pr-2"></i>Convert Pemesanan Hari Ini
									(<?= date('d')?> <?php 
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
							<form
								action="<?php echo base_url() ?>stok/Pemesanan/convertExcelBytanggal?doc=1"
								target="_blank" method="post" enctype="multipart/form-data">
								<div class="modal-body p-20">
									<div class="row">
										<div class="col-md-4">
											<label class="control-label">Start date:</label>
											<input class="form-control form-white sd" type="date"
												name="start_date" required />
										</div>
										<div class="col-md-4">
											<label class="control-label">End date:</label>
											<input class="form-control form-white ed" type="date"
												name="end_date" required />
										</div>
										<div class="col-md-4">
											<button type="submit"
												class="btn btn-info btn-block ripple m-t-10">
												<i class="fa fa-print pr-2"></i>Convert<br>Pemesanan</a>
										</div>
									</div>
								</div>
							</form>

							<div class="btn-group col-md-12">
							<button type="button" class="btn btn-success dropdown-toggle col-md-12"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
									class="fa fa-print pr-2"></i>
								Cetak Berdasarkan Kurir
							</button>
							<center>
							<div class="dropdown-menu">
								<center><a class="dropdown-item" >Seluruh Kurir</a></center>
								<?php foreach($kurir->result_array() as $i ) : 
									$kurir_nama = $i['kurir_nama'];				
								?>
								<center><a class="dropdown-item" style="width: 420px"><?= $kurir_nama ?></a></center>
								<?php endforeach; ?>
							</div>
							</center>
					</div>		
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
		<div class="modal fade" id="wordP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Convert Data Pemesanan (Word)</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">

						<div class="col-md-12">
							<button type="button" class="btn btn-info dropdown-toggle ripple m-t-10 mb-4" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false" style="width: 470px">
								Filter Kurir
							</button>
							<div class="dropdown-menu">
							<center><a class="dropdown-item" onclick="ckurir(<?= -1 ?>)" id="changeKurir<?= -1 ?>" style="width: 470px">Seluruh Kurir</a>
								<?php foreach($kurir->result_array() as $i ) : 
									$kurir_id = $i['kurir_id'];
                      				$kurir_nama = $i['kurir_nama'];
									  $kurir_tanggal = $i['kurir_tanggal'];
									  ?>
								<a class="dropdown-item" onclick="ckurir(<?= $kurir_id ?>)" id="changeKurir<?= $kurir_id ?>"><?= $kurir_nama ?></a>
								<?php endforeach; ?>
							</center>
							</div>
						</div>

							<div class="col-md-12">
								<a href="<?= base_url() ?>stok/Pemesanan/convertWord?doc=1"
									target="_blank" class="btn btn-success btn-block ripple m-t-10">
									<i class="fa fa-print pr-2"></i>Convert Seluruh Pemesanan</a>
								</a>
							</div>

							<div class="col-md-12 mt-4">
								<a href="<?= base_url() ?>stok/Pemesanan/convertWordPerhari?doc=1"
									target="_blank" class="btn btn-success btn-block ripple m-t-10">
									<i class="fa fa-print pr-2"></i>Convert Pemesanan Hari Ini
									(<?= date('d')?> <?php 
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
								<a href="<?= base_url() ?>stok/Pemesanan/convertWordPerbulan?doc=1&bulan=<?= date('m')?>&tahun=<?= date("Y")?>"
									target="_blank" class="btn btn-success btn-block ripple m-t-10">
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
							<form
								action="<?php echo base_url() ?>stok/Pemesanan/convertWordPertanggal?doc=1"
								target="_blank" method="post" enctype="multipart/form-data">
								<div class="modal-body p-20">
									<div class="row">
										<div class="col-md-4">
											<label class="control-label">Start date:</label>
											<input class="form-control form-white sd" type="date"
												name="start_date" required />
										</div>
										<div class="col-md-4">
											<label class="control-label">End date:</label>
											<input class="form-control form-white ed" type="date"
												name="end_date" required />
										</div>
										<div class="col-md-4">
											<button type="submit"
												class="btn btn-info btn-block ripple m-t-10">
												<i class="fa fa-print pr-2"></i>Convert<br>Pemesanan</a>
										</div>
									</div>
								</div>
							</form>

							<div class="btn-group col-md-12">
								<button type="button" class="btn btn-success dropdown-toggle col-md-12"
									data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
										class="fa fa-print pr-2"></i>
									Cetak Berdasarkan Kurir
								</button>
								<center>
								<div class="dropdown-menu">
									<center><a class="dropdown-item" >Seluruh Kurir</a></center>
									<?php foreach($kurir->result_array() as $i ) : 
										$kurir_nama = $i['kurir_nama'];				
									?>
									<center><a class="dropdown-item" style="width: 420px"><?= $kurir_nama ?></a></center>
									<?php endforeach; ?>
								</div>
								</center>
							</div>		

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
		<div class="modal fade" id="exportpdfP" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Convert Data Pemesanan (PDF)</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">

						<div class="col-md-12">
							<button type="button" class="btn btn-info dropdown-toggle ripple m-t-10 mb-4" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false" style="width: 470px">
								Filter Kurir
							</button>
							<div class="dropdown-menu">
							<center><a class="dropdown-item" onclick="ckurir(<?= -1 ?>)" id="changeKurir<?= -1 ?>" style="width: 470px">Seluruh Kurir</a>
								<?php foreach($kurir->result_array() as $i ) : 
									$kurir_id = $i['kurir_id'];
                      				$kurir_nama = $i['kurir_nama'];
									  $kurir_tanggal = $i['kurir_tanggal'];
									  ?>
								<a class="dropdown-item" onclick="ckurir(<?= $kurir_id ?>)" id="changeKurir<?= $kurir_id ?>"><?= $kurir_nama ?></a>
								<?php endforeach; ?>
							</center>
							</div>
						</div>

							<div class="col-md-12">
								<a href="<?= base_url() ?>stok/Pemesanan/convertPDF?doc=1"
									target="_blank" class="btn btn-success btn-block ripple m-t-10">
									<i class="fa fa-print pr-2"></i>Convert Seluruh Pemesanan</a>
								</a>
							</div>

							<div class="col-md-12 mt-4">
								<a href="<?= base_url() ?>stok/Pemesanan/convertPDFPerhari?doc=1"
									target="_blank" class="btn btn-success btn-block ripple m-t-10">
									<i class="fa fa-print pr-2"></i>Convert Pemesanan Hari Ini
									(<?= date('d')?> <?php 
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
								<a href="<?= base_url() ?>stok/Pemesanan/convertPDFPerbulan?doc=1&bulan=<?= date('m')?>&tahun=<?= date("Y")?>"
									target="_blank" class="btn btn-success btn-block ripple m-t-10">
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
							<form
								action="<?php echo base_url() ?>stok/Pemesanan/convertPDFPertanggal?doc=1"
								target="_blank" method="post" enctype="multipart/form-data">
								<div class="modal-body p-20">
									<div class="row">
										<div class="col-md-4">
											<label class="control-label">Start date:</label>
											<input class="form-control form-white sd" type="date"
												name="start_date" required />
										</div>
										<div class="col-md-4">
											<label class="control-label">End date:</label>
											<input class="form-control form-white ed" type="date"
												name="end_date" required />
										</div>
										<div class="col-md-4">
											<button type="submit"
												class="btn btn-info btn-block ripple m-t-10">
												<i class="fa fa-print pr-2"></i>Convert<br>Pemesanan</a>
										</div>
									</div>
								</div>
							</form>

							<div class="btn-group col-md-12">
								<button type="button" class="btn btn-success dropdown-toggle col-md-12"
									data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
										class="fa fa-print pr-2"></i>
									Cetak Berdasarkan Kurir
								</button>
								<center>
								<div class="dropdown-menu">
									<center><a class="dropdown-item" >Seluruh Kurir</a></center>
									<?php foreach($kurir->result_array() as $i ) : 
										$kurir_nama = $i['kurir_nama'];				
									?>
									<center><a class="dropdown-item" style="width: 420px"><?= $kurir_nama ?></a></center>
									<?php endforeach; ?>
								</div>
								</center>
							</div>	

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- end modal pdf -->

	<div class="modal fade" id="Conv-Transaksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="margin-right: 5px">
					<h5 class="modal-title" id="exampleModalLabel">Pilihan</h5>
				</div>
				<div class="modal-body">
					<div class="col-md-12 mt-4">
						<a href="" target="_blank" class="btn btn-warning btn-block ripple m-t-10" id="excelT" data-toggle="modal" data-target="#exportT">
							<i class="fa fa-file-excel-o pr-2"></i>Convert Excel
						</a>
					</div>
					<div class="col-md-12 mt-4">
						<a href="" target="_blank" class="btn btn-warning btn-block ripple m-t-10" id="pdfT" data-toggle="modal" data-target="#exportpdfT">
							<i class="fa fa-file-pdf-o pr-2"></i>Convert PDF
						</a>
					</div>
					<div class="col-md-12 mt-4 mb-4">
						<a href="" target="_blank"  class="btn btn-warning btn-block ripple m-t-10" id="wordsT" data-toggle="modal" data-target="#wordT">
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
		<div class="modal fade" id="exportT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Convert Data Transaksi (Excel)</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
						<div class="col-md-12">
							<button type="button" class="btn btn-info dropdown-toggle ripple m-t-10 mb-4" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false" style="width: 470px">
								Filter Kurir
							</button>
							<div class="dropdown-menu">
							<center><a class="dropdown-item" onclick="ckurir(<?= -1 ?>)" id="changeKurir<?= -1 ?>" style="width: 470px">Seluruh Kurir</a>
								<?php foreach($kurir->result_array() as $i ) : 
									$kurir_id = $i['kurir_id'];
                      				$kurir_nama = $i['kurir_nama'];
									  $kurir_tanggal = $i['kurir_tanggal'];
									  ?>
								<a class="dropdown-item" onclick="ckurir(<?= $kurir_id ?>)" id="changeKurir<?= $kurir_id ?>"><?= $kurir_nama ?></a>
								<?php endforeach; ?>
							</center>
							</div>
						</div>

							<div class="col-md-12">
								<a href="<?= base_url() ?>stok/Pemesanan/convertExcel?doc=2"
									target="_blank" class="btn btn-success btn-block ripple m-t-10">
									<i class="fa fa-print pr-2"></i>Convert Seluruh Transaksi</a>
								</a>
							</div>

							<div class="col-md-12 mt-4">
								<a href="<?= base_url() ?>stok/Pemesanan/convertExcelPerhari?doc=2"
									target="_blank" class="btn btn-success btn-block ripple m-t-10">
									<i class="fa fa-print pr-2"></i>Convert Transaksi Hari Ini
									(<?= date('d')?> <?php 
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
								<a href="<?= base_url() ?>stok/Pemesanan/convertExcelPerbulan?doc=2&bulan=<?= date('m')?>&tahun=<?= date("Y")?>"
									target="_blank" class="btn btn-success btn-block ripple m-t-10">
									<i class="fa fa-print pr-2"></i>Convert Transaksi Bulan Ini (<?php 
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
							<form
								action="<?php echo base_url() ?>stok/Pemesanan/convertExcelBytanggal?doc=2"
								target="_blank" method="post" enctype="multipart/form-data">
								<div class="modal-body p-20">
									<div class="row">
										<div class="col-md-4">
											<label class="control-label">Start date:</label>
											<input class="form-control form-white sd" type="date"
												name="start_date" required />
										</div>
										<div class="col-md-4">
											<label class="control-label">End date:</label>
											<input class="form-control form-white ed" type="date"
												name="end_date" required />
										</div>
										<div class="col-md-4">
											<button type="submit"
												class="btn btn-info btn-block ripple m-t-10">
												<i class="fa fa-print pr-2"></i>Convert<br>Transaksi</a>
										</div>
									</div>
								</div>
							</form>

							<div class="btn-group col-md-12">
								<button type="button" class="btn btn-success dropdown-toggle col-md-12"
									data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
										class="fa fa-print pr-2"></i>
									Cetak Berdasarkan Kurir
								</button>
								<center>
								<div class="dropdown-menu">
									<center><a class="dropdown-item" >Seluruh Kurir</a></center>
									<?php foreach($kurir->result_array() as $i ) : 
										$kurir_nama = $i['kurir_nama'];				
									?>
									<center><a class="dropdown-item" style="width: 420px"><?= $kurir_nama ?></a></center>
									<?php endforeach; ?>
								</div>
								</center>
							</div>		
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
		<div class="modal fade" id="wordT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Convert Data Transaksi (Word)</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">

						<div class="col-md-12">
							<button type="button" class="btn btn-info dropdown-toggle ripple m-t-10 mb-4" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false" style="width: 470px">
								Filter Kurir
							</button>
							<div class="dropdown-menu">
							<center><a class="dropdown-item" onclick="ckurir(<?= -1 ?>)" id="changeKurir<?= -1 ?>" style="width: 470px">Seluruh Kurir</a>
								<?php foreach($kurir->result_array() as $i ) : 
									$kurir_id = $i['kurir_id'];
                      				$kurir_nama = $i['kurir_nama'];
									  $kurir_tanggal = $i['kurir_tanggal'];
									  ?>
								<a class="dropdown-item" onclick="ckurir(<?= $kurir_id ?>)" id="changeKurir<?= $kurir_id ?>"><?= $kurir_nama ?></a>
								<?php endforeach; ?>
							</center>
							</div>
						</div>							

							<div class="col-md-12">
								<a href="<?= base_url() ?>stok/Pemesanan/convertWord?doc=2"
									target="_blank" class="btn btn-success btn-block ripple m-t-10">
									<i class="fa fa-print pr-2"></i>Convert Seluruh Transaksi</a>
								</a>
							</div>

							<div class="col-md-12 mt-4">
								<a href="<?= base_url() ?>stok/Pemesanan/convertWordPerhari?doc=2"
									target="_blank" class="btn btn-success btn-block ripple m-t-10">
									<i class="fa fa-print pr-2"></i>Convert Transaksi Hari Ini
									(<?= date('d')?> <?php 
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
								<a href="<?= base_url() ?>stok/Pemesanan/convertWordPerbulan?doc=2&bulan=<?= date('m')?>&tahun=<?= date("Y")?>"
									target="_blank" class="btn btn-success btn-block ripple m-t-10">
									<i class="fa fa-print pr-2"></i>Convert Transaksi Bulan Ini (<?php 
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
							<form
								action="<?php echo base_url() ?>stok/Pemesanan/convertWordPertanggal?doc=2"
								target="_blank" method="post" enctype="multipart/form-data">
								<div class="modal-body p-20">
									<div class="row">
										<div class="col-md-4">
											<label class="control-label">Start date:</label>
											<input class="form-control form-white sd" id="startdateword"
												type="date" name="start_date" required />
										</div>
										<div class="col-md-4">
											<label class="control-label">End date:</label>
											<input class="form-control form-white ed" id="enddateword"
												type="date" name="end_date" required />
										</div>
										<div class="col-md-4">
											<button type="submit"
												class="btn btn-info btn-block ripple m-t-10">
												<i class="fa fa-print pr-2"></i>Convert<br>Transaksi</a>
										</div>
									</div>
								</div>
							</form>

							<div class="btn-group col-md-12">
								<button type="button" class="btn btn-success dropdown-toggle col-md-12"
									data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
										class="fa fa-print pr-2"></i>
									Cetak Berdasarkan Kurir
								</button>
								<center>
								<div class="dropdown-menu">
									<center><a class="dropdown-item" >Seluruh Kurir</a></center>
									<?php foreach($kurir->result_array() as $i ) : 
										$kurir_nama = $i['kurir_nama'];				
									?>
									<center><a class="dropdown-item" style="width: 420px"><?= $kurir_nama ?></a></center>
									<?php endforeach; ?>
								</div>
								</center>
							</div>		
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
		<div class="modal fade" id="exportpdfT" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Convert Data Transaksi (PDF)</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							
						<div class="col-md-12">
							<button type="button" class="btn btn-info dropdown-toggle ripple m-t-10 mb-4" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false" style="width: 470px">
								Filter Kurir
							</button>
							<div class="dropdown-menu">
							<center><a class="dropdown-item" onclick="ckurir(<?= -1 ?>)" id="changeKurir<?= -1 ?>" style="width: 470px">Seluruh Kurir</a>
								<?php foreach($kurir->result_array() as $i ) : 
									$kurir_id = $i['kurir_id'];
                      				$kurir_nama = $i['kurir_nama'];
									  $kurir_tanggal = $i['kurir_tanggal'];
									  ?>
								<a class="dropdown-item" onclick="ckurir(<?= $kurir_id ?>)" id="changeKurir<?= $kurir_id ?>"><?= $kurir_nama ?></a>
								<?php endforeach; ?>
							</center>
							</div>
						</div>

							<div class="col-md-12">
								<a href="<?= base_url() ?>stok/Pemesanan/convertPDF?doc=2"
									target="_blank" class="btn btn-success btn-block ripple m-t-10">
									<i class="fa fa-print pr-2"></i>Convert Seluruh Transaksi</a>
								</a>
							</div>

							<div class="col-md-12 mt-4">
								<a href="<?= base_url() ?>stok/Pemesanan/convertPDFPerhari?doc=2"
									target="_blank" class="btn btn-success btn-block ripple m-t-10">
									<i class="fa fa-print pr-2"></i>Convert Transaksi Hari Ini
									(<?= date('d')?> <?php 
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
								<a href="<?= base_url() ?>stok/Pemesanan/convertPDFPerbulan?doc=2&bulan=<?= date('m')?>&tahun=<?= date("Y")?>"
									target="_blank" class="btn btn-success btn-block ripple m-t-10">
									<i class="fa fa-print pr-2"></i>Convert Transaksi Bulan Ini (<?php 
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
							<form
								action="<?php echo base_url() ?>stok/Pemesanan/convertPDFPertanggal?doc=2"
								target="_blank" method="post" enctype="multipart/form-data">
								<div class="modal-body p-20">
									<div class="row">
										<div class="col-md-4">
											<label class="control-label">Start date:</label>
											<input class="form-control form-white sd" type="date"
												name="start_date" required />
										</div>
										<div class="col-md-4">
											<label class="control-label">End date:</label>
											<input class="form-control form-white ed" type="date"
												name="end_date" required />
										</div>
										<div class="col-md-4">
											<button type="submit"
												class="btn btn-info btn-block ripple m-t-10">
												<i class="fa fa-print pr-2"></i>Convert<br>Transaksi</a>
										</div>
									</div>
								</div>
							</form>

							<div class="btn-group col-md-12">
								<button type="button" class="btn btn-success dropdown-toggle col-md-12"
									data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
										class="fa fa-print pr-2"></i>
									Cetak Berdasarkan Kurir
								</button>
								<center>
								<div class="dropdown-menu">
									<center><a class="dropdown-item" >Seluruh Kurir</a></center>
									<?php foreach($kurir->result_array() as $i ) : 
										$kurir_nama = $i['kurir_nama'];				
									?>
									<center><a class="dropdown-item" style="width: 420px"><?= $kurir_nama ?></a></center>
									<?php endforeach; ?>
								</div>
								</center>
							</div>		
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

	<!-- Modal Status -->
	<?php
    $no = 0;
    foreach ($datapesanan->result_array() as $i) :
    $no++;
    $pemesanan_id = $i['pemesanan_id'];
    $status_eks = $i['status_eks'];
    ?>

	<div class="modal" tabindex="-1" role="dialog" id="lunas<?= $pemesanan_id ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Ganti Status</h5>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body p-20">
					<form action="<?php echo base_url() ?>Stok/Pemesanan/status" method="POST">
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" name="pemesanan_id" value="<?php echo $pemesanan_id ?>" />
								<input type="hidden" name="status_eks" value="<?php echo $status_eks ?>" />
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
					<form action="<?php echo base_url() ?>Stok/Pemesanan/status" method="POST">
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" name="pemesanan_id" value="<?php echo $pemesanan_id ?>" />
								<input type="hidden" name="status_eks" value="<?php echo $status_eks ?>" />
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

	<div class="modal" tabindex="-1" role="dialog" id="selesai<?= $pemesanan_id ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Ganti Status</h5>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body p-20">
					<form action="<?php echo base_url() ?>Stok/Pemesanan/status" method="POST">
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" name="pemesanan_id" value="<?php echo $pemesanan_id ?>" />
								<input type="hidden" name="jumlah" value="<?php echo $jumlah ?>" />
								<input type="hidden" name="status_eks" value="2" />
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

<!-- jquery -->
<script src="<?php echo base_url()?>assets/admin/js/jquery-3.3.1.min.js"></script>

<!-- plugins-jquery -->
<script src="<?php echo base_url()?>assets/admin/js/plugins-jquery.js"></script>

<!-- plugin_path -->
<script>var plugin_path = '<?php echo base_url()?>assets/admin/js/';</script>

<!-- chart -->
<script src="<?php echo base_url()?>assets/admin/js/chart-init.js"></script>

<!-- calendar -->
<script src="<?php echo base_url()?>assets/admin/js/calendar.init.js"></script>

<!-- charts sparkline -->
<script src="<?php echo base_url()?>assets/admin/js/sparkline.init.js"></script>

<!-- charts morris -->
<script src="<?php echo base_url()?>assets/admin/js/morris.init.js"></script>

<!-- datepicker -->
<script src="<?php echo base_url()?>assets/admin/js/datepicker.js"></script>

<!-- sweetalert2 -->
<script src="<?php echo base_url()?>assets/admin/js/sweetalert2.js"></script>

<!-- toastr -->
<script src="<?php echo base_url().'assets/admin/js/jquery.toast.min.js'?>"></script>

<!-- validation -->
<script src="<?php echo base_url()?>assets/admin/js/validation.js"></script>

<!-- lobilist -->
<script src="<?php echo base_url()?>assets/admin/js/lobilist.js"></script>
 
<!-- custom -->
<script src="<?php echo base_url()?>assets/admin/js/custom.js"></script>
  
<!-- mask -->
<script src="<?php echo base_url()?>assets/admin/js/jquery.mask.min.js"></script>

</body>

</html>


<script type="text/javascript">
    function submitexcelsemua() {
      $("#excelall").submit();
    }    
</script>

<script type="text/javascript">
    function submitexcelperbulan() {
      $("#excelperbulann").submit();
    }    
</script>


<script>
	function cyear(num) {
		let value = parseInt($('#changeYear' + num).html())
		$.ajax({
			method: "POST",
			url: "<?= base_url() ?>stok/Pemesanan/pemesananByTahun",
			data: {
				thn: parseInt($('#changeYear' + num).html())
			},
			success: function (result) {
				$('#parent').html(result)
				$("#s").attr('min', value+"-01-01");
				$("#s").attr('max', value+"-12-31");
				$("#s").attr('value', value+"-01-01");
				$("#e").attr('min', value+"-01-01");
				$("#e").attr('max', value+"-12-31");
				$("#e").attr('value', value+"-12-31");
				$('#s').val(value+"-01-01")
              	$('#e').val(value+"-12-31")

			if(isNaN(value)){
				$("#thun").text("")
             }
             else{
                $("#thun").text(parseInt($('#changeYear' + num).html()))
             }
			}
		});
		
	}

</script>

<script>
	function ckurir(num) {
		let value = num
		$.ajax({
			method: "POST",
			url: "<?= base_url() ?>stok/Pemesanan/pemesananByKurir",
			data: {
				id_kurir: value
			},
			success: function (result) {
				$('#parent').html(result)
				$("#thun").text("")
			}
		});
		
	}

</script>

<script>
	$('#formsearch').submit(function (e) {
		$.ajax({
			method: "POST",
			url: "<?= base_url() ?>stok/Pemesanan/pemesananByTanggal",
			data: {
				startt: $('#s').val(),
				endd: $('#e').val()
			},
			success: function (result) {
				$('#parent').html(result)
			}
		});
		e.preventDefault()
	});

</script>

<script type="text/javascript">
	$(document).ready(function () {
		// Format mata uang.
		$('.money').mask('000.000.000.000.000', {
			reverse: true
		});

	})

</script>

<script type="text/javascript">
	$("#excel").click(function () {
		$("#Conv-Pemesanan").modal('hide');
	});

</script>

<script type="text/javascript">
	$("#words").click(function () {
		$("#Conv-Pemesanan").modal('hide');
	});

</script>

<script type="text/javascript">
	$("#pdf").click(function () {
		$("#Conv-Pemesanan").modal('hide');
	});

</script>

<script type="text/javascript">
	$("#excelT").click(function () {
		$("#Conv-Transaksi").modal('hide');
	});

</script>

<script type="text/javascript">
	$("#wordsT").click(function () {
		$("#Conv-Transaksi").modal('hide');
	});

</script>

<script type="text/javascript">
	$("#pdfT").click(function () {
		$("#Conv-Transaksi").modal('hide');
	});

</script>

<script type="text/javascript">
	function noresicus(checkbox) {
		var isChecked = $('#checkboxcus').is(':checked');
		if (isChecked == true) {
			$("#checkboxcus").after(`
                      <div class="col-md-12 resi" id="a">
                        <br>
                        <label class="control-label">Nomor Resi</label>
                        <input placeholder="Input Nomor Resi" class="form-control form-white" type="text" name="no_resi" required />
                        <br>
                      </div>
            `);
		} else {
			$("#a").remove();
		}
	}

</script>

<script type="text/javascript">
	function noresires(checkbox) {
		var isChecked = $('#checkboxres').is(':checked');
		if (isChecked == true) {
			$("#checkboxres").after(`
                      <div class="col-md-12 resi" id="a">
                        <br>
                        <label class="control-label">Nomor Resi</label>
                        <input placeholder="Input Nomor Resi" class="form-control form-white" type="text" name="no_resi" required />
                        <br>
                      </div>
            `);
		} else {
			$("#a").remove();
		}
	}

</script>

<script type="text/javascript">
	$(document).ready(function () {
		var i = 1;
		$('#add').click(function () {
			i++;
			$('#dynamic_field').append('<div class="row" id="row' + i +
				'"><div class="col-md-2"><label class="control-label" for="harga">Min.qty</label><input class="form-control" type="number" name="minqty[]" ></div><div class="col-md-2"><label class="control-label" for="harga">Max.qty</label><input class="form-control" type="number" name="maxqty[]"></div><div class="col-md-5"><label class="control-label" for="harga">Harga</label><input class="form-control money" type="text" name="harga[]"></div><div class="col-md-2 mt-30"><button type="button" id="' +
				i + '" class="btn btn-danger btn-block btn_remove">Delete</button></div></div>');
		});

		$(document).on('click', '.btn_remove', function () {
			var button_id = $(this).attr("id");
			$('#row' + button_id + '').remove();
		});

		$('#submit').click(function () {
			$.ajax({
				url: "<?php echo base_url()?>Owner/Barang",
				method: "POST",
				data: $('#add_name').serialize(),
				success: function (data) {
					$('#add_name')[0].reset();
				}
			});
		});

	});

</script>

<?php if($this->session->flashdata('msg')=='update'):?>
<script type="text/javascript">
	$.toast({
		heading: 'Update',
		text: "Data berhasil Diupdate.",
		showHideTransition: 'slide',
		icon: 'success',
		loader: true, // Change it to false to disable loader
		loaderBg: '#ffffff',
		position: 'top-right',
		bgColor: '#00C9E6'
	});

</script>
<?php elseif($this->session->flashdata('msg')=='success'):?>
<script type="text/javascript">
	$.toast({
		heading: 'Success',
		text: "Data berhasil disimpan",
		showHideTransition: 'slide',
		icon: 'info',
		loader: true, // Change it to false to disable loader
		loaderBg: '#ffffff',
		position: 'top-right',
		bgColor: '#7EC857'
	});

</script>
<?php elseif($this->session->flashdata('msg')=='warning'):?>
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
<?php elseif($this->session->flashdata('msg')=='error'):?>
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
<?php elseif($this->session->flashdata('msg')=='success_non_reseller'):?>
<script type="text/javascript">
	$.toast({
		heading: 'Success',
		text: "Berhasil tambah data barang reseller",
		showHideTransition: 'slide',
		icon: 'info',
		loader: true, // Change it to false to disable loader
		loaderBg: '#ffffff',
		position: 'top-right',
		bgColor: '#7EC857'
	});

</script>
<?php elseif($this->session->flashdata('msg')=='delete'):?>
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

<?php else:?>
<?php endif;?>