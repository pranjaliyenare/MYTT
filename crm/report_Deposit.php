<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; 
      include 'database.php'; ?>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
    label {
        font-weight: bold;
    }
</style>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Deposit Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">
    <style>
    * {
    box-sizing: border-box;
    }

    #myInput {
    background-image: url('/css/searchicon.png');
    background-position: 10px 10px;
    background-repeat: no-repeat;
    width: 100%;
    font-size: 16px;
    padding: 12px 20px 12px 40px;
    border: 1px solid #ddd;
    margin-bottom: 12px;
    }

    #myTable {
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #ddd;
    font-size: 18px;
    }

    #myTable th, #myTable td {
    text-align: left;
    padding: 12px;
    }

    #myTable tr {
    border-bottom: 1px solid #ddd;
    }

    #myTable tr.header, #myTable tr:hover {
    background-color: #f1f1f1;
    }
    </style>
    </head>
    <body>
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title" style="padding: 10px;">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                            <i class="fa fa-check-circle" aria-hidden="true" ></i>
                            </div>
                            <div>Deposit Report
                                <div class="page-title-subheading">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-11">
                        <div class="main-card mb-3 card">
                            <div class="card-body"><h5 class="card-title"></h5>
                            <form class="">
                                <!-- <h2>My Customers</h2> -->
                                <div class="table-responsive">
                                <input type="text" id="myInput" placeholder="Search for names.." title="Type in a name">

                                <?php
                                $query = '';
                                if($_SESSION['ROLE'] == "admin") {
                                    $query = 'SELECT * FROM `msd_xway_pay_response_table` WHERE `pay_status` != 2 ORDER BY `id` DESC';
                                } else if($_SESSION['ROLE'] == "accountant") {
                                  $query = 'SELECT * FROM `msd_xway_pay_response_table` WHERE `pay_status` != 2 ORDER BY `id` DESC';
                                } else if($_SESSION['ROLE'] == "customer") {
                                    $query = 'SELECT * FROM `msd_xway_pay_response_table` WHERE `pay_status` != 2 AND `userid` = "'.$_SESSION['USERID'].'" ORDER BY `id` DESC';
                                } else if($_SESSION['ROLE'] == "employee" || $_SESSION['ROLE'] == "manager") {
                                    $query = 'SELECT * FROM `msd_xway_pay_response_table` WHERE `pay_status` != 2 AND `paymentby` = "'.$_SESSION['USERID'].'" ORDER BY `id` DESC';
                                }
                    
                                echo '<table id="myTable">
                                    <thead>
                                      <tr class="header">
                                         <th>ID</th>
                                          <th>Name</th>
                                          <th>Amount</th>
                                          <th>Transaction ID</th>
                                          <th>Mode</th>
                                          <th>Date</th>
                                          <th>Status</th>
                                      </tr>
                                    </thead>
                                    <tbody>';
                                      if ($query) {
                                      if ($result = $conn->query($query)) {
                                        while ($row = $result->fetch_assoc()) {
                                            
                                    echo'<td>'.$row["id"].'</td>
                                    <td>'.$row["billing_name"]." ". $row["userid"].'</td>
                                    <td>'.$row["amount"].'</td>
                                    <td>'.$row["transaction_id"].'</td>
                                    <td>'.$row["mode"].'</td>
                                    <td>'.$row["date"].'</td>
                                    <td>';                                      
                                      if($row["status"] == "success")  {  
                                        echo '<div class="badge badge-success">Success</div>';
                                       } else if($row["status"] == "failed")  {
                                        echo '<div class="badge badge-danger">Failed</div>';
                                       }
                                    echo '</td>
                                    </tr>';
                                    }
                                    $result->free();
                                    echo '</tbody>
                                </table>';
                                      }
                                    }
                                ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
        //function myFunction() {
        // var input, filter, table, tr, td, i, txtValue;
        // input = document.getElementById("myInput");
        // filter = input.value.toUpperCase();
        // table = document.getElementById("myTable");
        // tr = table.getElementsByTagName("tr");
        // for (i = 0; i < tr.length; i++) {
        //     td = tr[i].getElementsByTagName("td")[2];
        //     if (td) {
        //     txtValue = td.textContent || td.innerText;
        //     if (txtValue.toUpperCase().indexOf(filter) > -1) {
        //         tr[i].style.display = "";
        //     } else {
        //         tr[i].style.display = "none";
        //     }
        //     }       
        // }
        // }

            myInput.addEventListener("keyup",function(){
                var keyword = this.value;
                keyword = keyword.toUpperCase();
                var table_3 = document.getElementById("myTable");
                var all_tr = table_3.getElementsByTagName("tr");
                for(var i=0; i<all_tr.length; i++){
                        var all_columns = all_tr[i].getElementsByTagName("td");
                        for(j=0;j<all_columns.length; j++){
                            if(all_columns[j]){
                                var column_value = all_columns[j].textContent || all_columns[j].innerText;
                                column_value = column_value.toUpperCase();
                                if(column_value.indexOf(keyword) > -1){
                                    all_tr[i].style.display = ""; // show
                                    break;
                                }else{
                                    all_tr[i].style.display = "none"; // hide
                                }
                            }
                        }
                    }
            })    

        </script>

    </body>
</html>
<?php include 'footer.php';?>

