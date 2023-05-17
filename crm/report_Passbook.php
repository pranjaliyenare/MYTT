

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
        <title>Statement</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
        <meta name="msapplication-tap-highlight" content="no">
    </head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="./main.css" rel="stylesheet">
    <script type="text/javascript" src="./assets/scripts/main.js"></script>

    <style>
        table thead 
        {
            text-align: center;
        }
        table tbody
        {
            text-align: center;
        }
        table tfoot
        {
            text-align: center;
        }

        #table-wrapper {
            position:relative;
        }
        #table-scroll {
            height:500px;
            overflow:auto;  
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
            background : #bac0c7;
            position: sticky;
            top: 0;
            border:1px solid white;
        }
        table tfoot th {
            position: sticky;
            bottom: 0;
            z-index: 2;
            background : #bac0c7;
            border:1px solid white;
        }
    </style>
    <body>
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title" style="padding: 10px;">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <div>Statement
                                <div class="page-title-subheading"></div>
                            </div>
                        </div>
                        <div class="page-title-actions" id="divBtnAdd" >
                            <!-- <button class="btn" style="background: #3d9852; color:white;" onclick="exportTableToExcel('tblData', 'Customer-Data')">Export To Excel</button> -->
                            <button class="btn" onclick="ExportExcel('xlsx')" style="background: #3d9852; color:white;"><i class="fa fa-file-excel-o" style="font-size:24px"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body"><h5 class="card-title"></h5>
                                <form class="" method="post" action="#">
                                    <div class="position-relative row form-group">
                                        <label for="exampleEmail" class="col-sm-2 col-form-label"><b> Customer Name :</b></label>
                                                <div class="col-sm-5">
                                                        <?php   
                                                            if($_SESSION['ROLE'] == "admin") {
                                                                    echo '<select class="mb-2 form-control" name="customer_name" id="customer_id" >';
                                                                    //if($_POST['customer_name'] != "") {echo '<option selected value= "'.$_POST['customer_name'].'">'.$userId.'</option>'; }
                                                                    $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE  `msd_register_customer_table`.`register_status` != 2 AND `register_approved_status` = 'approved'");
                                                                    $row = mysqli_num_rows($sql);
                                                                    while ($row = mysqli_fetch_array($sql)) {
                                                                        if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                                        echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                                        $selected ="";
                                                                }
                                                                echo '</select>
                                                                <div class="select-dropdown"></div>';
                                                            } else if($_SESSION['ROLE'] == "accountant" || $_SESSION['ROLE'] == "assistant") {
                                                                echo '<select class="mb-2 form-control" name="customer_name" id="customer_id" >';
                                                                //if($_POST['customer_name'] != "") {echo '<option selected value= "'.$_POST['customer_name'].'">'.$userId.'</option>'; }
                                                                $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE  `msd_register_customer_table`.`register_status` != 2 AND `register_approved_status` = 'approved'");
                                                                $row = mysqli_num_rows($sql);
                                                                while ($row = mysqli_fetch_array($sql)) {
                                                                    if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                                    echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                                    $selected ="";
                                                            }
                                                            echo '</select>
                                                            <div class="select-dropdown"></div>';
                                                        } else if($_SESSION['ROLE'] == "manager") {
                                                                echo '<select class="mb-2 form-control" name="customer_name" id="customer_id" >';
                                                                $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE reference_id = '".$_SESSION['USERID']."' AND `msd_register_customer_table`.`register_status` != 2 AND `register_approved_status` = 'approved'");
                                                                $row = mysqli_num_rows($sql);
                                                                while ($row = mysqli_fetch_array($sql)) {
                                                                    if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                                    echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                                    $selected ="";
                                                            }
                                                            echo '</select>
                                                            <div class="select-dropdown"></div>';
                                                        } else if($_SESSION['ROLE'] == "employee") {
                                                            echo '<select class="mb-2 form-control" name="customer_name" id="customer_id" >';
                                                            $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE reference_id = '".$_SESSION['USERID']."' AND `msd_register_customer_table`.`register_status` != 2 AND `register_approved_status` = 'approved'");
                                                            $row = mysqli_num_rows($sql);
                                                            while ($row = mysqli_fetch_array($sql)) {
                                                                if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                                echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ; 
                                                                $selected ="";
                                                        }
                                                        echo '</select>
                                                        <div class="select-dropdown"></div>';
                                                    } else if($_SESSION['ROLE'] == "agent") {
                                                        echo '<select class="mb-2 form-control" name="customer_name" id="customer_id" >';
                                                        $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE agent_id = '".$_SESSION['USERID']."' AND `msd_register_customer_table`.`register_status` != 2 AND `register_approved_status` = 'approved'");
                                                        $row = mysqli_num_rows($sql);
                                                        while ($row = mysqli_fetch_array($sql)) {
                                                            if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                            echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                            $selected ="";
                                                    }
                                                    echo '</select>
                                                    <div class="select-dropdown"></div>';
                                                }
                                            ?>
                                    </div>
                                        <div class="col-sm-2">
                                            <input class="mb-2 mr-2 btn btn-primary" type="submit" name="submit" value="Search" />
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom01">From Date</label>
                                                <input type="date" class="form-control" id="datefilterfrom" data-date-split-input="true">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">To Date</label>
                                                <input type="date" class="form-control" id="datefilterto" data-date-split-input="true">
                                            </div>
                                            
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    if(isset($_POST['submit'])){
                        //echo $_POST['customer_name'];
                    echo '<div class="row">
                    <div class="col-lg-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body"><h5 class="card-title"></h5>
                            <form>
                            <div class="table_Div" id="table_Div_id">            
                            <div class="table-responsive">
                                <p style="margin-bottom: 0; text-align:left;">'; 
                            
                                $sql = "SELECT * FROM `msd_register_customer_table` WHERE `register_id` = '".$_POST['customer_name']."' AND register_status != 2 AND `register_approved_status` = 'approved'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                $month = date("Y-m");  

                                if($row>0) {
                                        $userId =$row['register_fname']." ".$row['register_lname'];
                                        $address = $row["register_addr1"].", ".$row["register_addr2"].", ".$row["register_city"].", ".$row["register_state"].", ".$row["register_country"]."-".$row["register_pincode"];
                                                                        
                                        echo "<b>".$userId." - ".$row["register_id"]."</b>
                                            <p style='margin-bottom: 0;'>".$row["register_addr1"].", ".$row["register_addr2"].", ".$row["register_city"]."</p>
                                            <p style='margin-bottom: 0;'>".$row["register_state"]." - ".$row["register_pincode"]."</p>
                                            <p style='margin-bottom: 0;'>".$row["register_country"].".</p>
                                            <p style='margin-bottom: 0;'> Mobile : ".$row["register_mobno"]."</p>
                                            <p style='margin-bottom: 0;'> Email : ".$row["register_email"]."</p></br>";
                                }
                            
                            $q = "SELECT * FROM `msd_customer_plan_table` WHERE `customer_id` ='".$_POST['customer_name']."' AND `status`!=2";
                            //$plan = mysqli_fetch_assoc($q);
                            //$rows = mysqli_num_rows($q);
                                
                            if ($plan = $conn->query($q)) {
                                while ($rowPlan = $plan->fetch_assoc()) {
                            //if($rows) {
                                    $bal = 0.00;
                                    $profit = 0.00;
                                    $tot_dep = 0.00;
                                    $tot_profit = 0.00;
                                    $tot_with = 0.00;
                                    $tot_princ = 0.00;
                                    $i =0;
                                    //$query = "SELECT PAYRES.date dt, 'Deposit' AS refno, PAYRES.amount AS deposit, 0.00 AS withdrawals, 0.00 AS profit FROM `msd_xway_pay_response_table` AS PAYRES LEFT JOIN `msd_transaction_withdraw_table` AS WITHDRAW ON WITHDRAW.user_id = PAYRES.userid WHERE PAYRES.userid = '".$_POST['customer_name']."' AND PAYRES.`plan_id` = '".$rowPlan['plan_id']."' AND PAYRES.`status` != 'failed' GROUP BY PAYRES.id UNION SELECT PROFIT.date AS dt, 'Profit' AS refno, 0.00 AS deposit, 0.00 AS withdrawals, PROFIT.cust_profit_amount AS profit FROM `msd_profit_table` PROFIT WHERE PROFIT.userid = '".$_POST['customer_name']."' AND PROFIT.`plan_id` = '".$rowPlan['plan_id']."' AND status != 2 UNION SELECT WITHDRAW.approve_date dt, 'withdraw' AS refno, 0.00 AS deposit, WITHDRAW.amount AS withdrawals, 0.00 AS profit FROM `msd_transaction_withdraw_table` AS WITHDRAW RIGHT JOIN `msd_xway_pay_response_table` AS PAYRES ON PAYRES.userid = WITHDRAW.user_id WHERE PAYRES.userid = '".$_POST['customer_name']."' AND WITHDRAW.`plan_id` = '".$rowPlan['plan_id']."' AND PAYRES.`status` != 'failed' AND `approve_status` = 'approved'  ORDER BY dt;";
                                    $query = "SELECT PAYRES.date dt, 'Deposit' AS refno, PAYRES.amount AS deposit, 0.00 AS withdrawals, 0.00 AS principle, 0.00 AS profit FROM `msd_xway_pay_response_table` AS PAYRES LEFT JOIN `msd_transaction_withdraw_table` AS WITHDRAW ON WITHDRAW.user_id = PAYRES.userid WHERE PAYRES.userid = '".$_POST['customer_name']."' AND PAYRES.`plan_id` = '".$rowPlan['plan_id']."' AND PAYRES.`status` != 'failed' GROUP BY PAYRES.id UNION SELECT PROFIT.date AS dt, 'Profit' AS refno, 0.00 AS deposit, 0.00 AS withdrawals, 0.00 AS principle, PROFIT.cust_profit_amount AS profit FROM `msd_profit_table` PROFIT WHERE PROFIT.userid = '".$_POST['customer_name']."' AND PROFIT.`plan_id` = '".$rowPlan['plan_id']."' AND status != 2 UNION SELECT WITHDRAW.approve_date dt, 'withdraw' AS refno, 0.00 AS deposit, WITHDRAW.amount AS withdrawals, WITHDRAW.`principal_amount` AS principle, 0.00 AS profit FROM `msd_transaction_withdraw_table` AS WITHDRAW RIGHT JOIN `msd_xway_pay_response_table` AS PAYRES ON PAYRES.userid = WITHDRAW.user_id WHERE PAYRES.userid = '".$_POST['customer_name']."' AND WITHDRAW.`plan_id` = '".$rowPlan['plan_id']."' AND PAYRES.`status` != 'failed' AND `approve_status` = 'approved' ORDER BY `dt`";
                                    
                                    $querypaidprinc = mysqli_query($conn, "SELECT SUM(principal_amount) AS paid_princ FROM `msd_transaction_withdraw_table` WHERE `user_id` = '".$_POST['customer_name']."' AND `plan_id` = '".$rowPlan['plan_id']."' AND `status` != 2 AND `approve_status` = 'approved'");
                                    if(isset($querypaidprinc)) {                            
                                        $paidprinc_array = mysqli_fetch_assoc($querypaidprinc);
                                        $paid_princ = $paidprinc_array["paid_princ"];   
                                    } else {
                                        $paid_princ = 0.00;
                                    }

                                    echo '<hr/>
                                    <p style="margin-top: 1rem; font-weight: bold;">★ Plan Name : '.$rowPlan['plan_id']." ~ ".$rowPlan['plan_name']." ~ ".$rowPlan['duration']." Months - ".$rowPlan['active_status'].'</p>
                                    <p style="margin-top: 1rem; font-weight: bold;">★ Amount : '.$rowPlan['deposit_amt'].' '.$rowPlan['currency'].'<p>';
                                    if($rowPlan['perc_return'] == 'YES') {
                                        if($paid_princ == ''){
                                            $princ = '0.00';
                                        } else {
                                            $princ =$paid_princ;
                                        }
                                        echo '<p style="font-weight: bold; color: #d1147a;">★ Total Principle Return: '.$princ.'</p>';
                                    }
                                    
                                    echo '<div id="table-wrapper">            
                                        <div id="table-scroll">
                                            <table id="tblData" class="mb-0 table table-bordered">
                                            <thead>
                                            <tr>
                                            <th>Sr.No.</th>
                                            <th>Date</th>
                                            <th>Ref No.</th>
                                            <th>Deposit</th>
                                            <th>Withdrawals</th>';
                                            if($rowPlan['perc_return'] == 'YES') {
                                                echo '<th>Principle</th>';
                                            }
                                            echo '<th>Profit</th>
                                            <th>Balance</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr style="font-weight: bolder;"><td colspan="6" style="text-align: center;">Opening Balance</td>
                                                <td>0</td>
                                            </tr>';
                                    if ($result = $conn->query($query)) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $paydate = $row["dt"];
                                                    $reference_no = $row["refno"];
                                                    $withdrawal = $row["withdrawals"];
                                                    $principle = $row["principle"];
                                                    $deposit = $row["deposit"];
                                                    $profit = $row["profit"];

                                                    $balance = $bal+$deposit+$profit-$withdrawal = $row["withdrawals"];
                                                    echo'<tr>
                                                    <td>'.++$i.'</td>
                                                    <td>'.date("d-m-Y", strtotime($paydate)).'</td>
                                                    <td>'.$reference_no.'</td>';
                                                    if($deposit>0.00){
                                                        echo '<td style="color:green">'.$deposit.'</td>';
                                                    } else {
                                                        echo '<td>'.$deposit.'</td>';
                                                    }
                                                    if($withdrawal> -0.00){
                                                        echo '<td style="color:red">-'.$withdrawal.'</td>';
                                                    } else {
                                                        echo '<td>-'.$withdrawal.'</td>';
                                                    }
                                                    if($rowPlan['perc_return'] == 'YES') {
                                                        if($principle> -0.00){
                                                            echo '<td style="color:red">-'.$principle.'</td>';
                                                        } else {
                                                            echo '<td>'.$principle.'</td>';
                                                        }
                                                    }
                                                    if($profit> 0.00){
                                                        echo '<td style="color:#16aaff">'.$profit.'</td>';
                                                    } else {
                                                        echo '<td>'.$profit.'</td>';
                                                    }
                                                    echo '<td>'.number_format($balance, 2).'</td>                                                    
                                                    </tr>';
                                                    $bal = $balance;
                                                    $tot_dep += $deposit;
                                                    $tot_profit += $profit;
                                                    $tot_with +=  $withdrawal;
                                                    $tot_princ +=   $principle;
                                                    }
                                                    $result->free();
                                                    echo '</tbody>
                                                    <tfoot>
                                                    <tr">
                                                        <th colspan="3">Total</th>
                                                        <th>'.$tot_dep.' - '.$rowPlan['currency'].'</th>
                                                        <th>'.number_format($tot_with, 2).'</th>';
                                                        if($rowPlan['perc_return'] == 'YES') { 
                                                            echo '<th>'.number_format($tot_princ, 2).'</th>'; 
                                                        } 
                                                        echo'<th>'.number_format($tot_profit, 2).'</th>
                                                        <th>'.number_format($tot_profit-$tot_with, 2).' - '.$rowPlan['currency'].'</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>';
                                    }
                                }
                            }
                        echo '</p>
                        </div>
                        <div><form></div>
                        </div>
                    </div>
                </div></div></div>';
                }
            ?>
        </div>
        <script type="text/javascript" src="dist/xlsx.full.min.js"></script>
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

        <script>

            function filterRows() {
                var from = $('#datefilterfrom').val();
            var to = $('#datefilterto').val();
            
            if (!from && !to) { // no value for from and to
                return;
            }
            
            from = from || '1970-01-01'; // default from to a old date if it is not set
            to = to || '2999-12-31';
            
            var dateFrom = moment(from);
            var dateTo = moment(to);
            
            $('#tblData tr').each(function(i, tr) {
                var val = $(tr).find("td:nth-child(2)").text();
                var dateVal = moment(val, "DD-MM-YYYY");
                var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? "" : "none"; // [] for inclusive
                $(tr).css('display', visible);
            });
            }

            $('#datefilterfrom').on("change", filterRows);
            $('#datefilterto').on("change", filterRows);

            function ExportExcel(type, fn, dl) {
                var elt = document.getElementById('tblData');
                var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
                return dl ?
                XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
                XLSX.writeFile(wb, fn || ('Statement_Report.' + (type || 'xlsx')));
            }

            function exportTableToExcel(tableID, filename = ''){
                $(".table tr td").css("color","black");
                var downloadLink;
                var dataType = 'application/vnd.ms-excel';
                var tableSelect = document.getElementById(tableID);
                var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

                // Specify file name
                filename = filename?filename+'.xls':'excel_data.xls';

                // Create download link element
                downloadLink = document.createElement("a");

                document.body.appendChild(downloadLink);

                if(navigator.msSaveOrOpenBlob){
                    var blob = new Blob(['\ufeff', tableHTML], {
                        type: dataType
                    });
                    navigator.msSaveOrOpenBlob( blob, filename);
                }else{
                    // Create a link to the file
                    downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
                
                    // Setting the file name
                    downloadLink.download = filename;

                    //triggering the function
                    downloadLink.click();
                }
            }
            //window.onload = function() {
            function custChange() {
                    
                document.getElementById('table_Div_id').style.display = "block";
            }
            
        </script>
        <!-- select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
        <script>
            window.onload = function(){
                $('#customer_id').select2();
            }   
        </script>
    </body>
</html>
<?php include 'footer.php';?>
