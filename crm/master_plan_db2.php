<?php
  include 'database.php';
  if(isset($_POST['id'])) {
    $sql = "SELECT * FROM `msd_customer_plan_table` WHERE `customer_id` = '".$_POST['id']."' AND `status` != 2"; 
      $result = $conn->query($sql);
      $json = [];
    while($row = $result->fetch_assoc()){
          $json[$row['plan_id']] = $row['plan_name'];
    }
    echo json_encode($json);
  }
?>