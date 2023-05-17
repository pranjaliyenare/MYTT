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
    <title>Passbook</title>
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
      /* background:yellow; */
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
    table tfoot th {
        position: sticky;
        bottom: 0;
        z-index: 2;
        background : #3f6ad8;
        border:1px solid white;
    }
</style>
<body>
<div class="app-main__outer">
    <div class="app-main__inner">
        <?php if($_SESSION["ROLE"] == "admin") { ?>
        <div class="app-page-title" style="padding: 10px;">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div>Passbook
                        <div class="page-title-subheading"></div>
                    </div>
                </div>
                <div class="page-title-actions" id="divBtnAdd" >
                    <!-- <button class="btn" style="background: #3d9852; color:white;" onclick="exportTableToExcel('tblData', 'Customer-Data')">Export To Excel</button> -->
                    <button class="btn" onclick="ExportExcel('xlsx')" style="background: #3d9852; color:white;"><i class="fa fa-file-excel-o" style="font-size:24px"></i></button>
                </div>
            </div>
        </div>
        

     <?php
                      
                            //echo $_POST['customer_name'];
                        echo '<div class="row">
                        <div class="col-lg-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body"><h5 class="card-title"></h5>
                                <form>
                                <div class="table_Div" id="table_Div_id">            
                        <div class="table-responsive">
                            <p style="margin-bottom: 0;" align="left">'; 
                                 $query = "SELECT `register_id` AS id, concat(`register_fname`, ' ', `register_lname`) AS name,  `aggr_plan_start_date` AS stdt, `aggr_plan_end_date` todt, PAYRES.date dt, 'Deposit' AS refno, PAYRES.amount AS deposit, 0.00 AS withdrawals FROM `msd_xway_pay_response_table` AS PAYRES LEFT JOIN `msd_register_customer_table` AS cust ON cust.`register_id` = PAYRES.userid AND `register_status` != 2 AND `register_approved_status` = 'approved' WHERE PAYRES.`status` != 'failed' AND `pay_status`!= 2 UNION SELECT `register_id` id, concat(`register_fname`, ' ', `register_lname`) AS name, `aggr_plan_start_date` AS stdt, `aggr_plan_end_date` todt, WITHDRAW.date dt, 'withdraw' AS refno, 0.00 AS deposit, WITHDRAW.amount AS withdrawals FROM `msd_transaction_withdraw_table` AS WITHDRAW  RIGHT JOIN `msd_register_customer_table` AS cust ON cust.`register_id` = WITHDRAW.user_id AND `register_status` != 2 AND `register_approved_status` = 'approved' AND `register_activate_status` = 'activate' WHERE WITHDRAW.`status` != 2 AND `approve_status` = 'approved'  ORDER BY id";
                                     
                                    $bal = 0.00;
                                    $profit = 0.00;
                                    $tot_dep = 0.00;
                                    $tot_profit = 0.00;
                                    $tot_with = 0.00;
                                    $i =0;
                                    echo date('dmY');
                                    echo '<div id="table-wrapper">            
                                        <div id="table-scroll">
                                            <table id="tblData" class="mb-0 table table-bordered">
                                            <thead>
                                            <tr>
                                            <th>Sr.No.</th>
                                            <th>User ID</th>
                                            <th>Name</th>   
                                            <th>Date</th>
                                            <th>Type</th>                                        
                                            <th>Deposit Date</th>
                                            <th>Expiry Date</th>                                            
                                            <th>Deposit Amount</th>
                                            <th>Withdraw Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                           ';
                                    if ($result = $conn->query($query)) {
                                                while ($row = $result->fetch_assoc()) {                                                   
                                                    echo'<tr>
                                                    <td>'.++$i.'</td>
                                                    <td>'.$row["id"].'</td>
                                                    <td>'.$row["name"].'</td>
                                                    <td>'.date("d-m-Y", strtotime($row["dt"])).'</td>
                                                    <td>'.$row["refno"].'</td>                
                                                    <td>'.date("d-m-Y", strtotime($row["stdt"])).'</td>
                                                    <td>'.date("d-m-Y", strtotime($row["todt"])).'</td>                                
                                                    <td>'.number_format($row["deposit"], 2).'</td>  
                                                    <td>'.number_format($row["withdrawals"], 2).'</td>                                                    
                                                    </tr>';
                                                    }
                                                    $result->free();
                                                    echo '</tbody>                                                   
                                                </table>
                                            </div>
                                        </div>';
                                    }
                            echo '</p>
                            </div>
                            <div><form></div>
                            </div>
                        </div>
                    </div></div></div>';
                                
                        ?>
                    </div>
    <script type="text/javascript" src="dist/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
               XLSX.writeFile(wb, fn || ('Passbook_Report.' + (type || 'xlsx')));
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