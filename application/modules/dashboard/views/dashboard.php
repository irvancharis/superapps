   <div class="main-content">
       <section class="section">
           <div class="row ">
               <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                   <div class="card">
                       <div class="card-statistic-4">
                           <div class="align-items-center justify-content-between">
                               <div class="row ">
                                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                       <div class="card-content">
                                           <h5 class="font-18">Total Transaksi Pengadaan</h5>
                                           <h2 class="mb-3 font-18"><?= $transaksi_pengadaan_total;  ?></h2>
                                           <p class="mb-0"><span class="col-orange"><?= $transaksi_pengadaan_proses;  ?></span> Dalam Proses</p>
                                       </div>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                       <div class="banner-img">
                                           <img src="assets/img/banner/1.png" alt="">
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                   <div class="card">
                       <div class="card-statistic-4">
                           <div class="align-items-center justify-content-between">
                               <div class="row ">
                                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                       <div class="card-content">
                                           <h5 class="font-18"> Total Transaksi Pemindahan</h5>
                                           <h2 class="mb-3 font-18"><?= $transaksi_pemindahan_total;  ?></h2>
                                           <p class="mb-0"><span class="col-orange"><?= $transaksi_pemindahan_proses;  ?></span> Dalam Proses</p>
                                       </div>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                       <div class="banner-img">
                                           <img src="assets/img/banner/2.png" alt="">
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                   <div class="card">
                       <div class="card-statistic-4">
                           <div class="align-items-center justify-content-between">
                               <div class="row ">
                                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                       <div class="card-content">
                                           <h5 class="font-18">Total Transaksi Penghapusan</h5>
                                           <h2 class="mb-3 font-18"><?= $transaksi_penghapusan_total;  ?></h2>
                                           <p class="mb-0"><span class="col-orange"><?= $transaksi_penghapusan_proses;  ?></span> Dalam Proses</p>
                                       </div>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                       <div class="banner-img">
                                           <img src="assets/img/banner/3.png" alt="">
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                   <div class="card">
                       <div class="card-statistic-4">
                           <div class="align-items-center justify-content-between">
                               <div class="row ">
                                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                       <div class="card-content">
                                           <h5 class="font-18">Total Transaksi Opname</h5>
                                           <h2 class="mb-3 font-18"><?= $transaksi_opname_total;  ?></h2>
                                           <p class="mb-0"><span class="col-orange"><?= $transaksi_opname_proses;  ?></span> Dalam Proses</p>
                                       </div>
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                       <div class="banner-img">
                                           <img src="assets/img/banner/4.png" alt="">
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>



           <?php $this->load->view('layout/footer'); ?>