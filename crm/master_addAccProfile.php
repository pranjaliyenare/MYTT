<link href="./main.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<!doctype html>
<?php include 'header.php'; 
      include 'database.php';
      $userid = $_SESSION['USERID'];
?>

<?php

 if(isset($_POST['submit'])) {       
       $uploadPath = 'assets/images/avatars/'; 
       if(isset($_POST['submit']) && !empty($_FILES['file']['name'])) { 
           if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath.$_FILES['file']['name'])){ 
               //echo "File has been uploaded successfully."; 
           } else { 
              // echo 'File upload failed, please try again.';  
           } 
       } 
    
        $table="msd_register_comp_accountant_table";
        $field =array("`acc_id`, `reference_id`, `acc_name`, `acc_mobile`, `acc_email`, `acc_password`, `acc_re_password`, `acc_address`, `acc_gender`, `acc_image`, `acc_role_type`");
        $data =array("'".$_POST['id_name']."', '".$_POST['reference']."', '". $_POST['name']."', '". $_POST['mobile']."','". strtolower($_POST['email'])."', '". $_POST['password']."', '". $_POST['confirm_password']."', '". $_POST['address']."', '". $_POST['radio2']."', '". $_FILES['file']['name']."', 'accountant'");
        $field_values= implode(',',$field);
        $data_values=implode(',',$data);
        
        $query="INSERT INTO". " ".$table." (".$field_values. ") VALUES(".$data_values.")";    
        $result = $conn->query($query);

        $query1="INSERT INTO `msd_login_table`(`userid`,`username`, `password`, `type`) VALUES ('".$_POST['id_name']."','".strtolower($_POST['email'])."', '".$_POST['password']."', 'accountant')";
        $result1 = $conn->query($query1);

       
       // Send Email
    //    $to = strtolower($_POST['email']);
    //    $subject = "Welcome To MyThink Tank";
       
    //    $message = "<html>
    //               <head>
    //                <title>Welcome to MyThink Tank !</title>
                   
    //                </head>
    //                <body>
    //                <div> <img src='assets/images/logo.png' alt='MYTT'>
	//                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    //                 ".date("l jS \ F Y") ." </div>

    //                <h4>Thank You For Registering MyThink Tank.</h4>
    //                <p>Dear ". $_POST['name'].", </p>
    //                <p>You now have access to your MyThink Tank account, Where you can login and track your team accounts. </p>
    //                <p>Update your personal details.</p>
    //                                <h4>Your login Details are as:</h4>
    //                                    <table style='background-color:lightgrey'>
    //                                    <tr><td style='font-weight:bold'>Your User ID </td><td>: ".$_POST['id_name']."</td></tr>
    //                                    <tr><td style='font-weight:bold'>Your Login ID </td><td>: ".strtolower($_POST['email'])."</td></tr>
    //                                    </table>
                   
    //                <p>For Any Questions you may have, do not hesitate to contact the MyThink Tank Support Team,</p>
    //                <p>Email- support@mytt.in</p>
    //                <p>Website- www.mytt.in</p>
    //                 </body>
    //                </html>";
        
    //     $header = "From:no-reply@mytt.in \r\n";
    //     //$header .= "Cc:afgh@somedomain.com \r\n";
    //     $header .= "MIME-Version: 1.0\r\n";
    //     $header .= "Content-type: text/html\r\n";
        
    //     $retval = mail ($to,$subject,$message,$header);
        
    //      if( $retval == true ) {
    //         echo "Message sent successfully...";
    //      }else {
    //         echo "Message could not be sent...";
    //      }

         if($result)
         {
            echo "<script>alert('Your Form Submitted Successfully');</script>";
            echo "<script>window.location = 'master_displayAccountant?role=".base64_encode($role)."';</script>";
         }
         else
         {
            echo "<script>alert('Your Form Not Submitted, Please Try Again After sometime..!!!')</script>";
        }
    }
 ?>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

    
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Add Profile.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
        <meta name="msapplication-tap-highlight" content="no">
        
    <link href="./main.css" rel="stylesheet"></head>
    <style>
        .form-control {
            width: 50%;
        }
        label {
            font-weight: bold;
        }
    </style>
    <body>
                <div class="app-main__outer">
                    <div class="app-main__inner">
                    <?php if ($_SESSION['ROLE'] == "admin") { ?> 
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon ">
                                        <i class="fa fa-user-plus" aria-hidden="true" ></i>
                                    </div>
                                    Add Accountant Profile    
                                </div>
                            </div>              
                        </div>          
                        <div class="tab-content">
                            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="main-card mb-3 card">
                                            <div class="card-body"><h5 class="card-title"></h5>
                                                
                                            <form class="" method="POST" enctype="multipart/form-data" id="uploadForm">
                                                <div class="position-relative row form-group"><label for="name_id" class="col-sm-2 col-form-label">ID</label>
                                                    <div class="col-sm-10">
                                                        <?php                                                
                                                        $query = mysqli_query($conn, "SELECT lpad(MAX(`id`)+1,4,'0')id FROM `msd_register_comp_accountant_table` ");
                                                        $my_id_array=mysqli_fetch_assoc($query);
                                                        $my_id=$my_id_array['id']; 
                                                        if($my_id == "")  {
                                                            $my_id = "0001";
                                                        }
                                                        $id = 'MS'.$my_id.'AC';  
                                                                                            
                                                        echo '<input type="text" id="id" style="font-weight: bold;" name="id_name" class="form-control border-0" value="'.$id.'" readonly>';
                                                    ?>    
                                                        <!-- <input name="id" id="id" type="text" class="form-control border-0" disabled> -->
                                                    </div>
                                                    </div>
                                                    <div class="position-relative row form-group"><label for="reference_id" class="col-sm-2 col-form-label">Reference Id</label>
                                                        <div class="col-sm-10"><input name="reference" id="reference_id" placeholder="Enter Reference Id" type="text" class="form-control reference_class" value="<?php echo $userid ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="position-relative row form-group"><label for="name_id" class="col-sm-2 col-form-label">Name</label>
                                                        <div class="col-sm-10">
                                                            <input name="name" id="name_id" placeholder="Enter Name" type="text" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="position-relative row form-group"><label for="mobile_id" class="col-sm-2 col-form-label">Mobile</label>
                                                        <div class="col-sm-10"><input name="mobile" id="mobile_id" placeholder="Enter Mobile" type="text" pattern="\d*" maxlength="10" class="form-control" required></div>
                                                    </div>
                                                    <div class="position-relative row form-group"><label for="email_id" class="col-sm-2 col-form-label">Email</label>
                                                        <div class="col-sm-10"><input name="email" id="email_id" placeholder="Enter Username" type="email" class="form-control" required></div>
                                                    </div>
                                                    <div class="position-relative row form-group"><label for="password_id" class="col-sm-2 col-form-label">Password</label>
                                                        <div class="col-sm-10"><input name="password" id="password_id" placeholder="Enter Password" type="password" class="form-control" pattern="(?=.*\d)(?=.*[\W_]).{7,}" title="Minimum of 7 characters. Should have at least one special character and one number." required></div>
                                                    </div>

                                                    <div class="position-relative row form-group"><label for="confirm_password_id" class="col-sm-2 col-form-label">Confirm Password</label>
                                                        <div class="col-sm-10"><input name="confirm_password" id="confirm_password_id" placeholder="Enter Re-Password" type="password" class="form-control" pattern="(?=.*\d)(?=.*[\W_]).{7,}" title="Minimum of 7 characters. Should have at least one special character and one number." required>
                                                        <span id='message'></span>
                                                    </div>
                                                    </div>
                                            
                                                    <div class="position-relative row form-group"><label for="address_id" class="col-sm-2 col-form-label">Address</label>
                                                        <div class="col-sm-10"><input name="address" id="address_id" placeholder="Enter Address" type="text" class="form-control" required></div>
                                                    </div>                                            

                                                    
                                                    <fieldset class="position-relative row form-group">
                                                        <legend class="col-form-label col-sm-2">Gender</legend>
                                                        <div class="col-sm-10">
                                                            <div class="position-relative form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" id="rbtn_male_id" value="male" required> Male</label></div>
                                                            <div class="position-relative form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" id="rbtn_female_id" value="female" required> Female </label></div>
                                                            <div class="position-relative form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" id="rbtn_other_id" value="other" required>Other</label></div>
                                                        </div>
                                                    </fieldset>
                                                    
                                                        <div class="position-relative row form-group"><label for="image_id" class="col-sm-2 col-form-label">Image</label>
                                                            <div class="col-sm-10">
                                                                <form method="post" enctype="multipart/form-data" id="uploadForm">
                                                                    <input type="file" name="file" id="file" accept="image/*"/>
                                                                    </br>
                                                                    </br>
                                                                    <button class="btn btn-info" type="submit" name="submit" onclick="javascript:ResisterOnclick(this)">Save Changes</button>
                                                                    <input type="button" onclick="window.location = 'master_displayAccountant?role=<?php echo base64_encode($role) ?>'" class="btn btn-secondary" name="close_name" value="Close"/> 
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                               </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                           
                        </div>
                    </div>
           <!-- <div>  -->
        <script>
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
        $('#uploadForm').after('<embed src="'+e.target.result+'" width="200" height="200">');
                function filePreview(input) {
                    debugger
                    if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#uploadForm + img').remove();
                        $('#uploadForm').after('<img src="'+e.target.result+'" width="200" height="200"/>');
                    };
                    reader.readAsDataURL(input.files[0]);
                    }
                }
        </script> 
        <script>        
                $( "select[name='state']" ).change(function () {
            var stateID = $(this).val();
            
            if(stateID) {
                $.ajax({
                    url: "state_city_ddl.php",
                    dataType: 'Json',
                    data: {'id':stateID},
                    success: function(data) {
                        $('select[name="city"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="city"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });


            } else {
                $('select[name="city"]').empty();
            }
        });
        function ResisterOnclick() {
            $("#state_hidden").val($("#state_id option:selected").text());
            $("#city_hidden").val($("#city_id option:selected").text());
        }
        </script> 
    </body>
</html>
<?php include 'footer.php'; ?>
<?php } else { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="widget-content-wrapper" id="divImg">
                            <img  src="assets/images/404-error.jpg" alt="mytt"  style="width:100%; "/>
                        </div>
                    </div>
                </div>                                
            </div>
        </div>
    </body>
</html>
<?php } ?>