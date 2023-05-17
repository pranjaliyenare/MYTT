<?php
  include 'database.php';  
  session_start();
?>

<?php 
  
   if(isset($_GET['ajax_plan_id'])) { 
        $id = $_GET['ajax_plan_id'];
        $data = array();
        $query = mysqli_query($conn, "SELECT * FROM `msd_plan_table` WHERE `plan_id` ='".$id."' AND `status` != 2");
        
        //if($query->num_rows > 0) {
            $data =  mysqli_fetch_assoc($query);
        //}
        echo json_encode($data);
    }

?>