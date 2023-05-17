<?php
  include 'database.php';
  $sql = "SELECT * FROM `all_cities` WHERE state_code LIKE '%".$_GET['id']."%'"; 
    $result = $conn->query($sql);
    $json = [];
   while($row = $result->fetch_assoc()){
        $json[$row['city_code']] = $row['city_name'];
   }
   echo json_encode($json);
   ?>