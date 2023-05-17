<?php
    if(base64_decode($_GET['type']) == "delete") {
      include 'database.php';
      //if (isset($_POST['register_id_name'])){
            mysqli_query($conn,"UPDATE `msd_register_customer_table` SET `register_approved_status`= 'rejected', `register_activate_status` = 'deactivate', `register_status`= 2 WHERE `register_id`='".base64_decode($_GET['id'])."'");
            mysqli_query($conn,"UPDATE `msd_login_table` SET  `status` = 2 WHERE `userid`='".base64_decode($_GET['id'])."'");
            echo "<script>window.location = 'master_user_profiledtl';</script>";
        //}
    }
?>