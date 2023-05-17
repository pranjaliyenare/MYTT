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

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  } 
  $projects = array();  
  $records = mysqli_query($conn, "SELECT * FROM `msd_notification_table` WHERE `exp_date` < NOW();");
    while ($project =  mysqli_fetch_assoc($records))
    {
        $projects[] = $project;
    }
    foreach ($projects as $project)
    {
       // mysqli_query($conn,"UPDATE `msd_notification_table` SET `status`= 2 WHERE `id`='".$project["id"]."'"); 
       mysqli_query($conn,"DELETE FROM `msd_notification_table` WHERE `id`='".$project["id"]."'"); 
    }

        $sql = mysqli_query($conn, "SELECT * FROM `msd_customer_plan_table` WHERE `end_date` = DATE(NOW())");
        while ($row = $sql->fetch_assoc()) {          
            mysqli_query($conn, "UPDATE `msd_customer_plan_table` SET `active_status`='expire',`status`= 1 WHERE `plan_id` = '".$row["plan_id"]."'");

             $notf_query = "INSERT INTO `msd_notification_table`(`user_id`, `comment_subject`, `comment_text`, `comment_type`, `start_date`) VALUES ('".$row["customer_id"]."','MYTT-EXPIRED PLAN','<b>Hello ". $row['customer_name'].",</b> <br/> Your Plan <b> ".$row["plan_name"]." (".$row["plan_id"].") </b> Has Been Expired...!!! On This Date <b> ".date('d/m/Y', strtotime($row['end_date']))." </b>.','expire', '".date('Y-m-d')."')";
             $result2 = $conn->query($notf_query);
           
             $notf_query1 = "INSERT INTO `msd_notification_table`(`user_id`, `comment_subject`, `comment_text`, `comment_type`, `start_date`) VALUES ('MS0001A','MYTT-EXPIRED PLAN','<b>Hello ". $row['customer_name'].",</b> <br/> Your Plan <b> ".$row["plan_name"]." (".$row["plan_id"].") </b> Has Been Expired...!!! On This Date <b> ".date('d/m/Y', strtotime($row['end_date']))." </b>.','expire', '".date('Y-m-d')."')";
             $result1 = $conn->query($notf_query1);

             $query = mysqli_query($conn, "SELECT * FROM `msd_register_customer_table` WHERE `register_id`='".$row["customer_id"]."' AND `register_status` != 2 AND `register_approved_status` ='approved'");
             $array=mysqli_fetch_assoc($query);
             $email = $array['register_email'];  
            //Send Mail Expired Plan
            $to = strtolower($email); //strtolower($_POST['email']);
            $subject = "MYTT-Expired Plan";
            $message = "<html>     
                            <head>     
                              <title>Expired Plan to Mythink Tank !</title>
                            </head>     
                            <body>     
                                <div> <img src='https://crm.mytt.in/assets/images/logo.png' alt='MYTT' style='width: 80px; height: 80px;'>     
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     
                                 <b> ".date("l jS \ F Y") ."</b> </div>     
                                <h4>Thank You For Invested In Mythink Tank Multimedia Pvt Ltd.</h4>     
                                <p><b>Dear ".$row['customer_name'].", </b></p>     
                                <p>Your Plan <b> ".$row["plan_name"]." (".$row["plan_id"].") </b> Has Been Expired...!!! On This Date <b> ".date('d/m/Y', strtotime($row['end_date']))." </b>.  </p>      
                                               
                                <p>For Any Questions you may have, do not hesitate to contact the Mythink Tank Multimedia Pvt Ltd Support Team,</p>     
                                <p><b>Email</b>- support@mytt.in</p>     
                                <p><b>Website</b>- <u>www.mytt.in</u></p>     
                            </body>     
                        </html>";     
             $header = "From:no-reply@mytt.in \r\n";     
             //$header .= "Cc:afgh@somedomain.com \r\n";     
             $header .= "MIME-Version: 1.0\r\n";     
             $header .= "Content-type: text/html\r\n";
             $retval = mail ($to,$subject,$message,$header);     
             //if( $retval == true ) {
             //   echo "Message sent successfully...";
             //}else {
             //   echo "Message could not be sent...";
             //}   
              $query=mysqli_query($conn, "INSERT INTO `msd_rej_appr_mail_table`(`user_id`, `to`, `from`, `subject`, `message`, `type`) VALUES ('".$row['customer_id']."','".$to."', 'no-reply@mytt.in', '".$subject."', '".$message."', 'user activated')");
            // $result = $conn->query($query);
            
        }
?>	