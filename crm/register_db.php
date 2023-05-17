<?php
  include 'database.php';
  session_start();

  if(isset($_POST['id'])) {
          $sql = "SELECT * FROM `all_cities` WHERE state_code LIKE '%".$_POST['id']."%'"; 
          $result = $conn->query($sql);
          $json = [];
        while($row = $result->fetch_assoc()){
              $json[$row['city_code']] = $row['city_name'];
        }
        echo json_encode($json);
  }
// Insert Customer Details
  if(isset($_POST['add'])) {  

    $uploadPath = 'assets/images/avatars/'; 
       if(!empty($_FILES['file']['name'])){ 
           if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath.date('d-m-Y').$_FILES['file']['name'])){ 
               //echo "File has been uploaded successfully."; 
           } else { 
               //echo 'File upload failed, please try again.';  
           } 
       } 
       
    $query = mysqli_query($conn, "SELECT lpad(MAX(`id`)+1,4,'0')id FROM `msd_register_customer_table`");
     $my_id_array=mysqli_fetch_assoc($query);
     $my_id=$my_id_array['id']; 
     if($my_id == "")  {
         $my_id = "0001";
     }
     $registerid = 'MS'.$my_id.'C';  

    if (isset($registerid)){
      $query = mysqli_query($conn, "SELECT `reference_id` FROM `msd_register_comp_agent_table` WHERE `agent_id` = '".$_POST['reference']."' AND `status` != 2");
      $array=mysqli_fetch_assoc($query);
      $referenceid = $array['reference_id']; 
      $string =$_POST['reference'];
      $length = strlen($string);
      $index = $length - 1; 
      $ref = $string[$index];
     
        if($ref == "G") {
          $query = mysqli_query($conn, "SELECT `reference_id` FROM `msd_register_comp_agent_table` WHERE `agent_id` = '".$_POST['reference']."' AND `status` != 2");
          $array=mysqli_fetch_assoc($query);
          $referenceid = $array['reference_id'];  
        } else if($ref == "M") {
          $referenceid = $_POST['reference'];
        } else if($ref == "E") {
          $referenceid = $_POST['reference'];
        } else if($ref == "A") {
          $referenceid = $_POST['reference'];
        }         
      
      
      // if(isset($_POST['invalidCheck'])){
      //   $empid =  $_POST['emp'];
      //   $empname =  $_POST['emp_hidden'];
      //   $empperc =  $_POST['emp_perc'];
      //   $check = 'YES';
      // } else {
      //   $empid =  "0";
      //   $empname = "";
      //   $empperc = "0";
      //   $check = 'NO';
      // }
      // Insert Value
      $sql = "INSERT INTO `msd_register_customer_table`(`register_id`, `admin_id`, `reference_id`,`agent_id`, `register_fname`, `register_mname`, `register_lname`, `register_dob`, `register_nominee_relation`, `register_nominee_name`, `register_addr1`, `register_addr2`,`register_city_id`, `register_city`, `register_state_id`, `register_state`, `register_pincode`, `register_country`, `register_mobno`, `register_email`, `register_password`, `register_repassword`, `register_invest_amount`, `register_profit_perc`, `register_agent_profit_perc`, `register_image`, `register_type`) 
      VALUES ('".$registerid."', '".$_SESSION["ADMINID"]."', '".$referenceid."', '".$_POST['reference']."', '".$_POST['first_name']."', '".$_POST['middle_name']."', '".$_POST['last_name']."', '".$_POST['dob']."', '".$_POST['nominee_relation']."', '".$_POST['nominee_name']."', '".$_POST['address1']."', '".$_POST['address2']."', '".$_POST['city']."','".$_POST['city_hidden']."', '".$_POST['state']."', '".$_POST['state_hidden']."', '".$_POST['pincode']."', '".$_POST['country']."', '".$_POST['mobno']."', '".strtolower($_POST['email'])."', '".$_POST['password']."', '".$_POST['repassword']."', '".$_POST['amount']."', '0','0', '". date('d-m-Y').$_FILES['file']['name']."', 'customer')";
    }
      if (mysqli_query($conn, $sql)) {
        //echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      $sqllogin = "INSERT INTO `msd_login_table`(`userid`,`username`, `password`, `type`) VALUES ('".$registerid."', '".strtolower($_POST['email'])."', '".$_POST['password']."', 'customer')";//

        // Send Email

       $userid = $_POST['first_name']." ".$_POST['middle_name']." ".$_POST['last_name'];

       $notf_query = "INSERT INTO `msd_notification_table`(`user_id`, `comment_subject`, `comment_text`, `comment_type`, `start_date`) VALUES ('".$registerid."','Welcome To MYTT','<b>Hello ".$userid.",</b> <br/> <span style=font-size:100px;>&#127942;</span> <br/><b>Congratulations </b> on being part of our MYTT. <br/> <b>Thanks <span style=font-size:20px;>&#128591;</span></b> For Signing up with MYTT.','welcome', '".date('Y-m-d h:i:s')."')";
       $result2 = $conn->query($notf_query);

       $to = strtolower($_POST['email']);

       $subject = "Welcome To Mythink Tank";

       

       $message = "<html>

                  <head>

                   <title>Welcome to Mythink Tank !</title>

                   

                   </head>

                   <body>

                   <div> <img src='assets/images/logo.png' alt='Italian Trulli'>

	                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    ".date("l jS \ F Y") ." </div>



                   <h4>Thank You For Registering Mythink Tank Multimedia Pvt Ltd.</h4>

                   <p>Dear ". $userid.", </p>

                   <p>You now have access to your Mythink Tank Multimedia Pvt Ltd account, where you can login and make deposit

                   & withdrawals also you can see daily credit report. </p>

                   <p>Update your personal details.</p>

                                   <h4>Your login Details are as:</h4>

                                       <table style='background-color:lightgrey'>

                                       <tr><td style='font-weight:bold'>Your User ID </td><td>: ".$registerid."</td></tr>

                                       <tr><td style='font-weight:bold'>Your Login ID </td><td>: ".strtolower($_POST['email'])."</td></tr>

                                       </table>

                   

                   <p>For Any Questions you may have, do not hesitate to contact the Mythink Tank Multimedia Pvt Ltd Support Team,</p>

                   <p>Email- support@mytt.in</p>

                   <p>Website- www.mytt.in</p>

                    </body>

                   </html>";

        

        $header = "From:no-reply@mytt.in \r\n";

        //$header .= "Cc:afgh@somedomain.com \r\n";

        $header .= "MIME-Version: 1.0\r\n";

        $header .= "Content-type: text/html\r\n";

        

        $retval = mail ($to,$subject,$message,$header);
        
        // if( $retval == true ) {
        //    echo "Message sent successfully...";
        // }else {
        //    echo "Message could not be sent...";
        // }

      if (mysqli_query($conn, $sqllogin)) {
        if($_SESSION['ROLE'] == 'admin'){
           echo "<script>window.location = 'master_user_profiledtl';</script>";
          //header("location: master_user_profiledtl");
        } else
        if($_SESSION['ROLE'] == 'manager'){
          echo "<script>window.location = 'master_user_profiledtl';</script>";
          //header("location: master_user_profiledtl");
        } else
        if($_SESSION['ROLE'] == 'employee'){
          echo "<script>window.location = 'master_user_profiledtl';</script>";
          //header("location: master_user_profiledtl");
       } else
       if($_SESSION['ROLE'] == 'agent'){
          echo "<script>window.location = 'master_user_profiledtl';</script>";
         //header("location: master_user_profiledtl");
       } else {
       //header("location: login");
       echo "<script>window.location = 'login';</script>";
       }
       exit();
     } else {
       echo "Error: " . $sqllogin . "<br>" . mysqli_error($conn);
      }
       
    }
// Update Customer Details
    if(isset($_POST['edit'])) {
      //include 'database.php';
      if (isset($_POST['register_id_name'])){
            $referenceid = "";
            $string = $_POST['reference'];
            $length = strlen($string);
            $index = $length - 1;
            $ref = $string[$index];

            $uploadPath = 'assets/images/avatars/';
              if(!empty($_FILES['file']['name'])) {
                  if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath.date('d-m-Y').$_FILES['file']['name'])) {
                      //echo '<script> alert("File has been uploaded successfully."); </script>';
                  } else {
                      //echo '<script> alert("File upload failed, please try again."); </script>';
                  }
              }

              if($_FILES['file']['name']) {
                  $profile = date('d-m-Y').$_FILES['file']['name'];            
              } else {
                  $profile = $_POST['userfile'];
              }
            
              if($ref == "G") {
                $query = mysqli_query($conn, "SELECT `reference_id` FROM `msd_register_comp_agent_table` WHERE `agent_id` = '".$_POST['reference']."' AND `status` != 2");
                $array=mysqli_fetch_assoc($query);
                $referenceid = $array['reference_id'];    
              } else if($ref == "M") {
                $referenceid = $_POST['reference'];
              } else if($ref == "E") {
                $referenceid = $_POST['reference'];
              } else if($ref == "A") {
                $referenceid = $_POST['reference'];
              }
          

            if(isset($_POST['invalidCheck'])){
              $empid = $_POST['emp'];
              $empname =  $_POST['emp_hidden'];
              $empperc =  $_POST['emp_perc'];
              $check = 'YES';
            } else {
              $empid = "0";
              $empname = "";
              $empperc = "0";
              $check = 'NO';
            }
            
            mysqli_query($conn,"UPDATE `msd_register_customer_table` SET `admin_id` = '".$_SESSION["ADMINID"]."', `reference_id` = '".$referenceid."',`agent_id`='".$_POST['reference']."',`register_fname`='".$_POST['first_name']."', `register_mname` = '".$_POST['middle_name']."', `register_lname`='".$_POST['last_name']."',  `register_dob` = '".$_POST['dob']."',`register_nominee_relation` ='".$_POST['nominee_relation']."', `register_nominee_name`='".$_POST['nominee_name']."', `register_addr1`='".$_POST['address1']."',`register_addr2`='".$_POST['address2']."',`register_city_id` ='".$_POST['city']."', `register_city`='".$_POST['city_hidden']."', `register_state_id`='".$_POST['state']."', `register_state`='".$_POST['state_hidden']."',`register_pincode`='".$_POST['pincode']."',`register_country`='".$_POST['country']."',`register_mobno`='".$_POST['mobno']."',`register_email`='".strtolower($_POST['email'])."', `register_invest_amount`='".$_POST['amount']."', `register_image` = '". $profile."', `register_emp_checked` = '".$check."', `reference_id` ='".$empid."', `register_emp_name` = '".$empname."', `register_emp_perc` = '".$empperc."', `register_status`= 1 WHERE `register_id`='".$_POST['register_id_name']."'");
            mysqli_query($conn,"UPDATE `msd_login_table` SET `username` = '". strtolower($_POST['email'])."', `status` = 1 WHERE `userid`='".$_POST['register_id_name']."'");
            echo "<script>window.location = '".$_POST['path']."';</script>";
        }
    }

    if(isset($_POST['cancel'])) {
      echo "<script>window.location = '".$_POST['path']."';</script>";
    }
   
?>