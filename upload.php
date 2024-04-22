<?PHP 
include('header.php'); 
?>
<!--Menyatakan pembolehubah untuk css-->
<style>
#para1 {
    font-family: comic;
    font-size: 25px;
    color: dimgrey;
}
a:link, a:visited {
  background-color: lightseagreen;
  color: lightcyan;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}
a:hover, a:active {
  background-color: darkturquoise;
}
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 15px;
  padding: 20px;
  width: 150px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
#para2 {
    font-family: arial;
    font-size: 20px;
    color: chocolate;
}
</style>
<!-- bahagian form untuk upload fail mula -------------------------------------------------------- -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<div class="w3-container">
  <div class="w3-panel w3-padding-small w3-pale-green w3-bottombar w3-round-xlarge w3-topbar w3-border-green w3-border">
<p id='para1'>Muat Naik Data Ahli Secara Pukal</p>
</div>
</div>
<a href='menuutama.php'> Menu Utama </a><br>
<form method='POST' action='upload.php' enctype='multipart/form-data'>
<p id='para2'>Pilih Fail txt untuk di import :</p>
<input type='file' name='file' required/><button type='submit' name='btn-upload'>Muat Naik</button>
</form>
<!-- bahagian form untuk upload fail tamat ------------------------------------------------------- -->

<!-- bahagian mendapatkan data dari fail dan menyimpanya dalam jadual ahli mula ------------------ -->
<?PHP
//menguji kewujudan fail yang di POST
if (isset($_POST['btn-upload']))
{
    //memanggil fail connection
    include('connection.php');

    $namafailsementara=$_FILES["file"]["tmp_name"];
    //mengambil nama fail

    $namafail=$_FILES['file']['name'];
    //mengambil jenis fail
    $jenisfail=pathinfo($namafail,PATHINFO_EXTENSION);
    
    //menguji jenis fail dan saiz fail
    if($_FILES["file"]["size"]>0 AND $jenisfail=="txt")
    {
      //membuka fail yang diambil
      $failyangdataingindiupload=fopen($namafailsementara,"r");

      //mendapatkan datafail
      while (!feof($failyangdataingindiupload)) 
      {   
      //mengambil data sebaris sahaja bg setiap pusingan
      $ambilbarisdata = fgets($failyangdataingindiupload);

      //memecahkan baris data mengikut tanda koma
      $pecahkanbaris = explode("|",$ambilbarisdata);

      //selepas pecahan tadi akan diumpukan kepada 3 pemboleh ubah
      list($nokp,$nama,$id_kelas,$id_kategori) = $pecahkanbaris;
                    
      //memasukkan data kedalam jadual peminjaman
      $result=mysqli_query($condb, "insert into ahli (nokp_murid,nama_murid,id_kelas,id_kategori)
      values
      ('$nokp','$nama','$id_kelas','$id_kategori')");
                
      echo"<script>alert('import fail data berjaya.');
      window.location.href='ahli_senarai.php';</script>";            
      }
                
    fclose($failyangdataingindiupload);
}
    else
    {
        echo"<script>alert('hanya fail berformat txt sahaja dibenarkan');</script>";
    }

    mysqli_close($condb);
}
?>
<!-- bahagian mendapatkan data dari fail dan menyimpanya dalam jadual ahli tamat ----------------- -->

<?PHP
include('footer.php');
?>