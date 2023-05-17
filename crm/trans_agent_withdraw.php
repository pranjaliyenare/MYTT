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
    <title>Partner List</title>
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
                             <i class="fas fa-money-check">
                            </i>
                        </div>
                        <div>Partner List
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
                                            if($_SESSION['ROLE'] == "agent"){   
                                                $query = "SELECT * FROM `msd_register_comp_agent_table` WHERE `agent_id` = '".$userid."' AND `status` != 2;";
                                            } else  if($_SESSION['ROLE'] == "manager" || $_SESSION['ROLE'] == "employee"){   
                                                $query = "SELECT * FROM `msd_register_comp_agent_table` WHERE `refer_emp_mgr_id` = '".$userid."' AND `status` != 2;";
                                            } else if($_SESSION['ROLE'] == "admin"){                                            
                                                $query = "SELECT * FROM `msd_register_comp_agent_table` WHERE `status` != 2";
                                            } else if($_SESSION['ROLE'] == "accountant"){                                            
                                                $query = "SELECT * FROM `msd_register_comp_agent_table` WHERE `status` != 2";
                                            }
                                            $i = 0;
                                            echo '<table class="mb-0 table table-bordered">
                                                    <thead>
                                                    <tr>
                                                    <th>Sr. No.</th>
                                                    <th>ID</th>
                                                    <th>Partners</th>
                                                    <th>Mobile</th>
                                                    <th>Email</th>
                                                    <th>Withdraw</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>';
                                            if ($result = $conn->query($query)) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            
                                                            $agent_id = $row["agent_id"];
                                                            $agent_name = $row["agent_name"];
                                                            $agent_mobile = $row["agent_mobile"];
                                                            $agent_email = $row["agent_email"];
                                                            echo'<tr>
                                                            <td>'.++$i.'</td>
                                                            <td>'.$agent_id.'</td>
                                                            <td>'.$agent_name.'</td>
                                                            <td>'.$agent_mobile.'</td>
                                                            <td>'.$agent_email.'</td>
                                                            <td> <a href="transaction_admin_agent_withdraw?id='.base64_encode($agent_id).'" class="mb-2 mr-2 btn btn-warning"><i class="fa fa-download" aria-hidden="true" style="color:white;" title="Withdraw Amount"></i></a></td>
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