<?php
$whitelist = [
    // IPv4 address
    '127.0.0.1', 

    // IPv6 address
    '::1'
];

if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) 
    {
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "allianza_crm_mytt";
} else {
  $servername = "allianza.in";
  $username = "allianza_crm_mytt";
  $password = "3,mx-M=EsMHW";
  $dbname = "allianza_crm_mytt";
}
  //$servername = "airgigafiber.com";
  //$username = "sidwddfj_sidwddfj";
  //$password = "Krisna@1299";
  //$dbname = "sidwddfj_mindstay";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
} 
?>
