<?PHP 
include ('header.php');
?>
<!--Menyatakan pembolehubah untuk css-->
<style>
#para1 {
  font-family: arial;
  font-size: 25.5px;
  font-weight: bold;
  color: saddlebrown;
}
#para2 {
  font-family: arial;
  font-size: 20.5px;
  font-weight: bold;
  color: black;
}
input[type=text] {
  width: 250px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 15px;
  background-color: white;
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}
input[type=text]:focus {
  width: 300px;
}
input[type=password] {
  width: 250px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 15px;
  background-color: white;
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}
input[type=password]:focus {
  width: 300px;
}
.button {
  display: inline-block;
  border-radius: 10px;
  background-color: #BC8F8F;
  border: ridge;
  color: moccasin;
  text-align: center;
  font-size: 16.5px;
  height: 50px;
  padding: 10px;
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
a:link, a:visited {
  background-color: tomato;
  color: white;
  border-radius: 10px;
  border: ridge;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

a:hover, a:active {
  background-color: red;
}
</style>
<!-- kawasan form mula (HTML)-->
<p id="para1">Daftar pengguna baru</p>
<form action='' method='POST'>
<table>
<p id="para2">Lengkapkan Maklumat Di Bawah</p>
    <tr> 
       <form>
        <td align='right'><p style="color:darkgreen;font-family:georgia;font-size:16.0px;margin-left:30px;">Nama:</p></td>
        <td><input type='text' name='nama' placeholder='Contoh: intan' maxlength='12' required autofocus></td>
    </form>
    </tr>
    <tr>
        <td align='right'><p style="color:darkgreen;font-family:georgia;font-size:16.0px;margin-left:30px;">No K/P:</p></td>
        <td><input type='text' name='nokp' placeholder='Contoh: 010101010101' maxlength='12' required autofocus></td>
    </tr>
    <tr>
        <td align='right'><p style="color:darkgreen;font-family:georgia;font-size:16.0px;margin-left:30px;">Katalaluan :</p></td>
        <td><input type='password' name='pass' placeholder='Contoh:Intan Comel' maxlength='13' required></td>
    </tr>
    <tr>
        <td></td>
        <td><td align='left'>
        <button class="button" style="vertical-align:middle"><span>Hantar </span></button></td>
 <td></td>
        <td><td align='leftt'>
<button class="button" style="vertical-align:middle"><span>Set semula </span></button></td>
    </tr>
    <td></td>
    <tr>
        <td></td>
        <td> <a href='index.php'> Daftar Masuk (Login) </a> </td>
    </tr>
</table>
</form>
<!-- kawasan form tamat (HTML) ------------------------------------------------------ -->


<!-- kawasan insert data mula (PHP) ------------------------------------------------- -->
<?PHP 

//Memeriksa kewujudan data POST
if(!empty($_POST))
{
    //Mengambil data POST
    $nama=$_POST['nama'];
    $nokp=$_POST['nokp'];
    $pass=$_POST['pass'];

    //Memanggil fail connnection
    include ('connection.php');

    //Data validation ( Mengesahkan bilangan nokp dan tidak ada aksara )
    if(strlen($nokp)!=12 or !is_numeric($nokp))
    {
        echo"<script>alert('Ralat pada NoKP'); window.history.back();</script>";
    }

    // encrypt password
    $pass=base64_encode($pass);

    //Memasukkan data (menggunakan penyataan SQL)
    if (mysqli_query($condb, " INSERT INTO pengguna 
    (nokp, nama, katalaluan, tahap) VALUES ('$nokp','$nama', '$pass', 'tidak')"))
    {
        echo"<script>alert('Data berjaya disimpan. Tunggu pengaktifan daripada admin'); 
        window.location.href='index.php';</script>";
    } 
    else 
    {
        echo"<script>alert('Data Gagal di simpan'); window.history.back();</script>";
    }

    //Menutup connection
    mysqli_close($condb);
}
?>
<!-- kawasan insert data tamat (PHP) ------------------------------------------------ -->

<?PHP 
include ('footer.php');
?>

