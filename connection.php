<?php
// Heroku JawsDB URL
$dbUrl = "mysql://ddjvbu2ey3xesqfq:c7wgxv73ff04gouk@ipobfcpvprjpmdo9.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/fh3418remojvoxud";

// Parse the URL to extract database connection details
$components = parse_url($dbUrl);

// Extract the hostname, username, password, and database name from the URL
$namahost = $components['ipobfcpvprjpmdo9.cbetxkdyhwsb.us-east-1.rds.amazonaws.com'];
$username_SQL = $components['ddjvbu2ey3xesqfq'];
$katalaluan_SQL = $components['c7wgxv73ff04gouk'];
$port = $components['3306'];
$nama_pangkalan_data = substr($components['fh3418remojvoxud'], 1); // Remove the leading slash from the path to get the database name

// Create a connection to the MySQL database
$condb = mysqli_connect($namahost, $username_SQL, $katalaluan_SQL, $nama_pangkalan_data, $port);

// Check the connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>
