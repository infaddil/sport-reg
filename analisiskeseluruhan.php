<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!--Menyatakan pembolehubah css-->
<style>
#para1 {
font-family: comic;
font-size: 25px;
color: black;
padding-top: 9px;
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
padding-top: 10px;
width: 100px;
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
background-color: turquoise;
}
select {
width: 100%;
padding: 16px 20px;
border: none;
border-radius: 4px;
background-color: #f1f1f1;
}
</style>
<?PHP
include('header.php');
include('connection.php');

//menyediakan form seperti biasa melalui table dan drop down list
echo"<div class='w3-container'>
<div class='w3-panel w3-pale-blue w3-margin w3-leftbar w3-rightbar w3-border-blue'><p id='para1'> Analisis Pendaftaran Acara</p>
</div>
</div>
<form name='senarainama' action='".$_SERVER['PHP_SELF']."' method='POST' target='_SELF'>
    <table width='50%' align='center' >
        
            <tr>
                <td align='right' p id='para2'>Kategori :</p> </td></td>
                <td width='50%'>
                    <select name='id_kategori' required>
                        <option disabled selected value>Pilih</option>";

                        //statement SQL untuk memilih semua field yang terdapat didalam table persatuan
                        $sqlselect=mysqli_query($condb,"Select* from kategori");
                        //sama konsep seperti memaparkan data dlm jadual, tetapi kali ini pengulangan
                        //berlaku pada tag <option></option>
                        while($data=mysqli_fetch_array($sqlselect)){
                            echo"<option value='".$data['id_kategori']."'>
                            ".$data['jenis_kategori']."</option>";
                        }
                    echo"</select>
                        <input type='submit' value='papar'>
                </td>
            </tr>
    </table>
</form>";

//apabila nilai POST dihantar ke fail yang sama, perlu ada pengujian kewujudan data post bagi
//mengelak berlakunya ralat pada kali pertama page dibuka.
if(!empty($_POST)){

    // mengambil nilai dari data yang dipost
    $id_kategori=$_POST['id_kategori'];
    $sqlpapar=mysqli_query($condb," Select* from acara_ahli, ahli, kategori,kelas, acara
    where
    acara_ahli.nokp_murid=ahli.nokp_murid and
    acara_ahli.id_acara=acara.id_acara and
    ahli.id_kelas=kelas.id_kelas and
    ahli.id_kategori=kategori.id_kategori and
    ahli.id_kategori='$id_kategori' 
    order by acara.id_acara
    ");
    $jumlah=mysqli_num_rows($sqlpapar);
    if($jumlah>0)
    {
    //menyediakan header untuk table
    echo"
    <table width='95%' align='center' border='1'>
    <tr>
        <td>Bil</td>
        <td>Nama</td>
        <td>No K/P</td>
        <td>Kelas</td>
        <td>Kategori</td>
        <td>Acara</td>
    </tr>";
    $i=1;
    //memaparkan senarai nama ahli row demi row selagi syarat2 didalam $sqlpapar dipenuhi
        while($row=mysqli_fetch_array($sqlpapar)){
            echo"<tr>
                    <td>".$i."</td>
                    <td>".$row['nama_murid']."</td>
                    <td>".$row['nokp_murid']."</td>
                    <td>".$row['ting']." ".$row['nama_kelas']."</td>
                    <td>".$row['jenis_kategori']."</td>
                    <td>".$row['nama_acara']."</td>
                </tr>";    
    $i++; }

    echo"
    
    </table>";
    }
    
    echo"Tamat Carian<br>Sebanyak ".$jumlah." rekod telah ditemui";
    echo"<br><a href='menuutama.php'>Kembali ke Menu Utama</a>";
}
include('footer.php');
?>