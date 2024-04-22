<html>
<body>
<style>
div
/*Menyatakn pembolehubah untuk css*/
#para1{
  font-family: arial;
  font-size: 25.5px;
  font-weight: bold;
  font-style: oblique;
  color: saddlebrown;
}
#para2{
  font-family: sans-serif;
  font-size: 25.5px;
  font-style: italic;
  color: midnightblue;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a, .dropbtn {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

li.dropdown {
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: rosybrown;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>
<html>
<div>
<?PHP 
include ('header.php');
echo"<p id='para1'>Menu Utama</p>
<p id='para2'>Selamat Datang ".$_SESSION['nama_pengguna']." ( " . $_SESSION['tahap']." )</p> "; 
# -- istihar menu bagi pengguna aktif mula-----------------------------------------
$aktif="<fieldset style='width:85%'>
<table width='100%'>
<body>
<tr>
<ul>
  <li><a href='index.php'>Keluar</a></li>
   <li class='dropdown'>
    <a href='javascript:void(0)' class='dropbtn'>Pengguna aktif</a>
    <div class='dropdown-content'>
      <a href='ahli_senarai.php'><img src='images/atlet.png'>Senarai ahli
      <a href='acara_pilih.php'><img src='images/runner.png'>Pilih acara
      <a href='analisiskeseluruhan.php'><img src='images/analisis.png'>Analisis acara
      <a href='cetak.php'><img src='images/printer.png'>Cetak laporan
      <a href='logout.php'><img src='images/logout.png'>Logout</a>
      </div>
  </li>
   <li class='dropdown'>
    <a href='javascript:void(0)' class='dropbtn'>Pengguna admin</a>
    <div class='dropdown-content'>
      <a href='pengguna_senarai.php'><img src='images/Pengguna.png'>Senarai pengguna
      <a href='upload.php'><img src='images/upload.png'>Upload</a>
    </div>
  </li>
    </tr>
</table>
</body>
</fieldset>";
# -- istihar menu bagi pengguna aktif tamat-----------------------------------------

# -- istihar menu bagi pengguna admin mula-----------------------------------------
$admin="<fieldset style='width:85%'>
</fieldset>";
# -- istihar menu bagi pengguna aktif tamat-----------------------------------------

# -- menguji dan memaparkan menu berdasarkan session tahap mula---------------------
switch($_SESSION['tahap'])
{
    case 'admin' : echo $aktif.$admin; break;
    case 'aktif' : echo $aktif; break;
    default      : header('Location: logout.php');
}
# -- menguji dan memaparkan menu berdasarkan session tahap tamat--------------------

include ('footer.php');
?>
</body>
</html>