<?PHP
include('header.php');
include('connection.php');
?>
<!--Menyatakan pembolehubah untuk css-->
<style>
#para1 {
    font-family: comic;
    font-size: 25px;
    color: peachpuff;
}
#para2 {
    font-family: comic;
    font-size: 25px;
    color: tomato;
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
  background-color: bisque;
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
<!-- Bahagian form untuk memilih kelas (html) mula-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 <div class="w3-container">
  <div class="w3-panel w3-blue w3-round-xlarge">
<p id='para1'>Pendaftaran Acara Ahli</p>
</div>
</div>
 <a href='menuutama.php' target="_blank">Menu Utama</a> 
 <a href='papar_acara.php' target="_blank">Papar acara Atlet</a> 
<fieldset style="width:85%">
<div class="w3-container">
  <div class="w3-panel w3-khaki w3-round-xlarge">
    <p id='para2'>Pilih Kelas Ahli</p>
    <form name='senarainama'  action='' method='POST' target='_SELF'>
        <table width='100%' align='center'>
            <tr>
            <form>
                <td align='right'<p style="color:darkgreen;font-family:georgia;font-size:16.0px;margin-left:30px;"</td></p>
            </form>
                    <select name='idkelas' required>
                        <option disabled selected value>Kelas Ahli</option>
                <?PHP
                        $sqlselect=mysqli_query($condb,"Select* from kelas");
                        while($data=mysqli_fetch_array($sqlselect))
                        {
                            echo"<option value='".$data['id_kelas']."'>".$data['ting'] . $data['nama_kelas']."</option>";
                        }
                ?>

                    </select>
                    <button class="button" style="vertical-align:middle"><span>Papar </span></button>
                </td>
            </tr>
        </table>
    </form>
</fieldset>
<!-- Bahagian form untuk memilih kelas (html) tamat ----------- -->
<!-- Bahagian memaparkan ahli dari kelas yang dipilih (php) mula-->
<?PHP 
//Memeriksa kewujudan data POST
if(!empty($_POST))
{
echo"<br><fieldset style='width:85%'><div class='w3-container'>
  <div class='w3-panel w3-khaki w3-round-xlarge'>
<p id='para2'>Senarai Ahli berdaftar</p>";    
//Mencari data di jadual ahli dan kelas
$sqlselect=mysqli_query($condb,"select* from ahli,kelas where ahli.id_kelas=kelas.id_kelas AND
ahli.id_kelas='".$_POST['idkelas']."' order by nama_murid ASC");
//Mengambil bilangan row yang dijumpai 
$bilangan=mysqli_num_rows($sqlselect);
//Jika bilangan lebih besar dari 0 maka header jadual dipaparkan
if($bilangan>0)
{
    echo"<table border='1' width='100%'>
                <tr>
                    <th width='5%'>Bil</th>
                    <th width='60%'>Nama Pengguna</th>
                    <th width='15%'>Nokp</th>
                    <th width='10%'>Kelas</th>
                    <th width='10%'>Jumlah Acara</th>
                   
                    <th width='10%'>Pilih</th>
                </tr>";
    $pembilang=1;
    //Mengambil data yang telah dipilih di L2
    while($row=mysqli_fetch_array($sqlselect))
    {   
        //Memaparkan semula data ahli
        //Mencari bilangan data acara individu yang telah didaftarkan sebelum ini
        $sqlkiraindividu=mysqli_query($condb,"select* from acara_ahli,acara 
        where acara_ahli.id_acara=acara.id_acara  
        and acara_ahli.nokp_murid='".$row['nokp_murid']."'");
        $bilindividu=mysqli_num_rows($sqlkiraindividu);
        if($bilindividu>=4)
        {
            $warna="bgcolor='pink'";
        }
        else
        {
            $warna="bgcolor='white'";
        } 
        echo"
        <tr  ".$warna.">
            <td align='center'>".$pembilang."</td>
            <td>".$row['nama_murid']."</td>
            <td>".$row['nokp_murid']."</td>
            <td align='center'>".$row['ting']." ".$row['nama_kelas']."</td>
            <td align='center'>".$bilindividu."</td>";

            if($bilindividu>=3)
        {
            echo"<td align='center'>Penuh</td>";
        }
        else
        {
            echo"<td align='center'><a href='acara_daftar.php?nokp=".$row['nokp_murid']."'>Pilih</a></td>";
        }

            
             
            
       echo" </tr>";
       $pembilang++;
    }

echo"</table>";
}
echo "<br>".$bilangan." Bilangan rekod yang ditemui.";
}
echo"</fieldset><br>";
?>
<!-- Bahagian memaparkan ahli dari kelas yang dipilih (php) tamat-->
<?PHP
include('footer.php');
?>