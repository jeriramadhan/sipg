<?php if ($action == 'view' || empty($action)){ ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">unit</h1>
    </div>
                <!-- /.col-lg-12 -->
</div>
	<div class="row">
       <!-- /.col-lg-6 -->
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Unit
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <a href="<?php echo base_url();?>admin/unit/tambah" class="btn btn-lg btn-success">Tambah Unit</a><br><br>
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID Unit</th>
                                        <th>Nama Unit</th>
                                        <th>Deskripsi</th>
                                        <th>Logo</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php   
                            $query = $this->db->query("SELECT * FROM t_unit ORDER BY unit_id");
                            foreach ($query->result() as $row){ 
                            ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $row->unit_id; ?></td>
                                        <td><?php echo $row->unit_nama; ?></td>
                                        <td><?php echo $row->unit_desk; ?></td>
                                        <td><img src="<?php echo base_url()."assets/images/peserta/kecil_".$row->unit_logo; ?>"width="100" height="110"/>
                                        <td><a href="<?php echo base_url();?>admin/unit/edit/<?php echo $row->unit_id; ?>"class="btn btn-lg btn-info btn-xs">Edit</a> <a href="<?php echo base_url();?>admin/unit/hapus/<?php echo $row->unit_id; ?>"class="btn btn-lg btn-danger btn-xs">Hapus</a></td>
                                    </tr>
                              <?php } ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
	</div>

<?php } elseif ($action == 'tambah') { ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Penambahan Unit</h1>
    </div>
                <!-- /.col-lg-12 -->
</div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Unit
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
                                    <form role="form" action="<?php echo base_url();?>admin/unit/tambah" method="post" enctype="multipart/form-data" data-parsley-validate="">
                                        <div class="form-group">
                                            <label>Nama Unit<span class="required">*</span></label>
                                            <input type="text" value=""  name="unit_nama" id="unit_nama" required="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi <span class="required">*</span></label>
                                            <!--<input type="textarea" value=""  name="unit_desk" id="unit_desk" required="" class="form-control">-->
                                            <textarea class="form-control" value=""  name="unit_desk" id="unit_desk" required="" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Logo <span class="required">*</span></label>
                                            <input type="file" name="unit_logo" value="<?php echo $unit_logo;?>" id="unit_logo" required="" class="form-control"><?php echo $unit_logo;?></fi>
                                        </div>
                                        <div class="form-group">
                                			<input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
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
<?php } elseif ($action == 'edit') { ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Unit</h1>
    </div>
                <!-- /.col-lg-12 -->
</div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Unit
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
                                    <form role="form" action="<?php echo base_url();?>admin/unit/edit" method="post" enctype="multipart/form-data" data-parsley-validate="">
                                        <input type="hidden" name="unit_id" value="<?php echo $unit_id;?>" />
                                        <div class="form-group">
                                            <label>Nama Unit <span class="required">*</span></label>
                                            <input type="text" name="unit_nama" value="<?php echo $unit_nama;?>" id="unit_nama" required="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi <span class="required">*</span></label>
                                            <textarea name="unit_desk" value="<?php echo $unit_desk;?>" id="unit_desk" required="" class="form-control"><?php echo $unit_desk;?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Logo <span class="required">*</span></label>
                                            <input type="file" name="unit_logo" value="<?php echo $unit_logo;?>" id="unit_logo" required="" class="form-control"><?php echo $unit_logo;?></fi>
                                        </div>
                                        <div class="form-group">
                                			<input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
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
<?php } ?>