
<?php
require_once("db_connect.php");
$height = $_GET['ht'];
$id = $_GET['id'];
$battery = $_GET['bs'];
$battery = $battery/1000;


/******************************** Logging Data **************************************/
//echo($height);
echo("Data Received");
echo("<html><body><br></body></html>");
echo(($battery)."mV");
date_default_timezone_set('Asia/Kolkata');
$date = date_create();
$myfile = fopen("../logs.txt", "a");
fwrite($myfile, date_format($date, 'd-m-Y H:i:s')." ".$height." ".$battery." V"."\n");
fclose($myfile);

$time = date_format($date, 'd-m-Y H:i:s');
$bin_name = "bin_".$id;
$time_name = "time_".$id;
$bstat = "bstat";

/******************************** Check Data **************************************/
//newline
echo '<br>';

// if ($result = $connection->query("SELECT  * FROM bin_data")) 
// {
//     printf("Select returned %d rows.\n", $result->num_rows);
//     echo '<br>';
//     /* free result set */
//     $result->close();
// }

if($height > 0 and $height < 150)
{
	
	$query = "INSERT INTO bin_data ($bin_name, $time_name, $bstat)
			  VALUES ('$height','$time','$battery')";
	if ($connection->query($query) === TRUE) 
	{
	//    echo "New record created successfully";
	}
	else 
	{
	    echo "Error: " . $query . "<br>" . $connection->error;
	}
}




?>