<link href="./main.css" rel="stylesheet">
<?php include 'header.php'; 
      include 'database.php';
      
      if($_SESSION['ROLE'] == "customer"){
        $userid = $_SESSION['USERID'];
    } else {
        if(isset($_GET['id'])){
        $userid = $_GET['id'];
        } else {
            $userid = $_SESSION['USERID'];
        }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Add Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="app-main__outer">
         <div class="app-main__inner">
            <?php if($_SESSION["ROLE"] == "admin" || $_SESSION["ROLE"] == "customer" || $_SESSION["ROLE"] == "accountant") { ?>
            <div class="app-page-title" style="padding: 10px;">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                             <i class="fas fa-money-check">
                            </i>
                        </div>
                        <div>Add Payment
                            <div class="page-title-subheading"> </div>
                        </div>
                    </div>

                </div>
            </div>

                        <div class="row">
                            <div class="col-lg-11">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title"></h5>
                                    <form class="" method="post" action="pay.php">
                                    <div class="table-responsive">
                                    <?php
                                            if($_SESSION['ROLE'] == "customer"){   
                                                $query = "SELECT * FROM `msd_register_customer_table` WHERE `register_approved_status` = 'approved' AND `register_id` = '".$userid."' AND register_status != 2";
                                            } else  if($_SESSION['ROLE'] == "manager" || $_SESSION['ROLE'] == "employee"){   
                                                $query = "SELECT * FROM `msd_register_customer_table` WHERE `register_approved_status` = 'approved' AND `reference_id` = '".$userid."' AND register_status != 2";
                                            } else if($_SESSION['ROLE'] == "admin" || $_SESSION["ROLE"] == "accountant"){                                            
                                                $query = "SELECT * FROM `msd_register_customer_table` WHERE `register_approved_status` = 'approved' AND register_status != 2";
                                            } 
                                            $i = 0;
                                            echo '<table class="mb-0 table table-bordered">
                                                    <thead>
                                                    <tr>
                                                    <th>Sr. No.</th>
                                                    <th>ID</th>
                                                    <th>User</th>
                                                    <th>Email</th>';
                                                    if($_SESSION["ROLE"] == "admin" || $_SESSION["ROLE"] == "customer" || $_SESSION["ROLE"] == "accountant"){
                                                        echo '<th>Pay</th>';
                                                    }
                                                    if($_SESSION["ROLE"] == "admin" || $_SESSION["ROLE"] == "accountant"){ echo '<th>Withdraw</th>'; }
                                                    echo '</tr>
                                                    </thead>
                                                    <tbody>';
                                            if ($result = $conn->query($query)) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            
                                                            $register_id = $row["register_id"];
                                                            $name = $row["register_fname"]." ".$row["register_lname"];
                                                            $address = $row["register_addr1"].", ".$row["register_addr2"].", ".$row["register_city"].", ".$row["register_state"].", ".$row["register_country"]." -".$row["register_pincode"];
                                                            $register_mobno = $row["register_mobno"];
                                                            $register_email = $row["register_email"];
                                                            $amount = $row["register_invest_amount"];
                                                            echo'<tr>
                                                            <td>'.++$i.'</td>
                                                            <td>'.$register_id.'</td>
                                                            <td>'.$name.'</td>
                                                            <td>'.$register_email.'</td>';
                                                                echo '<td> <a href="pay?id='.base64_encode($register_id).'" class="mb-2 mr-2 btn btn-alternate" style="height: 100%;width: 100%;"><i class="fa fa-rupee" aria-hidden="true" title="Do Payment"></i></a>';
                                                            if($_SESSION["ROLE"] == "admin"){
                                                                echo '<a href="trans_offline_pay?id='.base64_encode($register_id).'" class="mb-2 mr-2 btn btn-primary" style="height: 100%;width: 100%;"><i class="fa fa-credit-card" aria-hidden="true" title="Do Offline Payment Payment"></i></a></td>';
                                                            }
                                                             if($_SESSION["ROLE"] == "admin" || $_SESSION["ROLE"] == "accountant"){ echo '<td> <a href="transaction_withdraw?id='.base64_encode($register_id).'" class="mb-2 mr-2 btn btn-warning"><i class="fa fa-download" aria-hidden="true" style="color:white;" title="Withdraw Amount"></i></a>'; } 
                                                             if($_SESSION["ROLE"] == "admin"){ echo ' <a href="master_profitAdd?id='.base64_encode($register_id).'" class="mb-2 mr-2 btn btn-focus"><i class="fa fa-money" aria-hidden="true" style="color:white;" title="Add Profit"></i></a>'; }
                                                            echo '</td>
                                                            </tr>';
                                                                }
                                                            $result->free();
                                                            echo '</tbody>
                                                        </table>';
                                            }
                                         ?>
                                         <div>
                                    </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

<script type="text/javascript" src="./assets/scripts/main.js"></script></body>
</html>
<?php 
include "footer.php";
?>
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