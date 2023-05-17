<?php
   include 'database.php';
   session_start();

   // Insert Customer Details
  if(isset($_POST['add'])) {  

    $validation = mysqli_query($conn, "SELECT `register_email` AS mail FROM `msd_register_customer_table` WHERE `register_status` != 2 AND `register_email`='".$_POST['email']."' ");
    $validation_array=mysqli_fetch_assoc($validation);
    if(strtolower($validation_array["mail"]) == $_POST['email'])
    {
      echo '<script> alert("'.$_POST['email'].' This Email Already Register. Please try another."); </script>';
      echo "<script>window.location = 'master_user_profiledtl';</script>";
    } else {
        $uploadPath = 'assets/images/avatars/';
        if (!empty($_FILES['file']['name'])) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath.date('d-m-Y').$_FILES['file']['name'])) {
                //echo "File has been uploaded successfully.";
            } else {
                //echo 'File upload failed, please try again.';
            }
        }
       
        $query = mysqli_query($conn, "SELECT lpad(MAX(`id`)+1,4,'0')id FROM `msd_register_customer_table`");
        $my_id_array=mysqli_fetch_assoc($query);
        $my_id=$my_id_array['id'];
        if ($my_id == "") {
            $my_id = "0001";
        }
        $registerid = 'MS'.$my_id.'C';

        if (isset($registerid)) {
            $query = mysqli_query($conn, "SELECT `reference_id` FROM `msd_register_comp_agent_table` WHERE `agent_id` = '".$_POST['reference']."' AND `status` != 2");
            $array=mysqli_fetch_assoc($query);
            $referenceid = $array['reference_id'];
            $agentid = "";
            $string =$_POST['reference'];
            $length = strlen($string);
            $index = $length - 1;
            $ref = $string[$index];

            if ($ref == "G") {
                $query = mysqli_query($conn, "SELECT `reference_id` FROM `msd_register_comp_agent_table` WHERE `agent_id` = '".$_POST['reference']."' AND `status` != 2");
                $array=mysqli_fetch_assoc($query);
                $referenceid = $array['reference_id'];
                $agentid = $_POST['reference'];
            } elseif ($ref == "M") {
                $referenceid = $_POST['reference'];
                $agentid = $_POST['reference'];
            } elseif ($ref == "E") {
                $referenceid = $_POST['reference'];
                $agentid = $_POST['reference'];
            } elseif ($ref == "A") {
                $referenceid = $_POST['reference'];
                $agentid = $_POST['reference'];
            }
            // Insert Value
            $sql = "INSERT INTO `msd_register_customer_table`(`register_id`, `admin_id`, `reference_id`,`agent_id`, `register_fname`, `register_mname`, `register_lname`, `register_dob`, `register_nominee_relation`, `register_nominee_name`, `register_addr1`, `register_addr2`,`register_city_id`, `register_city`, `register_state_id`, `register_state`, `register_pincode`, `register_country`, `register_mobno`, `register_email`, `register_password`, `register_repassword`, `register_invest_amount`,  `register_profit_perc`, `register_agent_profit_perc`, `register_image`, `register_type`) 
            VALUES ('".$registerid."', 'MS0001A', '".$referenceid."', '".$agentid."', '".$_POST['first_name']."', '".$_POST['middle_name']."', '".$_POST['last_name']."', '".$_POST['dob']."', '".$_POST['nominee_relation']."', '".$_POST['nominee_name']."', '".$_POST['address1']."', '".$_POST['address2']."', '".$_POST['city']."','".$_POST['city_hidden']."', '".$_POST['state']."', '".$_POST['state_hidden']."', '".$_POST['pincode']."', '".$_POST['country']."', '".$_POST['mobno']."', '".strtolower($_POST['email'])."', '".$_POST['password']."', '".$_POST['repassword']."', '".$_POST['amount']."', '0','0', '". date('d-m-Y').$_FILES['file']['name']."', 'customer')";
        }
        if (mysqli_query($conn, $sql)) {
            //echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $sqllogin = "INSERT INTO `msd_login_table`(`userid`,`username`, `password`, `type`) VALUES ('".$registerid."', '".strtolower($_POST['email'])."', '".$_POST['password']."', 'customer')";//

        // Send Email

        $userid = $_POST['first_name']." ".$_POST['last_name'];

        $notf_query = "INSERT INTO `msd_notification_table`(`user_id`, `comment_subject`, `comment_text`, `comment_type`, `start_date`) VALUES ('".$registerid."','Welcome To MYTT','<b>Hello ".$userid.",</b> <br/> <span style=font-size:100px;>&#127942;</span> <br/><b>Congratulations </b> on being part of our MYTT. <br/> <b>Thanks <span style=font-size:20px;>&#128591;</span></b> For Signing up with MYTT.','welcome', '".date('Y-m-d h:i:s')."')";
        $result2 = $conn->query($notf_query);

        $to = strtolower($_POST['email']);

        $subject = "Welcome To Mythink Tank";

            

        $message = "<html>

                        <head>

                        <title>Welcome to Mythink Tank !</title>

                        

                        </head>

                        <body>

                        <div> <img src='https://crm.mytt.in/assets/images/logo.png' alt='MYTT' style='width: 80px; height: 80px;'>  

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <b> ".date("l jS \ F Y") ."</b> </div>



                        <h4>Thank You For Registering Mythink Tank Multimedia Pvt Ltd.</h4>

                        <p><b>Dear ". $userid.", </b></p>

                        <p>You now have access to your Mythink Tank Multimedia Pvt Ltd account, where you can login and make deposit

                        & withdrawals also you can see daily credit report. </p>

                        <p>Update your personal details.</p>

                                        <h4>Your login Details are as:</h4>

                                            <table style='background-color:lightgrey'>

                                            <tr><td style='font-weight:bold'>Your User ID </td><td>: ".$registerid."</td></tr>

                                            <tr><td style='font-weight:bold'>Your Login ID </td><td>: ".strtolower($_POST['email'])."</td></tr>

                                            </table>

                        

                        <p>For Any Questions you may have, do not hesitate to contact the Mythink Tank Multimedia Pvt Ltd Support Team,</p>

                        <p><b>Email</b>- support@mytt.in</p>

                        <p><b>Website</b>- <u>www.mytt.in</u></p>

                            </body>

                        </html>";

                

        $header = "From:no-reply@mytt.in \r\n";

        //$header .= "Cc:afgh@somedomain.com \r\n";

        $header .= "MIME-Version: 1.0\r\n";

        $header .= "Content-type: text/html\r\n";

                

        $retval = mail($to, $subject, $message, $header);
                
        // if( $retval == true ) {
        //    echo "Message sent successfully...";
        // }else {
        //    echo "Message could not be sent...";
        // }

        if (mysqli_query($conn, $sqllogin)) {
            echo "<script>window.location = 'login';</script>";
        }
    }
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="MYTT Registration Form">
    <meta name="author" content="MYTT">
    <meta name="keywords" content="MYTT Registration Form">

    <!-- Title Page-->
    <title>Register Forms</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css"> -->

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2register/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/mainregister.css" rel="stylesheet" media="all">

      <style>
          .btn--blue {
             background: dodgerblue;
          }
      </style>  
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Registration Form</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="register1.php" enctype="multipart/form-data" id="uploadForm">
                        
                        <div class="form-row">
                            <div class="name">ID*</div>
                               <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                        <?php
                                                $query = mysqli_query($conn, "SELECT lpad(MAX(`id`)+1,4,'0')id FROM `msd_register_customer_table`");
                                                $my_id_array=mysqli_fetch_assoc($query);
                                                $my_id=$my_id_array['id']; 
                                                if($my_id == "")  {
                                                    $my_id = "0001";
                                                }
                                                $id = 'MS'.$my_id.'C';                                             
                                                echo '<input type="text" id="register_id" style="font-weight: bold;" name="register_id_name" value="'.$id.'" readonly>';
                                            ?>   
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5 reference_class" type="text" name="reference" id="reference_id" placeholder="Reference Id" value="MS0003G" required>
                                            <!-- <label class="label--desc">Reference Id</label> -->
                                        </div>
                                    </div>
                                    <!-- <div class="col-2">
                                        <div class="input-group-desc">
                                            <div class="rs-select2 js-select-simple">
                                       
                                                <?php 
                                                // if( isset($_SESSION['USERID'])) {
                                                //         if($_SESSION['ROLE'] == "admin") {
                                                //             echo '<select name="agent_name" id="agent_id" type="text" required>';
                                                //             $sql = mysqli_query($conn, "SELECT agent_id FROM `msd_register_comp_agent_table` WHERE `msd_register_comp_agent_table`.`status` != 2");
                                                //             $row = mysqli_num_rows($sql);
                                                //             while ($row = mysqli_fetch_array($sql)) {
                                                //                 echo "<option value='". $row['agent_id'] ."'>" .$row['agent_id'] ."</option>" ;
                                                //             }
                                                //             echo '</select>
                                                //             <div class="select-dropdown"></div>';
                                                //         } else if($_SESSION['ROLE'] == "manager") {
                                                //             echo '<select name="agent_name" id="agent_id" type="text" required>';
                                                //             $sql = mysqli_query($conn, "SELECT agent_id FROM `msd_register_comp_agent_table` WHERE `reference_id` = '".$_SESSION['USERID']."' AND `msd_register_comp_agent_table`.`status` != 2");
                                                //             $row = mysqli_num_rows($sql);
                                                //             while ($row = mysqli_fetch_array($sql)) {
                                                //                 echo "<option value='". $row['agent_id'] ."'>" .$row['agent_id'] ."</option>" ;
                                                //             }
                                                //             echo '</select>
                                                //             <div class="select-dropdown"></div>';
                                                //         } else if($_SESSION['ROLE'] == "employee") {
                                                //             echo '<select name="agent_name" id="agent_id" type="text" required>';
                                                //             $sql = mysqli_query($conn, "SELECT agent_id FROM `msd_register_comp_agent_table` WHERE `reference_id` = '".$_SESSION['USERID']."' AND `msd_register_comp_agent_table`.`status` != 2");
                                                //             $row = mysqli_num_rows($sql);
                                                //             while ($row = mysqli_fetch_array($sql)) {
                                                //                 echo "<option value='". $row['agent_id'] ."'>" .$row['agent_id'] ."</option>" ;
                                                //             }
                                                //             echo '</select>
                                                //             <div class="select-dropdown"></div>';
                                                //         } else if($_SESSION['ROLE'] == "agent") {
                                                //             echo '<input class="input--style-5 reference_class" type="text" name="reference" id="reference_id" placeholder="Reference Id" value="'.$_SESSION['USERID'].'" required>';
                                                //         } 
                                                //     } else {
                                                //         echo '<input class="input--style-5 reference_class" type="text" name="reference" id="reference_id" placeholder="Reference Id" value="MS" required>';
                                                        
                                                //     }
                                                    ?>
                                            </div>
                                        </div>
                                    </div> -->
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="form-row m-b-55"> 
                                <div class="name">Name*</div>
                                    <div class="value">
                                        <div class="row row-space">
                                            <div class="col-2">
                                                <div class="input-group-desc">
                                                    <input class="input--style-5 first_name_class" type="text" name="first_name" placeholder="First Name" id="first_name_id" required>
                                                <!-- <label class="label--desc">first name</label> -->
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="input-group-desc">
                                                    <input class="input--style-5 middle_name_class" type="text" name="middle_name" placeholder="Middle Name" id="middle_name_id" required>
                                                    <!-- <label class="label--desc">last name</label> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row m-b-55"> 
                                <div class="name"></div>
                                    <div class="value">
                                        <div class="row row-space">                                            
                                            <div class="col-2">
                                                <div class="input-group-desc">
                                                    <input class="input--style-5 last_name_class" type="text" name="last_name" placeholder="Last Name" id="last_name_id" required>
                                                    <!-- <label class="label--desc">last name</label> -->
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="input-group-desc">
                                                    <input class="input--style-5 dob_class" type="date" class="form-control" id="dob" name="dob" required>
                                                <label class="label--desc">Date Of Birth</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                        
                            <div class="form-row m-b-55"> 
                                <div class="name">Nominee</div>
                                   <div class="value">
                                       <div class="row row-space">
                                            <div class="col-2">
                                               <div class="input-group-desc">
                                                   <input class="input--style-5 nominee_name_class" type="text" name="nominee_name" placeholder="Nominee Name" id="nominee_name_id" >
                                               </div>
                                           </div>
                                           <div class="col-2">
                                               <div class="input-group-desc">
                                                   <input class="input--style-5 nominee_relation_class" type="text" name="nominee_relation" placeholder="Relation With Nominee" id="nominee_relation_id" >
                                               </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                            </div>

                            <div class="form-row m-b-55"> 
                                <div class="name">Address*</div>
                                   <div class="value">
                                       <div class="row row-space">
                                       <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5 address1_class" type="text" name="address1" placeholder="Address1" required>
                                             </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5 address2_class" type="text" name="address2" placeholder="Address2" required>
                                            </div>
                                    </div>
                                           
                                        </div>
                                    </div>
                            </div>


                        <div class="form-row m-b-55">
                            <div class="name"></div>
                            <div class="value">
                                <!-- <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5 address1_class" type="text" name="address1" placeholder="Address1" required>
                                             </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5 address2_class" type="text" name="address2" placeholder="Address2" required>
                                            </div>
                                    </div>
                                </div>
                                <br>
                                <br> -->
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                        <div class="rs-select2 js-select-simple">
                                            <?php 
                                                echo '<select class="state_class" name="state" id="state_id" type="text" required><option disabled selected value="0">Select State...</option>';
                                                     $sql = mysqli_query($conn, "SELECT * FROM `all_states`  ");
                                                     $row = mysqli_num_rows($sql);
                                                     while ($row = mysqli_fetch_array($sql)) {
                                                         echo "<option value='". $row['state_code'] ."'>" .$row['state_name'] ."</option>" ;
                                                     }
                                                echo '</select>
                                                <div class="select-dropdown"></div>';
                                            ?>
                                        </div>
                                        <input type="hidden" name="state_hidden" id="state_hidden">                                           
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                        <div class="rs-select2 js-select-simple">
                                        <!-- <select class="city_class" name="city" id="city_id" type="text">
                                            <option disabled selected value="0">Select City...</option> -->
                                            <?php 
                                                echo '<select class="city_class" name="city" id="city_id" type="text" required>';
                                                     $sql1 = mysqli_query($conn, "SELECT * FROM `all_cities`");
                                                     $row1 = mysqli_num_rows($sql1);
                                                     while ($row1 = mysqli_fetch_array($sql1)) {
                                                         echo "<option value='". $row1['city_code'] ."'>" .$row1['city_name'] ."</option>" ;
                                                     }
                                                echo '</select>
                                                <div class="select-dropdown"></div>';
                                            ?>
                                            <!-- </select>
                                                <div class="select-dropdown"></div> -->
                                                <input type="hidden" name="city_hidden" id="city_hidden">
                                                
                                           </div>
                                        
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5 pincode_class" type="number" name="pincode" placeholder="PinCode" maxlength="6" required>
                                            <!-- <label class="label--desc">PinCode</label> -->
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5 country_class" type="text" name="country" placeholder="Country" value="India" readonly>
                                            <!-- <label class="label--desc">Country</label> -->
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="name">Mobile*</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5 mo-bno_class" type="number" placeholder="Mobile Number" name="mobno" maxlength="10" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Email*</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5 email_class" type="email" placeholder="Username" name="email" required>
                                    <!-- <label class="label--desc">Username</label> -->
                                </div>
                            </div>
                        </div>

                        <div class="form-row" style="margin-bottom: 10px;">
                            <div class="name">Password*</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5 password_class" type="password" placeholder="Password" name="password" id ="password_id" pattern="(?=.*\d)(?=.*[\W_]).{7,}" title="Minimum of 7 characters. Should have at least one special character and one number." required>
                                    <label class="label--desc">Format (eg - abc@123)</label>
                                    <br><br>
                                    <span id='message'></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Re-Type Password*</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5 re_password_class" type="password" placeholder="Confirm Password" id ="confirm_password_id" name="repassword" pattern="(?=.*\d)(?=.*[\W_]).{7,}" title="Minimum of 7 characters. Should have at least one special character and one number." required>
                                    <!-- <label class="label--desc">Comfirm Password</label> -->
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Amount to be invest*</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5 amount_class" type="number" placeholder="Amount (eg. 123000)" name="amount" required>
                                    <!-- <label class="label--desc">Amount (eg. 123000)</label> -->
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-row">
                            <div class="name">Month Of Plan*</div>
                            <div class="value">
                                <div class="input-group">
                                <div class="input-group-desc">
                                                <div class="rs-select2 js-select-simple">
                                                   <select class="monthplan_class" name="monthplan" id="monthplan_id" type="text">
                                                       <!-- <option selected value= "<?php //echo $customer_aggre_month ?>"><?php //if($customer_aggre_month == '6') { echo "6 Month"; } else if($customer_aggre_month == '12') { echo "12 Month"; } else if($customer_aggre_month == '20') { echo "20 Month"; }   ?></option> 
                                                       <option value="6">6 Month</option>
                                                       <option value="12">12 Month</option>
                                                       <option value="20">20 Month</option>
                                                    </select>
                                                         <div class="select-dropdown"></div>
                                                </div>                                            
                                            </div>
                                </div>
                            </div>
                        </div>                       -->

                       
                            <!-- <div class="form-row m-b-55"> 
                                <div class="name">Plan Start to End Date</div>
                                   <div class="value">
                                       <div class="row row-space">                                          
                                           <div class="col-2">
                                               <div class="input-group-desc">
                                                   <input class="input--style-5 start_dt_class" type="date" name="start_dt"  id="start_dt_id" value="<?php  echo date('Y-m-d');  ?>">
                                               </div>
                                            </div>
                                           
                                            <div class="col-2">
                                               <div class="input-group-desc">
                                                   <input class="input--style-5 end_dt_class" type="date" name="end_dt"  id="end_dt_id" value="<?php  echo date('Y-m-d');  ?>">
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                            </div> -->
                        
                         <div class="form-row">
                            <div class="name">Profile Image*</div>
                            <div class="value">
                                <div class="input-group">
                                    <input type="file" name="file" id="file" accept="image/*"/>
                                </div>
                            </div>
                        </div> 
                        <div>
                            <button class="btn btn--radius-2 btn--blue btnAddClass" id="btnAddId" name="add" type="submit" onclick="javascript:RegisterOnclick(this)">Register</button>                        
                            <button class="btn btn--radius-2 btn--red" type="cancel" onclick=" window.location.href='login.html';">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- Jquery JS-->
    <script src="vendor/jqueryregister/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2register/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

    <script>
        //document.getElementById('btnAddId').disabled = true;
        $('#password_id, #confirm_password_id').on('keyup', function () {
        if ($('#password_id').val() == $('#confirm_password_id').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else 
            $('#message').html('Not Matching').css('color', 'red');
        });
        
        $("#file").change(function () {
            filePreview(this);
        });
        $('#uploadForm + embed').remove();
        $('#uploadForm').after('<embed src="'+e.target.result+'" width="450" height="300">');
            function filePreview(input) {
                 
                if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#uploadForm + img').remove();
                    $('#uploadForm').after('<img src="'+e.target.result+'" width="200" height="200"/>');
                };
                reader.readAsDataURL(input.files[0]);
                }
            }

        function RegisterOnclick() {
            //document.getElementById('btnAddId').disabled = true;
            $("#state_hidden").val($("#state_id option:selected").text());
            $("#city_hidden").val($("#city_id option:selected").text());
            //$("#city_hidden").val(("#city_id").find(":selected").text());

            var name = $(".first_name_class").val() + " " + $(".last_name_class").val();
            alert("Hiii...! "+ name +" Your Username "+ $(".email_class").val());
        }
      </script>
<script>
   // function stateOnchange() {
    $( "select[name='state']" ).change(function () {
    var stateID = $(this).val();
    
    if(stateID) {
        $.ajax({
            type: "POST",
            url: "register_db.php",
            dataType: 'Json',
            data: {'id':stateID},
            success: function(data) {
                $('select[name="city"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="city"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
            }
        });


    }else{
        $('select[name="city"]').empty();
    }
});
  //  }
</script>

</body>

</html>