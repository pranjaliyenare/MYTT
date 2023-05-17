<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; 
include 'database.php';
$userid = base64_decode($_GET['id']);
if(isset($userid)){
    $userid = base64_decode($_GET['id']);
    } else {
        $userid = $_SESSION['USERID'];
    }
    
?>


<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>


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
    <title>Withdraw</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">

</head>
<body>
    <div class="app-main__outer">
        <div class="app-main__inner">
            <?php if($_SESSION["ROLE"] == "admin") { ?>
            <div class="app-page-title" style="padding: 10px;">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-download icon-gradient bg-happy-itmeo"> </i>
                        </div>
                        <div>Withdraw
                            <div class="page-title-subheading"> </div>
                        </div>
                    </div>
                    <div class="page-title-actions" id="divBtnAdd">
                        <div class="d-inline-block dropdown btn mr-2 mb-2 btn-primary">
                           <a href="withdraw_file"  style="color: white;">
                            Import Excel
                           </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">                        
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <form class="" method="post" >
                                        <div class="position-relative row form-group div_date_class"><label for="date" class="col-sm-3 col-form-label">Date</label>
                                            <div class="col-sm-9">
                                                <input type="datetime-local" name="date" id="date" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group div_plan_class"><label for="plan_id" class="col-sm-3 col-form-label">Plan</label>
                                            <div class="col-sm-9">
                                                <select class="mb-2 form-control" name="plan_id" id="plan_id" >
                                                        <!-- <option value="0">Select...</option> -->
                                                        <?php 
                                                                $sql = mysqli_query($conn, "SELECT * FROM `msd_customer_plan_table` WHERE `customer_id` ='".$userid."' AND `status`!=2 ORDER BY id DESC");
                                                                $row = mysqli_num_rows($sql);
                                                                while ($row = mysqli_fetch_array($sql)) {
                                                                    //if($_POST['plan_name'] == $row['plan_id']) { $selected='selected'; }
                                                                    echo "<option value='". $row['plan_id'] ."'>". $row['plan_name'] . "~" .$row['plan_id'] ."</option>" ;
                                                                    //$selected ="";
                                                                }   
                                                        ?>
                                                    </select>
                                            </div>
                                        </div>
                                            <?php 
                                            $query = mysqli_query($conn, "SELECT `register_id`, `agent_id`, SUM(PAY.amount) AS amt, `register_profit_perc` cust_perc, `register_agent_profit_perc` agent_perc FROM `msd_register_customer_table` CUST LEFT JOIN `msd_xway_pay_response_table` PAY ON CUST.`register_id` = PAY.`userid` WHERE `register_id` = '". $userid."' AND `register_approved_status` = 'approved' AND `register_approved_status` != 2");
                                            $reg_array = mysqli_fetch_assoc($query);
                                            $custperc = $reg_array["cust_perc"]/100;
                                            $custperc1 =  ($reg_array["amt"]*$custperc);                                        
                                            ?>
                                            <div class="position-relative row form-group div_amount_class"><label for="amount_id" class="col-sm-3 col-form-label">Amount</label>
                                                <div class="col-sm-9">
                                                    <input name="amount_name" id="amount_id" placeholder="Enter Amount" type="text" class="form-control" min="100" required>
                                                </div>
                                            </div>
                                            <?php
                                            if($_SESSION['ROLE'] == 'admin') {
                                                ?>
                                            <div class="position-relative row form-group div_amount_class"><label for="amount_id" class="col-sm-3 col-form-label">Principal Amount</label>
                                                <div class="col-sm-9">
                                                    <input name="princ_amount_name" id="princ_amount_id" placeholder="Enter Principal Amount" type="text" class="form-control" min="100" value="<?php echo $reg_array["amt"]*0.05; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input id="chkBtnId" type="checkbox" class="chkBtnClass" value="checked" class="form-check-input" onchange="valueChanged()">
                                                    <label class="form-check-label" for="closeButton">Add Bonus</label>
                                                    <input id="chltxtId" name="chktxtname" type="text" class="chktxtClass" value="NO" class="form-control" style="display:none;">
                                                </div>
                                            </div>

                                            <div class="position-relative row form-group div_bonus_class"><label for="bonus_id" class="col-sm-3 col-form-label">Bonus Amount</label>
                                                <div class="col-sm-9">
                                                    <input name="bonus_name" id="bonus_id" placeholder="Enter Bonus" type="text" class="form-control" value="0.00">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group div_bonus_desc_class"><label for="bonus_desc_id" class="col-sm-3 col-form-label">Bonus Description</label>
                                                <div class="col-sm-9">
                                                    <input name="bonus_desc_name" id="bonus_desc_id" placeholder="Enter Bonus Description" type="text" value="" class="form-control">
                                                </div>
                                            </div>
                                            <?php } else if($_SESSION['ROLE'] == 'customer') { ?>
                                            <div class="position-relative row form-group div_amount_class" style="display: none;"><label for="amount_id" class="col-sm-3 col-form-label">Principal Amount</label>
                                                <div class="col-sm-9">
                                                    <input name="princ_amount_name" id="princ_amount_id" placeholder="Enter Principal Amount" type="number" class="form-control" min="100" value="0.00" required>
                                                </div>
                                            </div>
                                                <?php } ?>
                                            <!-- <div class="position-relative row form-group">
                                                <div class="col-sm-12">     -->
                                                    <input type="submit" class="btn btn-primary" name="submit_name" value="Withdraw"/>
                                                    <input type="button" onclick="window.location = 'payment';" class="btn btn-secondary" name="close_name" value="Close"/> 
                                                <!-- </div>
                                            </div> -->
                                    </form> 
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                        <div class="col-md-6">
                            <div class="main-card mb-3 card">
                                <div class="card-body"><h5 class="card-title">MEMBER DETAILS</h5>
                                    <form class="">
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM `msd_register_customer_table` WHERE `register_id` = '".$userid."' AND `register_status` != 2");
                                            $my_id_array=mysqli_fetch_assoc($query);
                                            //$userId =$my_id_array['register_id'];
                                            $name= $my_id_array['register_fname']." ".$my_id_array['register_lname'];
                                            $mobno =$my_id_array['register_mobno'];
                                        ?>
                                    <div class="position-relative row div_name_class" ><label for="name_id" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9"><label name="name" id="name_id" class="form-control border-0"><?php echo $name ?></label></div>
                                    </div>
                                    <div class="position-relative row div_mobile_class" ><label for="mobile_id" class="col-sm-3 col-form-label">Mobile</label>
                                        <div class="col-sm-9"><label name="mobile_name" id="mobile_id" class="form-control border-0"> <?php echo $mobno ?></label></div>
                                    </div>
                                    
                                    </form>
                                </div>
                            </div>
                            <div class="main-card mb-3 card">
                                <div class="card-body"><h5 class="card-title">BANK DETAILS</h5>
                                    <form class="">
                                                <?php
                                                    $query = mysqli_query($conn, "SELECT * FROM `msd_user_bankdtl_table` WHERE `ACCOUNT_HOLDER_NAME` = '".$userid."' and `STATUS` != 2");
                                                    
                                                    $my_id_array=mysqli_fetch_assoc($query);
                                                    if($my_id_array>0) {
                                                    $bankId =$my_id_array['ID'];
                                                    $bankname=$my_id_array['USER_BANK_NAME'];
                                                    $branch=$my_id_array['USER_BANK_BRANCH'];
                                                    $accno=$my_id_array['USER_ACCOUNT_NO'];
                                                    $ifsc=$my_id_array['USER_IFSC'];
                                                    } else {
                                                        echo "<script>alert('Bank Details Not Available...!!!')</script>";
                                                        echo "<script>window.location = 'payment';</script>";
                                                    }
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
                                        </form>
                                    </div>
                                </div>                                        
                    </div>
                </div>
            </div>
        </div>                                
    </div>
    <script type="text/javascript">
        window.onload = function() {
             $(".div_bonus_class").hide();
             $(".div_bonus_desc_class").hide();
         }
        
        function valueChanged()
        {
            if($('.chkBtnClass').is(":checked"))   {
                $(".div_bonus_class").show();
                $(".div_bonus_desc_class").show();
                $(".chktxtClass").val("YES");
             }
                 else {
                     $(".div_bonus_class").hide();
                     $(".div_bonus_desc_class").hide();
                     $(".chktxtClass").val("NO");
             }
        }
    </script>
</body>
</html>
<?php 
    if(isset($_POST['submit_name'])) {
        $query = mysqli_query($conn, "SELECT * FROM `msd_customer_plan_table` WHERE `customer_id` = '".$userid."' AND `plan_id` ='".$_POST['plan_id']."' ");
        $my_id_array=mysqli_fetch_assoc($query);        
        $aggre_month= $my_id_array['duration'];
        $perc_return= $my_id_array['perc_return'];
        $pric_amt = 0.00;
        
         //if($aggre_month == '20' && $perc_return == 'YES') {
            $query="INSERT INTO `msd_transaction_withdraw_table`(`user_id`, `plan_id`, `bank_id`, `amount`, `principal_amount`, `bonus_type`, `bonus_amount`, `bonus_desc`, `date`) VALUES ('".$userid."', '".$_POST['plan_id']."', '".$bankname."', ".$_POST['amount_name'].", ".$_POST['princ_amount_name'].", '".$_POST['chktxtname']."', ".$_POST['bonus_name'].", '".$_POST['bonus_desc_name']."', '".date('Y-m-d H:i:s', strtotime($_POST['date']))."')";
        // } else {
           // $query="INSERT INTO `msd_transaction_withdraw_table`(`user_id`, `plan_id`, `bank_id`, `amount`, `bonus_type`, `bonus_amount`, `bonus_desc`, `date`) VALUES ('".$userid."', '".$_POST['plan_id']."', '".$bankname."', ".$_POST['amount_name'].", '".$_POST['chktxtname']."', ".$_POST['bonus_name'].", '".$_POST['bonus_desc_name']."', '".date('Y-m-d H:i:s', strtotime($_POST['date']))."')";
         //}
        $result = $conn->query($query);
        
          if($result)
          {
             echo "<script>alert('Record Added Successfully')</script>";
             echo "<script>window.location = 'payment';</script>";
          }
          else
          {
             echo "<script>alert('Record Not Added Successfully')</script>";
         }
 
    }
    
?>
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
