<link href="./main.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php
include 'header.php';
include 'database.php';

  $userid = $_SESSION["USERID"];
  $user_id = base64_decode($_GET['id']);
  $query = mysqli_query($conn, "SELECT * FROM `msd_register_customer_table` WHERE `register_id` = '".$user_id."' AND `register_status` != 2");
  $my_id_array=mysqli_fetch_assoc($query);
  $reg =$my_id_array['register_id'];
  $name= $my_id_array['register_fname']." ".$my_id_array['register_lname'];
  $email =$my_id_array['register_email'];
  $mobno =$my_id_array['register_mobno'];
  $addr =$my_id_array['register_addr1'];
  $city =$my_id_array['register_city'];
  $state =$my_id_array['register_state'];
  $pincode =$my_id_array['register_pincode'];

  $query1 = mysqli_query($conn, "SET sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");
  $query1 = mysqli_query($conn, "SELECT lpad(MAX(`id`)+1,9,'0') maxid, id FROM `msd_xway_pay_accdtl_table` WHERE `status` != 2");
  $array1=mysqli_fetch_assoc($query1);                                                
   $accountid = "M".$array1['maxid']; 

  $query2 = mysqli_query($conn, "SELECT lpad(MAX(`id`)+1,5,'0') maxid, id FROM `msd_xway_pay_accdtl_table` WHERE `status` != 2");
  $array2=mysqli_fetch_assoc($query2);                                                
   $referenceno = "M".$array2['maxid']; 
    
?>
<?php
    if(isset($_POST['submit'])) {
        $xwaykey='4f00bfb4958bff8267f1ba3d6f073fb5f42e3a14'; // Provided by swipez admin
        $hash = $xwaykey."|".$_POST['account_id']."|".$_POST['amount']."|".$_POST['reference_no']."|".$_POST['return_url'];
        $secure_hash = md5($hash);
        $query= "INSERT INTO `msd_xway_pay_accdtl_table` (`account_id`, `vendor_id`, `reference_no`, `amount`, `description`, `return_url`, `name`, `address`, `city`, `state`, `postal_code`, `mobile`, `email`, `userid`, `paymentby`, `plan_id`, `Udf4`, `Udf5`, `Secure_hash`) VALUES ('". $_POST['account_id']."', '". $_POST['vendor_id']."', '". $_POST['reference_no']."','". $_POST['amount']."','". $_POST['description']."','". $_POST['return_url']."','". $_POST['name']."','". $_POST['address']."','". $_POST['city']."','". $_POST['state']."','". $_POST['postal_code']."','". $_POST['phone']."','". $_POST['email']."','". $_POST['udf1']."','". $_POST['udf2']."','". $_POST['udf3']."','". $_POST['udf4']."','". $_POST['udf5']."','". $secure_hash."')";
        $result = $conn->query($query);
        //$query1="INSERT INTO `msd_xway_pay_response_table`(`checksum`, `merchant_domain`, `transaction_id`, `bank_ref_no`, `reference_no`, `mode`, `status`, `amount`, `date`, `message`, `merchant_email`, `mobile_no`, `company_name`, `billing_name`, `billing_email`, `billing_mobile`, `billing_address`, `billing_city`, `billing_state`, `billing_postal_code`, `franchise_id`, `userid`, `paymentby`, `udf3`, `udf4`, `udf5`, `request_amount`, `type`) VALUES ('". $_POST['checksum']."','". $_POST['merchant_domain']."','". $_POST['transaction_name']."','". $_POST['bank_ref_no']."','". $_POST['reference_no']."','". $_POST['mode']."','". $_POST['status']."','". $_POST['amount']."','". $_POST['date']."','". $_POST['message']."','". $_POST['merchant_email']."','". $_POST['mobile_no']."','". $_POST['company_name']."','". $_POST['billing_name']."','". $_POST['billing_email']."','". $_POST['billing_mobile']."','". $_POST['billing_address']."','". $_POST['billing_city']."','". $_POST['billing_state']."','". $_POST['postal_code']."','". $_POST['udf3']."','". $_POST['udf1']."','". $_POST['udf2']."','". $_POST['udf3']."','". $_POST['udf4']."','". $_POST['udf5']."','". $_POST['udf3']."','". $_POST['radio2']."')";
            $query1="INSERT INTO `msd_xway_pay_response_table`( `transaction_id`, `reference_no`, `mode`, `status`, `amount`, `date`, `message`, `merchant_email`, `mobile_no`, `company_name`, `billing_name`, `billing_email`, `billing_mobile`, `billing_address`, `billing_city`, `billing_state`, `billing_postal_code`, `franchise_id`, `userid`, `paymentby`, `plan_id`, `udf4`, `udf5`, `request_amount`, `type`) VALUES ('". $_POST['transaction_name']."', '". $_POST['reference_no']."', '". $_POST['radio2']."', 'success', '". $_POST['amount']."','". $_POST['date']."','". $_POST['description']."', 'info@mytt.in', 9604533533,'". $_POST['company_name']."','". $_POST['name']."','". $_POST['email']."','". $_POST['phone']."','". $_POST['address']."','". $_POST['city']."','". $_POST['state']."','". $_POST['postal_code']."','0','". $_POST['udf1']."','". $_POST['udf2']."','". $_POST['udf3']."','". $_POST['udf4']."','". $_POST['udf5']."','0', 'request')";
            $result1 = $conn->query($query1);

            $notf_query = "INSERT INTO `msd_notification_table`(`user_id`, `comment_subject`, `comment_text`, `comment_type`, `start_date`) VALUES ('". $_POST['udf1']."','MYTT-Deposit','<b>Hello ". $_POST['name'].",</b> <br/> Your Investment Amount INR <b> ". $_POST['amount']." </b> Deposited on <b>". date("d/m/Y", strtotime($_POST['date']))." </b> Successfully...!!!','deposit', '".date('Y-m-d H:m:s', strtotime($_POST['date']))."')";
            $result2 = $conn->query($notf_query);

            if($result1)
            {
                echo "<script>alert('Your Data Submitted Successfully')</script>";
                echo "<script>window.location = 'payment';</script>";
            }
            else
            {
                echo "<script>alert('Your Data Not Save!!')</script>";
            }

            
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Offline Payment.</title>
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
                    <?php if($_SESSION["ROLE"] == "admin") { ?>
                 <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon ">
                                <i class="fa fa-credit-card" aria-hidden="true" ></i>
                            </div>
                            Add Offline Payment   
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
                                            <div class="position-relative row form-group" style="display: none;"><label for="company_name" class="col-sm-2 col-form-label">Company Name</label>
                                                <div class="col-sm-10">                                                                                       
                                                    <input class="form-control" type="text" id="company_id" name="company_name" class="form-control border-0" value="MYTHINK TANK MULTIMEDIA PRIVATE LIMITED">
                                               </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="trd_date_id" class="col-sm-2 col-form-label">Date</label>
                                                    <div class="col-sm-10"><input name="date" id="trd_date_id"  type="datetime-local" class="form-control" value="<?php echo date('Y-m-d'); ?>" ></div>
                                            </div>
                                            <div class="position-relative row form-group" style="display: none;"><label for="account_id" class="col-sm-2 col-form-label">*Account ID</label>
                                                <div class="col-sm-10">                                                                                       
                                                    <input class="form-control" type="text" id="account_id" name="account_id" class="form-control border-0" value="<?php echo $accountid ?>">
                                            </div>
                                            </div>
                                            <div class="position-relative row form-group" style="display: none;"><label for="return_url" class="col-sm-2 col-form-label">*Return Url</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="return_url" type="text" size="60" value="https://crm.mytt.in/response.php" />
                                            </div>
                                            </div>
                                            <div class="position-relative row form-group" style="display: none;"><label for="vendor_id" class="col-sm-2 col-form-label">Vendor ID</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="vendor_id" type="number" value="0"/>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="reference_no" class="col-sm-2 col-form-label">*Reference No</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="reference_no" type="text" value="<?php echo $referenceno ?>"/>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="amount" class="col-sm-2 col-form-label">*Amount</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="amount" type="number" />
                                                </div>
                                            </div>
                                            <div class="position-relative form-group"><div id="display"></div></div>
                                            <div class="position-relative form-group"><label for="receiptno_id" class="">Payment Type</label>
                                                <div class="position-relative form-check">
                                                    <div class="position-relative form-check form-check-inline"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="cash" checked >Cash</label></div>
                                                    <div class="position-relative form-check form-check-inline"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="upi" checked >UPI</label></div>
                                                    <div class="position-relative form-check form-check-inline"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="cheque">Cheque</label></div>
                                                    <div class="position-relative form-check form-check-inline"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="neft"> NEFT/IMPS</label></div>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group" ><label for="transaction_id" class="col-sm-2 col-form-label">Transaction Id</label>
                                                <div class="col-sm-10">
                                                    <input name="transaction_name" id="transaction_id" placeholder="Enter Transaction Id" style="text-transform:uppercase" type="text" class="form-control">
                                                </div>
                                            </div>           
                                            <div class="position-relative row form-group"><label for="description" class="col-sm-2 col-form-label">*Description</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="description" type="text" />
                                                </div>
                                            </div>

                                            <div class="position-relative row form-group"><label for="name" class="col-sm-2 col-form-label">*Name</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="name" type="text" maxlength="255" value="<?php echo $name ?>" readonly/>
                                                </div>
                                            </div>
                                    
                                            <div class="position-relative row form-group" style="display: none;"><label for="address" class="col-sm-2 col-form-label">*Address</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="address" type="text" value="<?php echo $addr ?>"/>
                                                </div>
                                            </div>    
                                            
                                            <div class="position-relative row form-group" style="display: none;"><label for="city" class="col-sm-2 col-form-label">*City</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="city" type="text" value="<?php echo $city ?>"/>
                                                </div>
                                            </div>

                                            <div class="position-relative row form-group" style="display: none;"><label for="state" class="col-sm-2 col-form-label">*State/Province</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="state" type="text" value="<?php echo $state ?>"/>
                                                </div>
                                            </div>

                                            <div class="position-relative row form-group" style="display: none;"><label for="postal_code" class="col-sm-2 col-form-label">*PIN Code</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="postal_code" type="text" value="<?php echo $pincode ?>"/>
                                                </div>
                                            </div>

                                            <div class="position-relative row form-group" style="display: none;"><label for="email" class="col-sm-2 col-form-label">*Email</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="email" type="text" value="<?php echo $email ?>"/>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group" style="display: none;"><label for="phone" class="col-sm-2 col-form-label">*Mobile</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="phone" type="text" value="<?php echo $mobno ?>"/>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="udf1" class="col-sm-2 col-form-label">*User ID</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="udf1" type="text" value="<?php echo $user_id ?>" readonly/>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group" style="display: none;"><label for="udf2" class="col-sm-2 col-form-label">*Payment By</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="udf2" type="text" value="<?php echo $userid ?>"/>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="plan_id" class="col-sm-2 col-form-label">Plan</label>
                                                <div class="col-sm-10">
                                                   <select class="mb-2 form-control" name="udf3" id="plan_id" >
                                                      <!-- <option value="0">Select...</option> -->
                                                      <?php 
                                                            $sql = mysqli_query($conn, "SELECT * FROM `msd_customer_plan_table` WHERE `customer_id` ='".$user_id."' AND `status`!=2 ORDER BY id DESC");
                                                            $row = mysqli_num_rows($sql);
                                                            while ($row = mysqli_fetch_array($sql)) {
                                                                //if($_POST['plan_name'] == $row['plan_id']) { $selected='selected'; }
                                                                echo "<option value='". $row['plan_id'] ."'>". $row['plan_name'] . "~" .$row['plan_id'] ."</option>" ;
                                                                //$selected ="";
                                                            }   
                                                      ?>
                                                   </select>
                                                  <!-- <input class="form-control"  name="udf3" type="text" maxlength="20"/>  -->
                                                </div>
                                            </div>

                                            <div class="position-relative row form-group" style="display: none;"><label for="udf4" class="col-sm-2 col-form-label">Udf4</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="udf4" type="text" />
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group" style="display: none;"><label for="udf5" class="col-sm-2 col-form-label">Udf5</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="udf5" type="text" />
                                                </div>
                                             </div>
                                            
                                                <button class="btn btn-info" type="submit" name="submit" >Submit</button>
                                                <input type="button" onclick="window.location = 'payment';" class="btn btn-secondary" name="close_name" value="Close"/> 
                                               
                                           </div>
                                        </form>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                  
               </div>
          <!-- </div>
          <div>  -->
    
</body>

</html>
<?php include 'footer.php'; ?>
<?php } else { ?>
    <div class="row">
        <div class="col-lg-12">
            <!-- <div class="main-card mb-3 card"> -->
                <div class="widget-content-wrapper" id="divImg">
                    <img  src="assets/images/404-error.jpg" alt="mytt"  style="width:100%; "/>
                </div>
            <!-- </div> -->
        </div>                                
    </div>
</div>
</body>
</html>
<?php } ?>
