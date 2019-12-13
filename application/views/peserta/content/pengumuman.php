 <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Pengumuman</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                        <?php  
                        $npm = $peserta->pst_npm;                      
                        $query = $this->db->query("SELECT 
                        t_pendaftaran.pendaftaran_id AS pendaftaran_id,
                        t_pendaftaran.pst_npm AS pst_npm,
                        t_pendaftaran.unit_id AS unit_id,
                        t_pendaftaran.pendaftaran_status AS pendaftaran_status,
                        t_pendaftaran.pendaftaran_tahun AS pendaftaran_tahun,
                        t_peserta.pst_npm AS pst_npm,
                        t_peserta.pst_nama AS pst_nama,
                        t_unit.unit_nama AS unit_nama,
                        t_unit.unit_id AS unit_id
                        FROM t_pendaftaran
                        LEFT JOIN t_peserta ON t_peserta.pst_npm = t_pendaftaran.pst_npm
                        LEFT JOIN t_unit ON t_unit.unit_id = t_pendaftaran.unit_id WHERE t_pendaftaran.pst_npm ='$npm' ORDER BY pendaftaran_tahun ");
                                 foreach ($query->result() as $row){ 
                            ?>
                            <?php if($row->pendaftaran_status == '?'){ ?>
                                        <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <?php echo $peserta->pst_nama; ?> Harap Menunggu, karena Pendaftaran unit <?php echo $row->unit_nama; ?> belum di proses.
                                        <br>
                                        <table>
                                        <tr>
                                            <th>Data</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>ID Pendaftaran</td>
                                            <td><?php echo $row->pendaftaran_id; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td><?php echo $peserta->pst_nama; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Registrasi Mahasiswa</td>
                                            <td><?php echo $peserta->pst_npm; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Unit Yang Di Pilih</td>
                                            <td><?php echo $row->unit_nama; ?></td>
                                        </tr>
                                        
                                        </table>
                                    </div>
                            <?php }elseif($row->pendaftaran_status == 'DITERIMA') { ?>
                                   <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                       Selamat <?php echo $peserta->pst_nama; ?>! Anda<strong> DITERIMA</strong> di unit <?php echo $row->unit_nama; ?>.
                                    </div>
                            <?php }else{ ?>
                                <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        Mohon Maaf, <?php echo $peserta->pst_nama; ?>! Anda <strong>TIDAK DITERIMA</strong> di unit <?php echo $row->unit_nama; ?>.
                                    </div>
                            <?php } ?>          
                        <?php } ?>      
                </div>

            </div>
