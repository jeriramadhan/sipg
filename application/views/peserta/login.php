<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistem Informasi Pendaftaran Gedung G UNJ</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="<?php echo base_url();?>templates/peserta/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="<?php echo base_url();?>templates/peserta/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="<?php echo base_url();?>templates/peserta/assets/css/style.css" rel="stylesheet" />
    <link rel="icon" href="<?php echo base_url();?>assets/images/favicon.png" type="image/gif">
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <strong>Email: </strong>gedung.g@unj.ac.id
                    &nbsp;&nbsp;
                    <strong>Support: </strong>(+62) 888888
                </div>

            </div>
        </div>
    </header>
    <!-- HEADER END-->
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">

                    <img src="<?php echo base_url();?>templates/peserta/assets/img/logo.png" />
                </a>

            </div>

            <div class="left-div login-icon">
        </div>
            </div>
        </div>
    <!-- LOGO HEADER END-->
   
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Silahkan Login</h4>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                              <!-- ========== Flashdata ========== -->
                    <?php if ($this->session->flashdata('warning') || $this->session->flashdata('error')) { ?>
                        <?php if ($this->session->flashdata('warning')) { ?>
                            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-close sign"></i><?php echo $this->session->flashdata('warning'); ?>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-warning sign"></i><?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <!-- ========== End Flashdata ========== -->
                    <form role="form" action="<?php echo base_url();?>peserta/ceklogin" method="post">
                        <label>Username : </label>
                        <input type="text" name="pst_npm" class="form-control" />
                        <label>Password :  </label>
                        <input type="password" name="pst_password" class="form-control" />
                        <hr />
                        <input type="submit" name="masuk" value="Login" class="btn btn-info">
                    </form>
                </div>
                <br />
                <div class="col-md-6">
                    <div class="alert alert-info">
                        <div style='text-align:justify;'>
                        <strong> Info Pendaftaran</strong>
                        <br />
                        <ul>
                            <li>
                            Pendaftaran Dibuka Pada 10 November 2019
                            </li>
                        </ul>
                        </div>
                    </div>
                    <div class="alert alert-success">
                        <div style='text-align:justify;'>
                         <strong> Petunjuk Penggunaan :</strong>
                        <ul>
                            <li>
                                Sebelum melakukan pendaftaran peserta diwajibkan Login terlebih dahulu
                            </li>
                            <li>
                                Setelah Login, peserta bisa mendaftar unit kegiatan mahasiswa yang akan diikuti
                            </li>
                            <li>
                                Selesai Mendaftar, peserta harap menunggu konfirmasi dari pihak unit kegiatan mahasiswa terkait
                            </li>
                        </ul>
                       
                    </div>
                </div>
                </div>
                <div>
                <h5 class="page-head-line"><a href="<?php echo base_url();?>daftar/register.php">Silahkan Mendaftar</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy;  2019 Sistem Informasi Pendaftaran Gedung G UNJ| By : Tim 3 Sekawan 5 INCI Corps
                </div>

            </div>
        </div>
    </footer>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="<?php echo base_url();?>templates/peserta/assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="<?php echo base_url();?>templates/peserta/assets/js/bootstrap.js"></script>
</body>
</html>
