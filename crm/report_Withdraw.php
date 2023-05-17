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
    <title>Withdraw History</title>
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
                        <!-- <h2>My Customers</h2> -->
                        <div class="table-responsive">
                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                       
                        <?php
                        $query = '';
                        if($_SESSION['ROLE'] == "admin") {
                            $query = 'SELECT withdraw_id, plan_id, concat(user_id, "-", register_fname, " ", register_lname ) as user_id, `approve_date` AS date, bank_id, amount, principal_amount AS pric_amt, msd_transaction_withdraw_table.comment AS comment, approve_status, type FROM `msd_transaction_withdraw_table` INNER JOIN `msd_register_customer_table` ON `register_id` = `user_id` WHERE `type`= "customer" AND status != 2 UNION ALL SELECT withdraw_id, plan_id, concat(agent_id, "-", agent_name) as user_id, `approve_date` AS date, bank_id, amount, 0 AS pric_amt, msd_transaction_withdraw_table.comment AS comment, approve_status, type FROM `msd_transaction_withdraw_table` INNER JOIN `msd_register_comp_agent_table` ON `agent_id` = `user_id` WHERE `type`= "agent" AND `msd_register_comp_agent_table`.status != 2 ORDER BY withdraw_id DESC';
                        } else if($_SESSION['ROLE'] == "accountant" || $_SESSION['ROLE'] == "assistant") {
                          $query = 'SELECT withdraw_id, plan_id, concat(user_id, "-", register_fname, " ", register_lname ) as user_id, `approve_date` AS date, bank_id, amount, principal_amount AS pric_amt, msd_transaction_withdraw_table.comment AS comment, approve_status, type FROM `msd_transaction_withdraw_table` INNER JOIN `msd_register_customer_table` ON `register_id` = `user_id` WHERE `type`= "customer" AND status != 2 UNION ALL SELECT withdraw_id, plan_id, concat(agent_id, "-", agent_name) as user_id, `approve_date` AS date, bank_id, amount, 0 AS pric_amt, msd_transaction_withdraw_table.comment AS comment, approve_status, type FROM `msd_transaction_withdraw_table` INNER JOIN `msd_register_comp_agent_table` ON `agent_id` = `user_id` WHERE `type`= "agent" AND `msd_register_comp_agent_table`.status != 2 ORDER BY withdraw_id DESC';
                      } else if($_SESSION['ROLE'] == "manager") {
                            $query = 'SELECT withdraw_id, plan_id, concat(user_id, "-", register_fname, " ", register_lname ) as user_id, `approve_date` AS date, bank_id, amount, principal_amount AS pric_amt, msd_transaction_withdraw_table.comment AS comment, approve_status, type FROM `msd_transaction_withdraw_table` INNER JOIN `msd_register_customer_table` ON `register_id` = `user_id` AND  `reference_id` = "'.$_SESSION['USERID'].'" WHERE `type`= "customer" AND status != 2 UNION ALL SELECT withdraw_id,  plan_id, concat(agent_id, "-", agent_name) as user_id, `approve_date` AS date, bank_id, amount, 0 AS pric_amt, msd_transaction_withdraw_table.comment AS comment, approve_status, type FROM `msd_transaction_withdraw_table` INNER JOIN `msd_register_comp_agent_table` ON `agent_id` = `user_id` AND  `refer_emp_mgr_id` = "'.$_SESSION['USERID'].'" WHERE `type`= "agent" AND `msd_register_comp_agent_table`.status != 2 ORDER BY withdraw_id DESC;';
                        } else if($_SESSION['ROLE'] == "employee") {
                            $query = 'SELECT withdraw_id, plan_id, concat(user_id, "-", register_fname, " ", register_lname ) as user_id, `approve_date` AS date, bank_id, amount, principal_amount AS pric_amt, msd_transaction_withdraw_table.comment AS comment, approve_status, type FROM `msd_transaction_withdraw_table` INNER JOIN `msd_register_customer_table` ON `register_id` = `user_id` AND  `reference_id` = "'.$_SESSION['USERID'].'" WHERE `type`= "customer" AND status != 2 UNION ALL SELECT withdraw_id, plan_id, concat(agent_id, "-", agent_name) as user_id, `approve_date` AS date, bank_id, amount, 0 AS pric_amt, msd_transaction_withdraw_table.comment AS comment, approve_status, type FROM `msd_transaction_withdraw_table` INNER JOIN `msd_register_comp_agent_table` ON `agent_id` = `user_id` AND  `refer_emp_mgr_id` = "'.$_SESSION['USERID'].'" WHERE `type`= "agent" AND `msd_register_comp_agent_table`.status != 2 ORDER BY withdraw_id DESC;';
                        } else {
                          $query = '';
                        }
                            
                                    echo '<table id="myTable">
                                            <thead>
                                              <tr class="header">
                                                 <th>Withdraw ID</th>
                                                  <th>Name</th>
                                                  <th>Plan Id</th>
                                                  <th>Bank Name</th>
                                                  <th>Amount</th>
                                                  <th>Principal Amount</th>
                                                  <th>Role</th>
                                                  <th>Date</th>
                                                  <th>Reason</th>
                                                  <th>Status</th>
                                              </tr>
                                            </thead>
                                            <tbody>';
                                              if ($query) {
                                              if ($result = $conn->query($query)) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $withdraw_id = $row["withdraw_id"];
                                                    $user_id = $row["user_id"];
                                                    $bank_id = $row["bank_id"];
                                                    if($row["date"] == NULL) { $date= ""; } else { $date= date("d/m/Y", strtotime($row["date"])); }
                                                    $amount = $row["amount"];
                                                    $princ_amt = $row["pric_amt"];
                                                    $status = $row["approve_status"];
                                                    $comment = $row["comment"];
                                                    $type = $row["type"];
                                                    if($type == "customer"){ echo'<tr class="list-group-item-info">'; } else { echo'<tr class="list-group-item-danger">'; }
                                            echo'<td>'.$withdraw_id.'</td>
                                            <td>'.$user_id.'</td>
                                            <td>'.$row["plan_id"].'</td>
                                            <td>'.$bank_id.'</td>
                                            <td>'.$amount.'</td>
                                            <td>'.$princ_amt.'</td>
                                            <td>'.$type.'</td>
                                            <td>'.$date.'</td>
                                            <td>'.$comment.'</td>
                                            <td>';
                                              
                                             if($status == "not approved") {
                                              echo '<div class="badge badge-info">Pending</div>';
                                                //echo '<label style="color: #00bcd4;">Pending...</label>';
                                               } else if($status == "approved")  {  
                                                echo '<div class="badge badge-success">Paid</div>';
                                                //echo '<label style="color: #8bc34a;">Paid</label>';
                                               } else if($status == "rejected")  {
                                                echo '<div class="badge badge-danger">Rejected</div>';
                                                //echo '<label style="color: #ff5722;">Rejected</label>';
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
    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }       
      }
    }
    </script>

    </body>
  </html>
<?php include 'footer.php';?>

