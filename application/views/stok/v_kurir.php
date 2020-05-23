
<div class="content-wrapper">
	<div class="page-title">
		<div class="row">
			<div class="col-sm-6">
				<h4 class="mb-0">Data Kurir</h4>
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
								<a class="dropdown-item" style="width: 420px" target="_blank" href="<?php echo base_url() ?>stok/Pemesanan/cetakTransaksiBerjalan" ><center>Data Pemesanan</center></a>
								<a class="dropdown-item" style="width: 420px" target="_blank" href="<?php echo base_url() ?>stok/Pemesanan/cetakTransaksiTBerjalan" ><center>Data Keuangan</center></a>
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
					<div class="btn-group mt-4">
							<button type="button" class="btn btn-info dropdown-toggle mb-4 ml-4" data-toggle="dropdown"
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
					</div>
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
						<a href="<?php echo base_url() ?>stok/Pemesanan/convertExcelPBerjalan" target="_blank" class="btn btn-warning btn-block ripple m-t-10" id="excel">
							<i class="fa fa-file-excel-o pr-2"></i>Convert Excel
						</a>
					</div>
					<div class="col-md-12 mt-4">
						<a href="<?php echo base_url() ?>stok/Pemesanan/convertPDFPBerjalan" target="_blank" class="btn btn-warning btn-block ripple m-t-10" id="pdf">
							<i class="fa fa-file-pdf-o pr-2"></i>Convert PDF
						</a>
					</div>
					<div class="col-md-12 mt-4 mb-4">
						<a href="<?php echo base_url() ?>stok/Pemesanan/convertWordPBerjalan" target="_blank"  class="btn btn-warning btn-block ripple m-t-10" id="words">
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

	<div class="modal fade" id="Conv-Transaksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="margin-right: 5px">
					<h5 class="modal-title" id="exampleModalLabel">Pilihan</h5>
				</div>
				<div class="modal-body">
					<div class="col-md-12 mt-4">
						<a href="<?php echo base_url() ?>stok/Pemesanan/convertExcelBerjalan" target="_blank" class="btn btn-warning btn-block ripple m-t-10" id="excel" >
							<i class="fa fa-file-excel-o pr-2"></i>Convert Excel
						</a>
					</div>
					<div class="col-md-12 mt-4">
						<a href="<?php echo base_url() ?>stok/Pemesanan/convertPDFBerjalan" target="_blank" class="btn btn-warning btn-block ripple m-t-10" id="pdf">
							<i class="fa fa-file-pdf-o pr-2"></i>Convert PDF
						</a>
					</div>
					<div class="col-md-12 mt-4 mb-4">
						<a href="<?php echo base_url() ?>stok/Pemesanan/convertWordBerjalan" target="_blank"  class="btn btn-warning btn-block ripple m-t-10" id="words">
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
<script>
	var plugin_path = '<?php echo base_url()?>assets/admin/js/';

</script>

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
	$(document).ready(function () {
		// Format mata uang.
		$('.money').mask('000.000.000.000.000', {
			reverse: true
		});

	})

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
<script>
	function ckurir(num) {
		let value = parseInt($('#changeKurir' + num).html())
		$.ajax({
			method: "POST",
			url: "<?= base_url() ?>stok/Pemesanan/PemesananByKurir",
			data: {
				id_kurir: parseInt($('#changeYear' + num).html())
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
			}
		});
		
	}

</script>
<?php else:?>
<?php endif;?>