<div class="content-wrapper">
    <div class="page-title">
      <div class="row">
          <div class="col-sm-6">
              <h4 class="mb-0"><?= $title_view ?>
              <span id="thun">
              </span>
              </h4>              
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
              <li class="breadcrumb-item"><?=$title_view?></a></li>
            </ol>
          </div>
        </div>
    </div>

    <!-- main body --> 
    <div class="row">   
      <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">

          
    <div class="col-xl-12 mb-10" style="display: flex">
						<div class="container">
							<h7 class="mb-0">Cari Berdasarkan Tanggal : </h7>
							<br>
							<form id="formsearch" method="post">
								<input class="sd" style="width:142px;" type="date" class="form-control" name="start" id="s">
								<input class="ed" style="width:142px;" type="date" class="form-control" name="end" id="e">
								<button type="submit" class="btn btn-secondary"><i class="fa fa-search"
										aria-hidden="true"></i></button>
							</form>
						</div>
						<div class="btn-group mt-4 mr-5">
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
    </div>

    <div id="parent">

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
    </div>
  </div>   
</div>
</div>
    </div>

    
<!--=================================
 footer -->
 
    <footer class="bg-white p-4">
      <div class="row">
        <div class="col-md-6">
          <div class="text-center text-md-left">
              <p class="mb-0"> &copy; Copyright <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span>. <a href="#"> Webmin </a> All Rights Reserved. </p>
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


<script>
	function cyear(num) {
		let value = parseInt($('#changeYear' + num).html())
		$.ajax({
			method: "POST",
			url: "<?= base_url() ?>owner/Barang/historyPemesananByTahun?stts=<?= $st ?>",
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
	$('#formsearch').submit(function (e) {
		$.ajax({
			method: "POST",
			url: "<?= base_url() ?>owner/Barang/historyPemesananByTanggal?stts=<?= $st ?>",
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
	var e = document.getElementsByClassName("sd");
	$('.sd').on('change', function () {
		var date = new Date($(this).val());
		days = date.getDate();
		months = date.getMonth() + 1;
		years = date.getFullYear();
	});

	var e = document.getElementsByClassName("ed");
	$('.ed').on('change', function () {
		var date = new Date($(this).val());
		daye = date.getDate();
		monthe = date.getMonth() + 1;
		yeare = date.getFullYear();
		if (years > yeare) {
			alert("Tanggal tidak valid (Start date > End date)");
			$(this).val('');
		} else if ((years == yeare) && (months > monthe)) {
			alert("Tanggal tidak valid (Start date > End date)");
			$(this).val('');
		} else if ((days > daye) && (years == yeare) && (months == monthe)) {
			alert("Tanggal tidak valid (Start date > End date)");
			$(this).val('');
		}
	});

</script>


<script type="text/javascript">
	var e = document.getElementsByClassName("ed");
	$('.ed').on('change', function () {
		var date = new Date($(this).val());
		daye = date.getDate();
		monthe = date.getMonth() + 1;
		yeare = date.getFullYear();
	});

	var e = document.getElementsByClassName("sd");
	$('.sd').on('change', function () {
		var date = new Date($(this).val());
		days = date.getDate();
		months = date.getMonth() + 1;
		years = date.getFullYear();
		if (years > yeare) {
			alert("Tanggal tidak valid (Start date > End date)");
			$(this).val('');
		} else if ((years == yeare) && (months > monthe)) {
			alert("Tanggal tidak valid (Start date > End date)");
			$(this).val('');
		} else if ((days > daye) && (years == yeare) && (months == monthe)) {
			alert("Tanggal tidak valid (Start date > End date)");
			$(this).val('');
		}
	});

</script>

<script type="text/javascript">
  $(document).ready(function(){
    // Format mata uang.
    $( '.money' ).mask('000.000.000.000.000', {reverse: true});

  })
</script>

<script type="text/javascript">
  $(document).ready(function(){
  var i=1;
  $('#add').click(function(){
    i++;
    $('#dynamic_field').append('<div class="row" id="row'+i+'"><div class="col-md-2"><label class="control-label" for="harga">Min.qty</label><input class="form-control" type="number" min=1 name="minqty[]" ></div><div class="col-md-2"><label class="control-label" for="harga">Max.qty</label><input class="form-control" type="number" min=1 name="maxqty[]"></div><div class="col-md-5"><label class="control-label" for="harga">Harga</label><input class="form-control money" type="text" name="harga[]"></div><div class="col-md-2 mt-30"><button type="button" id="'+i+'" class="btn btn-danger btn-block btn_remove">Delete</button></div></div>');
  });
  
  $(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id"); 
    $('#row'+button_id+'').remove();
  });
  
  $('#submit').click(function(){    
    $.ajax({
      url:"<?php echo base_url()?>owner/Barang",
      method:"POST",
      data:$('#add_name').serialize(),
      success:function(data)
      {
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
                    text: "Data Harian berhasil Diupdate.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    loader: true,        // Change it to false to disable loader
                    loaderBg: '#ffffff',
                    position: 'top-right',
                    bgColor: '#00C9E6'
                });
        </script>
<?php elseif($this->session->flashdata('msg')=='success'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Berhasil tambah data barang reseller",
                    showHideTransition: 'slide',
                    icon: 'info',
                    loader: true,        // Change it to false to disable loader
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
                    loader: true,        // Change it to false to disable loader
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
                    loader: true,        // Change it to false to disable loader
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
                    loader: true,        // Change it to false to disable loader
                    loaderBg: '#ffffff',
                    position: 'top-right',
                    bgColor: '#7EC857'
                });
        </script>
<?php elseif($this->session->flashdata('msg')=='delete'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Delete',
                    text: "Barang berhasil didelete",
                    showHideTransition: 'slide',
                    icon: 'info',
                    loader: true,        // Change it to false to disable loader
                    loaderBg: '#ffffff',
                    position: 'top-right',
                    bgColor: 'red'
                });
        </script>
<?php else:?>
<?php endif;?>
