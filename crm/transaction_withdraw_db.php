<?php 
include 'database.php';
    if(isset($_POST['submit_name'])) {
        $query="INSERT INTO msd_transaction_withdraw_table (`user_id`, `bank_id`, `amount`, `type`) VALUES('".$_POST['id']."', '".$_POST['bankname']."', ".$_POST['amount_name'].", 'agent')";
        $result = $conn->query($query);
        
          if($result)
          {
             echo "<script>alert('Record Added Successfully')</script>";
             echo "<script>window.location = 'trans_agent_withdraw';</script>";
          }
          else
          {
            echo "<script>alert('Record Not Added Successfully')</script>";
            echo "<script>window.location = 'trans_agent_withdraw';</script>";              
          }
 
     }
    
?>