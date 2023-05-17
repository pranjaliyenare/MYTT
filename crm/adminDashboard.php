<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<!doctype html>
<?php
include 'header.php';
include 'database.php';
include 'count.php';
?>
 <?php   
    $query = mysqli_query($conn, "SET sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");
    $query = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM `msd_register_customer_table` WHERE `register_status` != 2");
    $my_array=mysqli_fetch_assoc($query);
    $count = $my_array["cnt"];

    $mgr_query = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM `msd_register_comp_manager_table` WHERE `status` != 2");
    $mgr__array=mysqli_fetch_assoc($mgr_query);
    $mgr_count = $mgr__array["cnt"];

    $emp_query = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM `msd_register_comp_employee_table` WHERE `status` != 2");
    $emp__array=mysqli_fetch_assoc($emp_query);
    $emp_count = $emp__array["cnt"];
    
    $agent_query = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM `msd_register_comp_agent_table` WHERE `status` != 2");
    $agent__array=mysqli_fetch_assoc($agent_query);
    $agent_count = $agent__array["cnt"];

     ?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Admin Dashboard.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">    
    </head>
    <style>
        #divImg {
            height: 300px;
        }

        @media screen and (max-width: 480px) {
            #divImg {
                height: 120px;
            }
        }
        
        th {
            text-align: center;
            /* background : #b9babb; */
        }
        td {
            text-align: right;
        }
        
    </style>
<body>   
    <div class="app-main__outer">
        <div class="app-main__inner">
            <?php if ($_SESSION['ROLE'] == "admin") { ?>
            <!-- image add in dashboard -->
              <!--  <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-wrapper" id="divImg">
                                <img src="assets/images/diwali1.jpeg" alt="mytt" style="width: 100%; height:100%" />
                            </div>
                        </div>
                    </div>                                
                </div> -->
                      
                        <div class="row">                        
                            <div class="col-md-6 col-xl-3">
                                <div class="card mb-3 widget-content" style="background-color: 	#248d87;">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Manager</div>
                                            <div class="widget-subheading">Total Manager</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $mgr_count ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card mb-3 widget-content" style="background-color: #f93e5a;">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Employee</div>
                                            <div class="widget-subheading">Total Employee</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $emp_count ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card mb-3 widget-content" style="background-color: #673ab7;">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Partner</div>
                                            <div class="widget-subheading">Total Partner</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $agent_count ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card mb-3 widget-content" style="background-color: #FFBF00;">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Customer</div>
                                            <div class="widget-subheading">Total Customer</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $count ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Daily Total</h5>
                                    <div class="table_Div">
                                        <table class="mb-0 table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th class="headcol">#</th>
                                                <th>Daily</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            <th>Deposit</th>
                                                <td><?php echo $day_deposit_amt; ?></td>
                                            </tr>
                                            <tr>
                                            <th>Profit</th>
                                                <td><?php echo $day_profit_amt; ?></td>
                                            </tr>
                                            <tr>
                                            <th>Withdraw</th>
                                                <td><?php echo $day_withdraw_amt; ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Monthly Total</h5>
                                        <div class="table_Div">
                                            <table class="mb-0 table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th class="headcol">#</th>
                                                    <th>Monthly</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                <th>Deposit</th>
                                                    <td><?php echo $month_deposit_amt; ?></td>
                                                </tr>
                                                <tr>
                                                <th>Profit</th>
                                                    <td><?php echo $month_profit_amt; ?></td>
                                                </tr>
                                                <tr>
                                                <th>Withdraw</th>
                                                    <td><?php echo $month_withdraw_amt; ?></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Total</h5>
                                    <div class="table_Div">
                                    <table class="mb-0 table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th class="headcol">#</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                <th>Deposit</th>
                                                    <td><?php echo $deposit_amt; ?></td>
                                                </tr>
                                                <tr>
                                                <th>Profit</th>
                                                    <td><?php echo $profit_amt; ?></td>
                                                </tr>
                                                <tr>
                                                <th>Withdraw</th>
                                                    <td><?php echo $withdraw_amt; ?></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
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
    