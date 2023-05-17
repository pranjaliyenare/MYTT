<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

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
    <style>
        .btn {
            margin: 2px;
            width: 50px;
        }
    </style>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title" style="padding: 10px;">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                <i class="fa fa-users" aria-hidden="true" ></i>
                                </div>
                                <div>User Profile
                                    <div class="page-title-subheading"> </div>
                                </div>
                            </div>
                            <?php  if($_SESSION['ROLE'] == "admin"){ ?>
                                <div class="page-title-actions" id="divBtnAdd">
                                    <div class="d-inline-block dropdown btn mr-2 mb-2 btn-primary">
                                        <a href="master_addUser"  style="color: white;">
                                            <i class="fa fa-plus" aria-hidden="true" ></i>
                                        </a>
                                    </div>
                                    
                                    <div class="d-inline-block dropdown btn mr-2 mb-2 btn-primary">
                                        <a href="transaction_percentage"  style="color: white;">
                                            <i class="fa fa-percent" aria-hidden="true" ></i>
                                        </a>                                
                                    </div>                                       
                                </div>
                            <?php } ?>  
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-card mb-3">
                                <div class="card-body"><h5 class="card-title"></h5>
                                    <form class="" method="post">
                                        <div class="table-responsive">
                                            <?php
                                                if($_SESSION['ROLE'] == "customer"){
                                                    $query = "SELECT * FROM `msd_register_customer_table` WHERE  `register_id` = '".$_SESSION['USERID']."' AND register_status != 2";
                                                } else if($_SESSION['ROLE'] == "manager"){
                                                    $query = "SELECT * FROM `msd_register_customer_table` WHERE  `reference_id` = '".$userid."' AND register_status != 2";
                                                } else if($_SESSION['ROLE'] == "employee") {
                                                    $query = "SELECT * FROM `msd_register_customer_table` WHERE  `reference_id` = '".$userid."' AND register_status != 2";
                                                } else if($_SESSION['ROLE'] == "agent") {
                                                    $query = "SELECT * FROM `msd_register_customer_table` WHERE  `agent_id` = '".$userid."' AND register_status != 2";
                                                } else if($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "accountant"  || $_SESSION['ROLE'] == "assistant") {
                                                    $query = "SELECT * FROM `msd_register_customer_table` WHERE register_status != 2";
                                                }
                                                $i = 0;
                                                echo '<table class="mb-0 table table-bordered">
                                                        <thead>
                                                        <tr>
                                                        <th>Sr. No.</th>
                                                        <th>Joining Date</th>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Address</th>
                                                        <th>Mobile</th>
                                                        <th>Email</th>';
                                                        if ($_SESSION['ROLE'] == "admin") {
                                                            echo '<th>Action</th>';
                                                        } else if($_SESSION["ROLE"] == "employee" || $_SESSION["ROLE"] == "manager" || $_SESSION["ROLE"] == "accountant") {
                                                            echo '<th>Report</th>';
                                                        }
                                                        echo '</tr>
                                                        </thead>
                                                        <tbody>';
                                                if ($result = $conn->query($query)) {
                                                            while ($row = $result->fetch_assoc()) {

                                                                $register_id = $row["register_id"];
                                                                $name = $row["register_fname"]." ".$row["register_mname"] ." ".$row["register_lname"];
                                                                $address = $row["register_addr1"].", ".$row["register_addr2"].", ".$row["register_city"].", ".$row["register_state"].", ".$row["register_country"]."-".$row["register_pincode"];
                                                                $register_mobno = $row["register_mobno"];
                                                                $register_email = $row["register_email"];
                                                                $amount = $row["register_invest_amount"];
                                                                $date = $row["date"];
                                                                echo'<tr>
                                                                <td>'.++$i.'</td>
                                                                <td>'.date("d/m/Y", strtotime($date)).'</td>
                                                                <td>'.$register_id.'</td>
                                                                <td>'.$name.'</td>
                                                                <td data-toggle="tooltip" data-placement="top" data-original-title="'.$address.'" style="width: 10%;">'.$row["register_city"].", ".$row["register_state"].'</td>
                                                                <td>'.$register_mobno.'</td>
                                                                <td>'.$register_email.'</td>';
                                                                if($_SESSION["ROLE"] == "admin") {
                                                                    echo '<td>
                                                                        <a href="master_editUser?id='.base64_encode($register_id).'&type='.base64_encode('edit').'&path='.base64_encode('master_user_profiledtl').'" class="btn btn-info edit" ><i class="fas fa-edit" aria-hidden="true" title="Edit Profile"></i> </a>
                                                                        <a href="master_user_delete_db?type='.base64_encode('delete').'&id='.base64_encode($register_id).'" name="delete" class="btn btn-danger" ><i class="fas fa-trash" aria-hidden="true" title="Delete Profile"></i> </a>
                                                                        <a href="master_user_bankdtl?id='.base64_encode($register_id).'&path='.base64_encode('master_user_profiledtl').'" class="btn btn-alternate"><i class="fas fa-university" aria-hidden="true" title="Add Bank Details"></i></a> 
                                                                        <a href="master_user_kyc?id='.base64_encode($register_id).'&path='.base64_encode('master_user_profiledtl').'" class="btn btn-success"><i class="fa fa-id-card" aria-hidden="true" title="KYC Details" style="color: white;"></i></a>
                                                                    </td>';                                                                
                                                                } else  if($_SESSION["ROLE"] == "employee" || $_SESSION["ROLE"] == "manager" || $_SESSION["ROLE"] == "accountant" || $_SESSION['ROLE'] == "assistant"){
                                                                    echo'<td><a href="report_customer?id='.base64_encode($register_id).'&path='.base64_encode('master_user_profiledtl').'" class="btn btn-success"><i class="fa fa-file" aria-hidden="true" title="Customer Profile Report" style="color: white;"></i></a></td>';
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
        <script>
                var x = document.getElementById("divBtnAdd");
                if("<?php echo $_SESSION['ROLE'] ?>" == "customer"){
                    x.style.display = "none";
                } 

        </script>

        <?php
        include "footer.php";
        ?>
