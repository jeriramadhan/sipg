<!DOCTYPE html>
<html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<body>

<h3>Form Input Data Penunjung</h3>

<div>
  <form action="action.php">
  <label>Nama Tahanan</label>
         <select name="kode_tahanan">
			 <?php
          $conn = new mysqli('localhost', 'root', '', 'kepolisian') or die ('Cannot connect to db');

	 $result = $conn->query("select kode_tahanan, nama_tahanan from dlmbg_tahanan");

    // echo "<select name='nama_tahanan'>";
   $select_attribute = '';
  
    while ($row = $result->fetch_assoc()) {

                  unset($kode_tahanan, $nama_tahanan);
                  $kode_tahanan = $row['kode_tahanan'];
                  $nama_tahanan = $row['nama_tahanan']; 
                  echo '<option value="'.$kode_tahanan.'">'.$nama_tahanan.'</option>';

}
// echo "</select>";


?> 
</select>

    <label for="nama_pembesuk">Nama Pembesuk </label>
    <input type="text" id="nama_pembesuk" name="nama_pembesuk" placeholder="Nama Anda">

    <label for="tgl_kunjungan">Tanggal Kunjungan </label>
    <br>
    <br>
    <input type="date" id="tgl_kunjungan" name="tgl_kunjungan" placeholder="Tanggal Kunjungan">

    <br>
    <br>

    <label for="alamat">Alamat </label>
    <input type="text" id="alamat" name="alamat" placeholder="Alamat Anda">

    <label for="barang_diberikan">Barang Diberikan </label>
    <input type="text" id="barang_diberikan" name="barang_diberikan" placeholder="Barang Diberikan">

    <label for="kasus">Kasus </label>
    <input type="text" id="kasus" name="kasus" placeholder="Kasus">

    <label>Foto:</label>  <br>                          
                            <input type="file" name="foto" id="profile-img" required/><br>
                                    <img src="" id="profile-img-tag" width="100px" />

                                    <script type="text/javascript">
                                        function readURL(input) {
                                            if (input.files && input.files[0]) {
                                                var reader = new FileReader();
                                                
                                                reader.onload = function (e) {
                                                    $('#profile-img-tag').attr('src', e.target.result);
                                                }
                                                reader.readAsDataURL(input.files[0]);
                                            }
                                        }
                                        $("#profile-img").change(function(){
                                            readURL(this);
                                        });
                                    </script>
  
    <input type="submit" value="submit" name="register">
  </form>
</div>

</body>
</html>
