

                <?php
                if(isset($_GET['did']) && $_GET['did'] == 1){
                ?>
                <section class="content_new">
                   
                <div class="alert alert-info alert-dismissable">
                <i class="fa fa-check"></i>
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <b>Sukses !</b>
               Simpan Berhasil
                </div>
           
                </section>
                <?php
                }else if(isset($_GET['did']) && $_GET['did'] == 2){
                ?>
                <section class="content_new">
                   
                <div class="alert alert-info alert-dismissable">
                <i class="fa fa-check"></i>
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <b>Sukses !</b>
               Edit Berhasil
                </div>
           
                </section>
                <?php
                }else if(isset($_GET['did']) && $_GET['did'] == 3){
                ?>
                <section class="content_new">
                   
                <div class="alert alert-info alert-dismissable">
                <i class="fa fa-check"></i>
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <b>Sukses !</b>
               Delete Berhasil
                </div>
           
                </section>
                <?php
                }
                ?>

                <!-- Main content -->
                <section class="content">
                  
                      <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?= $date_now ?>
                                    </h3>
                                    <p>
                                       Tanggal
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-calendar"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?= $jumlah_penjualan ?>
                                    </h3>
                                    <p>
                                        Jumlah Penjualan
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                   
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?php echo "<span style='font-size:20px'>Rp. </span>".$total_omset ?>
                                    </h3>
                                    <p>
                                        Total Omset 
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                  
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red" >
                                <div class="inner" style="height:90px;">
                                    <h3 style="font-size:16px;">
                                       <?= $menu_terlaris?>
                                    </h3>
                                    <p>
                                       Menu Terlaris
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-android-star"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                   
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <div class="row">
                    <div class="col-xs-12">
                    <img src="" style="width:100%;" />
                    </div>
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body2 table-responsive" style="padding:20px; text-align:center;">
                                   <h2>Hikaru</h2>
                                  <h4>Resto</h4>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                        
                    </div>




                </section><!-- /.content -->
                
       