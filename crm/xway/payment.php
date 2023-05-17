<link href="../main.css" rel="stylesheet">
<?php include '../header.php'; 
      include '../database.php';?>

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
            <div class="app-page-title" style="padding: 10px;">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                             <i class="pe-7s-credit icon-gradient bg-happy-itmeo">
                            </i>
                        </div>
                        <div>Add Payment
                            <div class="page-title-subheading"> </div>
                        </div>
                    </div>

                </div>
            </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title"></h5>
                                    <form class="" method="post" action="pay.php">
                                    <?php
                                            if($_SESSION['ROLE'] == "customer"){   
                                                $query = "SELECT * FROM `msd_register_customer_table` WHERE `register_approved_status` = 'approved' AND `register_id` = '".$userid."' AND register_status != 2";
                                            } else {
                                            
                                            $query = "SELECT * FROM `msd_register_customer_table` WHERE `register_approved_status` = 'approved' AND register_status != 2";
                                            }
                                            $i = 0;
                                            echo '<table class="mb-0 table table-bordered">
                                                    <thead>
                                                    <tr>
                                                    <th>Sr. No.</th>
                                                    <th>ID</th>
                                                    <th>User Name</th>
                                                    <th>Address</th>
                                                    <th>Mobile Number</th>
                                                    <th>Email</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>';
                                            if ($result = $conn->query($query)) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            
                                                            $register_id = $row["register_id"];
                                                            $name = $row["register_fname"]." ".$row["register_lname"];
                                                            $address = $row["register_addr1"].", ".$row["register_addr2"].", ".$row["register_city"].", ".$row["register_state"].", ".$row["register_country"]."-".$row["register_pincode"];
                                                            $register_mobno = $row["register_mobno"];
                                                            $register_email = $row["register_email"];
                                                            $amount = $row["register_invest_amount"];
                                                            echo'<tr>
                                                            <td>'.++$i.'</td>
                                                            <td>'.$register_id.'</td>
                                                            <td>'.$name.'</td>
                                                            <td>'.$address.'</td>
                                                            <td>'.$register_mobno.'</td>
                                                            <td>'.$register_email.'</td>
                                                            <td>'.$amount.'</td>
                                                            <td>
                                                            <a href="../xway/pay.html" class="mb-2 mr-2 btn btn-alternate" ><i class="fa fa-fw" aria-hidden="true" title="Do Payment"></i></a>
                                                            </td>
                                                            </tr>';
                                                                }
                                                            $result->free();
                                                            echo '</tbody>
                                                        </table>';
                                            }
                                         ?>
                                    </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

<script type="text/javascript" src="../assets/scripts/main.js"></script></body>
</html>
<?php 
include "../footer.php";
?>