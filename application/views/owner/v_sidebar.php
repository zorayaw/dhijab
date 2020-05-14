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
            <li> <a href="<?php echo base_url()?>owner/Barang">Barang </a> </li>
            <li> <a href="<?php echo base_url()?>owner/Barang/Reseller">Kategori Barang</a> </li>
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#historyordersemua">
            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">History Order Semua</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="historyordersemua" class="collapse" data-parent="#sidebarnav">
            <li>
              <a href="<?php echo base_url()?>admin/Pemesanan"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Semua</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananAllByBulan/viewPemesananByBulan/1"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Januari</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananAllByBulan/viewPemesananByBulan/2"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Februari</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananAllByBulan/viewPemesananByBulan/3"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Maret</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananAllByBulan/viewPemesananByBulan/4"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering April</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananAllByBulan/viewPemesananByBulan/5"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Mei</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananAllByBulan/viewPemesananByBulan/6"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Juni</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananAllByBulan/viewPemesananByBulan/7"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Juli</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananAllByBulan/viewPemesananByBulan/8"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Agustus</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananAllByBulan/viewPemesananByBulan/9"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering September</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananAllByBulan/viewPemesananByBulan/10"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Oktober</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananAllByBulan/viewPemesananByBulan/11"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering November</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananAllByBulan/viewPemesananByBulan/12"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Desember</span> </a>
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
              <a href="<?php echo base_url()?>admin/PemesananCustomer"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer </span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananCustomerByBulan/viewPemesananByBulan/1"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Januari</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananCustomerByBulan/viewPemesananByBulan/2"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Februari</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananCustomerByBulan/viewPemesananByBulan/3"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Maret</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananCustomerByBulan/viewPemesananByBulan/4"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer April</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananCustomerByBulan/viewPemesananByBulan/5"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Mei</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananCustomerByBulan/viewPemesananByBulan/6"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Juni</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananCustomerByBulan/viewPemesananByBulan/7"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Juli</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananCustomerByBulan/viewPemesananByBulan/8"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Agustus</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananCustomerByBulan/viewPemesananByBulan/9"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer September</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananCustomerByBulan/viewPemesananByBulan/10"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Oktober</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananCustomerByBulan/viewPemesananByBulan/11"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer November</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananCustomerByBulan/viewPemesananByBulan/12"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Customer Desember</span> </a>
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
              <a href="<?php echo base_url()?>admin/PemesananReseller/"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller </span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananResellerByBulan/viewPemesananByBulan/1"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Januari</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananResellerByBulan/viewPemesananByBulan/2"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Februari</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananResellerByBulan/viewPemesananByBulan/3"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Maret</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananResellerByBulan/viewPemesananByBulan/4"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller April</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananResellerByBulan/viewPemesananByBulan/5"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Mei</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananResellerByBulan/viewPemesananByBulan/6"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Juni</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananResellerByBulan/viewPemesananByBulan/7"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Juli</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananResellerByBulan/viewPemesananByBulan/8"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Agustus</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananResellerByBulan/viewPemesananByBulan/9"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller September</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananResellerByBulan/viewPemesananByBulan/10"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Oktober</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananResellerByBulan/viewPemesananByBulan/11"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller November</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananResellerByBulan/viewPemesananByBulan/12"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Reseller Desember</span> </a>
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
              <a href="<?php echo base_url()?>admin/PemesananProduksi/"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi </span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananProduksiByBulan/viewPemesananByBulan/1"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Januari</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananProduksiByBulan/viewPemesananByBulan/2"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Februari</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananProduksiByBulan/viewPemesananByBulan/3"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Maret</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananProduksiByBulan/viewPemesananByBulan/4"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi April</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananProduksiByBulan/viewPemesananByBulan/5"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Mei</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananProduksiByBulan/viewPemesananByBulan/6"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Juni</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananProduksiByBulan/viewPemesananByBulan/7"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Juli</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananProduksiByBulan/viewPemesananByBulan/8"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Agustus</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananProduksiByBulan/viewPemesananByBulan/9"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi September</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananProduksiByBulan/viewPemesananByBulan/10"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Oktober</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananProduksiByBulan/viewPemesananByBulan/11"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi November</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>admin/PemesananProduksiByBulan/viewPemesananByBulan/12"><i class="ti-calendar"></i><span class="right-nav-text">History Ordering Produksi Desember</span> </a>
            </li>
        </ul>
      </li>
      <li>

      <a href="javascript:void(0);" data-toggle="collapse" data-target="#historyinputdata">
          <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">History Input Data</span></div>
          <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
      </a>
      <ul id="historyinputdata" class="collapse" data-parent="#sidebarnav">
          <li>
            <a href="<?php echo base_url()?>owner/Barang/historyPemesananCustomer"><i class="ti-calendar"></i><span class="right-nav-text">Input Data Customer </span> </a>
          </li>
          <li>
            <a href="<?php echo base_url()?>owner/Barang/historyPemesananReseller"><i class="ti-calendar"></i><span class="right-nav-text">Input Data Reseller</span> </a>
          </li>
          <li>
            <a href="<?php echo base_url()?>owner/Barang/historyPemesananProduksi"><i class="ti-calendar"></i><span class="right-nav-text">Input Data Produksi</span> </a>
          </li>
      </ul>
    </li>
    <li>
      <a href="javascript:void(0);" data-toggle="collapse" data-target="#LaporanKeu">
            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Data Keuangan</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>

        <ul id="LaporanKeu" class="collapse" data-parent="#sidebarnav">
            <li>
              <a href="<?php echo base_url()?>owner/Keuangan?status=0"><i class="ti-files"></i><span class="right-nav-text">Data Keuangan</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>owner/Keuangan?status=1"><i class="ti-files"></i><span class="right-nav-text">Data Keuangan Customer</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>owner/Keuangan?status=2"><i class="ti-files"></i><span class="right-nav-text">Data Keuangan Reseller</span> </a>
            </li>
            <li>
              <a href="<?php echo base_url()?>owner/Keuangan?status=3"><i class="ti-files"></i><span class="right-nav-text">Data Keuangan Produksi</span> </a>
            </li>
        </ul>
      </li>
        <li>
          <a href="<?php echo base_url()?>stok/Stock"><i class="ti-calendar"></i><span class="right-nav-text">Stock</span> </a>
        </li>

        <li>
          <a href="<?php echo base_url()?>admin/Pemesanan/konfirmasi_pesanan"><i class="ti-calendar"></i><span class="right-nav-text">Konfirmasi Pesanan</span> </a>
        </li>
       
        <li>
          <a href="<?php echo base_url()?>stok/Pemesanan/Kurir"><i class="ti-calendar"></i><span class="right-nav-text">Tagihan Ekspedisi</span> </a>
        </li>
        <!-- <li>
          <a href="<?php echo base_url()?>owner/Transaksi"><i class="ti-calendar"></i><span class="right-nav-text">History Transaksi</span> </a>
        </li>
        <li>
          <a href="<?php echo base_url()?>owner/Barang/pemesanan"><i class="ti-world"></i><span class="right-nav-text">Pemesanan</span> </a>
        </li>
        <li>
          <a href="<?php echo base_url()?>owner/Stock"><i class="ti-calendar"></i><span class="right-nav-text">History Stock</span> </a>
        </li>
        <li>
          <a href="<?php echo base_url()?>owner/User"><i class="ti-calendar"></i><span class="right-nav-text">Data Keuangan</span> </a>
        </li>
        <li>
          <a href="<?php echo base_url()?>owner/User"><i class="ti-user"></i><span class="right-nav-text">User</span> </a>
        </li> -->
    </ul>
  </div> 
</div>
<!-- Left Sidebar End-->