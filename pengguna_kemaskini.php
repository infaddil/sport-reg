<?PHP 
include('header.php'); 
?>
<style>
#para1 {
    font-family: comic;
    font-size: 25px;
    color: dimgrey;
}
</style>
<!-- (PHP) bahagaian mengambil data mula-->
<?PHP
//Memanggil fail connection.php
include('connection.php');

//Mengambil data GET
$nokpG=$_GET['nokp'];

//Mencari data dipangkalan data
$sqlcari=mysqli_query($condb,"select* from pengguna where nokp='$nokpG'");

//Mengambil data yang di cari
$data=mysqli_fetch_array($sqlcari);

?>
<!-- (PHP) bahagaian mengambil data tamat -------------------------------------- -->

<!-- (html + PHP) bahagian form yang mempunyai data mula ----------------------- -->

<!--Menyediakan borang dan memaparkan data yang di L4-->
<form action='pengguna_kemaskini.php?nokp=<?PHP echo $nokpG; ?>' method='POST'>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<div class="w3-container">
  <div class="w3-panel w3-padding-small w3-pale-green w3-bottombar w3-round-xlarge w3-topbar w3-border-teal w3-border">
<p id='para1'>Kemaskini data pengguna</p>
</div>
</div>

| <a href='menuutama.php'>Menu Utama</a> | | <a href='pengguna_senarai.php'>Senarai Pengguna</a> |
<p>Sila lengkapkan maklumat di bawah</p>
<fieldset style="width:85%">
    <legend>Kemaskini Data Pengguna</legend>

<table  width='40%'>
    <tr>
        <td align='right' width='50%' >Nama :</td>
        <td><input type='text' name='nama' value="<?PHP echo $data['nama'];?>" required></td>
    </tr>
    
    <tr>
        <td align='right' >Nokp :</td>
        <td><input type='text' name='nokp' maxlength='12'value="<?PHP echo $data['nokp'];?>" required></td>
    </tr>
     
    <tr>
        <td align='right' >tahap :</td>
        <td>
        <select name='tahap' required>
        <option value="<?PHP echo $data['tahap'];?>"><?PHP echo $data['tahap'];?></option>
        <option value='aktif'>admin</option>
        <option value='aktif'>aktif</option>
        <option value='tidak'>tidak</option>
        </select>
        </td>
    </tr>

    <tr>
        <td></td>
        <td><input type='submit' value='Kemaskini'></td>
    </tr>

</table>
</form>
<!-- (html + PHP) bahagian form yang mempunyai data tamat ---------------------- -->

<!-- (PHP) bahagian mengemaskini data mula ------------------------------------- -->
<?PHP

//Menguju kewujudan data POST
if(!empty($_POST))
{
    //Mengambil data yang diPOST
    $nama=$_POST['nama'];
    $nokp=$_POST['nokp'];
    $tahap=$_POST['tahap'];
     
    //Data validation

    //Menguji format NoKP
    if(strlen($nokp)!=12 or !is_numeric($nokp))
    {
        echo"<script>alert('Ralat pada NoKP'); window.history.back();</script>";
    }
    
    //Mengelakkan dari pengguna meng disable kan akaun sendiri
    if($tahap=='tidak' and $nokp==$_SESSION['nokp_pengguna']){
        die("<script>alert('Anda tidak dibenarkan nyahaktif diri sendiri'); 
        window.history.back();</script>");
        }
    
    //Melaksanakan proses mengemaskini data
    if(mysqli_query($condb,"update pengguna set nama='$nama', nokp='$nokp', tahap='$tahap' where nokp='$nokpG' "))
    {   
        //Jika berjaya, papar msg dan kembali ke fail pengguna_senarai.php
        echo"<script>alert('Kemaskini berjaya.'); 
        window.location.href='pengguna_senarai.php';</script>";
    }
    else
    { 
        //Jika Gagal, Papar msg dan kembali ke privious page
        echo"<script>alert('Kemaskini tidak berjaya.'); 
       window.history.back();
        </script>";
    } 

mysqli_close($condb);
}

?>
<!-- (PHP) bahagian mengemaskini data tamat ------------------------------------ -->

<?PHP 
include('footer.php'); 
?>