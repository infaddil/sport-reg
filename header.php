<?PHP 
session_start();
//untuk ubah warna
if(empty($_SESSION["warnatulisan"])){
    $_SESSION["warnatulisan"]="#000000";
    }

//code time out dlm masa 5 minit
$now = time();
$namafail = basename($_SERVER['PHP_SELF']);
if ((isset($_SESSION['logout_selepas']) AND $now > $_SESSION['logout_selepas'] ) AND ($namafail !='index.php' AND $namafail!='pengguna_daftar.php')) {
    echo"
		<script>alert('Session time out! Masa lengah telah melebihi had yang dibenarkan. Sila daftar masuk semula.');
		window.location.href='logout.php';
		</script>";
}

// 300 maksud 5x60saat..
$_SESSION['logout_selepas'] = $now + 300;
if(empty($_SESSION['nama_pengguna']) AND ($namafail !='index.php' AND $namafail!='pengguna_daftar.php')){
	echo "<script>alert('Sila Login');
	window.location.href='logout.php';
	</script>";
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sistem Deduct</title>

<style type='text/css'>
     {
     display : none ;
     }

legend {
  padding: 0.5px 0.5px;
  border:1px solid green;
  color:green;
  font-size:90%;
  text-align:right;
  }
</style>
    </head>
<body background='images\download.jpg' text="<?PHP echo $_SESSION["warnatulisan"]; ?>">
<!--menghasilkan table layout -->
<table align='center'>
    <!--row header -->
    <tr >
        <td><img src='images\banner2.jpg' alt="Header1" width="750" height="155"></td>
    </tr>

    <!--row info -->

    <!--row content -->
    <tr height='220' bgcolor='#99FFFF'>
        <td valign='top' align='center'>