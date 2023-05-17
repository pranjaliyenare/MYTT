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
    <title>Percentage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">

</head>
<body>
        <div class="app-main__outer">
            <div class="app-main__inner">
        <?php  if($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "accountant" || $_SESSION['ROLE'] == "assistant" ) { ?>
                <div class="app-page-title" style="padding: 10px;">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">   
                            <i class="fa fa-percent" aria-hidden="true" ></i>
                            </div>
                            <div>Percentage
                                <div class="page-title-subheading"> </div>
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
                                    if($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "accountant" || $_SESSION['ROLE'] == "assistant") {
                                        $query = "SELECT * FROM `msd_transaction_role_perc_table` ORDER BY `id` DESC;";
                                    } else {
                                        $query = "SELECT CONCAT(`register_fname`, ' ', `register_lname`) AS name, perc.* FROM `msd_transaction_role_perc_table` perc LEFT JOIN `msd_register_customer_table` ON `customer_id` = `register_id` AND `register_status` != 2 AND `register_approved_status` = 'approved' WHERE status != 2 AND `reference_id` = '".$_SESSION['USERID']."' ORDER BY `id` DESC;";
                                    }
                                        
                                        $i = 0;
                                        echo '<table id="table_Id" class="mb-0 table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Customer ID</th>
                                                    <th>Plan ID</th>
                                                    <th>Customer Percentage</th>
                                                    <th>Partner ID/Perc 1</th>
                                                    <th>Partner ID/Perc 2</th>
                                                    <th>Partner ID/Perc 3</th>
                                                    <th>Partner ID/Perc 4</th>
                                                    <th>Partner ID/Perc 5</th>
                                                    <th>Partner ID/Perc 6</th>                                           
                                                </tr>
                                                </thead>
                                                <tbody>';
                                        if ($result = $conn->query($query)) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        
                                                    echo'<tr>
                                                        <td>'.++$i.'</td>
                                                        <td>'.$row["customer_id"].'</td>
                                                        <td>'.$row["plan_id"].'</td>
                                                        <td>'.$row["customer_perc"].'</td>
                                                        <td>'.$row["agent_id1"]." - ".$row["agent_perc1"].'</td>
                                                        <td>'.$row["agent_id2"]." - ".$row["agent_perc2"].'</td>
                                                        <td>'.$row["agent_id3"]." - ".$row["agent_perc3"].'</td>
                                                        <td>'.$row["agent_id4"]." - ".$row["agent_perc4"].'</td>
                                                        <td>'.$row["agent_id5"]." - ".$row["agent_perc5"].'</td>
                                                        <td>'.$row["agent_id6"]." - ".$row["agent_perc6"].'</td>                                                    
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