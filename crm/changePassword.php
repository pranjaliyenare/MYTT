<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php';
      include 'database.php';
   
      if(isset($_POST['submit'])) {
        $result1 = mysqli_query($conn, "SELECT * FROM msd_login_table  WHERE userid = '".$_SESSION['USERID']."'");
        $my_id_array_pass = mysqli_fetch_assoc($result1);
        $my_pass = $my_id_array_pass['password'];
        
        if($my_pass == $_POST["current_password"]) 
        {
            if($_POST["new_password"] == $_POST["confirm_password"])
            {
                if($_SESSION['ROLE'] == "manager") {
                    mysqli_query($conn,"UPDATE `msd_register_comp_manager_table` SET  `mgr_password`='". $_POST['new_password']."', `mgr_re_password` = '". $_POST['confirm_password']."',  `status` = 1 WHERE `mgr_id`='" . $_SESSION['USERID'] . "'");
                    mysqli_query($conn,"UPDATE `msd_login_table` SET `password`='". $_POST['new_password']."', `status` = 1 WHERE `userid`='" . $_SESSION['USERID'] . "'");
                    echo "<script>window.location = 'logout.php';</script>";
                } else if($_SESSION['ROLE'] == "employee") {            
                    mysqli_query($conn,"UPDATE `msd_register_comp_employee_table` SET  `emp_password`='". $_POST['new_password']."', `emp_re_password` = '". $_POST['confirm_password']."',  `status` = 1 WHERE `emp_id`='" . $_SESSION['USERID'] . "'");
                    mysqli_query($conn,"UPDATE `msd_login_table` SET `password`='". $_POST['new_password']."', `status` = 1 WHERE `userid`='" . $_SESSION['USERID'] . "'");
                    echo "<script>window.location = 'logout.php';</script>";
                } else if($_SESSION['ROLE'] == "agent")  {        
                    mysqli_query($conn,"UPDATE `msd_register_comp_agent_table` SET  `agent_password`='". $_POST['new_password']."', `agent_re_password` = '". $_POST['confirm_password']."',  `status` = 1 WHERE `agent_id`='" . $_SESSION['USERID'] . "'");
                    mysqli_query($conn,"UPDATE `msd_login_table` SET  `password`='". $_POST['new_password']."' , `status` = 1 WHERE `userid`='" . $_SESSION['USERID'] . "'");
                    echo "<script>window.location = 'logout.php';</script>";
                }  else if($_SESSION['ROLE'] == "customer")  { 
                    mysqli_query($conn,"UPDATE `msd_register_customer_table` SET `register_password`='".$_POST['new_password']."',`register_repassword`='".$_POST['confirm_password']."', `register_status`= 1 WHERE `register_id`='" . $_SESSION['USERID'] . "'");
                    mysqli_query($conn,"UPDATE `msd_login_table` SET  `password`='". $_POST['new_password']."' , `status` = 1 WHERE `userid`='" . $_SESSION['USERID'] . "'");
                    echo "<script>window.location = 'logout.php';</script>";
               }  else if($_SESSION['ROLE'] == "admin") {        
                    mysqli_query($conn,"UPDATE `msd_login_table` SET  `password`='". $_POST['new_password']."' , `status` = 1 WHERE `userid`='" . $_SESSION['USERID'] . "'");
                    echo "<script>window.location = 'logout.php';</script>";
               } else if($_SESSION['ROLE'] == "accountant") {        
                    mysqli_query($conn,"UPDATE `msd_register_comp_accountant_table` SET  `acc_password`='". $_POST['new_password']."', `acc_re_password` = '". $_POST['confirm_password']."',  `status` = 1 WHERE `acc_id`='".$_SESSION['USERID']."'");
                    mysqli_query($conn,"UPDATE `msd_login_table` SET `password`='". $_POST['new_password']."', `status` = 1 WHERE `userid`='" . $_SESSION['USERID'] . "'");
                    echo "<script>window.location = 'logout.php';</script>";
                }
                
            } else {
                
                echo "<script>alert('The password and comfirm password are incorrect!')</script>";
            } 
        } else {
            echo "<script>alert('The username or password are incorrect!')</script>";
        }
      }


?>

<!doctype html>
<html lang="en">
<style>
    .form-control {
        width: 50%;
    }
    label {
        font-weight: bold;
    }
</style>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Change Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">

</head>
<body>
    <div class="app-main__outer">
         <div class="app-main__inner">
            <div class="app-page-title" style="padding: 10px;">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                        <i class="fa fa-key"></i>
                        </div>
                        <div>Change Password
                            <div class="page-title-subheading"> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title"></h5>
                            <form class="" method="post">
                                <div class="position-relative row form-group"><label for="current_password_id" class="col-sm-2 col-form-label">Current Password</label>
                                    :<div class="col-sm-8"><input name="current_password" id="current_password_id" placeholder="Enter Current Password" type="password" class="form-control" pattern="(?=.*\d)(?=.*[\W_]).{7,}" title="Minimum of 7 characters. Should have at least one special character and one number." required></div>
                                </div>
                                
                                <div class="position-relative row form-group"><label for="new_password_id" class="col-sm-2 col-form-label">Password</label>
                                    :<div class="col-sm-8"><input name="new_password" id="new_password_id" placeholder="Enter Password" type="password" class="form-control" pattern="(?=.*\d)(?=.*[\W_]).{7,}" title="Minimum of 7 characters. Should have at least one special character and one number." required></div>
                                </div>

                                <div class="position-relative row form-group"><label for="confirm_password_id" class="col-sm-2 col-form-label">Confirm Password</label>
                                    :<div class="col-sm-8"><input name="confirm_password" id="confirm_password_id" placeholder="Enter Re-Password" type="password" class="form-control" pattern="(?=.*\d)(?=.*[\W_]).{7,}" title="Minimum of 7 characters. Should have at least one special character and one number." required>
                                    <span id='message'></span>
                                </div>
                                </div>
                                <div class="position-relative row form-check">
                                                <div class="col-sm-10 offset-sm-2">
                                                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                                                <!-- <input type="button" onclick="if($_SESSION['ROLE']) { window.location = 'master_displayProfile.php'; }kkkkkkkkkkkkkkkkk" class="btn btn-secondary" name="close_name" value="Close"/>  -->
                                                <input type="button"  class="btn btn-secondary" name="close" onclick="if('<?php echo $_SESSION['ROLE'] ?>' == 'admin'){ window.location = 'adminDashboard.php'; } else if('<?php echo $_SESSION['ROLE'] ?>' == 'customer'){  window.location = 'customerDashboard.php'; } else if('<?php echo $_SESSION['ROLE'] ?>' == 'employee'){ window.location = 'employeeDashboard.php'; } else if('<?php echo $_SESSION['ROLE'] ?>' == 'agent'){ window.location = 'agentDashboard.php'; } else if('<?php echo $_SESSION['ROLE'] ?>' == 'manager'){ window.location = 'managerDashboard.php'; }" value="Close">
                                                <!-- <button class="btn btn-secondary" name="close" onclick="">Close</button> -->
                                                </div>
                                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <script>
      
       $('#new_password_id, #confirm_password_id').on('keyup', function () {
        if ($('#new_password_id').val() == $('#confirm_password_id').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else 
            $('#message').html('Not Matching').css('color', 'red');
        });

    </script>
</body>
</html>
<?php
include "footer.php";
?>
