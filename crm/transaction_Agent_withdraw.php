<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; 
include 'database.php';
//$agentid = base64_decode($_GET['id']);
//echo $agentid;
//if(isset($agentid)){
//    $agentid = base64_decode($_GET['id']);
//    } else {
        $agentid = $_SESSION['USERID'];
//    }
    
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
                </div>
            </div>

            <div class="tab-content">
                <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="main-card mb-3 card">
                                <div class="card-body"><h5 class="card-title">MEMBER DETAILS</h5>
                                    <form class="" method="post" action="transaction_Agent_withdraw">
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM `msd_register_comp_agent_table` WHERE `agent_id` = '".$agentid."' AND `status` != 2");
                                            $my_id_array=mysqli_fetch_assoc($query);
                                            //$agentId =$my_id_array['register_id'];
                                            $name= $my_id_array['agent_name'];
                                            //$mobno =$my_id_array['register_mobno'];
                                        ?>
                                    <div class="position-relative row form-group div_name_class" ><label for="name_id" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9"><label name="name" id="name_id" class="form-control border-0"><?php echo $name ?></label></div>
                                    </div>
                                        <div class="position-relative row form-group div_amount_class"><label for="amount_id" class="col-sm-3 col-form-label">Amount</label>
                                            <div class="col-sm-9"><input name="amount_name" id="amount_id" placeholder="Enter Amount" type="text" class="form-control" min="500" required></div> 
                                        </div>
                                        <input type="submit" class="btn btn-primary" name="submit_name" value="Withdraw"/>
                                        <input type="button" onclick="window.location = 'master_displayProfile?role="<?php base64_encode('agent') ?>"';" class="btn btn-secondary" name="close_name" value="Close"/> 
                                         
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    <!-- </div> -->
                   <div class="col-md-6">
                       <div class="main-card mb-6 card">
                           <div class="card-body"><h5 class="card-title">BANK DETAILS</h5>
                               <form class="">
                                        <?php
                                         $query = mysqli_query($conn, "SELECT * FROM `msd_user_bankdtl_table` WHERE `ACCOUNT_HOLDER_NAME` = '".$agentid."' and `STATUS` != 2");
                                            
                                            $my_id_array=mysqli_fetch_assoc($query);
                                            if($my_id_array>0) {
                                             $bankId =$my_id_array['ID'];
                                            $bankname=$my_id_array['USER_BANK_NAME'];
                                            $branch=$my_id_array['USER_BANK_BRANCH'];
                                            $accno=$my_id_array['USER_ACCOUNT_NO'];
                                            $ifsc=$my_id_array['USER_IFSC'];
                                            } else {
                                                echo "<script>alert('Bank Details Not Available...!!!')</script>";
                                                echo "<script>window.location = 'master_agent_bankdtl';</script>";
                                            }
                                        ?>
                                    <div class="position-relative row form-group div_bankname_class" ><label for="bankname_id" class="col-sm-4 col-form-label">Bank Name</label>
                                        <div class="col-sm-8"><label name="bankname_name" id="bankname_id" type="text" class="form-control border-0" ><?php echo $bankname ?></label></div>
                                    </div>
                                    <div class="position-relative row form-group div_branch_class" ><label for="branch_id" class="col-sm-4 col-form-label">Branch</label>
                                        <div class="col-sm-8"><label name="branch_name" id="branch_id" class="form-control border-0"> <?php echo $branch ?></label></div>
                                    </div>
                                    <div class="position-relative row form-group div_accno_class" ><label for="accno_id" class="col-sm-4 col-form-label">Account Number</label>
                                        <div class="col-sm-8"><label name="accno_name" id="accno_id" class="form-control border-0"><?php echo $accno ?></label></div>
                                    </div>
                                    <div class="position-relative row form-group div_ifsc_class" ><label for="ifsc_id" class="col-sm-4 col-form-label">IFSC</label>
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

</body>
</html>
<?php 
    if(isset($_POST['submit_name'])) {
         
        $query="INSERT INTO msd_transaction_withdraw_table (`user_id`, `bank_id`, `amount`, `type`) VALUES('".$agentid."', '".$bankname."', ". $_POST['amount_name'].", 'agent')";
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
