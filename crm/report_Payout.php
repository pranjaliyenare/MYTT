<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; 
      include 'database.php';
?>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

<body>
<div class="app-main__outer">
    <div class="app-main__inner">
        <?php  if($_SESSION['ROLE'] == "admin") { ?>
        <div class="app-page-title" style="padding: 10px;">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div>Payout Report
                        <div class="page-title-subheading"></div>
                    </div>
                </div>
                <div class="page-title-actions" id="divBtnAdd" >
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
                            <label for="exampleEmail" class="col-sm-2 col-form-label"><b>Month :</b></label>
                            <div class="col-sm-6">
                                <input type="month" id="month" name="month" class="form-control month_class">
                            </div>
                            <input class="mb-2 mr-2 btn btn-primary" type="submit" name="submit" value="Search" />
                        </div>
                        
                        </form>
                        </div>
                </div>
            </div>
        </div>

        <?php
           if(isset($_POST['submit'])) {
            echo ' <div class="row">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title"></h5>
                        <form class="" method="post">                           
                        <div class="table-responsive">
                            <p style="margin-bottom: 0;" align="left">';
                            
                            $bal = 0.00;
                            $profit = 0.00;
                            $tot_dep = 0.00;
                            $tot_profit = 0.00;
                            $tot_with = 0.00;
                            $i =0;
                            $query = mysqli_query($conn, "SET sql_mode = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");     
                            $query = "SELECT `customer_id` AS id, `customer_name` AS name, `payout_amount`  AS payout, `deposit_amount`, `principle_amount` AS prin_amt FROM `msd_payout_table` WHERE  DATE_FORMAT(date, '%Y-%m') = '".$_POST['month']."' AND status != 2";
                            //$query = "SELECT WITHAMT.date, `register_id` id, CONCAT(`register_fname`,' ', `register_lname`) as name, WITHAMT.`amount` AS payout, SUM(PAY.`amount`) AS prin_amt FROM `msd_register_customer_table` INNER JOIN `msd_xway_pay_response_table` PAY ON `userid` = `register_id` AND PAY.`status` != 'failed' AND `pay_status` != 2 RIGHT JOIN `msd_transaction_withdraw_table` AS WITHAMT ON `user_id` = `register_id` AND `approve_status` = 'approved' WHERE `register_approved_status` = 'approved' AND `register_activate_status` = 'activate' AND `register_status` != 2 AND DATE_FORMAT(WITHAMT.date, '%Y-%m') = '".$_POST['month']."' group by id, name";
                                if($_POST['month'] != ""){
                                    //$month1 = date('m');                                                      
                                    //$year  = date('Y');  
                                    $month = $_POST['month'];
                                    $month = explode('-', $month);
                                    $month1 = $month[1];
                                    $year  = $month[0];                                    
                                } else {
                                    $month1 = date('m');                                                      
                                    $year  = date('Y');  
                                }
                                    //echo $month1;
                                    if ($month1 == '01'){
                                        $textmonth = "January";
                                        } else if ($month1 == '02'){
                                        $textmonth="February";
                                        } else if ($month1 == '03'){
                                        $textmonth="March";
                                        } else if ($month1 == '04'){
                                        $textmonth="April";
                                        } else if ($month1 == '05'){
                                        $textmonth="May";
                                        } else if ($month1 == '06'){
                                        $textmonth="June";
                                        } else if ($month1 == '07'){
                                        $textmonth="July";
                                        } else if ($month1 == '08'){
                                        $textmonth="August";
                                        } else if ($month1 == '09'){
                                        $textmonth="September";
                                        } else if ($month1 == '10'){
                                        $textmonth="October";
                                        } else if ($month1 == '11'){
                                        $textmonth="November";
                                        } else if ($month1 == '12'){
                                        $textmonth="December";
                                        }
                                                     
                                            
                                    
                                    //<p style="text-align: center;">Payout Month : <label for="" class="col-sm-2 col-form-label" style="font-size: 20px; font-style: italic; text-decoration: underline;"><b>'.$textmonth.'-'.$year.'</b></label></p>';
                                    echo '<div id="table-wrapper" class="div_export"> 
                                                <h2 style="text-align: center;">MyThink Tank Multimedia Pvt. Ltd.</h2>
                                                <p style="text-align: center;">102, Gandharva Galaxia, Above Natural Ice Cream, Malawadi Road, Hadpsar, Pune, 411028.</p>
                                                <p style="text-align: center;">Mobile : <a href="http://wa.me/+919604533533">9604533533<a/> |  Email : info@mytt.in</p>
                                                <br/>           
                                    <div id="table-scroll">
                                    
                                    <table id="tblData" class="mb-0 table table-bordered" style="text-align: center;">
                                            <thead>
                                            <tr><th colspan="5">Payout Month '.$textmonth.' '.$year.'</th><tr>
                                            <tr>
                                            <th>Sr.No.</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Payout</th>
                                            <th>Principal Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>';
                                    if ($result = $conn->query($query)) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $str_length = strlen($row["name"]);
                                                    $name = substr($row["name"], 0, 2).str_repeat('*', $str_length - 3).substr($row["name"], $str_length - 2, 3);
                                                    $withdrawal = $row["payout"];
                                                    $deposit = $row["prin_amt"];
                                                    $dep = ($deposit*(5/100));
                                                    echo'<tr>
                                                    <td>'.++$i.'</td>
                                                    <td>'.$row["id"].'</td>
                                                    <td>'.$name.'</td>
                                                    <td>'.number_format($withdrawal, 2).'</td>
                                                    <td>'.number_format($deposit, 2).'</td>
                                                    </tr>';
                                                   //$tot_dep += $dep;
                                                   $tot_dep += $deposit;
                                                   $tot_with +=$withdrawal;
                                                    }
                                                    $result->free();
                                                    echo '</tbody>
                                                    <tfoot>
                                                       <tr">
                                                         <th colspan="3">Total</th>
                                                         <th>'.$tot_with.'</th>
                                                         <th>'.$tot_dep.'</th>
                                                         <th></th>
                                                       </tr>
                                                     </tfoot> </table><br/><b>This is System Generated Report...!!!</b> </div></div>';
                                    }

                          echo'  </p>
                            </div>
                        </form>
                    </div>
                </div>
            ';
                                }
            ?>
        </div>
        </div>
    </div>
    <script type="text/javascript" src="dist/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    <script>
        function ExportExcel(type, fn, dl) {
            var elt = document.getElementById('table-wrapper');
            var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
            return dl ?
               XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
               XLSX.writeFile(wb, fn || ('Payout.' + (type || 'xlsx')));
        }

        //function exportTableToExcel(tableID, filename = ''){
            // $(".div_export").css("color","black");
            // var downloadLink;
            // var dataType = 'application/vnd.ms-excel';
            // var tableSelect = document.getElementById(tableID);
            // var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // // Specify file name
            // filename = filename?filename+'.xls':'excel_data.xls';

            // // Create download link element
            // downloadLink = document.createElement("a");

            // document.body.appendChild(downloadLink);

            // if(navigator.msSaveOrOpenBlob){
            //     var blob = new Blob(['\ufeff', tableHTML], {
            //         type: dataType
            //     });
            //     navigator.msSaveOrOpenBlob( blob, filename);
            // }else{
            //     // Create a link to the file
            //     downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
            
            //     // Setting the file name
            //     downloadLink.download = filename;

            //     //triggering the function
            //     downloadLink.click();
            // }
        //}

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