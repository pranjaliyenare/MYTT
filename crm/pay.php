<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>
<?php
include 'header.php';
include 'database.php';
//session_start();
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
<!doctype html>
<html lang="en">
<style>
    label {
        font-weight: bold;
    }
</style>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>MyThink Tank Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="app-main__outer">
        <div class="app-main__inner">
           <div class="app-page-title" style="padding: 10px;">
               <div class="page-title-wrapper">
                   <div class="page-title-heading">
                       <div class="page-title-icon">
                            <i class="fa fa-rupee" aria-hidden="true"></i>
                       </div>
                        <div style="font-weight: bold;">MyThink Tank Payment
                            <div class="page-title-subheading">Welcome To MyThink Tank Payment </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title"></h5>
                    <!-- <form method="post" action="secure.php" name="frmTransaction" id="frmTransaction">
                    <div class="row">
                            <div class="col-lg-12"> -->
                            <div class="main-card mb-3 card" style="border: groove;">
                                    <div class="card-body"><h5 class="card-title">Fill Payment Details</h5>
                                    <form  method="post" action="secure.php" name="frmTransaction" id="frmTransaction" >
                                        
                                            <div class="position-relative row form-group">
                                                <div class="col-sm-12"><label class="col-sm-6 col-form-label" style="text-align: center;">Transaction Details</label></div>
                                            </div>
                                            <div class="position-relative row form-group" style="display: none;"><label for="account_id" class="col-sm-2 col-form-label">*Account Id</label>
                                                <div class="col-sm-5"><input class="form-control" id="account_id" name="account_id" type="text" value="M000032158" readonly/></div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="plan_id" class="col-sm-2 col-form-label">Plan</label>
                                                <div class="col-sm-5">
                                                   <select class="mb-2 form-control" name="udf3" id="plan_id" required>
                                                      <!-- <option value="0">Select...</option> -->
                                                      <?php 
                                                            $sql = mysqli_query($conn, "SELECT * FROM `msd_customer_plan_table` WHERE `customer_id` ='".$user_id."' AND `status`!=2");
                                                            $row = mysqli_num_rows($sql);
                                                              while ($row = mysqli_fetch_array($sql)) {
                                                                    $d1 = strtotime($row['start_date']);
                                                                    $d2 = strtotime(date('Y-m-d'));
                                                                    $day_diff = $d2 - $d1;
                                                                    $day_cnt = round($day_diff/(60*60*24));
                                                                    if ($day_cnt <= 5) {
                                                                        //if($_POST['plan_name'] == $row['plan_id']) { $selected='selected'; }
                                                                        echo "<option value='". $row['plan_id'] ."'>". $row['plan_name'] . "~" .$row['plan_id'] ."</option>" ;
                                                                        //$selected ="";
                                                                    }
                                                                } 
                                                      ?>
                                                   </select>
                                                  <!-- <input class="form-control"  name="udf3" type="text" maxlength="20"/>  -->
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group" style="display: none;"><label for="return_url" class="col-sm-2 col-form-label">*Return Url</label>
                                                <div class="col-sm-5"><input class="form-control" id="return_url" name="return_url" type="text" size="60" value="https://crm.mytt.in/response.php" readonly /></div>
                                            </div>
                                            <div class="position-relative row form-group" style="display: none;"><label for="account_id" class="col-sm-2 col-form-label">Vendor ID</label>
                                                <div class="col-sm-5"><input class="form-control"  name="vendor_id" type="number" value="0"/></div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="account_id" class="col-sm-2 col-form-label">*Reference No</label>
                                                <div class="col-sm-5"><input class="form-control"  name="reference_no" type="text" value="<?php echo $referenceno ?>" readonly/></div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="account_id" class="col-sm-2 col-form-label">*Amount : ₹</label>
                                                <div class="col-sm-5"><input class="form-control" name="amount" type="number" min="1" required/></div><div class="col-sm-5"><strong>INR</strong></div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="account_id" class="col-sm-2 col-form-label">*Description</label>
                                                <div class="col-sm-5"><input class="form-control" name="description" type="text" required/></div>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <div class="col-sm-12"><label class="col-sm-6 col-form-label" style="text-align: center;">Billing Details</label></div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="account_id" class="col-sm-2 col-form-label">*Name</label>
                                                <div class="col-sm-5"><input class="form-control" name="name" type="text" maxlength="255" required value="<?php echo $name ?>"/></div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="return_url" class="col-sm-2 col-form-label">*Address</label>
                                                <div class="col-sm-5"><input class="form-control" name="address" type="text" value="<?php echo $addr ?>" required/></div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="account_id" class="col-sm-2 col-form-label">*City</label>
                                                <div class="col-sm-5"><input class="form-control" name="city" type="text" value="<?php echo $city ?>" required/> </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="account_id" class="col-sm-2 col-form-label">*State/Province</label>
                                                <div class="col-sm-5"><input class="form-control" name="state" type="text" value="<?php echo $state ?>" required/> </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="account_id" class="col-sm-2 col-form-label">*PIN Code</label>
                                                <div class="col-sm-5"><input class="form-control" name="postal_code" type="text" value="<?php echo $pincode ?>"/></div>
                                            </div>                                           
                                            <div class="position-relative row form-group"><label for="exampleEmail" class="col-sm-2 col-form-label">*Email</label>
                                                <div class="col-sm-5"><input class="form-control" name="email" type="text" value="<?php echo $email ?>"/></div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="account_id" class="col-sm-2 col-form-label">*Mobile</label>
                                                <div class="col-sm-5"><input class="form-control" name="phone" type="text" maxlength="20" value="<?php echo $mobno ?>" required/></div>
                                            </div>

                                            <div class="position-relative row form-group" style="display: none;"><label for="account_id" class="col-sm-2 col-form-label">*User ID</label>
                                                <div class="col-sm-5"><input class="form-control"  name="udf1" type="text" maxlength="20" value="<?php echo $user_id ?>" required /></div>
                                            </div>
                                            <div class="position-relative row form-group" style="display: none;"><label for="return_url" class="col-sm-2 col-form-label">Payment By</label>
                                                <div class="col-sm-5"><input class="form-control"  name="udf2" type="text" maxlength="20" value="<?php echo $userid ?>" /></div>
                                            </div>
                                            
                                            <div class="position-relative row form-group" style="display: none;"><label for="udf4_id" class="col-sm-2 col-form-label">Udf4</label>
                                                <div class="col-sm-5"><input class="form-control"  name="udf4" type="text" maxlength="20" /> </div>
                                            </div>
                                            <div class="position-relative row form-group" style="display: none;"><label for="udf_id" class="col-sm-2 col-form-label">Udf5</label>
                                                <div class="col-sm-5"><input class="form-control"  name="udf5" type="text" maxlength="20" /></div>
                                            </div>                                           
                                           

                                            <div class="position-relative row form-check">
                                                <div class="col-sm-5 offset-sm-2">
                                                  <input class="btn btn-primary" name="submitted" value="Submit" type="submit" />
                                                  <input type="button" onclick="window.location = 'payment'" class="btn btn-secondary" name="close_name" value="Close"/>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"> <label><span class="style2" >*DENOTES </span><em>Mandatory Fields</em> </label></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>  
<script>
       
</script>

</body>
</html>
<?php
include "footer.php";
?>

