<!--Menghubungkan fail dengan connection dan header file-->
<?PHP
include('header.php');
include('connection.php');
?>
<!--Mengisytiharkan pembolehubah css-->
<style>
#para1 {
    font-family: comic;
    font-size: 25px;
    color: darkorchid;
    font-variant: small-caps;
}
#para2 {
    font-family: verdana;
    font-size: 22px;
    color: darkgoldenrod;
}
a:link, a:visited {
  background-color: darkmagenta;
  color: lightcyan;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}
a:hover, a:active {
  background-color: darkturquoise;
}
input[type=text] {
  width: 130px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  background-image: url('searchicon.png');
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
  width: 200px;
}
select {
  width: 100%;
  padding: 16px 20px;
  border: none;
  border-radius: 4px;
  background-color: #f1f1f1;
}
.button {
  display: inline-block;
  padding: 10px 15px;
  font-size: 15px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: hotpink;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.button:hover {background-color: lightpink}

.button:active {
  background-color: lightpink;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
</style>
<!--Kawasan form HTML bermula-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<div class="w3-container">
  <div class="w3-panel w3-padding-small w3-pale-green w3-bottombar w3-round-xlarge w3-topbar w3-border-green w3-border">
<p id='para1'>Senarai ahli yang telah berdaftar</p>
</div>
</div>
<a href='menuutama.php' target="_blank"> Menu utama </a>
<fieldset style="width:85%">
<div class="w3-panel w3-pale-brown w3-leftbar w3-rightbar w3-border-blu">

    <p id='para2'>Pendaftaran Ahli Baru</p>
</div>
    <form action='' method='POST'>
    <table>
        <tr>
    <td align='center'>Nama</td>
    <td align='center'>No K/P</td>

            <td></td>
        <div class="w3-bar">
</div>
        </tr>
        <tr>
            <td><input type='text' name='nama' placeholder='HURUF BESAR' size='35' required></td>
            <td><input type='text' name='nokp' placeholder='Contoh:010203040101' maxlength='12'></td>
            <td>

            <select name='id_kelas' required>
                <option disabled selected value>Kelas</option>
<!--Mengambil baris hasil dari jadual kelas-->
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
            <td>
            <select name='id_kategori' required>
                <option disabled selected value>Pilih kategori</option>
<!--Mengambil baris hasil dari jadual kategori-->
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
            <td><button class='button'<span>Simpan</span></button></td>
        </tr>
    </table>
    </form>
</fieldset>
<!-- Bahagian Form (HTML) Tamat -------------------- -->
<!-- Bahagian Insert data (PHP) mula --------------- -->
<?PHP 
// Menyemak data POST
if(!empty($_POST))
{   
    // Mengambil data POST
  
    $nama=$_POST['nama'];
    $nokp=$_POST['nokp'];
    $id_kelas=$_POST['id_kelas'];
    $id_kategori=$_POST['id_kategori'];
    //------------- data validation ---------------------------------------------------------
        //Data validation bagi no kad pengenalan bilangan digit & wujud aksara
        if(strlen($nokp)!=12 or !is_numeric($nokp))
        {
        die("<script>alert('NoKP yang dimasukkan tidak tepat'); window.history.back();</script>");
        }

        //Data validation bagi tahun pada nokp
        $tahunlahir="20".substr($nokp,0,2);
        $tahunsemasa=date("Y");
        $umur=$tahunsemasa-$tahunlahir;
        
        if($umur<=12 OR $umur>=16)
        {
            die("<script>alert('Ralat pada tahun nokp'); window.history.back();</script>");
        }

        //Menyemak kewujudan nokp yang dimasukkan.
        $sqlsemaknokp=mysqli_query($condb,"select* 
        from ahli, kelas 
        where
        ahli.id_kelas=kelas.id_kelas and
        ahli.nokp_murid='$nokp'");
        $row=mysqli_fetch_array($sqlsemaknokp);
        if(mysqli_num_rows($sqlsemaknokp)>=1)
        {
            die("<script>alert('Nokp yang dimasukkan telah didaftarkan atas nama ".$row['nama_murid']." tingkatan ".$row['ting']." ".$row['nama_kelas']." '); window.history.back();</script>");
        }
    //------------- Data validation ---------------------------------------------------------
    
    //Memasukkan data ke dalam jadual ahli
    if(mysqli_query($condb,"insert into ahli
    (nokp_murid,nama_murid,id_kelas, id_kategori)
    values
    ('$nokp','$nama','$id_kelas','$id_kategori')
    "))
    {
        echo"<script>alert('Pendaftaran berjaya');</script>";
    }
    else
    {
        echo"<script>alert('Pendaftaran Gagal');window.history.back();</script>";
    }
}
?>
<!-- Bahagian Insert data (PHP) tamat --------------- -->

<!-- Bahagian papar data (HTML in PHP) mula ------------- -->
<br>
<fieldset style="width:85%">
<div class="w3-panel w3-pale-yellow w3-border w3-border-yellow">
<p id='para2'>Senarai Ahli berdaftar</p>
<div>
<?PHP 
// Lakukan query terhadap pangkalan data
$sqlselect=mysqli_query($condb,"select* from ahli,kelas, kategori
where ahli.id_kelas=kelas.id_kelas AND ahli.id_kategori=kategori.id_kategori
order by kelas.ting, kelas.nama_kelas, ahli.nama_murid ASC");

echo"<table border='1' width='100%'>
    <tr>
        <th width='5%'>Bil</th>
        <th width='60%'>Nama Pengguna</th>
        <th width='15%'>Nokp</th>
        <th width='10%'>Kelas</th> 
        <th width='10%'>kategori</th>
		<th width='10%'>kemaskini</th> 
        <th width='10%'>padam</th>
    </tr>";

$pembilang=1;
while($row=mysqli_fetch_array($sqlselect)){   
    echo"
    <tr>
        <td align='center'>".$pembilang."</td>
        <td>".$row['nama_murid']."</td>
        <td>".$row['nokp_murid']."</td>
        <td align='center'>".$row['ting']." ".$row['nama_kelas']."</td>
        <td>".$row['jenis_kategori']."</td>
		<td align='center'>
		<a href='ahli_kemaskini.php?nokp=".$row['nokp_murid']."'>
        Kemaskini</a></td>

        <td align='center'>
        <a href='delete.php?nokp=".$row['nokp_murid']."' 
        onClick=\"return confirm('Anda pasti ingin padam data ini?')\" >
        Padam</a></td>
    </tr>";
    $pembilang++;
}
echo"</table></fieldset><br>";

mysqli_close($condb);
?>
<!-- Bahagian papar data (HTML in PHP) tamat ------------- -->
<?PHP
include('footer.php');
?>