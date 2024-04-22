<?PHP
include('header.php');
include('connection.php');
?>
<!--Menyatakan pembolehubah untuk css-->
<style>
#para1 {
    font-family: comic;
    font-size: 30px;
    color: darkorchid;
    font-variant: small-caps;
}
#para2 {
    font-family: arial;
    font-size: 25px;
    color: sienna;
}
a:link, a:visited {
  background-color: rosybrown;
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
</style>
<!-- - Bahagian mencari data utk dipaparkan pada form mula (PHP)-->
<?PHP
//Mengambil data GET
$nokp=$_GET['nokp'];

//Menilih data ahli yang dipilih
$sqlselect=mysqli_query($condb,"select* from ahli,kelas
where ahli.id_kelas=kelas.id_kelas AND ahli.nokp_murid='$nokp'");
$data=mysqli_fetch_array($sqlselect);

/*Memilih senarai acara(acara yang telah didaftarkan sebelum ini bagi ahli tersebut tidak akan dipaparkan sekali lagi*/
$sqlacara=mysqli_query($condb,"select* from acara where
id_acara not in(select id_acara from acara_ahli where nokp_murid='$nokp')");
?>
<!-- Bahagian mencari data utk dipaparkan pada form tamat (PHP)-->

<!-- Bahagian form data tamat (HTML)-->

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 <div class="w3-container">
  <div class="w3-panel w3-padding-small w3-pale-green w3-bottombar w3-round-xlarge w3-topbar w3-border-green w3-border">
  <p id='para1'> Daftar Acara Ahli</p>
 <a href='menuutama.php' target="_blank">Menu Utama</a>
 <a href='acara_pilih.php' target="_blank">Pilih Pelajar Lain</a>  
 <a href='papar_acara.php' target="_blank">Papar acara Atlet</a> 
<fieldset style='width:85%'>
    <p id='para2'>Pilih acara yang ingin didaftarkan</p>
    <table width='100%'>
        <tr>
            <td align='right' bgcolor='#c4c4c4' width='50%'>Nama Ahli :</td>
            <td><?PHP echo $data['nama_murid']; ?></td>
        </tr>
        <tr>
            <td align='right' bgcolor='#c4c4c4'>Nokp Ahli :</td>
            <td><?PHP echo $data['nokp_murid']; ?></td>
           
        </tr>
        <tr>
            <td align='right' bgcolor='#c4c4c4'>Kelas :</td>
            <td><?PHP echo $data['ting'].$data['nama_kelas']; ?></td>
        </tr>
        <tr>
            <td valign = 'top' align='right' bgcolor='#c4c4c4'>Acara :</td>
            <td>
            
            <form action='' method='POST'>

            <?PHP 
            echo "<input type='hidden' name='nokp' value='$nokp'";
            while($dataacara=mysqli_fetch_array($sqlacara))
            {
               echo"<br><input type='checkbox' name='acara[]' value='".$dataacara['id_acara']."'>".$dataacara['nama_acara'];
            }
            ?> 
            </td>
        </tr>
        <tr>
            <td></td>
            <td><button class="button" style="vertical-align:middle"><span>Daftar </span></button></td>
            </form></td>
        </tr>
    </table>
</fieldset>
<!-- Bahagian form data tamat (HTML) ----------------------------------------- -->

<!-- Bahagian insert data mula (PHP) ----------------------------------------- -->
<?PHP
# L1 - Menyemak kewujudan data POST
if(isset($_POST['acara']))
{
    #L2 - Mengambil data POST
    $nokp=$_POST['nokp'];
    $counter=0;


    #L3 - Menyemak bilangan acara yang di tick
    if(sizeof($_POST['acara'])>3)
    {    
            die("<script>alert('Bilangan acara maksimum adalah 3');
                window.history.back();</script>");
        
    }

    # L4 - Memasukkan data di dalam jadual acara_ahli
    foreach($_POST['acara'] as $acara)
    {

        $sqlsimpan=mysqli_query($condb,"insert into acara_ahli
        (nokp_murid,id_acara) values ('$nokp','$acara')");
    }
    echo"   <script>
            alert('Acara yang telah dipilih telah didaftarkan');
            window.location.href='papar_acara.php';
            </script>";
}
?>
<!-- Bahagian insert data Tamat (PHP) ----------------------------------------- -->
<?PHP
include('footer.php'); 
?>
