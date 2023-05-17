<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<!doctype html>
<?php
include 'header.php';
include 'database.php';

    $queryProfit = mysqli_query($conn, "SELECT SUM(profit) AS agent FROM (SELECT PROFIT.amt AS profit FROM ( SELECT *, `agent_profit_amount` amt FROM `msd_profit_table` WHERE `admin_id` = '".$_SESSION['USERID']."' AND status != 2 UNION SELECT *, `agent_profit_amount2` amt FROM `msd_profit_table` WHERE `agent_id2` = '".$_SESSION['USERID']."' AND status != 2 UNION SELECT *, `agent_profit_amount3` AS amt FROM `msd_profit_table` WHERE `agent_id3` = '".$_SESSION['USERID']."' AND status != 2 UNION SELECT *, `agent_profit_amount4` AS amt FROM `msd_profit_table` WHERE `agent_id4` = '".$_SESSION['USERID']."' AND status != 2 UNION SELECT *, `agent_profit_amount5` AS amt FROM `msd_profit_table` WHERE `agent_id5` = '".$_SESSION['USERID']."' AND status != 2 UNION SELECT *, `agent_profit_amount6` AS amt FROM `msd_profit_table` WHERE `agent_id6` = '".$_SESSION['USERID']."' AND status != 2) PROFIT ) AS tbl");

    $my_arrayProfit=mysqli_fetch_assoc($queryProfit);            
    $countProfit = $my_arrayProfit["agent"]; 

    $queryWihdraw = mysqli_query($conn, "SELECT SUM(withdraw.`amount`) amt FROM `msd_transaction_withdraw_table` AS withdraw WHERE `user_id` = '".$_SESSION['USERID']."' AND status !=2");
    $my_arrayWith=mysqli_fetch_assoc($queryWihdraw);            
    $countWith = $my_arrayWith["amt"]; 
?>
<html lang="en">
    <style>
            #divImg {
                height: 300px;
            }
            @media screen and (max-width: 480px) {
                #divImg {
                    height: 120px;
            }
        }
    </style>    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Partner Dashboard.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <meta name="description" content="This is an example dashboard created using build-in elements and components.">
        <meta name="msapplication-tap-highlight" content="no">
    </head>
    <body>
    
                 <div class="app-main__outer">
                    <div class="app-main__inner">
                      <?php if ($_SESSION['ROLE'] == "agent") { ?>  
                      <!--  <div class="row">
                            <div class="col-lg-12 col-xl-12">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper" id="divImg">
                                        <img src="assets/images/diwali1.jpeg" alt="mytt" style="width: 100%; height:100%" />
                                    </div>
                                </div>
                            </div>                                
                        </div> -->
                        <?php   
                            $query = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM `msd_register_customer_table` WHERE `agent_id` = '".$_SESSION['USERID']."' AND `register_status` != 2");
                            $my_array=mysqli_fetch_assoc($query);            
                            $count = $my_array["cnt"]; 

                            //$queryTable = "SELECT cust.`register_id` AS id, concat(cust.`register_fname`, ' ',cust.`register_lname`) AS name, cust.`register_profit_perc` AS cust_perc, cust.`register_agent_profit_perc` AS agent_perc, SUM(PAYRES.amount) AS deposit, T1.withdraw, T2.cust_profit, T2.agent_profit FROM `msd_register_customer_table` AS cust LEFT JOIN `msd_xway_pay_response_table` PAYRES ON  PAYRES.userid = cust.`register_id` AND PAYRES.`pay_status` != 2 LEFT JOIN (SELECT `register_id`,`user_id`, SUM(`amount`) AS withdraw FROM `msd_transaction_withdraw_table` INNER JOIN `msd_register_customer_table` ON `user_id` = `register_id` WHERE `approve_status` = 'approved' AND `agent_id` = '".$_SESSION['USERID']."') AS T1 ON T1.user_id = cust.`register_id` LEFT JOIN (SELECT SUM(PROFIT.cust_profit_amount) AS cust_profit, SUM(PROFIT.`agent_profit_amount`) AS agent_profit, userid, status FROM `msd_profit_table` PROFIT LEFT JOIN `msd_register_customer_table` CUST ON PROFIT.userid =register_id WHERE CUST.`agent_id` = '".$_SESSION['USERID']."') AS T2 ON T2.userid = PAYRES.userid AND T2.`status` != 2 WHERE cust.`agent_id` = '".$_SESSION['USERID']."'";
                         ?>
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
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
                           
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-arielle-smile">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Your Profit</div>
                                            <div class="widget-subheading">Total Profit</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $countProfit; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-grow-early">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Your Withdraw</div>
                                            <div class="widget-subheading">Total Withdraw</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $countWith; ?></span></div>
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
                                      
                                        echo '<table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th>Name</th>
                                                <th class="text-center">Deposit</th>
                                                <th class="text-center">Partner Profit</th>
                                                <th class="text-center">Customer Profit</th>
                                                <th class="text-center">Customer Withdraw</th>
                                            </tr>
                                            </thead>
                                            <tbody>';
                                            $query = mysqli_query($conn, "SET sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");
                                            $query = "SELECT DISTINCT `register_id` FROM `msd_register_customer_table` RIGHT JOIN `msd_xway_pay_accdtl_table` ON `register_id` = `userid` WHERE `agent_id` = '".$_SESSION['USERID']."' AND `register_approved_status` = 'approved' AND `register_status` != 2";
                                            if ($result1 = $conn->query($query)) {
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    $deposit =0.00;
                                                    $withdraw =0.00;
                                                    $cust_profit =0.00;
                                                    $agent_profit=0.00;
                                                    $queryTable = "select id, name, deposit, agent_profit, cust_profit, withdraw from (SELECT cust.`register_id` AS id, concat(cust.`register_fname`, ' ',cust.`register_lname`) AS name, SUM(`amount`) deposit, 0 agent_profit, 0 cust_profit, 0 withdraw FROM `msd_xway_pay_response_table` LEFT JOIN `msd_register_customer_table` cust ON `register_id` = `userid` and register_status != 2 WHERE `userid` = '".$row1["register_id"]."' AND `status` != 'failed' AND `pay_status` != 2
                                                    UNION SELECT cust.`register_id` AS id, concat(cust.`register_fname`, ' ',cust.`register_lname`) AS name,  0 deposit, sum(`agent_profit_amount`) agent_profit, SUM(`cust_profit_amount`) cust_profit, 0 withdraw FROM `msd_profit_table` LEFT JOIN `msd_register_customer_table` cust ON `register_id` = `userid` and register_status != 2 WHERE `userid` = '".$row1["register_id"]."' AND `status` != 2 UNION SELECT cust.`register_id` AS id, concat(cust.`register_fname`, ' ',cust.`register_lname`) AS name, 0 deposit, 0 agent_profit, 0 cust_profit, SUM(`amount`) withdraw FROM `msd_transaction_withdraw_table` LEFT JOIN `msd_register_customer_table` cust ON `register_id` = `user_id` and register_status != 2 WHERE `user_id` = '".$row1["register_id"]."' AND `status` != 2) t1";
                                            if ($result = $conn->query($queryTable)) {
                                                while ($row = $result->fetch_assoc()) {
                                                    if($row["id"] == $row1["register_id"]){
                                                    $id = $row["id"];
                                                    $name = $row["name"];
                                                    $deposit += $row["deposit"];
                                                    $withdraw += $row["withdraw"];
                                                    $cust_profit += $row["cust_profit"];
                                                    $agent_profit += $row["agent_profit"];
                                                    }
                                                }
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