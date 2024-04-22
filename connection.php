<?PHP 
//nama host (default : localhost)
$namahost='my-mysql';
//username akaun SQL (default : root)
$username_SQL='root'; 
//katalaluan SQL (jika ada, jika tiada letakan $katalaluan_SQL=''; sahaja)
$katalaluan_SQL='Jhw8099';
//nama pangkalan data
$nama_pangkalan_data='deduct';
//membuat connection menggunakan internal function (mysqli_connect)
$condb=mysqli_connect($namahost,$username_SQL,$katalaluan_SQL,$nama_pangkalan_data);
?>



