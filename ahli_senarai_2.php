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
    <td align='center'>No Bilik</td>

            <td></td>
        <div class="w3-bar">
</div>
        </tr>
        <tr>
            <td><input type='text' name='nama' placeholder='HURUF BESAR' size='35' required></td>
            <td><input type='text' name='no_bilik' placeholder='Contoh:010203040101' maxlength='12'></td>
            <td>

            <select name='id_bilik' required>
                <option disabled selected value>id_bilik</option>
<!--Mengambil baris hasil dari jadual kelas-->
<?PHP 
                $sqlcheckin=mysqli_query($condb,"SELECT* from check_in");
                while($data=mysqli_fetch_array($sqlcheckin))
                {
                    echo"<option value='".$data['id_biik']."'>
                    ".$data['nama']." ".$data['no_bilik']."</option>";        
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
