<html lang="en">
<head>
    <title>Input Data Kunjungan</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</head>
<body>

<div>
     <form action="action.php" method="post" enctype="multipart/form-data">
     <div class="form-group">
	    <label type="text" class="control-label">Nama Tahanan</label>
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
<br>

                            <label>Nama Pembesuk:</label>
                            <input type="text" name="nama_pembesuk" required/><br>
                            <label>Tanggal Kunjungan:</label>
                            <br>
                            <input type="date" name="tgl_kunjungan" required/><br>
                            <br>
                            <label>Alamat:</label>
                            <input type="text" name="alamat" required/><br>
                            <label>Barang Diberikan:</label>
                            <input type="text" name="barang_diberikan" required/><br>
                            <label>Kasus:</label>
                            <input type="text" name="kasus" required/><br>
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
                                    </script><br>
                                    </div>
                            <div class="form-group">
                            <input type="submit" name="register" value="submit" />
                            </div>         

        </form>
</body>
</html>
