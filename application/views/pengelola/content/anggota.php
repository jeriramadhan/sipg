<?php if ($action == 'view' || empty($action)){ ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Anggota unit</h1>
    </div>
                <!-- /.col-lg-12 -->
</div>
	<div class="row">
       <!-- /.col-lg-6 -->
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Anggota unit
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>peserta NPM</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Tahun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                            $sess_level = $this->session->userdata('pengelola_id');
                            if ($sess_level == 2) {
                            $query = $this->db->query("SELECT * FROM t_pendaftaran p join t_peserta m on p.pst_npm=m.pst_npm where unit_id=1 and pendaftaran_status='diterima' and batas_akhir=0 ");
                            } else if ($sess_level == 3) {
                            $query = $this->db->query("SELECT * FROM t_pendaftaran p join t_peserta m on p.pst_npm=m.pst_npm where unit_id=3 and pendaftaran_status='diterima' and batas_akhir=0 ");
                            }else if ($sess_level == 4) {
                            $query = $this->db->query("SELECT * FROM t_pendaftaran p join t_peserta m on p.pst_npm=m.pst_npm where unit_id=4 and pendaftaran_status='diterima' and batas_akhir=0 ");
                            }else if ($sess_level == 1) {
                            $query = $this->db->query("SELECT * FROM t_pendaftaran p join t_peserta m on p.pst_npm=m.pst_npm where unit_id=2 and pendaftaran_status='diterima' and batas_akhir=0 ");
                            }else if ($sess_level == 5) {
                            $query = $this->db->query("SELECT * FROM t_pendaftaran p join t_peserta m on p.pst_npm=m.pst_npm where unit_id=5 and pendaftaran_status='diterima' and batas_akhir=0 ");
                            }else if ($sess_level == 6) {
                            $query = $this->db->query("SELECT * FROM t_pendaftaran p join t_peserta m on p.pst_npm=m.pst_npm where unit_id=6 and pendaftaran_status='diterima' and batas_akhir=0 ");
                            }else if ($sess_level == 7) {
                            $query = $this->db->query("SELECT * FROM t_pendaftaran p join t_peserta m on p.pst_npm=m.pst_npm where unit_id=7 and pendaftaran_status='diterima' and batas_akhir=0 ");
                            }else if ($sess_level == 8) {
                            $query = $this->db->query("SELECT * FROM t_pendaftaran p join t_peserta m on p.pst_npm=m.pst_npm where unit_id=8 and pendaftaran_status='diterima' and batas_akhir=0 ");
                            }else if ($sess_level == 9) {
                            $query = $this->db->query("SELECT * FROM t_pendaftaran p join t_peserta m on p.pst_npm=m.pst_npm where unit_id=9 and pendaftaran_status='diterima' and batas_akhir=0 ");
                            }else if ($sess_level == 10) {
                            $query = $this->db->query("SELECT * FROM t_pendaftaran p join t_peserta m on p.pst_npm=m.pst_npm where unit_id=10 and pendaftaran_status='diterima' and batas_akhir=0 ");
                            }else if ($sess_level == 11) {
                            $query = $this->db->query("SELECT * FROM t_pendaftaran p join t_peserta m on p.pst_npm=m.pst_npm where unit_id=11 and pendaftaran_status='diterima' and batas_akhir=0 ");
                            }else if ($sess_level == 12) {
                            $query = $this->db->query("SELECT * FROM t_pendaftaran p join t_peserta m on p.pst_npm=m.pst_npm where unit_id=12 and pendaftaran_status='diterima' and batas_akhir=0 ");
                            } else {
                                    $query = $this->db->query("SELECT * FROM t_pendaftaran pn left join t_unit u on pn.unit_id=u.unit_id where u.unit_id=4 and pn.pendaftaran_status = 'diterima' ORDER BY pendaftaran_id ");
                            }
    
                            //$query = $this->db->query("SELECT * FROM t_pendaftaran pn left join t_unit u on pn.unit_id=u.unit_id where u.unit_id=1 ORDER BY pendaftaran_id ");
                            foreach ($query->result() as $row){ 
                            ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $row->pst_npm; ?></td>
                                        <td><?php echo $row->pst_nama; ?></td>
                                        <td><?php echo $row->pendaftaran_status; ?></td>
                                        <td><?php echo $row->pendaftaran_tahun; ?></td>
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
<?php } ?>