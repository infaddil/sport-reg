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
#para2 {
    font-family: comic;
    font-size: 25px;
    color: steelblue;
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
th {
  background-color: rosybrown;
  color: white;
}
</style>
<!--Kawasan header bagi jadual (HTML) bermula-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<div class="w3-container">
  <div class="w3-panel w3-padding-small w3-pale-green w3-bottombar w3-round-xlarge w3-topbar w3-border-green w3-border">
<p id='para1'>Senarai pengguna</p>
</div>
</div>
 <a href='menuutama.php'>Menu Utama</a> 
<fieldset style='width:85%'>
        <p id='para2' >Senarai Pengguna Berdaftar</p>
            <table border='1' width='100%'>
                <tr>
                    <th width='5%'>Bil</th>
                    <th width='50%'>Nama Pengguna</th>
                    <th width='15%'>Nokp</th>
                    <th width='10%'>Status</th>
                    <th width='10%'>Kemaskini</th>
                    <th width='10%'>Padam</th>
                </tr>
<!-- HTML (Header bagi jadual) Tamat-->

<!-- PHP memaparkan data baris demi baris mula-->
<?PHP

//Memanggil fail connection.php
include('connection.php');

//Mencari data di dalam jadual pengguna
$sqlselect=mysqli_query($condb,"select* from pengguna order by tahap");

$pembilang=1;

//Mengambil data yang dicari dan paparkan baris demi baris
while($row=mysqli_fetch_array($sqlselect))
{   
    echo"
    <tr>
        <td align='center'>".$pembilang."</td>
        <td>".$row['nama']."</td>
        <td align='center'>".$row['nokp']."</td>
        <td align='center'>".$row['tahap']."</td>
        <td align='center'>
        <a href='pengguna_kemaskini.php?nokp=".$row['nokp']."'>
        Kemaskini</a></td>
        <td align='center'>
        <a href='pengguna_padam.php?nokp=".$row['nokp']."' 
        onClick=\"return confirm('Anda pasti ingin padam data ini?')\" >
        Padam</a></td>
    </tr>";

    $pembilang++;
}

echo"</table></fieldset>";
mysqli_close($condb);
?>

<?PHP
include('footer.php');
?>
