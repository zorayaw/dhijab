<div class="container-fluid">
  <div class="row">
    <!-- Left Sidebar -->
    <div class="side-menu-fixed">
     <div class="scrollbar side-menu-bg">
      <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <!-- menu title -->
         <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Website Components</li>
        <!-- All Form  -->
         <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#Barang">
            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Barang</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="Barang" class="collapse" data-parent="#sidebarnav">
            <li> <a href="<?php echo base_url()?>Owner/Barang">Barang </a> </li>
            <li> <a href="<?php echo base_url()?>Owner/Barang/Reseller">Kategori Barang</a> </li>
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#historyordersemua">
            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">History Order Semua</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="historyordersemua" class="collapse" data-parent="#sidebarnav">
            <li>
              <a href="<?php echo base_url()?>Admin/Pemesanan"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Semua</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananAllByBulan/viewPemesananByBulan/1"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Januari</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananAllByBulan/viewPemesananByBulan/2"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Februari</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananAllByBulan/viewPemesananByBulan/3"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Maret</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananAllByBulan/viewPemesananByBulan/4"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering April</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananAllByBulan/viewPemesananByBulan/5"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Mei</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananAllByBulan/viewPemesananByBulan/6"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Juni</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananAllByBulan/viewPemesananByBulan/7"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Juli</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananAllByBulan/viewPemesananByBulan/8"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Agustus</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananAllByBulan/viewPemesananByBulan/9"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering September</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananAllByBulan/viewPemesananByBulan/10"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Oktober</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananAllByBulan/viewPemesananByBulan/11"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering November</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananAllByBulan/viewPemesananByBulan/12"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Desember</span> </a>
            </li>
        </ul>
      </li>
      <li>
      <a href="javascript:void(0);" data-toggle="collapse" data-target="#historyordercustomersemua">
            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">History Order Customer</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>

        <ul id="historyordercustomersemua" class="collapse" data-parent="#sidebarnav">
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananCustomer"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer </span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananCustomerByBulan/viewPemesananByBulan/1"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Januari</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananCustomerByBulan/viewPemesananByBulan/2"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Februari</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananCustomerByBulan/viewPemesananByBulan/3"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Maret</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananCustomerByBulan/viewPemesananByBulan/4"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer April</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananCustomerByBulan/viewPemesananByBulan/5"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Mei</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananCustomerByBulan/viewPemesananByBulan/6"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Juni</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananCustomerByBulan/viewPemesananByBulan/7"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Juli</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananCustomerByBulan/viewPemesananByBulan/8"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Agustus</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananCustomerByBulan/viewPemesananByBulan/9"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer September</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananCustomerByBulan/viewPemesananByBulan/10"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Oktober</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananCustomerByBulan/viewPemesananByBulan/11"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer November</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananCustomerByBulan/viewPemesananByBulan/12"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Desember</span> </a>
            </li>
        </ul>
      </li>
      <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#historyorderresellersemua">
            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">History Order Reseller</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
        </a>

        <ul id="historyorderresellersemua" class="collapse" data-parent="#sidebarnav">
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananReseller/"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller </span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananResellerByBulan/viewPemesananByBulan/1"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Januari</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananResellerByBulan/viewPemesananByBulan/2"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Februari</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananResellerByBulan/viewPemesananByBulan/3"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Maret</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananResellerByBulan/viewPemesananByBulan/4"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller April</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananResellerByBulan/viewPemesananByBulan/5"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Mei</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananResellerByBulan/viewPemesananByBulan/6"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Juni</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananResellerByBulan/viewPemesananByBulan/7"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Juli</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananResellerByBulan/viewPemesananByBulan/8"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Agustus</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananResellerByBulan/viewPemesananByBulan/9"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller September</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananResellerByBulan/viewPemesananByBulan/10"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Oktober</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananResellerByBulan/viewPemesananByBulan/11"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller November</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananResellerByBulan/viewPemesananByBulan/12"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Desember</span> </a>
            </li>
        </ul>
      </li>


      <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#historyorderProduksisemua">
            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">History Order Produksi</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
        </a>

        <ul id="historyorderProduksisemua" class="collapse" data-parent="#sidebarnav">
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananProduksi/"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi </span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananProduksiByBulan/viewPemesananByBulan/1"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Januari</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananProduksiByBulan/viewPemesananByBulan/2"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Februari</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananProduksiByBulan/viewPemesananByBulan/3"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Maret</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananProduksiByBulan/viewPemesananByBulan/4"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi April</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananProduksiByBulan/viewPemesananByBulan/5"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Mei</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananProduksiByBulan/viewPemesananByBulan/6"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Juni</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananProduksiByBulan/viewPemesananByBulan/7"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Juli</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananProduksiByBulan/viewPemesananByBulan/8"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Agustus</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananProduksiByBulan/viewPemesananByBulan/9"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi September</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananProduksiByBulan/viewPemesananByBulan/10"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Oktober</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananProduksiByBulan/viewPemesananByBulan/11"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi November</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>Admin/PemesananProduksiByBulan/viewPemesananByBulan/12"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Desember</span> </a>
            </li>
        </ul>
      </li>
        <!-- <li>
          <a href="<?php echo base_url()?>Owner/Transaksi"><i class="ti-calendar"></i><span class="right-nav-text">History Transaksi</span> </a>
        </li>
        <li>
          <a href="<?php echo base_url()?>Owner/Barang/pemesanan"><i class="ti-world"></i><span class="right-nav-text">Pemesanan</span> </a>
        </li>
        <li>
          <a href="<?php echo base_url()?>Owner/Stock"><i class="ti-calendar"></i><span class="right-nav-text">History Stock</span> </a>
        </li>
        <li>
          <a href="<?php echo base_url()?>Owner/User"><i class="ti-calendar"></i><span class="right-nav-text">Laporan Keuangan</span> </a>
        </li>
        <li>
          <a href="<?php echo base_url()?>Owner/User"><i class="ti-user"></i><span class="right-nav-text">User</span> </a>
        </li> -->
    </ul>
  </div> 
</div>
<!-- Left Sidebar End-->