<?PHP 

//Langkah 1 : memanggil fail connection
include('connection.php');

$nokp_murid=$_GET['nokp'];


//Langkah 2 : melaksanakan arahan menghapskan rekod
if(mysqli_query($condb,"delete from ahli where nokp_murid='".$nokp_murid."'

"))
{

    //Langkah 2.1 : arahan untk memaparkan Popup dan kembali ke page papar_acara. 
    echo"<script>alert('Rekod telah dihapuskan'); 
    window.location.href='ahli_senarai.php';
    </script>";
}
else
{   
    //Langkah 2.2 : arahan untk memaparkan Popup dan kembali ke page papar_acara.
    echo"<script>alert('Rekod GAGAL dihapuskan kerana mempunyai hubungan dengan rekod kerosakan aset'); 
    window.history.back();
    </script>";
}

mysqli_close($condb);

?>