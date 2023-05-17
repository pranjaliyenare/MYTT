
<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

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
    <title>Payout Report</title>
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
      width:100%;
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
    .app-main {
        display: block;
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
                    <div>Payout Report
                        <div class="page-title-subheading"></div>
                    </div>
                </div>
                <div class="page-title-actions" id="divBtnAdd" >
                    <button class="btn" onclick="ExportExcel('xlsx')" style="background: #3d9852; color:white;"><i class="fa fa-file-excel-o" style="font-size:20px"></i></button>
                </div>
            </div>
        </div>    
        
        <div class="row">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title"></h5>
                        <form class="" method="post" action="#">
                            <div class="divider"></div>
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustom01">From Date</label> 
                                        <input type="date" name="stdt" class="form-control" id="datefilterfrom" data-date-split-input="true" value="<?php if(isset($_POST['stdt'])) { echo $_POST['stdt']; } else { echo date("Y-m-d"); } ?>">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustom02">To Date</label>
                                        <input type="date" name="expdt" class="form-control" id="datefilterto" data-date-split-input="true" value="<?php if(isset($_POST['expdt'])) { echo $_POST['expdt']; } else { echo date("Y-m-d"); } ?>"> 
                                    </div>                                    
                                
                                    <div class="col-md-4 mb-3">
                                        <br/>
                                    <input class="mb-2 mr-2 btn btn-primary" type="submit" name="submit" value="Search" onclick="javascript:btnOnclick();"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        echo '<div class="row">
          <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title"></h5>
                  <form>
                  <h6><b>Start Date :</b> <label id="stdtLabel">'; if(isset($_POST['stdt'])) { echo date('d-M-Y', strtotime($_POST["stdt"])); } else { echo date("d-M-Y"); } echo '</label></h6>
                  <h6><b>End Date  :</b> <label id="enddtLabel">'; if(isset($_POST['expdt'])) { echo date('d-M-Y', strtotime($_POST["expdt"])); } else { echo date("d-M-Y"); } echo '</label></h6>
                    <div class="table_Div" id="table_Div_id">            
                        <div class="table-responsive">';
                        $projects = array();
                        $records = mysqli_query($conn, "SET sql_mode = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");     
                        //$records = mysqli_query($conn, "SELECT `register_id` id, concat(`register_fname`, ' ', `register_mname`, ' ', `register_lname`) AS name, `register_mobno` mobile, `register_email` email, kyc.`PAN_NO` AS PAN, SUM(dept.`amount`) AS inv_amt, plan.`perc_return` AS perc_ret, plan.plan_id AS plan, plan_name, plan.duration AS plan_in_mnt, plan.start_date st_dt, plan.end_date AS exp_dt, perc.`customer_perc` AS percen, princ_perc FROM `msd_register_customer_table` cust LEFT JOIN `msd_user_kyc_table` kyc ON kyc.`USER_ID` = cust.`register_id` AND kyc.`STATUS` != 2 RIGHT JOIN `msd_customer_plan_table` plan ON plan.`active_status` = 'active' AND plan.`customer_id` = cust.`register_id` LEFT JOIN `msd_xway_pay_response_table` dept ON dept.`userid` = cust.`register_id` AND dept.plan_id = plan.plan_id AND dept.`pay_status` != 2 AND dept.`status` != 'failed' LEFT JOIN `msd_transaction_role_perc_table` perc ON perc.`customer_id` = cust.`register_id` AND perc.plan_id= plan.plan_id AND perc.status != 2 WHERE `register_activate_status` = 'activate' AND `register_status` != 2 GROUP BY id, plan ORDER BY id");
                        $records = mysqli_query($conn, "SELECT `register_id` id, concat(`register_fname`, ' ', `register_mname`, ' ', `register_lname`) AS name, `register_mobno` mobile, `register_email` email, kyc.`PAN_NO` AS PAN, SUM(dept.`amount`) AS inv_amt, plan.`perc_return` AS perc_ret, plan.plan_id AS plan, plan_name, plan.duration AS plan_in_mnt, plan.start_date st_dt, plan.end_date AS exp_dt, perc.`customer_perc` AS percen, princ_perc, bank.`USER_BANK_NAME` AS bank_name, bank.`USER_ACCOUNT_NO` AS acc_no, bank.`USER_IFSC` AS ifsc FROM `msd_register_customer_table` cust LEFT JOIN `msd_user_kyc_table` kyc ON kyc.`USER_ID` = cust.`register_id` AND kyc.`STATUS` != 2 RIGHT JOIN `msd_customer_plan_table` plan ON plan.`active_status` = 'active' AND plan.`customer_id` = cust.`register_id` LEFT JOIN `msd_xway_pay_response_table` dept ON dept.`userid` = cust.`register_id` AND dept.plan_id = plan.plan_id AND dept.`pay_status` != 2 AND dept.`status` != 'failed' LEFT JOIN `msd_transaction_role_perc_table` perc ON perc.`customer_id` = cust.`register_id` AND perc.plan_id= plan.plan_id AND perc.status != 2 LEFT JOIN `msd_user_bankdtl_table` bank ON bank.`ACCOUNT_HOLDER_NAME` = cust.`register_id` AND bank.`TYPE` = 'customer' AND bank.`STATUS` != 2 WHERE `register_activate_status` = 'activate' AND `register_status` != 2 GROUP BY id, plan ORDER BY id;");
 
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
                                            <th>Plan ID</th>
                                            <th>Bank Name</th>
                                            <th>Acc. No.</th>
                                            <th>IFSC</th>
                                            <th>Investment Amount</th>
                                            <th>Plan In Month</th>
                                            <th>Deposit Date</th>
                                            <th>Expiry Date</th>
                                            <th>Profit in %</th>
                                            <th>Principal %</th>
                                            <th>Profit</th>
                                            <th>Principal Amount</th>
                                            <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>';
                                           
                                    foreach ($projects as $project)
                                    {
                                        $princ_bal = 0.00;
                                        $princ_per = 0.00;
                                        $queryProfit = mysqli_query($conn, "SET sql_mode = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");     
                                        
                                        if(isset($_POST['submit'])){
                                            //$queryProfit = mysqli_query($conn,"SELECT PROFIT.`userid` id, SUM(PROFIT.`cust_profit_amount`) profit_amt FROM `msd_profit_table` PROFIT WHERE PROFIT.`userid` = '". $project["id"]."' AND `plan_id` = '". $project["plan"]."' AND PROFIT.`status` != 2 AND Date_Format(`date`,'%Y-%m-%d') BETWEEN '".$_POST['stdt']."' AND '".$_POST['expdt']."'");
                                            $queryProfit = mysqli_query($conn,"SELECT PROFIT.`userid` id, SUM(PROFIT.`cust_profit_amount`) profit_amt FROM `msd_profit_table` PROFIT INNER JOIN `msd_customer_plan_table` PLAN ON PROFIT.`plan_id` = PLAN.`plan_id` AND PLAN.`status` != 2 AND PLAN.`active_status` = 'active' WHERE PROFIT.`userid` = '". $project["id"]."' AND PROFIT.`plan_id` = '".$project["plan"]."' AND PROFIT.`status` != 2 AND Date_Format(PROFIT.`date`,'%Y-%m-%d') BETWEEN '".$_POST['stdt']."' AND '".$_POST['expdt']."'");
                                        } else {
                                            $queryProfit = mysqli_query($conn, "SELECT PROFIT.`userid` id, SUM(PROFIT.`cust_profit_amount`) profit_amt FROM `msd_profit_table` PROFIT WHERE PROFIT.`userid` = '". $project["id"]."' AND `plan_id` =  '". $project["plan"]."' AND PROFIT.`status` != 2;");
                                        }
                                        //+(PROFIT.`cust_profit_amount`*3)
                                        $profitdtl_array = mysqli_fetch_assoc($queryProfit);
                                        if(isset($profitdtl_array)){
                                            $profit_amt = $profitdtl_array["profit_amt"];
                                        } else {
                                            $profit_amt =0.00;
                                        }

                                        if($project["princ_perc"]) { 
                                            $princ_per = $project["princ_perc"]; } 
                                       else { 
                                            $princ_per = 0;
                                        }

                                        if($project["perc_ret"] == 'YES') {
                                            $princ_bal = $project["inv_amt"]*$princ_per/100;
                                        }
                                         $tot_bal = $princ_bal+$profit_amt;
                                        echo '<tr>
                                        <td>'.++$i.'</td>
                                        <td>'.$project["id"].'</td>
                                        <td style="text-align: left;">'.$project["name"].'</td>
                                        <td>'.$project["plan"]." ~ " .$project["plan_name"].'</td>

                                        <td>'.$project["bank_name"].'</td>
                                        <td>'."'".$project["acc_no"].'</td>
                                        <td>'.$project["ifsc"].'</td>

                                        <td>'.$project["inv_amt"].'</td>
                                        <td>'.$project["plan_in_mnt"].'</td>
                                        <td>'.date("m-d-Y", strtotime($project["st_dt"])).'</td>
                                        <td>'.date("m-d-Y", strtotime($project["exp_dt"])).'</td>
                                        <td>'.$project["percen"].'%</td>                                                  
                                        <td>'.$princ_per.'%</td>                                                  
                                        <td>'.$profit_amt.'</td>
                                        <td>'.$princ_bal.'</td>
                                        <td>'.$tot_bal.'</td>
                                        </tr>';
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

    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script>
        function btnOnclick() {
                document.getElementById("stdtLabel").innerHTML = $("#datefilterfrom").val();
                document.getElementById("enddtLabel").innerHTML = $("#datefilterto").val();
               
            //$("label.stdtlabel").innerHTML ($("#datefilterfrom").val());
            //$("label.enddtLabel").innerHTML ($("#datefilterto").val());
        }

        function ExportExcel(type, fn, dl) {
            var elt = document.getElementById('tblData');
            var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
            return dl ?
               XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
               XLSX.writeFile(wb, fn || ('Customers-Payout-Report.' + (type || 'xlsx')));
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