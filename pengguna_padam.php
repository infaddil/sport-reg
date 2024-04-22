<?PHP
//Memulakan fungsi session
session_start();

//Mengambil data yang dihantar secara get pada link padam
$nokp=$_GET['nokp'];

//Menyemak data yang ingin dipadam
if($nokp==$_SESSION['nokp_pengguna'])
{
    die("<script>alert('anda tidak dibenarkan memadam data diri sendiri');
    window.history.back();</script>");
}

//Memanggil fail connection
include('connection.php');

//Melaksanakan arahan menghapskan rekod
if(mysqli_query($condb,"delete from pengguna where nokp='".$nokp."'"))
{

    //Arahan untk memaparkan Popup dan kembali ke page senaraipengguna. 
    echo"<script>alert('Rekod telah dihapuskan'); 
    window.location.href='pengguna_senarai.php';
    </script>";
}
else
{   
    //Arahan untk memaparkan Popup dan kembali ke page senaraipengguna.
    echo"<script>alert('Rekod GAGAL dihapuskan kerana mempunyai hubungan dengan rekod kerosakan aset'); 
    window.history.back();
    </script>";
}

mysqli_close($condb);
?>