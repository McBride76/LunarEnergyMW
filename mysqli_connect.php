<?php # script 9.2, database connection string
# This file contains the database access information
# This file also establishes a connection to MySQL, selects the database, and sets the encoding

// set the db access information as constants
define('DB_USER',     'root');
define('DB_PASSWORD', '');
define('DB_HOST',     'localhost');
define('DB_NAME',     'lunarenergy');

// make the connection
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
	OR die('Could not connect to MySQL: ' . mysqli_connect_error() );
	
// set encoding
mysqli_set_charset($dbc, 'utf8');