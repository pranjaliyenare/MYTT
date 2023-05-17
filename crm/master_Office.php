<?php 
    include 'database.php';
    include 'header.php';
    if(isset($_SESSION["MO_USER_NAME"])){
        echo "<script>window.location = 'master_office_add';</script>";
    } else {
        echo "<script>window.location = 'master_Office_Login';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en-US">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<head>
    <title>MyThink Tank Back Office</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Edit Profile.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">

<style type="text/css">
        h3 span {
            font-size: 22px;
        }
        h3 input.search-input {
            width: 300px;
            margin-left: auto;
            float: right
        }
        .mt32 {
            margin-top: 32px;
        }
    </style>
</head>
<body class="mt32">
<div class="app-main__outer">
<div class="app-main__inner">
                <?php  if($_SESSION['ROLE'] == "admin") { ?>
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon ">
                     <img src="assets/images/logo.png" alt="Italian Trulli" style="width: 50px; height: 50px;">
                </div>
                MyThink Tank Back Office
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title"></h5>

                                <!-- <div class="container"> -->
                                <!-- <form action="" method="post" action="master_Office_db.php"> -->
                                <!-- <h3>
                                    <span>MyThink Tank Assets Management</span>
                                    </h3>
                                <hr> -->
                                <h3>
                                <button name="submit" class="btn btn-primary" onclick="javascript: btnOnclick()">Save</button>
                                <input type="button" onclick="window.location = 'adminDashboard'" class="btn btn-danger" name="close_name" value="Close"/>
                                <input type="search" placeholder="Search..." class="form-control search-input" data-table="customers-list"/>
                                </h3>
                                <div class="table-responsive">
                                        <?php
                                        $i = 0;
                                        $query = "SELECT * FROM `msd_register_customer_table` WHERE register_status != 2 and register_id=0";
                                        echo '<table id="cust_table_id" class="mb-0 table table-striped mt32 cust_table_class customers-list">
                                            <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Investor Name</th>
                                                    <th>Date</th>
                                                    <th>Amount Received</th>
                                                    <th>Received BY</th>
                                                    <th>Transfer To Bank</th>
                                                    <th>Tranferred Amount</th>
                                                    <th>Trade A/C</th>
                                                    <th>Trade Amount</th>
                                                    <th>Trade Profit</th>
                                                    <th>W/D Req Date</th>
                                                    <th>W/D Amount</th>
                                                    <th>W/D Transfer To Bank</th>
                                                    <th>Trade A/C Balance</th>
                                                    <th>Trade Transfer To Bank</th>
                                                    <th>Bank A/C Balance</th>
                                                    <th>Total Balance</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                            if ($result = $conn->query($query)) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $register_id = $row["register_id"];
                                                    $name = $row["register_fname"]." ".$row["register_lname"];
                                                    $register_email = $row["register_email"];
                                                    $amount = $row["register_invest_amount"];

                                               echo' <tr class="myRow" contenteditable>
                                               <td class="srno"  contenteditable = "false">'.++$i.'</td>
                                               <td class="investor_name"  contenteditable = "false">'.$name.'</td>
                                               <td class="date"  contenteditable = "false">'.date("d-m-Y", strtotime($row["date"])). '</td>
                                               <td class="amount_rec" contenteditable = "false">'.$amount.'</td>
                                               <td class="received_by" ></td>
                                               <td class="transfer_to_bank" ></td>
                                               <td class="tranferred_amount">0</td>
                                               <td class="trade_acc" ></td>
                                               <td class="trade_amt" >0</td>
                                               <td class="trade_profit" >0</td>
                                               <td class="wd_req_date"  contenteditable = "false">'.date("d-m-Y").'</td>
                                               <td class="wd_amt" >0</td>
                                               <td class="wd_trans_bank" ></td>
                                               <td class="trade_bal" >0</td>
                                               <td class="trade_trans_bank" ></td>
                                               <td class="bank_bal" >0</td>
                                               <td class="total_bal" >0</td>
                                               </tr>';
                                            }
                                            $result->free();
                                            echo '</tbody>
                                        </table>';
                                            }else  
                                            {  
                                                 $output .= '<tr>  
                                                                     <td colspan="4">Data not Found</td>  
                                                                </tr>';  
                                            }
                                        ?>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <script>

        $(".myRow").focusout(function(){
            var transAmt =  $(this).find(".tranferred_amount").html();
            var tradeamt = $(this).find(".trade_amt").html();
            var tradeprofit = $(this).find(".trade_profit").html();
            var wdamt = $(this).find(".wd_amt").html();

        
            if(transAmt == "" && transAmt == null && transAmt == '<br>') {
                transAmt = 0.00;
            }  if(tradeamt == "" && tradeamt == null && tradeamt == '<br>') {
                tradeamt = 0.00;
            }  if(tradeprofit == "" && tradeprofit == null && tradeprofit == '<br>') {
                tradeprofit = 0.00;
            }

            tradebal = parseFloat(tradeamt)+parseFloat(tradeprofit)-parseFloat(wdamt);
            $(this).find(".trade_bal").html(tradebal);
        
            var bankbal = parseFloat(transAmt)+parseFloat(wdamt);
            $(this).find(".bank_bal").html(bankbal);
        
            var tradebal =  $(this).find(".trade_bal").html();
            var bank_acc_bal = $(this).find(".bank_bal").html();
            $(this).find(".total_bal").html(parseFloat(tradebal)+parseFloat(bank_acc_bal));
        
        });
        $(".myRow").on('click', function (e) {
            var transAmt =  $(this).find(".tranferred_amount").html();
            var tradeamt = $(this).find(".trade_amt").html();
            var tradeprofit = $(this).find(".trade_profit").html();
            var wdamt = $(this).find(".wd_amt").html();

        
            if(transAmt == "" && transAmt == null && transAmt == '<br>') {
                transAmt = 0.00;
            }  if(tradeamt == "" && tradeamt == null && tradeamt == '<br>') {
                tradeamt = 0.00;
            }  if(tradeprofit == "" && tradeprofit == null && tradeprofit == '<br>') {
                tradeprofit = 0.00;
            }

            tradebal = parseFloat(tradeamt)+parseFloat(tradeprofit)-parseFloat(wdamt);
            $(this).find(".trade_bal").html(tradebal);
        
            var bankbal = parseFloat(transAmt)+parseFloat(wdamt);
            $(this).find(".bank_bal").html(bankbal);
        
            var tradebal =  $(this).find(".trade_bal").html();
            var bank_acc_bal = $(this).find(".bank_bal").html();
            $(this).find(".total_bal").html(parseFloat(tradebal)+parseFloat(bank_acc_bal));
        });
 
        function btnOnclick(){ 
            var bodyArray = [];
            var headArray = [];
            $("table#cust_table_id tr").each(function() {
               var rowthDataArray = [];
               var actualData = $(this).find('th');
               if (actualData.length > 0) {
                  actualData.each(function() {
                      str = $(this).text();
                      var i = 0, strLength = str.length;
                        for(i; i < strLength; i++) {
                            str = str.replace(" ", "_");
                        }

                     rowthDataArray.push(str);
                  });
                  headArray.push(rowthDataArray);
               }
            });
            $("table#cust_table_id tr").each(function() {
               var rowDataArray = [];
               var actualData = $(this).find('td');
               if (actualData.length > 0) {
                  actualData.each(function() {
                     rowDataArray.push($(this).text());
                  });
                  bodyArray.push(rowDataArray);
               }
            });
            
            $.ajax({ 
                   type: "POST", 
                   url: "master_Office_db.php", 
                   data: { td_json_comment : bodyArray }, 
                   success: function(response) { 
                          alert(response);
                    } 
            }); 
        }
</script>

    <script>
        (function(document) {
            'use strict';
            
            var TableFilter = (function(myArray) {
                var search_input;

                function _onInputSearch(e) {
                    search_input = e.target;
                    var tables = document.getElementsByClassName(search_input.getAttribute('data-table'));
                    myArray.forEach.call(tables, function(table) {
                        myArray.forEach.call(table.tBodies, function(tbody) {
                            myArray.forEach.call(tbody.rows, function(row) {
                                var text_content = row.textContent.toLowerCase();
                                var search_val = search_input.value.toLowerCase();
                                row.style.display = text_content.indexOf(search_val) > -1 ? '' : 'none';
                            });
                        });
                    });
                }

                return {
                    init: function() {
                        var inputs = document.getElementsByClassName('search-input');
                        myArray.forEach.call(inputs, function(input) {
                            input.oninput = _onInputSearch;
                        });
                    }
                };
            })(Array.prototype);

            document.addEventListener('readystatechange', function() {
                if (document.readyState === 'complete') {
                    TableFilter.init();
                }
            });

        })(document);
    </script>
    
    
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