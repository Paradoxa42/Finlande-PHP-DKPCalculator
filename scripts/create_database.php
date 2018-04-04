<?php 
$connectstr_dbhost = 'localhost'; 
$connectstr_dbname = 'dkpTable'; 
$connectstr_dbusername = 'root'; 
$connectstr_dbpassword = 'dfghj'; 
  
foreach ($_SERVER as $key => $value) { 
  if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) { 
  continue; 
  } 
  
  $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value); 
  $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value); 
  $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value); 
  $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value); 
} 
  
echo "dbhost: ".$connectstr_dbhost."<br>"; 
echo "dbname: ".$connectstr_dbname."<br>"; 
echo "dbusername: ".$connectstr_dbusername."<br>"; 
echo "dbpassword: ".$connectstr_dbpassword."<br>"; 
  
$link = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname); 
  
if (!$link) { 
  echo "Error: Unable to connect to MySQL." . PHP_EOL; 
  echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL; 
  echo "Debugging error: " . mysqli_connect_error() . PHP_EOL; 
  exit; 
} 

echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL; 
echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL; 

echo "creating tables..."."\n";

if (mysqli_query($link, "CREATE TABLE activityModel ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL , dkpEarn INT NOT NULL ) ENGINE = InnoDB")) {
	echo "activityModel created"."\n";
}
else {
	echo "Error in creating activityModel\n".$link->error."\n";
}

if (mysqli_query($link, "CREATE TABLE characters ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL ) ENGINE = InnoDB;")) {
	echo "character created"."\n";
}
else {
	echo "Error in creating character\n".$link->error."\n";
}

if (mysqli_query($link, "CREATE TABLE activity ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, idCharacter INT NOT NULL , idActivity INT NOT NULL , dateTime DATE NOT NULL ) ENGINE = InnoDB;")) {
	echo "activity created"."\n";
}
else {
	echo "Error in creating activity\n".$link->error."\n";
}
  
mysqli_close($link); 
?> 