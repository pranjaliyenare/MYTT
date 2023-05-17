

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
        <title>Plan Wise Report</title>
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
            <?php  if($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "accountant") { ?>
                <div class="app-page-title" style="padding: 10px;">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <div>Plan Wise Report
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
                                            <select class="form-control plan_name_class" id="plan_name" name="plan_name" required="">
                                                <option value="0">Select Plan...</option>
                                                <?php 
                                                    $sql = mysqli_query($conn, "SELECT * FROM `msd_plan_table` WHERE `status` != 2");
                                                    $row = mysqli_num_rows($sql);
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                        echo "<option value='". $row['plan_id'] ."' ".$selected.">" .$row['plan_name'] ."</option>" ;
                                                    }                                            
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <input class="mb-2 mr-2 btn btn-primary" type="submit" name="submit" value="Search" />
                                        </div>
                                    </div>
                                    <!-- <div class="divider"></div> -->
                                        <!-- <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom01">From Date</label>
                                                <input type="date" class="form-control" id="datefilterfrom" data-date-split-input="true">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">To Date</label>
                                                <input type="date" class="form-control" id="datefilterto" data-date-split-input="true">
                                            </div>
                                            
                                        </div> -->
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
                            <div class="table-responsive">'; 
                            $i = 0;
                                    $query = "SELECT * FROM `msd_customer_plan_table` WHERE `plan_new_id` = '".$_POST['plan_name']."'";
                                    
                                    echo '<hr/>
                                    <p style="margin-top: 1rem; font-weight: bold;">★ Plan Name : '.$_POST['plan_name'].'</p>
                                    
                                    <div id="table-wrapper">            
                                            <div id="table-scroll">
                                            <table id="tblData" class="mb-0 table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.No.</th>
                                                        <th>Plan Name</th>
                                                        <th>Customer Name</th>
                                                        <th>Deposit Amount</th>
                                                        <th>Profit %</th>
                                                        <th>Principle %</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                            if ($result = $conn->query($query)) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo'<tr>
                                                    <td>'.++$i.'</td>
                                                    <td>'.$row["plan_id"]." - ".$row["plan_name"].'</td>
                                                    <td>'.$row["customer_name"].'</td>
                                                    <td>'.$row["deposit_amt"].'</td>
                                                    <td>-'.$row["profit_perc"].'</td>                                                                                                    
                                                    <td>-'.$row["princ_perc"].'</td>  
                                                    <td>'.date("d-m-Y", strtotime($row["start_date"])).'</td>
                                                    <td>'.date("d-m-Y", strtotime($row["end_date"])).'</td>                                                                                                 
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
                XLSX.writeFile(wb, fn || ('Plan_Wise_Report_Report.' + (type || 'xlsx')));
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