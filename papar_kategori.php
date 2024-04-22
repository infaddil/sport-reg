<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<div class="w3-container">
<!--Mentakan pembolehubah untuk css-->
<style>
#para1 {
    font-family: comic;
    font-size: 25px;
    color: crimson;
    font-variant: small-caps;
}
#para2 {
    font-family: comic;
    font-size: 25px;
    color: mediumseagreen;
}
a:link, a:visited {
  background-color: khaki;
  color: brown;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}
a:hover, a:active {
  background-color: darkturquoise;
}
th {
  background-color: Lightslategrey;
  color: white;
}
</style>
<?PHP
include('header.php');
include('connection.php');
#---Memaparkan data dalam bentuk jadual mula (html in PHP)--------------

#Memilih data dari table ahli dan kelas
$sqlselect=mysqli_query($condb,"select* from ahli,kelas where
ahli.nokp_murid in (select nokp_murid from acara_ahli) and
ahli.id_kelas = kelas.id_kelas order by ahli.nama_murid ASC");

#Menyediakan header bagi jadual yang ingin dibina
echo"<a href='menuutama.php' target='_blank'> Menu utama </a>
<fieldset style='width:85%'>
<p id='para2'>Senarai Ahli berdaftar</p>

<table border='1' width='100%'>
<caption>Klik pada acara untuk mengugurkan acara tersebut</caption>
    <tr>
        <th width='5%'>Bil</th>
        <th width='40%'>Nama Pengguna</th>
        <th width='15%'>Nokp</th>
        <th width='10%'>Kelas</th>
        <th width='20%'>Acara Berdaftar</th>
    </tr>";

    $pembilang=1;

    #Mengambil data yang dipilih
    while($row=mysqli_fetch_array($sqlselect))
    {   
        //Mengambil data dari table acara_ahli dan acara berdasarkan nokp yang telah diambil
        $paparacara=mysqli_query($condb,"select* from acara_ahli, acara
        where
        acara_ahli.nokp_murid='".$row['nokp_murid']."' AND
        acara_ahli.id_acara=acara.id_acara");
        if(mysqli_num_rows($paparacara)>=4)
        {
            $warna="bgcolor='pink'";
        }
        else
        {
            $warna="bgcolor='white'";
        }
        //Memaparkan data yang diambil baris demi baris
    echo"<tr ".$warna.">
        <td align='center'>".$pembilang."</td>
        <td>".$row['nama_murid']."</td>
        <td>".$row['nokp_murid']."</td>
        <td align='center'>".$row['ting']." ".$row['nama_kelas']."</td>
        <td>";  
        
        
        while($dataacara=mysqli_fetch_array($paparacara))
        {   
            
            //Memaparkan semua acara yang diambil
            echo "<a href=guguracara.php?nokp=".$dataacara['nokp_murid']."&id_acara=".$dataacara['id_acara'].">".$dataacara['nama_acara']."</a><br>";
        }        
        echo"</td>
    </tr>";
    $pembilang++;
    }
echo"</table></fieldset><br>";
#---Memaparkan data dalam bentuk jadual Tamat (html in PHP)-------------
include('footer.php');
?>

