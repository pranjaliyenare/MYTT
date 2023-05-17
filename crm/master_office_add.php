<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; 
        include 'database.php';
?>
 <?php 
    // $payamt  = 0.00;
    // $withamt = 0.00;
    // $query = "SELECT pay_amt, wit_amt FROM (select Sum(amount) pay_amt, 0 wit_amt from msd_xway_pay_response_table where `pay_status` != 2 AND DATE_FORMAT(pay_date, '%Y-%m-%d') = '".date("Y-m-d")."' UNION select 0 pay_amt, Sum(amount) wit_amt from msd_transaction_withdraw_table where `status` != 2 AND DATE_FORMAT(date, '%Y-%m-%d') = '".date("Y-m-d")."') AS tbl";
    //  if ($result = $conn->query($query)) {
    //      while ($row = $result->fetch_assoc()) {
    //         $payamt += $row["pay_amt"];
    //         $withamt += $row["wit_amt"];
    //      }
    //  }

    //  $query = mysqli_query($conn, "SELECT `close_amt` FROM `msd_comp_profit_loss_dtl_table` where `status` != 2 ORDER BY `id` DESC LIMIT 1");
    //  $my_array=mysqli_fetch_assoc($query);
    //  if(isset($my_array)) {
    //    $open_amt = $my_array["close_amt"];
    //  } else {
    //    $open_amt = 0.00;
    //  }
?>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<html lang="en">

<head>
    <title>Profile Report</title>
<style>

    label {
        font-weight: bold;
    }
</style>
</head>
<body>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>MyThink Tank Back Office</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">

<link href="./main.css" rel="stylesheet"></head>
<body>
    <div class="app-main__outer">
        <div class="app-main__inner">
                <?php  if($_SESSION['ROLE'] == "admin") { ?>
                        <div class="app-page-title" style="padding: 10px;">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                    <img src="assets/images/logo.png" alt="Italian Trulli" style="width: 50px; height: 50px;">
                                    </div>
                                    <div>MyThink Tank Back Office
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
                                    <span>Bank and Deposit</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                                    <span>Trade</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-2">
                                    <span>Profit/Loss</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a role="tab" class="nav-link" id="tab-3" data-toggle="tab" href="#tab-content-3">
                                    <span>Withdraw</span>
                                </a>
                            </li>
                        </ul>

                            <div class="tab-content">
                                <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body"><h5 class="card-title">Bank and Deposit</h5>
                                            <form class="" method="POST" action="master_Office_db">                                            
                                                <div class="position-relative row form-group"><label for="date_id" class="col-sm-2 col-form-label">Date</label>
                                                    <div class="col-sm-6"><input name="date" id="date_id"  type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required></div>
                                                </div>
                                                    <!-- <div class="position-relative row form-group"><label for="open_amt_id" class="col-sm-2 col-form-label">Opening Amount</label>
                                                        <div class="col-sm-6"><input name="open_amt" id="open_amt_id"  type="text" class="form-control" value="<?php echo $open_amt; ?>" readonly></div>
                                                    </div> -->
                                                <div class="position-relative row form-group"><label for="deposit_id" class="col-sm-2 col-form-label">Deposit Amount</label>
                                                    <div class="col-sm-6"><input name="deposit" id="deposit_id" placeholder="Enter deposit" type="text" class="form-control" value = "0.00" required></div>
                                                </div>
                                                <div class="position-relative form-group"><label>Payment Type</label>
                                                    <div class="position-relative form-check">
                                                        <div class="position-relative form-check form-check-inline"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="cash"> Cash</label></div>
                                                        <div class="position-relative form-check form-check-inline"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="upi" checked >UPI</label></div>
                                                        <div class="position-relative form-check form-check-inline"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="cheque">Cheque</label></div>
                                                        <div class="position-relative form-check form-check-inline"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="neft"> NEFT/IMPS</label></div>
                                                    </div>
                                                </div> 
                                                <div class="position-relative row form-group"><label for="receivedname_id" class="col-sm-2 col-form-label">Received BY</label>
                                                    <div class="col-sm-6">
                                                        <select name="receivedname" id="receivedname_id" type="text" class="form-control receivedname_class" required>
                                                           <option value="Ravindra Kute">Ravindra Kute</option>
                                                           <!-- <option value="Krushna Fulari">Krushna Fulari</option> -->
                                                        </select>
                                                    </div>
                                                </div> 
                                                <div class="position-relative row form-group"><label for="transferBank_id" class="col-sm-2 col-form-label">Transfer To Bank</label>
                                                    <div class="col-sm-6">
                                                        <select name="transferBank_name" id="transferBank_id" type="text" class="form-control transferBank_class" required>
                                                            <?php
                                                                $sql = mysqli_query($conn, "SELECT * FROM `msd_comp_bank_dtl_table` WHERE status != 2");
                                                                $row = mysqli_num_rows($sql);
                                                                while ($row = mysqli_fetch_array($sql)){
                                                                    echo "<option value='". $row['Bank_Name'] ."'>" .$row['Bank_Name'] ."</option>" ;
                                                                }                                                            
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div> 
                                                <button class="btn btn-primary" type="submit" name="bank_submit">Add</button>               
                                                <input type="button" onclick="window.location = 'adminDashboard'" class="btn btn-danger" name="close_name" value="Close"/>                
                                            </form>
                                        </div>
                                    </div>
                                </div>                        

                            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Trade</h5>
                                        <form class="" method="POST" action="master_Office_db">
                                                <div class="position-relative row form-group"><label for="trd_date_id" class="col-sm-2 col-form-label">Date</label>
                                                    <div class="col-sm-6"><input name="trd_date" id="trd_date_id"  type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required></div>
                                                </div>
                                                <div class="position-relative row form-group"><label for="trd_rec_name_id" class="col-sm-2 col-form-label">Transfer BY</label>
                                                    <div class="col-sm-6">
                                                        <select name="trd_rec_name" id="trd_rec_name_id" type="text" class="form-control trd_rec_name_class" required>
                                                           <option value="Ravindra Kute">Ravindra Kute</option>
                                                           <!-- <option value="Krushna Fulari">Krushna Fulari</option> -->
                                                        </select>
                                                    </div>
                                                </div> 
                                                <div class="position-relative row form-group"><label for="trd_transferBank_id" class="col-sm-2 col-form-label"> From Bank</label>
                                                    <div class="col-sm-6">
                                                        <select name="trd_transferBank_name" id="trd_transferBank_id" type="text" class="form-control trd_transferBank_class" required>
                                                            <?php
                                                                $sql = mysqli_query($conn, "SELECT * FROM `msd_comp_bank_dtl_table` WHERE status != 2");
                                                                $row = mysqli_num_rows($sql);
                                                                while ($row = mysqli_fetch_array($sql)){
                                                                    echo "<option value='". $row['Bank_Name'] ."'>" .$row['Bank_Name'] ."</option>" ;
                                                                }                                                            
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>    
                                                 <div class="position-relative row form-group"><label for="trd_acc_name_id" class="col-sm-2 col-form-label">To Trade A/C</label>
                                                     <div class="col-sm-6">
                                                         <select name="trd_acc_name" id="trd_acc_name_id" type="text" class="form-control trd_acc_name_class" required>
                                                            <option value="trade1">Trade 1</option>
                                                            <option value="trade1">Trade 2</option>
                                                         </select>
                                                     </div>
                                                 </div> 
                                                 <div class="position-relative row form-group"><label for="trd_amt_id" class="col-sm-2 col-form-label">Amount</label>
                                                     <div class="col-sm-6"><input name="trd_amt" id="trd_amt_id" placeholder="Enter Trade Amount" type="text" class="form-control" value="0.00" required></div>
                                                 </div>
                                                 <button class="btn btn-primary" type="submit" name="trade_submit">Add</button>               
                                                 <input type="button" onclick="window.location = 'adminDashboard'" class="btn btn-danger" name="close_name" value="Close"/>             
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Profit/Loss</h5>
                                        <form class="" method="POST" action="master_Office_db">
                                                <div class="position-relative row form-group"><label for="pft_loss_date_id" class="col-sm-2 col-form-label">Date</label>
                                                    <div class="col-sm-6"><input name="pft_loss_date" id="pft_loss_date_id"  type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required></div>
                                                </div>                                                
                                                <div class="position-relative row form-group"><label for="pft_loss_acc_name_id" class="col-sm-2 col-form-label">Trade A/C</label>
                                                     <div class="col-sm-6">
                                                         <select name="pft_loss_acc_name" id="pft_loss_acc_name_id" type="text" class="form-control pft_loss_acc_name_class" required>
                                                            <option value="trade1">Trade 1</option>
                                                            <option value="trade1">Trade 2</option>
                                                         </select>
                                                     </div>
                                                 </div> 
                                                 <fieldset class="position-relative row form-group">
                                                 <div class="col-sm-10">
                                                     <div class="position-relative form-check form-check-inline"><label class="form-check-label"><input name="radiopl" type="radio" class="form-check-input" id="rbtn_profit_id" value="profit" onclick="javascript: profitCheck()" checked> Profit</label></div>
                                                     <div class="position-relative form-check form-check-inline"><label class="form-check-label"><input name="radiopl" type="radio" class="form-check-input" id="rbtn_loss_id" value="loss" onclick="javascript: lossCheck()"> Loss </label></div>
                                                 </div>
                                                 </fieldset>
                                                 <div class="position-relative row form-group profit_div"><label for="Profit_id" class="col-sm-2 col-form-label">Profit Amount</label>
                                                     <div class="col-sm-6"><input name="profit" id="Profit_id" placeholder="Enter Profit" type="text" class="form-control profit_class" value="0.00" required>
                                                     </div>
                                                 </div>
                                                 <div class="position-relative row form-group loss_div"><label for="loss_id" class="col-sm-2 col-form-label">Loss Amount</label>
                                                     <div class="col-sm-6"><input name="loss" id="loss_id" placeholder="Enter Loss" type="text" class="form-control loss_class" value="0.00" required></div>
                                                 </div>                
                                            <button class="btn btn-primary" type="submit" name="pft_loss_submit">Add</button>               
                                            <input type="button" onclick="window.location = 'adminDashboard'" class="btn btn-danger" name="close_name" value="Close"/>             
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane tabs-animation fade" id="tab-content-3" role="tabpanel">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Withdrawal Details</h5>
                                        <form class="" method="POST" action="master_Office_db">
                                                <div class="position-relative row form-group"><label for="wd_rec_name_id" class="col-sm-2 col-form-label">Tranfer BY</label>
                                                    <div class="col-sm-6">
                                                        <select name="wd_rec_name" id="wd_rec_name_id" type="text" class="form-control wd_rec_name_class" required>
                                                           <option value="Ravindra Kute">Ravindra Kute</option>
                                                           <!-- <option value="Krushna Fulari">Krushna Fulari</option> -->
                                                        </select>
                                                    </div>
                                                </div> 
                                                <div class="position-relative row form-group"><label for="wd_trd_acc_name_id" class="col-sm-2 col-form-label">From Trade A/C</label>
                                                     <div class="col-sm-6">
                                                         <select name="wd_trd_acc_name" id="wd_trd_acc_name_id" type="text" class="form-control wd_trd_acc_name_class" required>
                                                            <option value="trade1">Trade 1</option>
                                                            <option value="trade1">Trade 2</option>
                                                         </select>
                                                     </div>
                                                 </div>
                                                <div class="position-relative row form-group"><label for="wd_transferBank_id" class="col-sm-2 col-form-label">Transfer To Bank</label>
                                                    <div class="col-sm-6">
                                                        <select name="wd_transferBank_name" id="wd_transferBank_id" type="text" class="form-control wd_transferBank_class" required>
                                                            <?php
                                                                $sql = mysqli_query($conn, "SELECT * FROM `msd_comp_bank_dtl_table` WHERE status != 2");
                                                                $row = mysqli_num_rows($sql);
                                                                while ($row = mysqli_fetch_array($sql)){
                                                                    echo "<option value='". $row['Bank_Name'] ."'>" .$row['Bank_Name'] ."</option>" ;
                                                                }                                                            
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>   
                                                 
                                            <div class="position-relative row form-group"><label for="wd_req_date_id" class="col-sm-2 col-form-label">W/D Req. Date</label>
                                                <div class="col-sm-6"><input name="wd_req_date" id="wd_req_date_id"  type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required></div>
                                            </div>                                       
                                            <div class="position-relative row form-group"><label for="withdraw_id" class="col-sm-2 col-form-label">Withdraw Amount</label>
                                                <div class="col-sm-6"><input name="withdraw" id="withdraw_id" placeholder="Enter Withdraw" type="withdraw" class="form-control" value = "0.00"></div>
                                            </div>
                                            
                                            <button class="btn btn-primary" type="submit" name="wd_submit">Add</button>               
                                                <input type="button" onclick="window.location = 'adminDashboard'" class="btn btn-danger" name="close_name" value="Close"/>             
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
    <script>
        $(".loss_div").hide();
        function profitCheck() {
        $(".loss_div").hide();
          $(".profit_div").show();
        }
        function lossCheck() {
          $(".loss_div").show();
          $(".profit_div").hide();
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