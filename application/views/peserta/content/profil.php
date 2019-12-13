<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Profil</h1>
    </div>
                <!-- /.col-lg-12 -->
</div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Profil
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
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
                                    <form role="form" action="<?php echo base_url();?>home/profil/edit/" method="post" enctype="multipart/form-data" data-parsley-validate="">
                                    <input type="hidden" name="peserta_npm" value="<?php echo $peserta_npm; ?>" />

                                        <div class="form-group">
                                            <label>NPM <span class="required">*</span></label>
                                            <input type="text" readonly class="form-control" value="<?php echo $peserta_npm; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Password <span class="required">*</span></label>
                                            <input type="password"  name="peserta_password" id="peserta_password" class="form-control" value=""> <span class="required">*</span>kosongkan bila password tidak diubah.
                                        </div>
                                        <div class="form-group">
                                            <label>Nama <span class="required">*</span></label>
                                            <input type="text"  name="peserta_nama" id="peserta_nama" required="" class="form-control" value="<?php echo $peserta_nama; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>E-mail <span class="required">*</span></label>
                                            <input type="email"  name="peserta_email" id="peserta_email" required="" class="form-control" value="<?php echo $peserta_email; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Kelas <span class="required">*</span></label>
                                            <input type="text"  name="peserta_kelas" id="peserta_kelas" required="" class="form-control" value="<?php echo $peserta_kelas; ?>">
                                        </div>
                                        <?php if ($peserta_foto){?>
                                        <div class="form-group">
                                            <img src="<?php echo base_url(); ?>assets/images/peserta/<?php echo $peserta_foto; ?>" style="width:80px;"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Ganti Foto</label>
                                            <input type="file" name="peserta_foto" accept="image/jpeg, image/png" class="form-control">
                                        </div>
                                        <?php } else { ?>
                                        <div class="form-group">
                                            <label>Foto</label>
                                            <input type="file" name="peserta_foto" accept="image/jpeg, image/png" class="form-control">
                                        </div>
                                        <?php } ?>
                                        <div class="form-group">
                                			<input type="submit" class="btn btn-primary" name="simpan" value="Edit Profil">
								</div>
								</form>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
            </div>