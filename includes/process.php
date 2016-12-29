<?php 

  require_once("db_connect.php");
  $table = "bin_data";
  $q = "SELECT * FROM $table ORDER BY id DESC LIMIT 30";

  
  $a = array();
  $i = 1;
  $result = $connection->query($q);          //query
  while($data = mysqli_fetch_array($result))
  {
     $a[$i][] = $data['id'];
     $a[$i][] = $data['bin_1'];
     $a[$i][] = $data['time_1'];
     $a[$i][] = $data['bstat'];
     $i++;  

  }

  echo json_encode($a);

?>