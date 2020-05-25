
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
  $hasil_rupiah = "Rp" . number_format($angka, 0, ',', '.');
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
                   

<!-- custom -->
<script src="<?php echo base_url()?>assets/admin/js/custom.js"></script>
 