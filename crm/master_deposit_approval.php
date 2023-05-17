<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; ?>
<?php include 'database.php'; ?>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Deposit Approval</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
        <meta name="msapplication-tap-highlight" content="no">
        
    </head>
    <body>
    <div class="app-main__outer">
        <div class="app-main__inner">
            <?php if ($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "accountant" || $_SESSION['ROLE'] == 'assistant') { ?>
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                        <i class="fa fa-check-circle" aria-hidden="true" ></i>
                        </div>
                        <div>Deposit Approval
                            <div class="page-title-subheading"></div>
                        </div>
                    </div>
                </div>
            </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title"></h5>
                <div class="table-responsive" style="height: 500px;">
                <?php
                    if($_SESSION['ROLE'] == 'admin'){
                        $query = 'SELECT * FROM `msd_transaction_payment_table` AS pay WHERE `status` != 2 ORDER BY `pay`.`date` DESC';
                    } 
                    if($_SESSION['ROLE'] == 'agent'){
                        $query = 'SELECT pay.* FROM `msd_transaction_payment_table` AS pay LEFT JOIN `msd_register_customer_table` cust ON `user_id` = `register_id` AND `register_status` != 2 WHERE `status` != 2 AND cust.agent_id = "'.$_SESSION['USERID'].'" ORDER BY `pay`.`date` DESC';
                    } if($_SESSION['ROLE'] == 'customer'){
                        $query = 'SELECT pay.* FROM `msd_transaction_payment_table` AS pay LEFT JOIN `msd_register_customer_table` cust ON `user_id` = `register_id` AND `register_status` != 2 WHERE `status` != 2 AND cust.register_id = "'.$_SESSION['USERID'].'" ORDER BY `pay`.`date` DESC';
                    } else if($_SESSION['ROLE'] == 'employee' || $_SESSION['ROLE'] == 'manager')  {
                        $query = 'SELECT pay.* FROM `msd_transaction_payment_table` AS pay LEFT JOIN `msd_register_customer_table` cust ON `user_id` = `register_id` AND `register_status` != 2 WHERE `status` != 2 AND cust.reference_id = "'.$_SESSION['USERID'].'" ORDER BY `pay`.`date` DESC';
                    } else if($_SESSION['ROLE'] == 'accountant' || $_SESSION['ROLE'] == 'assistant')  {
                        $query = 'SELECT * FROM `msd_transaction_payment_table` AS pay WHERE `status` != 2 ORDER BY `pay`.`date` DESC';
                    }
                    $i = 0;
                        echo '<table id="myTable" class="mb-0 table table-bordered">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th style="display:none"></th>
                                    <th>Date</th>
                                    <th>ID</th>
                                    <th>User Name</th> 
                                    <th>Plan Id</th> 
                                    <th>Amount</th>
                                    <th>Payment Type</th>
                                    <th>Transaction Id</th>
                                    <th>Description</th>
                                    <th>Created By</th>
                                    <th>Image</th>   ';
                                    if($_SESSION['ROLE'] == 'admin'){
                                        echo '<th>Add Comment</th>
                                        <th>Approval</th>';
                                    }
                                    echo '</tr>
                                </thead>
                                <tbody>';
                            if ($result = $conn->query($query)) {
                                    while ($row = $result->fetch_assoc()) {                                                           
                                        echo'<tr>
                                        <td>'.++$i.'</td>
                                        <td style="display:none">'.$row["id"].'</td>
                                        <td>'.$row["date"].'</td>
                                        <td>'.$row["user_id"].'</td>
                                        <td>'.$row["name"].'</td>
                                        <td>'.$row["plan_id"].'</td>
                                        <td>'.$row["amount"].'</td>
                                        <td>'.$row["pay_type"].'</td>
                                        <td>'.$row["transaction_id"].'</td>
                                        <td>'.$row["description"].'</td>
                                        <td>'.$row["payment_by"].'</td>
                                        <td><img style="width: 100px; height: 50px;" src="Transaction/'.$row["image"].'" data-toggle="modal" data-target="#imgModel"></td>';
                                        if ($_SESSION['ROLE'] == 'admin') {
                                            echo'<td id=tdedit" onfocusout="javascript:tdOnchange();" contenteditable="true">'.$row["comment"].'</td>
                                        
                                            <td>';
                                        
                                            if ($row["approve_status"] == "not approved") {
                                                echo '<a href="master_approval_db?mode=approvedDept&id='.$row["id"].'" style="color: mediumseagreen;"> <i class="fa-2x fa fa-check" style="font-size:24px"></i> </a> <a href="master_approval_db?mode=rejectedDept&id='.$row["id"].'" style="color: red;"> <i class="fa-2x fa fa-close" style="font-size:24px"></i></a>';
                                            } elseif ($row["approve_status"] == "approved") {
                                                echo '<label style="color: mediumseagreen;"> Approved </label>';
                                            } elseif ($row["approve_status"] == "rejected") {
                                                echo '<label style="color: red;"> Rejected </label>';
                                            }
                                            echo '</td>';
                                        }
                                        echo '</tr>';
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
         $(document).ready(function () {   
            $('img').on('click', function () {
                var image = $(this).attr('src');
                //alert(image);
                $('#imgModel').on('show.bs.modal', function () {
                    $(".showimage").attr("src", image);
                });
            });
        });
        function tdOnchange() {
        
        var table = document.getElementById('myTable');
          var jsonArr = [];
          for(var i =0,row;row = table.tBodies[0].rows[i];i++){
               var col = row.cells;
               var jsonObj = {
                   id : col[1].innerHTML,
                   comment : col[12].innerHTML
                 }             
              jsonArr.push(jsonObj);             
          }
          console.log(jsonArr);
            $.ajax({
                    type: "POST",
                    url: "master_approval_db.php",
                    dataType: 'Json',
                    data: {'json_dep_comment':jsonArr},
                    success: function(data) {
                        $.each(data, function(result) {
                            //console.log(result);
                        });
                    }               
            });        
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
<!-- Modal -->
<div class="modal fade" id="imgModel" tabindex="-1" role="dialog" aria-labelledby="imgModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imgModelLabel">Check Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="showimage img-responsive" src="" style="width: 100%; height: 100%;"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




