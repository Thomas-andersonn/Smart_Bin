<?php
	
	// 1. Create a database connection
	//		(Use your own servername, username and password if they are different.)
	//		$connection allows us to keep refering to this connection after it is established

	$connection = mysqli_connect('localhost', 'root', '123', 'data_mound');
	if (!$connection) {
		die("Database connection failed: " . mysql_error());
	}

	if (!$connection) 
	{
	    echo "Error: Unable to connect to MySQL." . PHP_EOL;
	    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}

	//echo "Success: A proper connection to MySQL was made! The data_mound database is great." . PHP_EOL;
	//echo "Host information: " . mysqli_get_host_info($connection) . PHP_EOL;


?>