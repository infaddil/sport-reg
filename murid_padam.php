<?PHP 
//Memulakan session
session_start ();
$nama_murid=$_GET['nama_murid']
$nokp_murid=$_GET['nokp']
$id_kategori=$_GET['id_kategori']
$id_kelas=$_GET['id_kelas']
if(mysqli_query($condb,"delete from ahli where nama_murid=".$nama_murid" , nokp_murid=".$nokp_murid"
id_kategori=".$id_kategori" and id_kelas=".$id_kelas"
"))

{
        echo"<script>alert('Rekod telah dihapuskan'); 
    window.location.href='ahli_senarai.php';
    </script>";
}
else
{   
    //Arahan untk memaparkan Popup dan kembali ke page papar_acara.
    echo"<script>alert('Rekod gagal dihapuskan'); 
    window.history.back();
    </script>";
}

mysqli_close($condb);

?>