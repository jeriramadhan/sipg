<?php 
    if(isset($_POST['register']))
    {
        $tgl_kunjungan = $_POST['tgl_kunjungan'];
        $kode_tahanan = $_POST['kode_tahanan'];
        $nama_pembesuk = $_POST['nama_pembesuk'];
        $alamat = $_POST['alamat'];
        $barang_diberikan = $_POST['barang_diberikan'];
        $kasus = $_POST['kasus'];
        $foto = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];

        move_uploaded_file($foto_tmp,"images/$foto");

        $con = mysqli_connect("localhost","root","","cops");

        $query = "insert into dlmbg_kunjungan (tgl_kunjungan,kode_tahanan,nama_pembesuk,alamat,barang_diberikan,kasus,foto) values ('$tgl_kunjungan','$kode_tahanan','$nama_pembesuk','$alamat','$barang_diberikan','$kasus','$foto')";

        $result = mysqli_query($con, $query);

        if($result==1)
        {       

            header("Location: index.php");
        
        
        }
        else {       

        echo "Insertion Failed";

             }
    }
?>