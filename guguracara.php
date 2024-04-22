<?PHP 

//Memanggil fail connection
include('connection.php');

$nokp_murid=$_GET['nokp'];
$id_acara=$_GET['id_acara'];

//Melaksanakan arahan menghapskan rekod
if(mysqli_query($condb,"delete from acara_ahli where nokp_murid='".$nokp_murid."'
and id_acara='".$id_acara."'
"))
{

    //Arahan untk memaparkan Popup dan kembali ke page papar_acara. 
    echo"<script>alert('Rekod telah dihapuskan'); 
    window.location.href='papar_acara.php';
    </script>";
}
else
{   
    //Arahan untk memaparkan Popup dan kembali ke page papar_acara.
    echo"<script>alert('Rekod GAGAL dihapuskan kerana mempunyai hubungan dengan rekod kerosakan aset'); 
    window.history.back();
    </script>";
}
//Menutup sambungan pangkalan data yang telah dibuka sebelumnya
mysqli_close($condb);

?>