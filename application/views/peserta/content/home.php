 <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Home</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        Selamat datang <b><?php echo $peserta->pst_nama; ?></b>, di Sistem Informasi Pendaftaran Gedung G UNJ!
                    </div>
                       <!-- ========== Flashdata ========== -->
                          <?php if ($this->session->flashdata('success') || $this->session->flashdata('warning') || $this->session->flashdata('error')) { ?>
                              <?php if ($this->session->flashdata('success')) { ?>
                                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <i class="fa fa-check sign"></i><?php echo $this->session->flashdata('success'); ?>
                                  </div>
                              <?php } else if ($this->session->flashdata('warning')) { ?>
                                  <div class="alert alert-warning">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <i class="fa fa-check sign"></i><?php echo $this->session->flashdata('warning'); ?>
                                  </div>
                              <?php } else { ?>
                                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <i class="fa fa-warning sign"></i><?php echo $this->session->flashdata('error'); ?>
                                  </div>
                              <?php } ?>
                          <?php } ?>
                    <!-- ========== End Flashdata ========== -->
                </div>

            </div>
            <div class="row">
                 <?php                     
                     $query = $this->db->query("SELECT * FROM t_unit order by unit_id");
                                 foreach ($query->result() as $row1){
                ?>

                 <div class="col-md-3 col-sm-3 col-xs-6">
                    
                    <form role="form" action="<?php echo base_url();?>peserta/home/tambah" method="post">
                            <input type="hidden" name="unit_id" value="<?php echo $row1->unit_id;?>" />
                    <div class="dashboard-div-wrapper bk-clr-three">
                        <img src="<?php echo base_url()."assets/images/peserta/kecil_".$row1->unit_logo; ?>" width="100" height="85" />
                        <br>
                        <br>
                        <div class="progress progress-striped active">
                          <div class="progress-bar progress-bar-danger" >
                          </div>
                         </div>
                            <?php           
                            $a = $row1->unit_id;   
                            $queryD = $this->db->query("SELECT * FROM t_deadline WHERE unit_id='$a'");
                            foreach ($queryD->result() as $row){
                            date_default_timezone_set('Asia/Jakarta'); 
                            $s=date("Y-m-d h:i:s");
                              if ($row->deadline_tgl<$s) {
                            ?>
                              <a class="btn btn-danger btn-ls">SUDAH DITUTUP</a></center><br>
                            <?php } else {  ?>
                              <input type="submit" class="btn btn-primary btn-ls"  name="simpan" value="Daftar <?php echo $row1->unit_nama;?>"></center><br>
                            <?php } }  ?>
                            <br>   
                              <a class="btn btn-warning btn-ls" data-toggle="modal" data-target="#myModal<?php echo $row1->unit_id;?>">Pendaftaran <?php echo $row1->unit_nama;?>
                            </a>
                    </div>  
                </form>
                                <!--  Modals-->
                            <div class="modal fade" id="myModal<?php echo $row1->unit_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Deskripsi</h4>
                                        </div>
                                        <div class="modal-body">
                                         <?php echo $row1->unit_desk; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                     <!-- End Modals-->

                    </a>
                </div>
                <?php } ?>
            </div>
           