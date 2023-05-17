<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; 
      include 'database.php';
?>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Display Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
        <meta name="msapplication-tap-highlight" content="no">

    <link href="./main.css" rel="stylesheet"></head>
    <body>
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <?php if($_SESSION["ROLE"] == "employee") { ?>
                        <div class="app-page-title" style="padding: 10px;">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                    <i class="fa fa-users" aria-hidden="true" ></i>
                                    </div>
                                    <div>Profile Report
                                        <div class="page-title-subheading">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title"></h5>

                                    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                          <li class="nav-item">
                                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                                    <span>Employee</span>
                                </a>
                            </li>
                           
                            <li class="nav-item">
                                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                                    <span>Partner</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-2">
                                    <span>Customer</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                        
                            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Employee Details</h5>
                                        <form class="">
                                        <div class="table-responsive">
                                        <?php
                                              $query = "SELECT * FROM msd_register_comp_employee_table WHERE emp_id = '".$_SESSION["USERID"]."' AND status!= 2";
                                              $i = 0;
                                            echo '<table class="mb-0 table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Sr. No.</th>
                                                        <th>Ref. ID</th>
                                                        <th>ID</th>                                                        
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Address</th>
                                                        <th>Gender</th> 
                                                    </tr>
                                                    </thead>
                                                    <tbody>';
                                            if ($result = $conn->query($query)) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $id = $row["emp_id"];
                                                            $name = $row["emp_name"];
                                                            $email = $row["emp_email"];
                                                            $address = $row["emp_address"].", ".$row["emp_city"].", ".$row["emp_state"];
                                                            $gender = $row["emp_gender"];
                                                            $reference_id = $row["reference_id"];
                                                    echo'<tr>
                                                    <td>'.++$i.'</td>
                                                    <td>'.$reference_id.'</td>
                                                    <td>'.$id.'</td>
                                                    <td>'.$name.'</td>
                                                    <td>'.$email.'</td>
                                                    <td>'.$address.'</td>
                                                    <td>'.$gender.'</td>
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

                            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Partner Details</h5>
                                        <form class="">
                                        <div class="table-responsive">
                                        <?php
                                              $query = "SELECT * FROM msd_register_comp_agent_table WHERE refer_emp_mgr_id = '".$_SESSION["USERID"]."' AND status!= 2";
                                              $i = 0;
                                            echo '<table class="mb-0 table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Sr. No.</th>
                                                        <th>Ref. ID</th>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Address</th>
                                                        <th>Gender</th> 
                                                    </tr>
                                                    </thead>
                                                    <tbody>';
                                            if ($result = $conn->query($query)) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $id = $row["agent_id"];
                                                            $name = $row["agent_name"];
                                                            $email = $row["agent_email"];
                                                            $address = $row["agent_address"].", ".$row["agent_city"].", ".$row["agent_state"];
                                                            $gender = $row["agent_gender"];
                                                            $reference_id = $row["refer_emp_mgr_id"];
                                                    echo'<tr>
                                                    <td>'.++$i.'</td>
                                                    <td>'.$reference_id.'</td>
                                                    <td>'.$id.'</td>
                                                    <td>'.$name.'</td>
                                                    <td>'.$email.'</td>
                                                    <td>'.$address.'</td>
                                                    <td>'.$gender.'</td>
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

                            <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Customer Details</h5>
                                        <form class="">
                                        <div class="table-responsive">
                                        <?php
                                              $query = "SELECT * FROM `msd_register_customer_table` WHERE reference_id = '".$_SESSION["USERID"]."' AND register_status != 2";
                                              $i = 0;
                                              echo '<table class="mb-0 table table-bordered">
                                              <thead>
                                              <tr>
                                              <th>Sr. No.</th>
                                              <th>Ref. ID</th>
                                              <th>ID</th>
                                              <th>User Name</th>  
                                              <th>Date Of Birth</th>                                            
                                              <th>Address</th>
                                              <th>Mobile Number</th>
                                              <th>Email</th>
                                              <th>Nominee</th>
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
                                                      $reference_id = $row["agent_id"];
                                                      $register_dob = $row["register_dob"];
                                                      $nominee_name = $row["register_nominee_name"];
                                                      $nominee_relation = $row["register_nominee_relation"];
                                                      echo'<tr>
                                                      <td>'.++$i.'</td>
                                                      <td>'.$reference_id.'</td>
                                                      <td>'.$register_id.'</td>
                                                      <td>'.$name.'</td>     
                                                      <td>'.date("d/m/Y", strtotime($register_dob)).'</td>                                                 
                                                      <td>'.$address.'</td>
                                                      <td>'.$register_mobno.'</td>
                                                      <td>'.$register_email.'</td>
                                                      <td>'.$nominee_name.'('.$nominee_relation.')</td>
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
                </div>
                </div> 

                        </div>
                    </div>

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