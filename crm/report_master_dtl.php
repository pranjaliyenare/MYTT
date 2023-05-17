<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; 
      include 'database.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Master Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">
</head>
    <style>
   table thead 
   {
    text-align: center;
   }
   table tbody
   {
    text-align: center;
   }
   
    #table-wrapper {
        position:relative;
    }
    #table-scroll {
      height:500px;
      /* overflow:auto;   */
      /* overflow-x: auto; */
      width:1100px;
      margin-top:20px;
    }
    #table-wrapper table {
        width:100%;

    }
    #table-wrapper table * {
      color:black;
    }
    #table-wrapper table thead th .text {
      position:absolute;   
      top:-20px;
      z-index:2;
      height:20px;
      width:35%;
      border:1px solid red;
    }
    #table-wrapper #table-scroll table thead th{
      background : #3f6ad8;
      position: sticky;
      top: 0;
      border:1px solid white;
    }
   
</style>
<body>
<div class="app-main__outer">
    <div class="app-main__inner">
            <?php  if($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "accountant") { ?>
        <div class="app-page-title" style="padding: 10px;">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-file"></i>
                    </div>
                    <div>Master Report
                        <div class="page-title-subheading"></div>
                    </div>
                </div>
                <div class="page-title-actions" id="divBtnAdd" >
                    <button class="btn" onclick="ExportExcel('xlsx')" style="background: #3d9852; color:white;"><i class="fa fa-file-excel-o" style="font-size:20px"></i></button>
                </div>
            </div>
        </div>   
        <?php
        echo '<div class="row">
          <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title"></h5>
                  <form>
                    <div class="table_Div" id="table_Div_id">            
                        <div class="table-responsive">';
                        $projects = array();
                        $records = mysqli_query($conn, "SELECT `register_id` FROM `msd_register_customer_table` WHERE `register_approved_status` = 'approved' AND `register_activate_status`= 'activate' AND `register_status` != 2");
  
                        while ($project =  mysqli_fetch_assoc($records))
                        {
                            $projects[] = $project;
                        }
                        $i =0;                                   
                                    echo '<div id="table-wrapper">            
                                        <div id="table-scroll">
                                            <table id="tblData" class="mb-0 table table-bordered" style="width:100%;" >
                                            <thead>
                                            <tr>
                                            <th>Sr.No.</th>
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Investment Amount</th>
                                            <th>Plan In Month</th>
                                            <th>Deposit Date</th>
                                            <th>Expiry Date</th>
                                            <th>Profit in %</th>
                                            <th>Payout Count</th>
                                            <th>Paid Profit</th>
                                            <th>Paid Principal</th>
                                            <th>Total Paid</th>
                                            <th>Profit Balance</th>
                                            <th>Principal Balance</th>
                                            <th>Total Balance</th>
                                            </tr>
                                            </thead>
                                            <tbody>';
                                           
                                    foreach ($projects as $project)
                                    {
                                        
                                        $queryCust = mysqli_query($conn, "SET sql_mode = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");     
                                        // CUSTOMER DETAILS
                                        $queryCust = mysqli_query($conn, "SELECT * FROM `msd_register_customer_table` CUST LEFT JOIN `msd_xway_pay_response_table` PAY ON CUST.`register_id` = PAY.`userid`  AND PAY.`status` != 'failed' WHERE `register_id` = '".$project["register_id"]."' AND `register_approved_status` = 'approved' AND `register_status` != 2");
                                        $custdtl_array = mysqli_fetch_assoc($queryCust);
                                        $id = $custdtl_array["register_id"];
                                        $name = $custdtl_array["register_fname"] . " ". $custdtl_array["register_lname"];                                        
                                        $mob = $custdtl_array["register_mobno"];
                                        $email = $custdtl_array["register_email"];
                                        $month_plan = $custdtl_array["customer_aggre_month"];
                                        $st_dt = $custdtl_array["aggr_plan_start_date"];
                                        $end_dt = $custdtl_array["aggr_plan_end_date"];
                                        
                                        $queryPlan = "SELECT * FROM `msd_customer_plan_table` WHERE `customer_id` ='".$project["register_id"]."' AND `status`!=2";
                                        if ($plan = $conn->query($queryPlan)) {
                                            while ($rowPlan = $plan->fetch_assoc()) {

                                        // WITHDRAWAL DETAILS
                                        $queryWithd = mysqli_query($conn,"SELECT COUNT(*) AS payout_cnt, `user_id` id, SUM(`amount`) with_amt, SUM(`principal_amount`) AS princ_amt FROM `msd_transaction_withdraw_table` WITHD WHERE WITHD.`user_id` = '". $project["register_id"]."' AND `plan_id` = '".$rowPlan['plan_id']."' AND WITHD.`approve_status` = 'approved' AND WITHD.`status` != 2");
                                        $withdtl_array = mysqli_fetch_assoc($queryWithd);
                                        if(isset($withdtl_array)){
                                            $with_amt = $withdtl_array["with_amt"];
                                            $princ_amt= $withdtl_array["princ_amt"];
                                            $pay_cnt =  $withdtl_array["payout_cnt"];
                                        } else {
                                            $with_amt =0.00;
                                            $princ_amt=0.00;
                                            $pay_cnt = 0.00;
                                        }

                                        // DEPOSIT DETAILS
                                        $queryDep = mysqli_query($conn,"SELECT  `userid` id, SUM(`amount`) inv_amt, pay_date FROM `msd_xway_pay_response_table` WHERE `userid` = '". $project["register_id"]."' AND `plan_id` = '".$rowPlan['plan_id']."' AND `pay_status` != 2");
                                        $depdtl_array = mysqli_fetch_assoc($queryDep);
                                        if(isset($depdtl_array)){
                                            $inv_amt = $depdtl_array["inv_amt"];
                                            $dep_date = $depdtl_array["pay_date"];
                                        } else {
                                            $inv_amt = 0.00;
                                            $dep_date = 0.00;
                                        }
                                        
                                        // PERCENTAGE DETAILS
                                        $queryPerc = mysqli_query($conn,"SELECT `customer_id` AS id, `customer_perc` AS prof_perc FROM `msd_transaction_role_perc_table` WHERE `customer_id` = '". $project["register_id"]."' AND `plan_id` = '".$rowPlan['plan_id']."' AND `status` != 2");
                                        $percdtl_array = mysqli_fetch_assoc($queryPerc);
                                        if(isset($percdtl_array["prof_perc"])){
                                            $prof_perc = $percdtl_array["prof_perc"];
                                        } else {
                                            $prof_perc = 0.00;
                                        }
                                        // PROFIT TABLE
                                        $queryProfit = mysqli_query($conn,"SELECT PROFIT.`userid` id, SUM(PROFIT.`cust_profit_amount`) profit_amt FROM `msd_profit_table` PROFIT WHERE PROFIT.`userid` = '". $project["register_id"]."' AND `plan_id` = '".$rowPlan['plan_id']."' AND PROFIT.`status` != 2");
                                        $profitdtl_array = mysqli_fetch_assoc($queryProfit);
                                        if(isset($profitdtl_array)){
                                            $profit_amt = $profitdtl_array["profit_amt"];
                                        } else {
                                            $profit_amt =0.00;
                                        }

                                         $profit_bal  = (($inv_amt*($prof_perc/100))*$month_plan)-$with_amt;
                                         $princ_bal = $inv_amt-$princ_amt;
                                         $tol_paid = $with_amt+$princ_amt;
                                         $tot_bal = $profit_bal+$princ_bal;
                                        echo '<tr>
                                        <td>'.++$i.'</td>
                                        <td>'.$id.'</td>
                                        <td>'.$name.'</td>
                                        <td>'.$inv_amt.'</td>
                                        <td>'.$month_plan.'</td>
                                        <td>'.date("d-m-Y", strtotime($st_dt)).'</td>
                                        <td>'.date("d-m-Y", strtotime($end_dt)).'</td>
                                        <td>'.$prof_perc.'</td>   
                                        <td>'.$pay_cnt.'</td>                                                   
                                        <td>'.$with_amt.'</td>
                                        <td>'.$princ_amt.'</td>
                                        <td>'.$tol_paid.'</td>                                                    
                                        <td>'.$profit_bal.'</td>
                                        <td>'.$princ_bal.'</td>
                                        <td>'.$tot_bal.'</td>
                                        </tr>';
                                            }
                                        }
                                    }
                                    echo '</tbody>                                    
                                    </table></div></div>
                                </p>
                            </div>
                        <div><form></div>
                    </div>
                </div>
            </div></div></div>';
        ?>
</div>
    <script type="text/javascript" src="dist/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    <script>
        function ExportExcel(type, fn, dl) {
            var elt = document.getElementById('tblData');
            var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
            return dl ?
               XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
               XLSX.writeFile(wb, fn || ('Master-Report.' + (type || 'xlsx')));
        }
    </script>
    
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