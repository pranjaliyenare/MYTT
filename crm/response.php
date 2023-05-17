<?php
include 'header.php';
include 'database.php'; 
?>
<!doctype html>
<html lang="en">
<style>
    span {
        font-weight: bold;
    }
</style>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Receipt</title>
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
                          <i class="metismenu-icon fas fa-receipt"></i>
                       </div>
                        <div>Receipt
                            <div class="page-title-subheading">Welcome To MyThink Tank Payment </div>
                        </div>
                    </div>
                

                                            <div class="page-title-actions" id="divBtnAdd" >
                                                <div class="d-inline-block dropdown btn mr-2 mb-2 btn-primary">
                                                    <a id="btnHome" href="https://crm.mytt.in/payment"  style="color: white;"> Home </a>
                                                </div>  
                                                <div class="d-inline-block dropdown btn mr-2 mb-2 btn-primary">
                                                    <a id="print-button" href="#"  style="color: white;" onclick="window.print();"> Print </a>
                                                </div>                                        
                                            </div>
                                            </div>
                                            </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="main-card mb-3 card">
                                                    <div class="card-body"><h5 class="card-title"></h5>
                                                    <form class="" method="post">
                                                    <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="main-card mb-3 card">
                                                                    <div class="card-body" style="align-self: center;"><h5 class="card-title">Transaction Details</h5>
                                                                        <table class="mb-0 table table-bordered" style="width:600px;">

                                    <!-- <table width="600" cellpadding="2" cellspacing="2" border="0"> -->
                                        <!-- <tr>
                                            <th colspan="2">Transaction Details</th>
                                        </tr> -->
                                        <?php
                                        // $columns = array();
                                        // $values = array();
                                        //  foreach( $_POST as $key => $value) {
                                        //     $columns[] = '`' . $key . '`';
                                        //     $values[] = '`' . $value . '`';            
                                        //  }
                                        //  //echo implode(',', $columns);
                                        //  //echo implode(',', $values);
                                        // $query="INSERT INTO msd_xway_pay_response_table (".implode(',', $columns). ") VALUES(".implode(',', $values).")";
                                        // $result = $conn->query($query);
                                        // if($result)
                                        //  {
                                        // echo "<script>alert('Your Payment Successfully')</script>";
                                        // }
                                            foreach( $_POST as $key => $value) {
                                        ?>			
                                        <tr>
                                        <td class="fieldName" width="50%"><?php echo $key; ?></td>
                                            <td class="fieldName" name="<?php echo $key; ?>" align="left" width="50%"><?php echo $value; ?></td>
                                        </tr>
                                        <?php
                                                }
                                            if(isset($_POST['checksum'])) {
                                            $query="INSERT INTO `msd_xway_pay_response_table`(`checksum`, `merchant_domain`, `transaction_id`, `bank_ref_no`, `reference_no`, `mode`, `status`, `amount`, `date`, `message`, `merchant_email`, `mobile_no`, `company_name`, `billing_name`, `billing_email`, `billing_mobile`, `billing_address`, `billing_city`, `billing_state`, `billing_postal_code`, `franchise_id`, `userid`, `paymentby`, `plan_id`, `udf4`, `udf5`, `request_amount`, `type`) VALUES ('". $_POST['checksum']."','". $_POST['merchant_domain']."','". $_POST['transaction_id']."','". $_POST['bank_ref_no']."','". $_POST['reference_no']."','". $_POST['mode']."','". $_POST['status']."','". $_POST['amount']."','". $_POST['date']."','". $_POST['message']."','". $_POST['merchant_email']."','". $_POST['mobile_no']."','". $_POST['company_name']."','". $_POST['billing_name']."','". $_POST['billing_email']."','". $_POST['billing_mobile']."','". $_POST['billing_address']."','". $_POST['billing_city']."','". $_POST['billing_state']."','". $_POST['billing_postal_code']."','". $_POST['franchise_id']."','". $_POST['udf1']."','". $_POST['udf2']."','". $_POST['udf3']."','". $_POST['udf4']."','". $_POST['udf5']."','". $_POST['request_amount']."','". $_POST['type']."')";
                                            $result = $conn->query($query);
                                            // if($result)
                                            // {
                                            //   echo "<script>alert('Your Payment Successfully')</script>"; 
                                            // }
                                            $notf_query = "INSERT INTO `msd_notification_table`(`user_id`, `comment_subject`, `comment_text`, `comment_type`, `start_date`) VALUES ('". $_POST['udf1']."','MYTT-Deposit','<b>Hello ". $_POST['billing_name'].",</b> <br/> Your Investment Amount INR <b> ".$_POST['amount']." </b> Deposited on <b>". date("d/m/Y", strtotime($_POST['date']))." </b> Successfully...!!!','deposit', '".date('Y-m-d', strtotime($_POST['date']))."')";
                                            $result2 = $conn->query($notf_query);
                                        }
                                        ?>		
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
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