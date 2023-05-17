<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<?php 
      include 'header.php';
      include 'database.php';      
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Bank Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">

</head>
<body>
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title" style="padding: 10px;">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">   
                            <i class="fa fa-bank" aria-hidden="true" ></i>
                            </div>
                            <div>Bank Details
                                <div class="page-title-subheading"> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body"><h5 class="card-title"></h5>
                                <form class="" method="post" action="#">
                                    
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

                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body"><h5 class="card-title"></h5>
                            <form class="" method="get" action="">
                            <div class="table-responsive">
                              <input type="hidden" id="hdnID" name="hdnName" >
                                <?php
                                    if($_SESSION['ROLE'] == "admin") {
                                        $query = "SELECT CONCAT(`register_fname`, ' ', `register_lname`) AS name, perc.* FROM `msd_user_bankdtl_table` perc LEFT JOIN `msd_register_customer_table` ON `ACCOUNT_HOLDER_NAME` = `register_id` AND `register_status` != 2 AND `register_approved_status` = 'approved' WHERE status != 2 ORDER BY `id` DESC;";
                                    } else  {
                                        $query = "SELECT CONCAT(`register_fname`, ' ', `register_lname`) AS name, perc.* FROM `msd_user_bankdtl_table` perc LEFT JOIN `msd_register_customer_table` ON `ACCOUNT_HOLDER_NAME` = `register_id` AND `register_status` != 2 AND `register_approved_status` = 'approved' WHERE status != 2 AND `reference_id` = '".$_SESSION['USERID']."' ORDER BY `id` DESC;";
                                    }
                                        
                                        $i = 0;
                                        echo '<table id="table_Id" class="mb-0 table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Date</th>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Bank Name</th>
                                                    <th>Account No.</th>
                                                    <th>IFSC Code</th>
                                                    <th>Branch of Bank </th>
                                                    <th>Type</th>
                                                </tr>
                                                </thead>
                                                <tbody>';
                                        if ($result = $conn->query($query)) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        
                                                    echo'<tr>
                                                        <td>'.++$i.'</td>
                                                        <td>'.date("d-m-Y", strtotime($row["DATE"])).'</td>
                                                        <td>'.$row["ACCOUNT_HOLDER_NAME"].'</td>
                                                        <td>'.$row["name"].'</td>
                                                        <td>'.$row["USER_BANK_NAME"].'</td>
                                                        <td>'.$row["USER_ACCOUNT_NO"].'</td>
                                                        <td>'.$row["USER_IFSC"].'</td>
                                                        <td>'.$row["USER_BANK_BRANCH"].'</td>
                                                        <td>'.$row["TYPE"].'</td>
                                                        </tr>';
                                                        }
                                                        $result->free();
                                                        echo '</tbody>
                                                    </table>';
                                        }
                                    ?>                                 
                                 </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
<?php
include "footer.php";
?>
<!-- Small modal -->
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

            $('#table_Id tr').each(function(i, tr) {
                var val = $(tr).find("td:nth-child(2)").text();
                var dateVal = moment(val, "DD-MM-YYYY");
                var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? "" : "none"; // [] for inclusive
                $(tr).css('display', visible);
            });
            }

            $('#datefilterfrom').on("change", filterRows);
            $('#datefilterto').on("change", filterRows);

            function ExportExcel(type, fn, dl) {
                var elt = document.getElementById('table_Id');
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

