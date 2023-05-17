<?php
include 'database.php';
include 'security.php';
date_default_timezone_set('Asia/Kolkata');

// Comment Add User in Approve and Reject
if (isset($_POST['json_comment'])) {
$obj = $_POST['json_comment'];
    foreach($obj as $item) {
        mysqli_query($conn,"UPDATE `msd_register_customer_table` SET `comment`= '".$item['comment']."' WHERE `register_id` = '".$item['id']."'");
        echo $item['comment'];
    }
    exit;
}
// Comment Add Withdraw in Approve and Reject
if (isset($_POST['json_comment_with'])) {
   $obj = $_POST['json_comment_with'];
   
       foreach($obj as $item) {
           mysqli_query($conn,"UPDATE `msd_transaction_withdraw_table` SET `comment`= '".$item['comment']."' WHERE `withdraw_id` = '".$item['id']."'");
           echo $item['comment'];
       }
   }

// Add Promote As Agent
   if ($_GET['mode'] == 'addAgentYes') {   
        $query = mysqli_query($conn, 'SELECT * FROM `msd_register_customer_table` WHERE `register_id`="'. $_GET['id'].'" AND `register_status` !=2');
        $my_agent_yes_array=mysqli_fetch_assoc($query);

        $cust_id=$my_agent_yes_array['register_id']; 
        $admin_id=$my_agent_yes_array['admin_id'];
        $reference_id=$my_agent_yes_array['reference_id'];
        $register_name=$my_agent_yes_array['register_fname']. " " . $my_agent_yes_array['register_lname'];
        $register_addr=$my_agent_yes_array['register_addr1']. " ". $my_agent_yes_array['register_addr2'];
        $register_city_id=$my_agent_yes_array['register_city_id'];
        $register_city=$my_agent_yes_array['register_city'];
        $register_state_id=$my_agent_yes_array['register_state_id'];
        $register_state=$my_agent_yes_array['register_state'];
        $email=$my_agent_yes_array['register_email'];
        $mobno=$my_agent_yes_array['register_mobno'];
        $register_password=$my_agent_yes_array['register_password'];
        
        $query = mysqli_query($conn, "SELECT lpad(MAX(`id`)+1,4,'0')id FROM `msd_register_comp_agent_table` WHERE `status` != 2");
        $my_agent_yes_array=mysqli_fetch_assoc($query);
        $my_id=$my_agent_yes_array['id']; 
        if($my_id == "")  {
            $my_id = "0001";
        }
        $id = 'MS'.$my_id.'G';  

            $queryInsertAgent="INSERT INTO `msd_register_comp_agent_table`(`agent_id`, `admin_id`, `reference_id`, `agent_name`, `agent_mobile`, `agent_email`, `agent_password`, `agent_re_password`, `agent_address`, `agent_city_code`, `agent_state_code`, `agent_city`, `agent_state`, `customer_id`, `customer_login`, `agent_role_type`) VALUES ('".$id."','".$admin_id."','".$admin_id."','".$register_name."','".$mobno."','".$email."','".$register_password."','".$register_password."','".$register_addr."','".$register_city_id."','".$register_state_id."','".$register_city."','".$register_state."','".$cust_id."','YES','agent')";    
            $result = $conn->query($queryInsertAgent);

            $query1="INSERT INTO `msd_login_table`(`userid`,`username`, `password`, `type`) VALUES ('".$id."','".strtolower($email)."', '".$register_password."', 'agent')";
            $result1 = $conn->query($query1);
            mysqli_query($conn,"UPDATE `msd_register_customer_table` SET `agent_login_id`= '".$id."', `agent_login_checked`= 'YES' WHERE `register_id`='" . $_GET['id'] . "'");
            if($result)
            {
               echo "<script>alert('Your Form Submitted Successfully');</script>";
               echo "<script>window.location = 'master_user_approval';</script>";
            }
            else
            {
               echo "<script>alert('Your Form Not Submitted, Please Try Again After sometime..!!!')</script>";
           }
    }
    if ($_GET['mode'] == 'addAgentNo') {
        $query = mysqli_query($conn, 'SELECT * FROM `msd_register_customer_table` WHERE `register_id`="'. $_GET['id'].'" AND `register_status` !=2');
        $my_agent_no_array=mysqli_fetch_assoc($query);
        $loginID=$my_agent_no_array['agent_login_id'];
        //mysqli_query($conn,"DELETE FROM `msd_register_comp_agent_table` WHERE `agent_id` = '".$loginID."' ");
        mysqli_query($conn,"UPDATE `msd_register_comp_agent_table` SET `status`='2'  WHERE `agent_id` = '".$loginID."'");
        mysqli_query($conn,"UPDATE `msd_login_table` SET `status`='2' WHERE `userid` =  '".$loginID."'");
        mysqli_query($conn,"UPDATE `msd_register_customer_table` SET `agent_login_id`= '', `agent_login_checked`= 'NO' WHERE `register_id`='" . $_GET['id'] . "'");
        echo "<script>window.location = 'master_user_approval';</script>";
    }


// user approval
if ($_GET['mode'] == 'approved') {
if(count($_GET)>0) {
    mysqli_query($conn,"UPDATE `msd_register_customer_table` SET `register_approved_status`= 'approved' WHERE `register_id`='" . $_GET['id'] . "'");

    $query = mysqli_query($conn, 'SELECT `register_id` AS id, concat(`register_fname`," ",`register_lname`) AS name, `register_email` AS email FROM `msd_register_customer_table` WHERE `register_id`="'. $_GET['id'].'" AND `register_status` !=2');
    $my_id_array=mysqli_fetch_assoc($query);
    $id=$my_id_array['id']; 
    $name=$my_id_array['name'];
    $email=$my_id_array['email'];

// Send User Approval Email
    $to = strtolower($email);
    $subject = "MyThink Tank Account Approved!";    
    $message = "<html>
               <head>
                <title>Welcome to MyThink Tank !</title>
                
                </head>
                <body>
                <div> <img src='https://crm.mytt.in/assets/images/logo.png' alt='MYTT' style='width: 80px; height: 80px;'>
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <b>".date("l jS \ F Y") ."</b> </div>
                    <p><b>Dear ". $name.", </b></p>
                <p>Your MyThink Tank Account is Approved Successfully!</p>
                <p>Please login with your Login ID & Password. </p>                
                    <h4>Your login Details are as:</h4>
                    <table style='background-color:#8fbde8; border: solid 1px !important; padding: 5px;'>
                    <tr><td style='font-weight:bold'>User ID </td><td>: ".$id."</td></tr>
                    <tr><td style='font-weight:bold'>Login ID </td><td>: ".$email."</td></tr>
                    </table>
                
                <p>For Any Questions you may have, do not hesitate to contact the MyThink Tank Support Team,</p>
                <p><b>Email</b>- support@mytt.in</p>
                <p><b>Website</b>- <u>www.mytt.in</u></p>
                 </body>
                </html>";
     
     $header = "From:no-reply@mytt.in \r\n";
     //$header .= "Cc:afgh@somedomain.com \r\n";
     $header .= "MIME-Version: 1.0\r\n";
     $header .= "Content-type: text/html\r\n";
     
     $retval = mail ($to,$subject,$message,$header);
     
    //  if( $retval == true ) {
    //     echo "Message sent successfully...";
    //  }else {
    //     echo "Message could not be sent...";
    //  }
     $query="INSERT INTO `msd_rej_appr_mail_table`(`user_id`, `to`, `from`, `subject`, `message`, `type`) VALUES ('".$id."','".$to."', 'no-reply@mytt.in', '".$subject."', '".$message."', 'user approved')";
     $result = $conn->query($query);
     echo "<script>window.location = 'master_user_approval';</script>";
    //header("location: master_user_approval");
   exit();
}
}

// User Reject 
if ($_GET['mode'] == 'rejected') {
    if(count($_GET)>0) {
        mysqli_query($conn,"UPDATE `msd_register_customer_table` SET `register_approved_status`= 'rejected' WHERE `register_id`='" . $_GET['id'] . "'");
        
        $query = mysqli_query($conn, 'SELECT `register_id` AS id, concat(`register_fname`," ",`register_lname`) AS name, `register_email` AS email FROM `msd_register_customer_table` WHERE `register_id`="'. $_GET['id'].'" AND `register_status` !=2');
    $my_id_array=mysqli_fetch_assoc($query);
    $id=$my_id_array['id']; 
    $name=$my_id_array['name'];
    $email=$my_id_array['email'];

// Send User Reject Email
$to = strtolower($email);
$subject = "MyThink Tank Account Rejected!";    
$message = "<html>
           <head>
            <title>Welcome to MyThink Tank !</title>                
            </head>
            <body>
            <div> 
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             ".date("l jS \ F Y") ." </div>
            <p><b>Hello ". $name.", </b></p>
            <p>Your MyThink Tank Account is Rejected!</p>
            <p>For More information contact support team.</p>                
                <h4>Your login Details are as:</h4>
                <table style='background-color:#8fbde8; border: solid 1px !important; padding: 5px;'>
                <tr><td style='font-weight:bold'>Your User ID </td><td>: ".$id."</td></tr>
                <tr><td style='font-weight:bold'>Your Login ID </td><td>: ".$email."</td></tr>
                </table>
            
            <p>For Any Questions you may have, do not hesitate to contact the MyThink Tank Support Team,</p>
            <p><b>Email</b>- support@mytt.in</p>
            <p><b>Website</b>- <u>www.mytt.in</u></p>
             </body>
            </html>";
 
 $header = "From:no-reply@mytt.in \r\n";
 $header .= "MIME-Version: 1.0\r\n";
 $header .= "Content-type: text/html\r\n";
 
 $retval = mail ($to,$subject,$message,$header);
     
    //  if( $retval == true ) {
    //     echo "Message sent successfully...";
    //  }else {
    //     echo "Message could not be sent...";
    //  }
    $query="INSERT INTO `msd_rej_appr_mail_table`(`user_id`, `to`, `from`, `subject`, `message`, `type`) VALUES ('".$id."','".$to."', 'no-reply@mytt.in', '".$subject."', '".$message."', 'user rejected')";
     $result = $conn->query($query);
     echo "<script>window.location = 'master_user_approval';</script>";
       exit();
    }
}

//Activate Profit
if ($_GET['mode'] == 'activate') {
    if(count($_GET)>0) {
        mysqli_query($conn,"UPDATE `msd_register_customer_table` SET `register_activate_status`= 'activate' WHERE `register_id`='" . $_GET['id'] . "'");
        $query = mysqli_query($conn, 'SELECT `register_id` AS id, concat(`register_fname`," ",`register_lname`) AS name, `register_email` AS email FROM `msd_register_customer_table` WHERE `register_id`="'. $_GET['id'].'" AND `register_status` !=2');
    $my_id_array=mysqli_fetch_assoc($query);
    $id=$my_id_array['id']; 
    $name=$my_id_array['name'];
    $email=$my_id_array['email'];

// Send Activate Email
$to = strtolower($email);
$subject = "MyThink Tank Account Activated!";    
$message = "<html>
           <head>
            <title>Welcome to MyThink Tank !</title>
            
            </head>
                <body>
                    <div> <img src='https://crm.mytt.in/assets/images/logo.png' alt='MYTT' style='width: 80px; height: 80px;'>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <b>".date("l jS \ F Y") ."</b> </div>
                        <p><b>Dear ". $name.", </b></p>
                    <p>Your MyThink Tank Account is activated Successfully!</p>
                    <p>Please login with your Login ID & Password. </p>                
                        <h4>Your login Details are as:</h4>
                        <table style='background-color:#8fbde8; border: solid 1px !important; padding: 5px;'>
                        <tr><td style='font-weight:bold'>Your User ID </td><td>: ".$id."</td></tr>
                        <tr><td style='font-weight:bold'>Your Login ID </td><td>: ".$email."</td></tr>
                        </table>
                    
                    <p>For Any Questions you may have, do not hesitate to contact the MyThink Tank Support Team,</p>
                    <p><b>Email</b>- support@mytt.in</p>
                    <p><b>Website</b>- <u>www.mytt.in</u></p>
                </body>
            </html>";
 
 $header = "From:no-reply@mytt.in \r\n";
 //$header .= "Cc:afgh@somedomain.com \r\n";
 $header .= "MIME-Version: 1.0\r\n";
 $header .= "Content-type: text/html\r\n";
 
 $retval = mail ($to,$subject,$message,$header);
     
    //  if( $retval == true ) {
    //     echo "Message sent successfully...";
    //  }else {
    //     echo "Message could not be sent...";
    //  }
    $query="INSERT INTO `msd_rej_appr_mail_table`(`user_id`, `to`, `from`, `subject`, `message`, `type`) VALUES ('".$id."','".$to."', 'no-reply@mytt.in', '".$subject."', '".$message."', 'user activated')";
     $result = $conn->query($query);
     echo "<script>window.location = 'master_user_approval';</script>";
        //header("location: master_user_approval");
       exit();
    }
    }
// Send Deactivate
if ($_GET['mode'] == 'deactivate') {
    if(count($_GET)>0) {
        mysqli_query($conn,"UPDATE `msd_register_customer_table` SET `register_activate_status`= 'deactivate' WHERE `register_id`='" . $_GET['id'] . "'");
        
        $query = mysqli_query($conn, 'SELECT `register_id` AS id, concat(`register_fname`," ",`register_lname`) AS name, `register_email` AS email FROM `msd_register_customer_table` WHERE `register_id`="'. $_GET['id'].'" AND `register_status` !=2');
        $my_id_array=mysqli_fetch_assoc($query);
        $id=$my_id_array['id']; 
        $name=$my_id_array['name'];
        $email=$my_id_array['email'];
            
    // Send Activate Email
        $to = strtolower($email);
        $subject = "MyThink Tank Account Deactivate!";    
        $message = "<html>
           <head>
            <title>Welcome to MyThink Tank !</title>
            
            </head>
            <body>
            <div> 
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             ".date("l jS \ F Y") ." </div>
                <p><b>Hello ". $name.", </b></p>
            <p>Your MyThink Tank Account is Deactivated!</p>
            
            <p>For Any Questions you may have, do not hesitate to contact the MyThink Tank Support Team,</p>
            <p><b>Email</b>- support@mytt.in</p>
            <p><b>Website</b>- <u>www.mytt.in</u></p>
             </body>
            </html>";
 
 $header = "From:no-reply@mytt.in \r\n";
 //$header .= "Cc:afgh@somedomain.com \r\n";
 $header .= "MIME-Version: 1.0\r\n";
 $header .= "Content-type: text/html\r\n";
 
 $retval = mail ($to,$subject,$message,$header);
     
    //  if( $retval == true ) {
    //     echo "Message sent successfully...";
    //  }else {
    //     echo "Message could not be sent...";
    //  }
    $query="INSERT INTO `msd_rej_appr_mail_table`(`user_id`, `to`, `from`, `subject`, `message`, `type`) VALUES ('".$id."','".$to."', 'no-reply@mytt.in', '".$subject."', '".$message."', 'user deactivated')";
     $result = $conn->query($query);
            echo "<script>window.location = 'master_user_approval';</script>";
            //header("location: master_user_approval");
           exit();
        }
    }

    //Add comment
    if(isset($_POST['submit'])) {

        mysqli_query($conn,"UPDATE `msd_register_customer_table` SET `comment`=".$_POST["comment"]." WHERE `register_id`='" . $_GET['id'] . "'");
        //include "master_approval_db?mode=rejected&id='.$register_id.'";
        if(count($_GET)>0) {
            mysqli_query($conn,"UPDATE `msd_register_customer_table` SET `register_approved_status`= 'rejected' WHERE `register_id`='" . $_GET['id'] . "'");
            //header("location: master_user_approval");
            echo "<script>window.location = 'master_user_approval';</script>";
            exit();
        }
    }

// ************************************* Withdraw *****************************************************
if ($_GET['mode'] == 'wapproved') {
    if(count($_GET)>0) {
    date_default_timezone_set('Asia/Kolkata');
    mysqli_query($conn,"UPDATE `msd_transaction_withdraw_table` SET `approve_status`= 'approved', `approve_date` = '".date('Y-m-d H:i:s')."' WHERE `withdraw_id`='" . $_GET['id'] . "'");
      
    if ($_GET['type'] == 'customer') {    
      $query = mysqli_query($conn, 'SELECT `user_id` AS id, `amount`, concat(`register_fname`," ", `register_lname`) AS name, `register_email` AS email, `msd_transaction_withdraw_table`.`date` AS approvedate FROM `msd_transaction_withdraw_table` LEFT JOIN `msd_register_customer_table` ON `register_id` = `user_id` WHERE `withdraw_id` = "'. $_GET['id'].'" AND `register_status` !=2');
      $my_id_array=mysqli_fetch_assoc($query);
      $id=$my_id_array['id']; 
      $name=$my_id_array['name'];
      $email=$my_id_array['email'];
      $date=date('d/m/Y H:i:s', strtotime($my_id_array['approvedate']));
      $amount= $my_id_array['amount'];
    } else if($_GET['type'] == 'agent') {
      $query = mysqli_query($conn, 'SELECT `user_id` AS id, `amount`, concat(agent_id, "-", agent_name) AS name, `agent_email` AS email, `msd_transaction_withdraw_table`.date AS approvedate FROM `msd_transaction_withdraw_table` LEFT JOIN `msd_register_comp_agent_table` ON `agent_id` = `user_id` WHERE `withdraw_id` = "'. $_GET['id'].'" AND `msd_register_comp_agent_table`.`status` !=2');
      $my_id_array=mysqli_fetch_assoc($query);
      $id=$my_id_array['id']; 
      $name=$my_id_array['name'];
      $email=$my_id_array['email'];
     $date=date('d/m/Y H:i:s', strtotime($my_id_array['approvedate']));
     $amount= $my_id_array['amount']; 
  }
    $notf_query = "INSERT INTO `msd_notification_table`(`user_id`, `comment_subject`, `comment_text`, `comment_type`, `start_date`) VALUES ('".$id."','MYTT-Withdraw','<b>Hello ". $name.",</b> <br/> Your Withdrawal Amount INR <b> ". $amount." </b> has been Successfully Processed On Date <b>". date("d/m/Y")."</b>','withdraw', '".date('Y-m-d')."')";
    $result2 = $conn->query($notf_query);
// Send User Approval Email
    $to = strtolower($email);
    $subject = "MyThink Tank Withdraw Approved!";    
    $message = "<html>
               <head>
                    <title>Welcome to MyThink Tank !</title>                
                </head>
                <body>
                <div> <img src='https://crm.mytt.in/assets/images/logo.png' alt='MYTT' style='width: 80px; height: 80px;'>
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <b>".date("l jS \ F Y") ." </b></div>
                    <p><b>Dear ". $name.", </b></p>
                <p>Your Withdrawal Request For ₹ ".$amount." on date ".$date." has been Approved. </p>
                <p>Within 24hr Your Amount Transferred to your bank account.</p>                
                 
                <p>For Any Questions you may have, do not hesitate to contact the MyThink Tank Support Team,</p>
                <p><b>Email</b>- support@mytt.in</p>
                <p><b>Website</b>- <u>www.mytt.in</u></p>
                 </body>
                </html>";
  
                $header = "From:no-reply@mytt.in \r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
  
        $retval = mail($to,$subject,$message,$header);
      
         if( $retval == true ) {
            //echo "Message sent successfully...";
         }else {
            //echo "Message could not be sent...";
         }
         $query="INSERT INTO `msd_rej_appr_mail_table`(`user_id`, `to`, `from`, `subject`, `message`, `type`) VALUES ('".$id."','".$to."', 'no-reply@mytt.in', '".$subject."', '".$message."', 'withdraw approved')";
         $result = $conn->query($query);
         echo "<script>window.location = 'master_withdraw_approval';</script>";
   }
 }
 if ($_GET['mode'] == 'wrejected') {
    if(count($_GET)>0) {
        mysqli_query($conn,"UPDATE `msd_transaction_withdraw_table` SET `approve_status`= 'rejected', `approve_date` = '".date("Y-m-d h:i:s")."' WHERE `withdraw_id`='" . $_GET['id'] . "'");
       // header("location: master_withdraw_approval");
       //exit();
       if($_GET['type'] == 'customer') {
            $query = mysqli_query($conn, 'SELECT `user_id` AS id, `amount`, concat(`register_fname`," ", `register_lname`) AS name, `register_email` AS email, `msd_transaction_withdraw_table`.date AS approvedate FROM `msd_transaction_withdraw_table` LEFT JOIN `msd_register_customer_table` ON `register_id` = `user_id` WHERE `withdraw_id` = "'. $_GET['id'].'" AND `register_status` !=2');
            $my_id_array=mysqli_fetch_assoc($query);
            $id=$my_id_array['id']; 
            $name=$my_id_array['name'];
            $email=$my_id_array['email'];
            //$date= date_format($my_id_array['approvedate'],"d/m/Y H:i:s");
            $date=date('d/m/Y H:i:s', strtotime($my_id_array['approvedate']));
            //echo date_format($my_id_array['approvedate'],"d/m/Y H:i:s");
            $amount= $my_id_array['amount'];
        } else if($_GET['type'] == 'agent') {
            $query = mysqli_query($conn, 'SELECT `user_id` AS id, `amount`, concat(agent_id, "-", agent_name) AS name, `agent_email` AS email, `msd_transaction_withdraw_table`.date AS approvedate FROM `msd_transaction_withdraw_table` LEFT JOIN `msd_register_comp_agent_table` ON `agent_id` = `user_id` WHERE `withdraw_id` = "'. $_GET['id'].'" AND `msd_register_comp_agent_table`.`status` !=2');
            $my_id_array=mysqli_fetch_assoc($query);
            $id=$my_id_array['id']; 
            $name=$my_id_array['name'];
            $email=$my_id_array['email'];
            $date=date('d/m/Y H:i:s', strtotime($my_id_array['approvedate']));
            $amount= $my_id_array['amount'];
        }

        // Send User Approval Email
        $to = strtolower($email);
        $subject = "MyThink Tank Withdraw Rejected!";    
        $message = "<html>
                <head>
                        <title>Welcome to MyThink Tank !</title>                
                    </head>
                    <body>
                    <div> <img src='https://crm.mytt.in/assets/images/logo.png' alt='MYTT' style='width: 80px; height: 80px;'>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <b> ".date("l jS \ F Y") ." </b></div>
                        <p><b>Hello ". $name.", </b></p>
                    <p>Your Withdrawal Request For ₹ ".$amount." on date ".$date." has been Rejected. </p>
                    <p>Please Contact Support Team.</p>                
                    <p><b>Email</b>- support@mytt.in</p>
                    <p><b>Website</b>- <u>www.mytt.in</u></p>
                    </body>
                    </html>";
        
        $header = "From:no-reply@mytt.in \r\n";
        //$header .= "Cc:afgh@somedomain.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        
        $retval = mail($to,$subject,$message,$header);
     
    //if( $retval == true ) {
    //   echo "Message sent successfully...";
    //}else {
    //   echo "Message could not be sent...";
    //}   
    $query="INSERT INTO `msd_rej_appr_mail_table`(`user_id`, `to`, `from`, `subject`, `message`, `type`) VALUES ('".$id."','".$to."', 'no-reply@mytt.in', '".$subject."', '".$message."', 'withdraw rejected')";
    $result = $conn->query($query);
       echo "<script>window.location = 'master_withdraw_approval';</script>";
    }
}

// Comment Add Deposit in Approve and Reject
if (isset($_POST['json_dep_comment'])) {
    $obj = $_POST['json_dep_comment'];
    echo "<script>alert('Approved Successfully')</script>";
        foreach($obj as $item) {
            mysqli_query($conn,"UPDATE `msd_transaction_payment_table` SET `comment`= '".$item['comment']."' WHERE `id` = '".$item['id']."'");
            echo $item['comment'];
        }
    }

    if ($_GET['mode'] == 'approvedDept') {
        if (count($_GET)>0) {
            mysqli_query($conn, "UPDATE `msd_transaction_payment_table` SET `approve_status`= 'approved' WHERE `id`='".$_GET['id']."'");        

            $query = mysqli_query($conn, "SELECT * FROM `msd_transaction_payment_table` WHERE `id` = '".$_GET['id']."' AND `status` != 2");
            $dept_array=mysqli_fetch_assoc($query);
            $user_id =$dept_array['user_id'];
            $name =$dept_array['name'];
            $plan_id =$dept_array['plan_id'];
            $amount =$dept_array['amount'];
            $pay_type =$dept_array['pay_type'];
            $transaction_id =$dept_array['transaction_id'];
            $description =$dept_array['description'];
            $comment =$dept_array['comment'];
            $date =$dept_array['date'];
            $payment_by =$dept_array['payment_by'];

            $query1 = mysqli_query($conn, "SET sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");
            $query1 = mysqli_query($conn, "SELECT lpad(MAX(`id`)+1,9,'0') maxid, id FROM `msd_xway_pay_accdtl_table` WHERE `status` != 2");
            $array1=mysqli_fetch_assoc($query1);                                                
             $accountid = "M".$array1['maxid']; 

            $query2 = mysqli_query($conn, "SELECT lpad(MAX(`id`)+1,5,'0') maxid, id FROM `msd_xway_pay_accdtl_table` WHERE `status` != 2");
            $array2=mysqli_fetch_assoc($query2);                                                
            $referenceno = "M".$array2['maxid']; 

            $query3 = mysqli_query($conn, "SELECT * FROM `msd_register_customer_table` WHERE `register_id` = '".$user_id."' AND `register_status` != 2");
            $my_id_array=mysqli_fetch_assoc($query3);
            $reg =$my_id_array['register_id'];
            $name= $my_id_array['register_fname']." ".$my_id_array['register_lname'];
            $email =$my_id_array['register_email'];
            $mobno =$my_id_array['register_mobno'];
            $addr =$my_id_array['register_addr1'];
            $city =$my_id_array['register_city'];
            $state =$my_id_array['register_state'];
            $pincode =$my_id_array['register_pincode'];
            
            $xwaykey='4f00bfb4958bff8267f1ba3d6f073fb5f42e3a14'; // Provided by swipez admin
            $hash = $xwaykey."|".$accountid."|".$amount."|".$referenceno."|".$_POST['return_url'];
            $secure_hash = md5($hash);

            $query= "INSERT INTO `msd_xway_pay_accdtl_table` (`account_id`, `vendor_id`, `reference_no`, `amount`, `description`, `return_url`, `name`, `address`, `city`, `state`, `postal_code`, `mobile`, `email`, `userid`, `paymentby`, `plan_id`, `Udf4`, `Udf5`, `Secure_hash`) VALUES ('". $accountid."', '0', '". $referenceno."','".$amount."','".$amount."','https://crm.mytt.in/response.php','".$name."','". $addr."','".$city."','".$state."','".$pincode."','".$mobno."','".$email."','".$user_id."','".$payment_by."','".$plan_id."','0','0','". $secure_hash."')";
            $result = $conn->query($query);
            
            $query1="INSERT INTO `msd_xway_pay_response_table`( `transaction_id`, `reference_no`, `mode`, `status`, `amount`, `date`, `message`, `merchant_email`, `mobile_no`, `company_name`, `billing_name`, `billing_email`, `billing_mobile`, `billing_address`, `billing_city`, `billing_state`, `billing_postal_code`, `franchise_id`, `userid`, `paymentby`, `plan_id`, `udf4`, `udf5`, `request_amount`, `type`) VALUES ('".$transaction_id."', '". $referenceno."', '".$pay_type."', 'success', '".$amount."','".date('Y-m-d H:m:s', strtotime($date))."','".$amount."', 'no-reply@mytt.in', 9604533533,'MyThink Tank Multimedia Pvt Ltd','".$name."','".$email."','".$mobno."','".$addr."','".$city."','".$state."','".$pincode."','0','".$user_id."','".$payment_by."','".$plan_id."','0','0','0', 'request')";
            $result1 = $conn->query($query1);

            $notf_query = "INSERT INTO `msd_notification_table`(`user_id`, `comment_subject`, `comment_text`, `comment_type`, `start_date`) VALUES ('".$user_id."','MYTT-Deposit','<b>Hello ".$name.",</b> <br/> Your Investment Amount INR <b> ".$amount." </b> Deposited on <b>". date("d/m/Y", strtotime($date))." </b> Successfully...!!!','deposit', '".date('Y-m-d H:m:s', strtotime($date))."')";
            $result2 = $conn->query($notf_query);

            if($result1)
            {
                echo "<script>alert('Approved Successfully')</script>";
                echo "<script>window.location = 'master_deposit_approval';</script>";
            }
            else
            {
                echo "<script>alert('Do Not Approve!!')</script>";
            }
            exit();
        }
    } 

    if ($_GET['mode'] == 'rejectedDept') {
        if (count($_GET)>0) {
            mysqli_query($conn, "UPDATE `msd_transaction_payment_table` SET `approve_status`= 'rejected' WHERE `id`='" . $_GET['id'] . "'");        
            echo "<script>window.location = 'master_deposit_approval';</script>";
            exit();
        }
    }
 ?>