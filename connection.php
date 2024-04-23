<?php
// Heroku JawsDB details
$dbUrl = getenv('JAWSDB_URL'); // Make sure to set this environment variable in Heroku Config Vars

// Parse the URL to extract database connection details
$components = parse_url($dbUrl);

// Extract the hostname, username, password, and database name from the URL
$namahost = $components['host']; // Correctly assign hostname from JawsDB URL
$username_SQL = $components['user']; // Correctly assign username from JawsDB URL
$katalaluan_SQL = $components['pass']; // Correctly assign password from JawsDB URL
$port = $components['port']; // This should be 3306 as provided in the URL
$nama_pangkalan_data = substr($components['path'], 1); // Correctly assign the database name from JawsDB URL

// Create a connection to the MySQL database
$condb = mysqli_connect($namahost, $username_SQL, $katalaluan_SQL, $nama_pangkalan_data, $port);

// Check the connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>
