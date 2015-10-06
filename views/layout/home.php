

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
                            <div class="small-box bg-white home_back1">
                                <div class="inner">
                                    <h3>
                                        <?= $date_now ?>
                                    </h3>
                                    <p>
                                       Tanggal
                                    </p>
                                </div>
                                <div class="icon home_icon1">
                                    
                                </div>
                                
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-white home_back2">
                                <div class="inner">
                                    <h3>
                                        <?= $jumlah_penjualan ?>
                                    </h3>
                                    <p>
                                        Jumlah Penjualan
                                    </p>
                                </div>
                                <div class="icon home_icon2">
                                </div>
                               
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-white home_back3">
                                <div class="inner">
                                    <h3>
                                        <?php echo "<span style='font-size:20px'>Rp. </span>".$total_omset ?>
                                    </h3>
                                    <p>
                                        Total Omset 
                                    </p>
                                </div>
                                <div class="icon home_icon3">
                                </div>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-white home_back4" >
                                <div class="inner" style="height:90px;">
                                    <h3 style="font-size:16px;">
                                       <?= $menu_terlaris?>
                                    </h3>
                                    <p>
                                       Menu Terlaris
                                    </p>
                                </div>
                                <div class="icon home_icon4">
                                   
                                </div>
                              
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <div class="row">
                    <div class="col-xs-12">
                   <img src="../img/new/home.jpg" style="width:100%;" />
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
                
       