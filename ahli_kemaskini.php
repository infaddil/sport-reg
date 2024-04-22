<?PHP 
include('header.php'); 
?>
<!-- (PHP) bahagaian mengambil data mula ---------------------------------------- -->
<?PHP
//L1 : Memanggil fail connection.php
include('connection.php');

//L2 : Mengambil data GET
$nokp=$_GET['nokp'];

//L3 : Mencari data dipangkalan data
$sqlcari=mysqli_query($condb,"select* from ahli where nokp_murid='$nokp'");

//L4 : Mengambil data yang di cari di L3
$data=mysqli_fetch_array($sqlcari);

?>
<!-- (PHP) bahagaian mengambil data tamat -------------------------------------- -->

<!-- (html + PHP) bahagian form yang mempunyai data mula ----------------------- -->

<!-- // L5 : Menyediakan borang dan memaparkan data yang di L4-->
<form action='ahli_kemaskini.php?nokp_murid=<?PHP echo $nokp; ?>' method='POST'>
<h2>Kemaskini Data Pengguna</h2>

| <a href='menuutama.php'>Menu Utama</a> | | <a href='ahli_senarai.php'>Senarai Pengguna</a> |
<p>Sila lengkapkan maklumat di bawah</p>
<fieldset style="width:85%">
    <legend>Kemaskini Data Ahli</legend>

<table  width='40%'>
    <tr>
        <td align='right' width='50%' >Nama :</td>
        <td><input type='text' name='nama_murid' value="<?PHP echo $data['nama_murid'];?>" required></td>
    </tr>
    
    <tr>
        <td align='right' >Nokp :</td>
        <td><input type='text' name='nokp_murid' maxlength='12'value="<?PHP echo $data['nokp_murid'];?>" required></td>
    </tr>
    <tr><tr><td align='center'>
	<td>
		<select name='id_kelas' required>
                <option disabled selected value>Pilih kelas</option>
                <?PHP 
                $sqlkelas=mysqli_query($condb,"SELECT* from kelas");
                while($data=mysqli_fetch_array($sqlkelas))
                {
                    echo"<option value='".$data['id_kelas']."'>
                    ".$data['ting']." ".$data['nama_kelas']."</option>";        
                }
                ?>
        </select>
            </td> 
	</tr></tr> 	
	 <tr><tr><td align='center'> 
            <td>
            <select name='id_kategori' required>
                <option disabled selected value>Pilih kategori</option>
                <?PHP 
                $sqlkategori=mysqli_query($condb,"SELECT* from kategori");
                while($data=mysqli_fetch_array($sqlkategori))
                {
                    echo"<option value='".$data['id_kategori']."'>
                    ".$data['ting']." ".$data['jenis_kategori']."</option>";        
                }
                ?>
            </select>
            </td> 
	</tr></tr>
    <tr>
        <td></td>
        <td><input type='submit' value='Kemaskini'></td>
    </tr>

</table>
</form>
<!-- (html + PHP) bahagian form yang mempunyai data tamat ---------------------- -->

<!-- (PHP) bahagian mengemaskini data mula ------------------------------------- -->
<?PHP

//Langkah 6 : Menguju kewujudan data POST
if(!empty($_POST))
{
  # L2 : mengambil data POST
    $nama=$_POST['nama_murid'];
    $nokp=$_POST['nokp_murid'];
    $id_kelas=$_POST['id_kelas'];
    $id_kategori=$_POST['id_kategori'];
     
    //Langkah 9 : data validation

    //Langkah 9.1 : Menguji format NoKP
     if(strlen($nokp)!=12 or !is_numeric($nokp))
        {
        die("<script>alert('NoKP yang dimasukkan tidak tepat'); window.history.back();</script>");
        }

        # L4 : data validation bagi tahun pada nokp
        $tahunlahir="20".substr($nokp,0,2);
        $tahunsemasa=date("Y");
        $umur=$tahunsemasa-$tahunlahir;
        
        if($umur<=11 OR $umur>=20)
        {
            die("<script>alert('Ralat pada tahun nokp'); window.history.back();</script>");
        }
    
    //Langkah 9.2 : Mengelakkan dari pengguna meng disable kan akaun sendiri
  
    
    //Langkah 10 : Melaksanakan proses mengemaskini data
    if(mysqli_query($condb,"update ahli set nama_murid='$nama', nokp_murid='$nokp', id_kelas='$id_kelas', id_kategori='$id_kategori' where nokp_murid='$nokp' "))
    {   
        //langkah 10.1 : Jika berjaya, papar msg dan kembali ke fail pengguna_senarai.php
        echo"<script>alert('Kemaskini berjaya.'); 
        window.location.href='ahli_senarai.php';</script>";
    }
    else
    { 
        //Langkah 10.2 : Jika Gagal, Papar msg dan kembali ke privious page
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