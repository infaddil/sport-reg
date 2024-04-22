<?PHP 
include ('header.php');
?>
<!--Menyatakan pembolehubah untuk css-->
<style> 
div{
  padding-top: 20px;
  padding-right: 25px;
  padding-bottom: 60px;
  padding-left: 25px;
  border-top: inset;
  border-radius: 25px;
  border-bottom: outset;
  border-left: dashed;
  border-right: dashed;
}
#para1 {
  font-family: arial;
  font-size: 20.5px;
  font-weight: bold;
  color: saddlebrown;
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
input[type=text] {
  width: 150px;
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
  width: 200px;
}
input[type=password] {
  width: 150px;
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
  width: 200px;
}
</style>

<!-- kawasan form mula (HTML)-->
<html>
<head>
<body>
<div>
<p id="para1">Sila Daftar Masuk</p>
<form action= '' method='POST'>
<table>
   <tr>
   <form>
        <td align='right'><p style="color:darkgreen;font-family:georgia;font-size:16.0px;margin-left:30px;">No K/P:</p></td>
        <td><input type='text' name='nokp' placeholder='Contoh 010101010101' maxlength='12' required autofocus></td>
    </form>
    </tr>
    <tr>
        <td align='right'><p style="color:darkgreen;font-family:georgia;font-size:16.0px;margin-left:30px;">Katalaluan :</p></td>
        <td><input type='password' name='pass' placeholder='Contoh:Intan Comel' maxlength='13' required></td>
    </tr>
    <tr>
    </tr>
    <td align='left'>
<td align='left'>
        <button class="button" style="vertical-align:middle"><span>Daftar masuk </span></button>
    </td>
    </td>
    </td>
    <tr>
        <td></td>
        <td align='left'><a href='pengguna_daftar.php'target="_blank"> Daftar Pengguna Baru </a> </button> </td>
    </tr>
</table>
</form>
<!-- kawasan form tamat ----------------------------------------------------------- -->


<!-- kawasan proses login mula (PHP) ----------------------------------------------- -->
<?PHP
//Memeriksa kewujudan data POST 
if(!empty($_POST))
{
    //Mengambil data yang dipost
    $nokp=$_POST['nokp'];
    $pass=$_POST['pass'];
    
    //Memanggil fail connection
    include('connection.php');

    //encrypt password
    $pass=base64_encode($pass);

    //Menyemak persamaan data yang di POST dan di DB
    $sql=mysqli_query($condb,"select* from pengguna where nokp='".
    $nokp."' and katalaluan='".$pass."' and tahap !='tidak' limit 1");
    
    //Semakan jika data yang di cari wujud
    if(mysqli_num_rows($sql)==1)
    {   
        //Mengambil data nama, nokp , tahap untuk diberikan kepada session
        $data=mysqli_fetch_array($sql);

        //Jika wujud login berjaya. set nilai session
        $_SESSION['nama_pengguna']=$data['nama'];
        $_SESSION['nokp_pengguna']=$data['nokp'];
        $_SESSION['tahap']=$data['tahap'];

        //Gerak ke menu utama
        echo" <script>window.location.href='menuutama.php';</script>";
    } 
    else
    {
        //Gerak ke previous page
        echo "<script>alert('Daftar Masuk Gagal');
              window.history.back();      
              </script>";
    }

    //Menutup connection
    mysqli_close($condb);
}
?>
<!-- kawasan proses login tamat ---------------------------------------------- -->

<?PHP 
include ('footer.php');
?>
