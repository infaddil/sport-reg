<?php
// Heroku JawsDB URL
$dbUrl = getenv('JAWSDB_URL');  // Fetching the URL from environment variable is safer

// Parse the URL to extract database connection details
$components = parse_url($dbUrl);

// Extract the hostname, username, password, and database name from the URL
$namahost = $components['host'];
$username_SQL = $components['user'];
$katalaluan_SQL = $components['pass'];
$port = $components['port'];
$nama_pangkalan_data = substr($components['path'], 1); // Remove the leading slash from the path to get the database name

// Create a connection to the MySQL database
$condb = mysqli_connect($namahost, $username_SQL, $katalaluan_SQL, $nama_pangkalan_data, $port);

// Check the connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>
