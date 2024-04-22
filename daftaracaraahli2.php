<?PHP
include('header.php');
include('connection.php');
//Mengambil data GET
$nokp=$_GET['nokp'];

//Memilih data dari jadual ahli dan kelas berdasarkan nokp di L1
$sqlselect=mysqli_query($condb,"select* from ahli,kelas 
where ahli.id_kelas=kelas.id_kelas AND ahli.nokp_murid='$nokp'");

//Memilih acara yang tidak wujud didalam jadual acara_ahli
$sqlacara=mysqli_query($condb,"select* from acara where
id_acara not in(select id_acara from acara_ahli where nokp_murid='$nokp')");

//Mengambil data dari L2
$data=mysqli_fetch_array($sqlselect);
?>

<!-- Memasukkan data dari L2 kedalam form menggunakan atribut value -->
<h2>Daftar Acara Ahli</h2>
| <a href='menuutama.php'>Menu Utama</a> | 
| <a href='daftaracaraahli.php'>Pilih Pelajar Lain</a> | 
| <a href='papar_acara.php'>Papar Semua Atlet Berdaftar</a> |
<fieldset style='width:85%'>
<legend>Pilih acara yang ingin didaftarkan</legend>
    <table width='100%'>
        <tr>
            <td align='right' bgcolor='#c4c4c4' width='50%'>Nama Ahli :</td>
            <td><?PHP echo $data['nama_murid']; ?></td>    
        </tr>
        <tr>
            <td align='right' bgcolor='#c4c4c4'>Nokp Ahli :</td>
            <td><?PHP echo $data['nokp_murid']; ?></td>
        </tr>
        <tr>
            <td align='right' bgcolor='#c4c4c4'>Kelas :</td>
            <td><?PHP echo $data['ting'].$data['nama_kelas']; ?></td>
        </tr>
        <tr>
            <td valign = 'top' align='right' bgcolor='#c4c4c4'>Acara :</td>
            <td>
            <form action='' method='POST'>
            <?PHP 
            echo "<input type='hidden' name='nokp' value='$nokp'";
            while($dataacara=mysqli_fetch_array($sqlacara))
            {
               echo"<br><input type='checkbox' name='acara[]' value='".$dataacara['id_acara']."'>".$dataacara['nama_acara'];
            }
            ?>         
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type='submit' value='Daftar'>
            </form></td>
        </tr>
    </table>
</fieldset>


<?PHP 
//Menyemak kewujudan data POST
if(isset($_POST['acara']))
{
    //Mengambil data POST
    $nokp=$_POST['nokp'];
    $individu=0;
    $kumpulan=0;

    //Menyemak bilangan data acara yang telah dipilih dari form
    foreach($_POST['acara'] as $acara)
    {
        $sqlcari=mysqli_query($condb,"select* from acara
        where id_acara='$acara' and jenis='individu'");
        if(mysqli_num_rows($sqlcari)==1)
        {
            $individu++;
        }
        else
        {
            $kumpulan++;
        }
    }

    //Menyemak adakah jumlah acara individu dan kumpulan telah mencukupi kuata
    if($individu>3 OR $kumpulan >2 or count($_POST['acara'])>5)
    {
        //Fungsi die() bermaksud menghenti aturcara.
        die("<script>alert('1Setiap pendaftaran acara hanya melibatkan 3 acara individu 
        dan 2 acara kumpulan sahaja'); window.history.back();</script>");
    }

    //Menyemak acara individu ahli yang telah didaftarkan sebelum nie
    $sqlcheckindividu=mysqli_query($condb,"select* from acara_ahli,acara 
    where acara_ahli.id_acara=acara.id_acara and acara.jenis='individu' and 
    acara_ahli.nokp_murid='$nokp'");
    //Menyemak acara kumpulan ahli yang telah didaftarkan sebelum nie
    $sqlcheckkumpulan=mysqli_query($condb,"select* from acara_ahli,acara 
    where acara_ahli.id_acara=acara.id_acara and acara.jenis='kumpulan' and 
    acara_ahli.nokp_murid='$nokp'");
    
    /*menambahkan bilangan acara individu dan kumpulan yang telah dipilih dan acara yang telah didaftarkan sebelum ni.*/
    $jumindividu=$individu+mysqli_num_rows($sqlcheckindividu);
    $jumkumpulan=$kumpulan+mysqli_num_rows($sqlcheckkumpulan);

    //Menguji jumlah acara yang ingin didaftarkan telah mencukupi kuata
    if($jumindividu>3 OR $jumkumpulan>2)
    {
        die("<script>alert('2Setiap pendaftaran acara hanya melibatkan 3 acara individu 
        dan 2 acara kumpulan sahaja'); window.history.back();</script>");
    }
    
    //Proses menyimpan data
    foreach($_POST['acara'] as $acara)
    {
        //Menyemak bilangan acara invididu yang telah berdaftar.
        $penyertaanindividu=mysqli_query($condb,"select* from acara_ahli, acara 
        where acara_ahli.id_acara=acara.id_acara and 
        acara_ahli.id_acara='$acara' and 
        acara.jenis='individu'");
        $rowin=mysqli_fetch_array($penyertaanindividu);
        $bilin=mysqli_num_rows($penyertaanindividu);

        //Menyemak bilangan acara kumpulan yang telah berdaftar.
        $penyertaankumpulan=mysqli_query($condb,"select* from acara_ahli, acara 
        where acara_ahli.id_acara=acara.id_acara and 
        acara_ahli.id_acara='$acara' and 
        acara.jenis='kumpulan'");
        $rowkum=mysqli_fetch_array($penyertaankumpulan);
        $bilkum=mysqli_num_rows($penyertaankumpulan);
        
        //Jika jumlah acara individu kurang dari 3 dan acara kumpulan kurang dari 2
        if(($bilin<2 AND $bilkum==0) or ($bilin==0 AND $bilkum<5))
        {
        //Proses Menyimpan data ke dalam table acara _ahli
        $sqlsimpan=mysqli_query($condb,"insert into acara_ahli
        (nokp_murid,id_acara)
        values
        ('$nokp','$acara')
        ");   
            echo"<script>
            alert('Acara yang telah dipilih telah didaftarkan');
            window.location.href='papar_acara.php';
            </script>";
        }
        else
        {
            echo"<script>alert('Pendaftaran bagi Acara ".$rowin['nama_acara']." ".$rowkum['nama_acara']." telah mencapai had bilangan penyertaan');</script>";
        }     
}
}
mysqli_close($condb);
include('footer.php'); 
?>