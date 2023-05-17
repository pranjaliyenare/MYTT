<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; 
         $role = "manager";
      include 'database.php';
      //session_start();
?>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<style>

    label {
        font-weight: bold;
    }
</style>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Display Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">

<link href="./main.css" rel="stylesheet"></head>
<body>
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <?php  if($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "customer") { ?>
                        <div class="app-page-title" style="padding: 10px;">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                    <i class="fa fa-users" aria-hidden="true" ></i>
                                    </div>
                                    <div>Profile Report
                                        <div class="page-title-subheading">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title"></h5>

                                    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                            <li class="nav-item">
                                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                                    <span><i class="fa fa-user" aria-hidden="true" title="Add Bank Details"></i> <b>Your Details</b></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                                    <span><i class="fas fa-university" aria-hidden="true" title="Add Bank Details"></i> <b>Bank Details</b></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-2">
                                 <span> <i class="fa fa-id-card" aria-hidden="true" title="Add KYC"></i> <b>KYC</b></span>
                                </a>
                            </li>
                            
                        </ul>

                        <?php 
                            $sql = mysqli_query($conn, "SELECT * FROM `msd_register_customer_table` WHERE `register_id` = '".$_SESSION['USERID']."' AND `register_approved_status` = 'approved' AND `register_status` != 2");
                            $my_array=mysqli_fetch_assoc($sql);

                            $my_id=$my_array["register_id"]; 
                            $reference_id=$my_array["agent_id"]; 
                            $fname=$my_array["register_fname"]; 
                            $lname=$my_array["register_lname"]; 
                            $mname=$my_array["register_mname"]; 
                            $register_nominee_name=$my_array["register_nominee_name"]; 
                            $register_nominee_relation=$my_array["register_nominee_relation"]; 
                            $addr1=$my_array["register_addr1"]; 
                            $addr2=$my_array["register_addr2"]; 
                            $city=$my_array["register_city"]; 
                            $state=$my_array["register_state"]; 
                            $city_code=$my_array["register_city_id"]; 
                            $state_code=$my_array["register_state_id"]; 
                            $pincode=$my_array["register_pincode"]; 
                            $country=$my_array["register_country"]; 
                            $mobno=$my_array["register_mobno"];
                            $email=$my_array["register_email"]; 
                            $password=$my_array["register_password"]; 
                            $repassword=$my_array["register_repassword"]; 
                            $invest_amount=$my_array["register_invest_amount"]; 
                            $register_profit_perc=$my_array["register_profit_perc"];                             
                            $image = $my_array["register_image"]; 
                            $approved_status =$my_array["register_approved_status"]; 
                            $activate_status =$my_array["register_activate_status"];  

                            $sql1 = mysqli_query($conn, "SELECT * FROM `msd_customer_plan_table` WHERE `customer_id` = '".$_SESSION['USERID']."' AND `status` != 2");
                            $plan_array=mysqli_fetch_assoc($sql1);
                            $profit_perc=$plan_array["profit_perc"]; 
                            $customer_aggre_month=$plan_array["duration"]; 
                            $aggr_plan_start_date=$plan_array["start_date"]; 
                            $aggr_plan_end_date=$plan_array["end_date"]; 
                        ?>

                        <div class="tab-content">
                            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Your Details</h5>
                                    <?php if($approved_status =='not approved' || $activate_status == 'deactivate') { ?>
                                        <div style="text-align: end;">                                             
                                            <a href="master_editUser?id='<?php echo base64_encode($_SESSION['USERID']); ?>'&type='<?php echo base64_encode('edit'); ?>'&path='<?php echo base64_encode('master_userProfile'); ?>'" class="btn btn-info edit" ><i class="fas fa-edit" aria-hidden="true" title="Edit Profile"></i> </a>
                                        </div>
                                    <?php } ?>
                                        <form class="">
                                            <div class="table-responsive">
                                            <table class="mb-0 table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th>ID </th>
                                                        <td>:  <?php echo $my_id; ?>.</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Name</th>
                                                        <td>:  <?php echo $fname." ". $mname." ". $lname; ?>.</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nominee</th>
                                                        <td>:  <?php if(isset($register_nominee_name)) { echo $register_nominee_name." - (". $register_nominee_relation.")."; } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address</th>
                                                        <td>:  <?php echo $addr1.", ". $addr2. ", "; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th></th>
                                                        <td>  <?php echo $city.", ".$state.", ". $country."-". $pincode; ?>.</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Mobile</th>
                                                        <td>:  <?php echo $mobno; ?>. </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email</th>
                                                        <td>:  <?php echo $email; ?>. </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Profit Percentage</th>
                                                        <td>:  <?php echo intval($profit_perc); ?>%. </td>
                                                    <tr>
                                                    <tr>
                                                        <th>Month of Plan</th>
                                                        <td>:  <?php if(isset($customer_aggre_month)) { echo $customer_aggre_month." Months."; } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Start Date</th>
                                                        <td>:  <?php echo date("d-m-Y", strtotime($aggr_plan_start_date)); ?>. </td>
                                                    </tr>
                                                    <tr>
                                                        <th>End Date</th>
                                                        <td>:  <?php echo date("d-m-Y", strtotime($aggr_plan_end_date)); ?>. </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </div>     
                                        </form>
                                    </div>
                                </div>
                            </div>                        


                            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                                <div class="main-card mb-3 card">
                                <label style="color:green;">Update Your Bank Details, Please Contact Our Support Team...!</label>
                                    <div class="card-body"><h5 class="card-title">Bank Details</h5>
                                   
                                    <?php if($approved_status =='not approved' || $activate_status == 'deactivate') { ?>
                                        <div style="text-align: end;"> <a href="master_user_bankdtl?id='<?php echo base64_encode($_SESSION['USERID']); ?>'&path='<?php echo base64_encode('master_userProfile'); ?>'" class="btn btn-alternate"><i class="fas fa-edit" aria-hidden="true" title="Edit Bank Details"></i></a>  </div>
                                    <?php } ?>
                                   
                                    <form class="">
                                    <?php
                                         $query = mysqli_query($conn, "SELECT * FROM `msd_user_bankdtl_table` WHERE `ACCOUNT_HOLDER_NAME` = '".$_SESSION['USERID']."' and `STATUS` != 2");
                                            
                                            $my_id_array=mysqli_fetch_assoc($query);
                                            if($my_id_array>0) {
                                             $bankId =$my_id_array['ID'];
                                            $bankname=$my_id_array['USER_BANK_NAME'];
                                            $branch=$my_id_array['USER_BANK_BRANCH'];
                                            $accno=$my_id_array['USER_ACCOUNT_NO'];
                                            $ifsc=$my_id_array['USER_IFSC'];
                                            
                                        ?>
                                        <div class="position-relative row div_bankname_class" ><label for="bankname_id" class="col-sm-4 col-form-label">Bank Name</label>
                                            <div class="col-sm-8"><label name="bankname_name" id="bankname_id" type="text" class="form-control border-0" ><?php echo $bankname ?></label></div>
                                        </div>
                                        <div class="position-relative row div_branch_class" ><label for="branch_id" class="col-sm-4 col-form-label">Branch</label>
                                            <div class="col-sm-8"><label name="branch_name" id="branch_id" class="form-control border-0"> <?php echo $branch ?></label></div>
                                        </div>
                                        <div class="position-relative row div_accno_class" ><label for="accno_id" class="col-sm-4 col-form-label">Account Number</label>
                                            <div class="col-sm-8"><label name="accno_name" id="accno_id" class="form-control border-0"><?php echo $accno ?></label></div>
                                        </div>
                                        <div class="position-relative row div_ifsc_class" ><label for="ifsc_id" class="col-sm-4 col-form-label">IFSC</label>
                                            <div class="col-sm-8"><label name="ifsc_name" id="ifsc_id" class="form-control border-0"><?php echo $ifsc ?></label></div>
                                        </div> 
                                        <?php } ?>                                          
                                </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
                                <div class="main-card mb-3">
                                    <div class="card-body"><h5 class="card-title">KYC</h5>
                                    <?php if($approved_status =='not approved' || $activate_status == 'deactivate') { ?>
                                        <div style="text-align: end;"><a href="master_user_kyc?id='<?php echo base64_encode($_SESSION['USERID']); ?>'&path='<?php echo base64_encode('master_userProfile'); ?>'" class="btn btn-success"><i class="fas fa-edit" aria-hidden="true" title="Edit KYC"></i></a> </div>
                                    <?php } ?>
                                        <form class="">
                                            <?php
                                                $query = mysqli_query($conn, "SELECT * FROM `msd_user_kyc_table` WHERE `USER_ID` = '".$_SESSION['USERID']."' AND `STATUS` != 2");
                                                    
                                                    $my_array=mysqli_fetch_assoc($query);
                                                    if($my_array>0) {
                                                    $bankId =$my_array['USER_ID'];
                                                    $adhaarno=$my_array['AADHAAR_NO'];
                                                    $adhaarfront=$my_array['AADHAR_FRONT_IMAGE'];
                                                    $adhaarback=$my_array['AADHAR_BACK_IMAGE'];
                                                    $panimg=$my_array['PAN_IMAGE'];
                                                    $panno=$my_array['PAN_NO'];
                                                    
                                                ?>
                                                <div class="position-relative row div_adhaarno_class" ><label for="adhaarno_id" class="col-sm-4 col-form-label">Adhaar No</label>
                                                    <div class="col-sm-8"><label name="adhaarno_name" id="adhaarno_id" type="text" class="form-control border-0" ><?php echo $adhaarno; ?></label></div>
                                                </div>
                                               
                                                <div class="position-relative row div_adhaarfr_class" ><label for="adhaarfr_id" class="col-sm-4 col-form-label">Adhaar Front</label>
                                                    <div class="col-sm-8"><img src="Document/<?php echo $adhaarfront; ?>" alt="MyThink Tank" style="width: 40%;"> </div>
                                                </div><hr/>
                                                <div class="position-relative row div_adhaarbk_class" ><label for="adhaarbk_id" class="col-sm-4 col-form-label">Adhaar Back</label>
                                                    <div class="col-sm-8"><img src="Document/<?php echo $adhaarback; ?>" alt="MyThink Tank" style="width: 40%;"> </div>
                                                </div><hr/>
                                                <div class="position-relative row div_pan_class" ><label for="pan_id" class="col-sm-4 col-form-label">PAN No</label>
                                                    <div class="col-sm-8"><label name="pan_name" id="pan_id" class="form-control border-0"> <?php echo $panno; ?></label></div>
                                                </div>
                                                <div class="position-relative row div_panimg_class" ><label for="panimg_id" class="col-sm-4 col-form-label">PAN Image</label>
                                                    <div class="col-sm-8"><img src="Document/<?php echo $panimg; ?>" alt="MyThink Tank" style="width: 40%;"></div>
                                                </div>
                                               
                                                <?php } ?>                                          
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

</body>
</html>
<?php include 'footer.php';?>
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