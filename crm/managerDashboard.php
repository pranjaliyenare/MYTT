<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<!doctype html>
<?php
include 'header.php';
include 'database.php';
    if ($_SESSION['ROLE'] == "manager") {
        $profit_amt = 0.00; 
        $withdraw_amt = 0.00; 
        $deposit_amt = 0.00;
        $month_withdraw_amt = 0.00; 
        $month_deposit_amt= 0.00; 
        $month_profit_amt = 0.00; 

        $year = date("Y");  
        $month = date("m");  
        $day = date("d");  
        $query = mysqli_query($conn, "SET sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");
                
        //Yearly deposit
        $dep_query = mysqli_query($conn, "SELECT YEAR(`pay_date`) AS year, SUM(amount) as amt FROM `msd_xway_pay_response_table` INNER JOIN `msd_register_customer_table` ON `register_id` = `userid` WHERE `status` != 'failed' AND `reference_id` = '".$_SESSION['USERID']."'  AND `pay_status` !=2");
        while ($rowdepo = $dep_query->fetch_assoc()) {
            //if($rowdepo["year"] == $year) {      
                $deposit_amt = $rowdepo["amt"];
            // } 
        }
        // Yearly Profit
        $profit_query = mysqli_query($conn, "SELECT SUM(`cust_profit_amount`) AS amount, YEAR(PROFIT.`date`) AS year FROM `msd_profit_table` AS PROFIT INNER JOIN `msd_register_customer_table` ON `register_id` = `userid` WHERE `reference_id` = '".$_SESSION['USERID']."' AND `status` != 2 GROUP BY YEAR(`date`)");
        while ($row = $profit_query->fetch_assoc()) {
            //if($row["year"] == $year) {      
                    $profit_amt = $row["amount"];
            // } 
        }

        // Yearly Withdraw
        $query = mysqli_query($conn, "SELECT SUM(`amount`) AS amount, YEAR(WITHDRAW.`date`) AS year FROM `msd_transaction_withdraw_table` AS WITHDRAW INNER JOIN `msd_register_customer_table` ON `register_id` = `user_id` WHERE `reference_id` = '".$_SESSION['USERID']."' AND `approve_status` = 'approved' AND`status` != 2 GROUP BY YEAR(`date`)");
         while ($rowWith = $query->fetch_assoc()) {
           // if($rowWith["year"] == $year) {      
                $withdraw_amt = $rowWith["amount"];
            // } 
        }
        
        //Monthly deposit
        $month_dep_query = mysqli_query($conn, "SELECT MONTH(`pay_date`) AS MONTH, SUM(amount) as amt FROM `msd_xway_pay_response_table` INNER JOIN `msd_register_customer_table` ON `register_id` = `userid` WHERE `status` != 'failed' AND `reference_id` = '".$_SESSION['USERID']."' AND `pay_status` !=2 GROUP BY MONTH(`pay_date`)");
        while ($month_dep_array = $month_dep_query->fetch_assoc()) {
            if($month_dep_array["MONTH"] == $month) {              
                $month_deposit_amt = $month_dep_array["amt"]; 
            }
        }
                //Monthly Profit
                $month_profit_query = mysqli_query($conn, "SELECT SUM(`cust_profit_amount`) AS amount, MONTH(PROFIT.`date`) AS MONTH FROM `msd_profit_table` AS PROFIT INNER JOIN `msd_register_customer_table` ON `register_id` = `userid` WHERE `reference_id` = '".$_SESSION['USERID']."' AND `status` != 2 GROUP BY MONTH(`date`)");
                while ($month_profit_array = $month_profit_query->fetch_assoc()) {                   
                if($month_profit_array["MONTH"] == $month) {      
                    $month_profit_amt = $month_profit_array["amount"];
                }
            }
        //Monthly Withdraw
        $month_query = mysqli_query($conn, "SELECT SUM(`amount`) AS amount, MONTH(WITHDRAW.`date`) AS MONTH FROM `msd_transaction_withdraw_table` AS WITHDRAW INNER JOIN `msd_register_customer_table` ON `register_id` = `user_id` WHERE `reference_id` = '".$_SESSION['USERID']."' AND `approve_status` = 'approved' AND`status` != 2 GROUP BY MONTH(`date`)");
        while ($month_with_array = $month_query->fetch_assoc()) {
            if($month_with_array["MONTH"] == $month) {   
                $month_withdraw_amt = $month_with_array["amount"];
            } 
        }
    }
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Manager Dashboard.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
</head>
<body>
    
                 <div class="app-main__outer">
                    <div class="app-main__inner">
                        <?php if ($_SESSION['ROLE'] == "manager") { ?>                
                        <?php   
                            if ($_SESSION['ROLE'] == "manager") {
                                $query = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM `msd_register_customer_table` WHERE `reference_id` = '".$_SESSION['USERID']."' AND `register_status` != 2");
                                $my_array=mysqli_fetch_assoc($query);
                                $count = $my_array["cnt"];

                                $query1 = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM `msd_register_comp_agent_table` WHERE `reference_id` = '".$_SESSION['USERID']."' AND `status` != 2");
                                $my_array1=mysqli_fetch_assoc($query1);
                                $count1 = $my_array1["cnt"];
                            }
                        ?>
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Partner</div>
                                            <div class="widget-subheading">Total Under Partner</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $count1 ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-md-6 col-xl-6">
                                <div class="card mb-3 widget-content bg-arielle-smile">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Customer</div>
                                            <div class="widget-subheading">Total Under Customer</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $count ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>                          
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content" style="background-image: linear-gradient(to top, #844c5a 0%, #71132a 100%) !important;">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Yearly Deposit</div>
                                            <div class="widget-subheading">Total Deposit</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $deposit_amt ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content" style="background-image: linear-gradient(to top, #ea6c97 0%, #e91e63 100%) !important;">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Yearly Profit</div>
                                            <div class="widget-subheading">Total Profit</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $profit_amt ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content" style="background-image: linear-gradient(to top, #ffeb3b 0%, #ff9800 100%) !important;">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Yearly Withdraw</div>
                                            <div class="widget-subheading">Total Withdraw</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $withdraw_amt ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content" style="background-image: linear-gradient(to top, #3ac47d 0%, #1e6641 100%) !important;">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Monthly Deposit</div>
                                            <div class="widget-subheading">Total Deposit</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $month_deposit_amt ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content" style="background-image: linear-gradient(to top, #d9252594 0%, #FF0000 100%) !important;">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Monthly Profit</div>
                                            <div class="widget-subheading">Total Profit</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $month_profit_amt ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content" style="background-image: linear-gradient(to top, #c78fdc 0%, #794c8a 100%) !important;">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Monthly Withdraw</div>
                                            <div class="widget-subheading">Total Withdraw</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $month_withdraw_amt ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>                          
                        </div>

                            <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                   
                                    <div class="table-responsive">
                                    <?php
                                       $queryTable = "SELECT cust.`register_id` AS id, concat(cust.`register_fname`, ' ',cust.`register_lname`) AS name, cust.`register_profit_perc` AS cust_perc, cust.`register_agent_profit_perc` AS agent_perc, PAYRES.amount AS deposit, T1.withdraw, T2.cust_profit, T2.agent_profit FROM `msd_register_customer_table` AS cust LEFT JOIN `msd_xway_pay_response_table` PAYRES ON  PAYRES.userid = cust.`register_id` AND `status` != 'failed' AND  PAYRES.`pay_status` != 2 LEFT JOIN (SELECT `register_id`,`user_id`, `amount` AS withdraw FROM `msd_transaction_withdraw_table` INNER JOIN `msd_register_customer_table` ON `user_id` = `register_id` WHERE `approve_status` = 'approved' AND `reference_id` = '".$_SESSION['USERID']."') AS T1 ON T1.user_id = cust.`register_id` LEFT JOIN (SELECT PROFIT.cust_profit_amount AS cust_profit, PROFIT.`agent_profit_amount` AS agent_profit, userid, status FROM `msd_profit_table` PROFIT LEFT JOIN `msd_register_customer_table` CUST ON PROFIT.userid =register_id WHERE CUST.`reference_id` = '".$_SESSION['USERID']."') AS T2 ON T2.userid = PAYRES.userid AND T2.`status` != 2 WHERE cust.`reference_id` = '".$_SESSION['USERID']."' AND cust.register_approved_status = 'approved'"; 

                                        echo '<table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th>Name</th>
                                                <th class="text-center">Deposit</th>
                                                <th class="text-center">Partner Profit</th>
                                                <th class="text-center">Customer Profit</th>
                                                <th class="text-center">Withdraw</th>
                                            </tr>
                                            </thead>
                                            <tbody>';
                                            $query = "SELECT `register_id` FROM `msd_register_customer_table` WHERE `reference_id` = '".$_SESSION['USERID']."' AND `register_approved_status` = 'approved' AND `register_status` != 2";
                                            if ($result1 = $conn->query($query)) {
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    
                                                    $cust_profit =0.00;
                                                    $agent_profit=0.00;

                                                    // CUSTOMER DETAILS
                                                    $queryCust = mysqli_query($conn, "SELECT * FROM `msd_register_customer_table` CUST LEFT JOIN `msd_xway_pay_response_table` PAY ON CUST.`register_id` = PAY.`userid`  AND PAY.`status` != 'failed' WHERE `register_id` = '".$row1['register_id']."' AND `register_approved_status` = 'approved' AND `register_status` != 2");
                                                    $custdtl_array = mysqli_fetch_assoc($queryCust);
                                                    $id = $custdtl_array["register_id"];
                                                    $name = $custdtl_array["register_fname"] . " ". $custdtl_array["register_lname"];                                        
                                                    
                                                    // WITHDRAWAL DETAILS
                                                    $queryWithd = mysqli_query($conn,"SELECT COUNT(*) AS payout_cnt, `user_id` id, SUM(`amount`) with_amt, SUM(`principal_amount`) AS princ_amt FROM `msd_transaction_withdraw_table` WITHD WHERE WITHD.`user_id` = '".$row1['register_id']."' AND WITHD.`approve_status` = 'approved' AND WITHD.`status` != 2");
                                                    $withdtl_array = mysqli_fetch_assoc($queryWithd);
                                                    if(isset($withdtl_array)) {
                                                        $withdraw = $withdtl_array["with_amt"];
                                                    } else {
                                                        $withdraw =0.00;
                                                    }

                                                    // DEPOSIT DETAILS
                                                    $queryDep = mysqli_query($conn,"SELECT  `userid` id, SUM(`amount`) inv_amt, pay_date FROM `msd_xway_pay_response_table` WHERE `status` != 'failed' AND `userid` = '".$row1['register_id']."' AND `pay_status` != 2");
                                                    $depdtl_array = mysqli_fetch_assoc($queryDep);
                                                    if(isset($depdtl_array)) {
                                                        $deposit = $depdtl_array["inv_amt"];
                                                    } else {
                                                        $deposit = 0.00;
                                                    }
                                                    
                                                    // PERCENTAGE DETAILS
                                                    $queryPerc = mysqli_query($conn,"SELECT `customer_id` AS id, `customer_perc` AS prof_perc FROM `msd_transaction_role_perc_table` WHERE `customer_id` = '".$row1['register_id']."' AND `status` != 2");
                                                    $percdtl_array = mysqli_fetch_assoc($queryPerc);
                                                    if(isset($percdtl_array["prof_perc"])){
                                                        $prof_perc = $percdtl_array["prof_perc"];
                                                    } else {
                                                        $prof_perc = 0.00;
                                                    }
                                                    // PROFIT TABLE
                                                    $queryProfit = mysqli_query($conn,"SELECT PROFIT.`userid` id, SUM(PROFIT.`cust_profit_amount`) profit_amt, SUM(PROFIT.`agent_profit_amount`) AS agent_amount FROM `msd_profit_table` PROFIT WHERE PROFIT.`userid` = '".$row1['register_id']."' AND PROFIT.`status` != 2");
                                                    $profitdtl_array = mysqli_fetch_assoc($queryProfit);
                                                    if(isset($profitdtl_array)){
                                                        $cust_profit = $profitdtl_array["profit_amt"];
                                                        $agent_profit = $profitdtl_array["agent_amount"];
                                                    } else {
                                                        $profit_amt =0.00;
                                                        $agent_profit = 0.00;
                                                    }

                                            echo '<tr>
                                                <td class="text-center text-muted">'.$id.'</td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">                                                            
                                                            <div class="widget-content-left flex2">
                                                                <div class="widget-heading">'.$name.'</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">'.$deposit.'</td>
                                                <td class="text-center">'.$agent_profit.'</td>
                                                <td class="text-center">'.$cust_profit.'</td>
                                                <td class="text-center">'.$withdraw.'</td>
                                            </tr>';
                                                }
                                            
                                            }
                                            echo '</tbody>
                                        </table>';
                                        ?>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                            
                        </div>
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