
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

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Withdraw History</title>
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
                                    <i class="fa fa-check-circle" aria-hidden="true" ></i>
                                    </div>
                                    <div>Withdraw History
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
                                    <div class="table-responsive">
                        <?php
                        if($_SESSION['ROLE'] == "customer"){
                            $query = 'SELECT withdraw_id, plan_id, concat(user_id, "-", register_fname, " ", register_lname ) as user_id, `approve_date` AS date, bank_id,principal_amount, amount, msd_transaction_withdraw_table.comment AS comment, approve_status FROM `msd_transaction_withdraw_table` INNER JOIN `msd_register_customer_table` ON `register_id` = `user_id` WHERE `type`= "customer" AND `user_id` = "'.$_SESSION['USERID'].'" AND status != 2 ORDER BY `msd_transaction_withdraw_table`.`withdraw_id` DESC';
                        } else if($_SESSION['ROLE'] == "agent") {
                            $query = 'SELECT withdraw_id, plan_id, concat(agent_id, "-", agent_name) as user_id, `approve_date` AS date, bank_id, amount,principal_amount, msd_transaction_withdraw_table.comment AS comment, approve_status FROM `msd_transaction_withdraw_table` INNER JOIN `msd_register_comp_agent_table` ON `agent_id` = `user_id` WHERE `type`= "agent" AND `agent_id`= "'.$_SESSION['USERID'].'" AND `msd_register_comp_agent_table`.status != 2 ORDER BY `msd_transaction_withdraw_table`.`withdraw_id` DESC';
                        } else {
                            $query = '';
                        }
                        $i =0;
                                      echo '<table id="myTable" class="mb-0 table table-bordered">
                                              <thead>
                                              <tr>
                                                  <th>Sr.No.</th>
                                                  <th>Name</th>
                                                  <th>Plan Id</th>
                                                  <th>Bank Name</th>
                                                  <th>Amount</th>
                                                  <th>Principal Amount</th>
                                                  <th>Reason</th>
                                                  <th>Date</th>
                                                  <th>Status</th>
                                              </tr>
                                              </thead>
                                              <tbody>';
                                      if ($result = $conn->query($query)) {
                                                  while ($row = $result->fetch_assoc()) {
                                                      $withdraw_id = $row["withdraw_id"];
                                                      $user_id = $row["user_id"];
                                                       if($row["date"] == NULL) { $date= ""; } else { $date= date("d/m/Y", strtotime($row["date"])); }
                                                      $bank_id = $row["bank_id"];
                                                      $amount = $row["amount"];
                                                      $princ_amt = $row["principal_amount"];
                                                      $status = $row["approve_status"];
                                                      $comment = $row["comment"];
                                              echo'<tr>
                                              <td>'.++$i.'</td>
                                              <td>'.$user_id.'</td>
                                              <td>'.$row["plan_id"].'</td>
                                              <td>'.$bank_id.'</td>
                                              <td>'.$amount.'</td>
                                              <td>'.$princ_amt.'</td>
                                              <td>'.$comment.'</td>
                                              <td>'.$date.'</td>
                                              <td>';
                                                
                                               if($status == "not approved") {
                                                  echo '<label style="color: #00bcd4;">Pending...</label>';
                                                 } else if($status == "approved")  {  
                                                  echo '<label style="color: #8bc34a;">Paid</label>';
                                                 } else if($status == "rejected")  {
                                                  echo '<label style="color: #ff5722;">Rejected</label>';
                                                 }
                                              echo '</td>
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
<?php include 'footer.php';?>
