<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; 
      $role = base64_decode($_GET['role']);
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

    <link href="./main.css" rel="stylesheet">
    </head>

    <body>
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title" style="padding: 10px;">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                    <i class="fa fa-user-circle" aria-hidden="true" ></i>
                                    </div>
                                    <div><?php if($role == "manager") { echo "Manager"; } else if($role == "employee") { echo "Employee"; } else if($role == "agent") { echo "Partner"; } ?> Profile
                                        <div class="page-title-subheading">
                                        </div>
                                    </div>
                                </div>

                                <?php if($_SESSION['ROLE'] == "admin") { ?>
                                    <div class="page-title-actions" id="divBtnAdd" >
                                        <div class="d-inline-block dropdown btn mr-2 mb-2 btn-primary">
                                            <a id="btnAdd" href="master_addProfile?role=<?php echo base64_encode($role) ?>"  style="color: white;">
                                                <!-- <i class="metismenu-icon"></i> -->
                                                Add Profile
                                            </a>
                                        </div>
                                        <?php if($role == "employee") { ?>
                                        <div class="d-inline-block dropdown btn mr-2 mb-2 btn-primary">
                                            <a id="btnAdd" href="report_Incentive" style="color: white;">
                                                <!-- <i class="metismenu-icon"></i> -->
                                                Employee Incentive
                                            </a>
                                        </div> 
                                        <?php } ?>                                        
                                    </div>
                                <?php } ?>
                               
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title"></h5>
                                    <div class="table-responsive" style="height: 600px;">
                                    <?php            
                                    if($_SESSION['ROLE'] == "admin") {
                                            if($role == "manager"){
                                                $query = "SELECT * FROM `msd_register_comp_manager_table` WHERE status!= 2";
                                                } else if($role == "employee"){
                                                    $query = "SELECT * FROM msd_register_comp_employee_table WHERE status!= 2";
                                                } else if($role == "agent"){
                                                    $query = "SELECT * FROM msd_register_comp_agent_table WHERE status!= 2";
                                                    
                                                }
                                    } else if($_SESSION['ROLE'] == "accountant") {
                                        if($role == "manager"){
                                            $query = "SELECT * FROM `msd_register_comp_manager_table` WHERE status!= 2";
                                            } else if($role == "employee"){
                                                $query = "SELECT * FROM msd_register_comp_employee_table WHERE status!= 2";
                                            } else if($role == "agent"){
                                                $query = "SELECT * FROM msd_register_comp_agent_table WHERE status!= 2";
                                                
                                            }
                                    }  else if($_SESSION['ROLE'] == "assistant") {
                                        if($role == "manager"){
                                            $query = "SELECT * FROM `msd_register_comp_manager_table` WHERE status!= 2";
                                            } else if($role == "employee"){
                                                $query = "SELECT * FROM msd_register_comp_employee_table WHERE status!= 2";
                                            } else if($role == "agent"){
                                                $query = "SELECT * FROM msd_register_comp_agent_table WHERE status!= 2";
                                                
                                            }
                                    } else if($_SESSION['ROLE'] == "manager") {

                                        if($role == "manager"){
                                        $query = "SELECT * FROM `msd_register_comp_manager_table` WHERE status!= 2 AND `mgr_id` = '".$_SESSION["USERID"]."'";
                                        } else if($role == "employee"){
                                            $query = "SELECT * FROM msd_register_comp_employee_table WHERE status!= 2 AND `emp_id` = '".$_SESSION["USERID"]."'";
                                        } else if($role == "agent"){
                                            $query = "SELECT * FROM msd_register_comp_agent_table WHERE status!= 2 AND `refer_emp_mgr_id` = '".$_SESSION["USERID"]."'";
                                        }
                                    } else if($_SESSION['ROLE'] == "employee") {
                                        if($role == "manager"){
                                            $query = "SELECT * FROM `msd_register_comp_manager_table` WHERE status!= 2 AND `mgr_id` = '".$_SESSION["USERID"]."'";
                                            } else if($role == "employee"){
                                                $query = "SELECT * FROM msd_register_comp_employee_table WHERE status!= 2 AND `emp_id` = '".$_SESSION["USERID"]."'";
                                            } else if($role == "agent"){
                                                $query = "SELECT * FROM msd_register_comp_agent_table WHERE status!= 2 AND `refer_emp_mgr_id` = '".$_SESSION["USERID"]."'";
                                            }
                                    } else if($_SESSION['ROLE'] == "agent") {
                                                $query = "SELECT * FROM msd_register_comp_agent_table WHERE status!= 2 AND `agent_id` = '".$_SESSION["USERID"]."'";        
                                    }

                                        $i = 0;
                                    echo '<table class="mb-0 table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Gender</th>';   
                                                if($_SESSION["ROLE"] == "admin" || $_SESSION["ROLE"] == "agent"){                                             
                                                 echo '<th>Status</th>';
                                                }
                                                echo'<th>Reference Link</th>
                                            </tr>
                                            </thead>
                                            <tbody>';
                                    if ($result = $conn->query($query)) {
                                                while ($row = $result->fetch_assoc()) {
                                                        if($role == "manager") {
                                                            $id = $row["mgr_id"];
                                                            $name = $row["mgr_name"];
                                                            $mobile = $row["mgr_mobile"];
                                                            $email = $row["mgr_email"];
                                                            $addr = $row["mgr_city"].", ".$row["mgr_state"];
                                                            $address = $row["mgr_address"].", ".$row["mgr_city"].", ".$row["mgr_state"];
                                                            $gender = $row["mgr_gender"];
                                                        } else if($role == "employee") {
                                                            $id = $row["emp_id"];
                                                            $name = $row["emp_name"];
                                                            $mobile = $row["emp_mobile"];
                                                            $email = $row["emp_email"];
                                                            $addr = $row["emp_city"].", ".$row["emp_state"];
                                                            $address = $row["emp_address"].", ".$row["emp_city"].", ".$row["emp_state"];
                                                            $gender = $row["emp_gender"];
                                                        } else if($role == "agent") {
                                                            $id = $row["agent_id"];
                                                            $name = $row["agent_name"];
                                                            $mobile = $row["agent_mobile"];
                                                            $email = $row["agent_email"];
                                                            $addr = $row["agent_city"].", ".$row["agent_state"];
                                                            $address = $row["agent_address"].", ".$row["agent_city"].", ".$row["agent_state"];
                                                            $gender = $row["agent_gender"];
                                                        }    
                                                    

                                            echo'<tr>
                                            <td>'.++$i.'</td>
                                            <td>'.$id.'</td>
                                            <td>'.$name.'</td>
                                            <td>'.$mobile.'</td>
                                            <td>'.$email.'</td>
                                            <td data-toggle="tooltip" data-placement="top" data-original-title="'.$address.'">'.$addr.'</td>
                                            <td>'.$gender.'</td>';     
                                            if ($_SESSION["ROLE"] == "admin" || $_SESSION["ROLE"] == "agent") {
                                                echo'<td>';
                                                if ($_SESSION["ROLE"] == "admin") {
                                                    echo '<a href="master_editProfile?role='.base64_encode($role).'&id='.base64_encode($id).'&type='.base64_encode('delete').'" class="btn btn-danger" style= "margin-bottom: 5px; width: 38px;"><i class="fas fa-trash" aria-hidden="true" title="Copy to use trash"></i> </a>';
                                                } 
                                                        echo '<a href="master_editProfile?role='.base64_encode($role).'&id='.base64_encode($id).'&type='.base64_encode('edit').'" class="btn btn-info" style= "margin-bottom: 5px; width: 38px;"><i class="fas fa-edit" aria-hidden="true" title="Copy to use edit"></i> </a>';
                                                        if($role == "agent") {
                                                            echo '<a href="master_agent_bankdtl?id='.base64_encode($id).'" class="btn btn-alternate" style= "margin-bottom: 5px; width: 38px;"><i class="fas fa-university" aria-hidden="true" title="Add Bank Details"></i></a>';
                                                        }
                                                   
                                                echo'</td>';
                                            }
                                                echo '<td id="tdClass"><a id="td_href_id" class="td_href_class">https://crm.mytt.in/register?ref='.base64_encode($id).'</a> </td>
                                                </tr>';
                                                }
                                            $result->free();
                                            echo '</tbody>
                                        </table>';
                                    }
                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                      
                    <script>
                                var x = document.getElementById("divBtnAdd");
                                if("<?php echo $_SESSION['ROLE'] ?>" == "manager" && "<?php echo $role ?>" == "manager"){
                                    x.style.display = "none";
                                } else if("<?php echo $_SESSION['ROLE'] ?>" == "employee" && "<?php echo $role ?>" == "employee"){
                                    x.style.display = "none";
                                } else if("<?php echo $_SESSION['ROLE'] ?>" == "agent" && "<?php echo $role ?>" == "agent"){
                                    x.style.display = "none";
                                } 

                                $(".td_href_class").click(function() {
                                    var inputc = document.body.appendChild(document.createElement("input"));
                                    inputc.value = $(this).text();
                                    inputc.focus();
                                    inputc.select();
                                    document.execCommand('copy');
                                    inputc.parentNode.removeChild(inputc);
                                    alert("URL Copied.");
                                });
                    </script>
    </body>
</html>
<?php include 'footer.php';?>   