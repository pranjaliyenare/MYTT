<link href="./main.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php
include 'header.php';
include 'database.php';
if ($_SESSION['ROLE'] == "admin") {
    $user_id = base64_decode($_GET['id']);
    $query = mysqli_query($conn, "SET sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");
    $query = mysqli_query($conn, "SELECT PERC.*, Sum(amount) amt FROM `msd_transaction_role_perc_table` PERC RIGHT JOIN `msd_xway_pay_response_table` PAY ON PERC.`customer_id` = PAY.`userid` AND PERC.`plan_id` = PAY.`plan_id` AND PAY.`status` != 'failed' WHERE PERC.`customer_id` = '".$user_id."' AND PERC.`status` != 2;");
    $my_id_array=mysqli_fetch_assoc($query);
    $customer_perc =$my_id_array['customer_perc'];
    $amt= $my_id_array['amt'];
    $agent_id1= $my_id_array['agent_id1'];
    $agent_perc1 =$my_id_array['agent_perc1'];
    $agent_id2 =$my_id_array['agent_id2'];
    $agent_perc2 =$my_id_array['agent_perc2'];
    $agent_id3 =$my_id_array['agent_id3'];
    $agent_perc3 =$my_id_array['agent_perc3'];
    $agent_id4 =$my_id_array['agent_id4'];
    $agent_perc4 =$my_id_array['agent_perc4'];
    $agent_id5 =$my_id_array['agent_id5'];
    $agent_perc5 =$my_id_array['agent_perc5'];
    $agent_id6 =$my_id_array['agent_id6'];
    $agent_perc6 =$my_id_array['agent_perc6'];
}

?>
<?php
    if(isset($_POST['submit'])) {
       
            $query= "INSERT INTO `msd_profit_table`(`userid`, `admin_id`, `plan_id`, `amount`, `cust_percentage`, `cust_profit_amount`, `agent_id`, `agent_perc`, `agent_profit_amount`, `agent_id2`, `agent_perc2`, `agent_profit_amount2`, `agent_id3`, `agent_perc3`, `agent_profit_amount3`, `agent_id4`, `agent_perc4`, `agent_profit_amount4`, `agent_id5`, `agent_perc5`, `agent_profit_amount5`, `agent_id6`, `agent_perc6`, `agent_profit_amount6`, `type`, `date`) VALUES ('". $_POST['profit_userid']."','". $_POST['agent_id1']."', '". $_POST['plan_id']."', '". $_POST['amount']."', '". $_POST['cust_perc']."', '". $_POST['cust_prof_amt']."', '". $_POST['agent_id1']."', '". $_POST['agent_perc1']."', '". $_POST['agent_prof_amt1']."',  '". $_POST['agent_id2']."', '". $_POST['agent_perc2']."', '". $_POST['agent_prof_amt2']."', '". $_POST['agent_id3']."', '". $_POST['agent_perc3']."', '". $_POST['agent_prof_amt3']."', '". $_POST['agent_id4']."', '". $_POST['agent_perc4']."', '". $_POST['agent_prof_amt4']."', '". $_POST['agent_id5']."', '". $_POST['agent_perc5']."', '". $_POST['agent_prof_amt5']."', '". $_POST['agent_id6']."', '". $_POST['agent_perc6']."', '". $_POST['agent_prof_amt6']."', 'customer', '". $_POST['profit_date']."')";
            $result = $conn->query($query);
       
            if($result)
            {
                echo "<script>alert('Your Data Submitted Successfully')</script>";
                echo "<script>window.location = 'payment';</script>";
            }
            else
            {
                echo "<script>alert('Your Data Not Submitted Successfully')</script>";
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
    <title>Profit.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">
    
<link href="./main.css" rel="stylesheet"></head>
<style>
    .form-control {
        width: 50%;
    }
    label {
        font-weight: bold;
    }
</style>
<body>
    
         <div class="app-main__outer">
             <div class="app-main__inner">
                <?php  if($_SESSION['ROLE'] == "admin") { ?>
                 <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon ">
                                        <i class="fa fa-credit-card" aria-hidden="true" ></i>
                                    </div>
                                    Add Profit   
                                </div>
                            </div>          
                 </div>          
                 <div class="tab-content">
                     <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title"></h5>
                                         
                                        <form class="" method="POST" enctype="multipart/form-data" id="uploadForm">

                                        <div class="position-relative row form-group"><label for="profit_userid" class="col-sm-3 col-form-label">User ID</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="profit_userid" type="text" value="<?php echo $user_id ?>" readonly/>
                                                </div>
                                        </div>

                                        <div class="position-relative row form-group"><label for="profit_date" class="col-sm-3 col-form-label">Date</label>
                                                <div class="col-sm-6"><input name="profit_date" id="profit_date"  type="datetime-local" class="form-control" value="<?php echo date('Y-m-d'); ?>" ></div>
                                        </div>
                                       
                                        <div class="position-relative row form-group"><label for="plan_id" class="col-sm-3 col-form-label">Plan</label>
                                                <div class="col-sm-6">
                                                   <select class="mb-2 form-control" name="plan_id" id="plan_id" >
                                                      <!-- <option value="0">Select...</option> -->
                                                      <?php 
                                                            $sql = mysqli_query($conn, "SELECT * FROM `msd_customer_plan_table` WHERE `customer_id` ='".$user_id."' AND `status`!=2 ORDER BY id DESC");
                                                            $row = mysqli_num_rows($sql);
                                                            while ($row = mysqli_fetch_array($sql)) {
                                                                echo "<option value='". $row['plan_id'] ."'>". $row['plan_name'] . "~" .$row['plan_id'] ."</option>" ;
                                                            }   
                                                      ?>
                                                   </select>
                                                  <!-- <input class="form-control"  name="udf3" type="text" maxlength="20"/>  -->
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="amount" class="col-sm-3 col-form-label">Amount</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="amount" type="text"  value="<?php echo $amt; ?>"/>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="cust_perc" class="col-sm-3 col-form-label">User Percentage</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="cust_perc" type="text"  value="<?php echo $customer_perc; ?>" />
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="cust_prof_amt" class="col-sm-3 col-form-label">User Profit Amount</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="cust_prof_amt" type="text" value="0.00" />
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="agent_id1" class="col-sm-3 col-form-label">Partner ID 1</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_id1" type="text" value="<?php echo $agent_id1 ?>"/>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="agent_perc1" class="col-sm-3 col-form-label">Partner Percentage 1</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_perc1" type="text" value="<?php echo $agent_perc1 ?>"/>
                                                </div>
                                            </div>
                                            
                                            <div class="position-relative row form-group"><label for="agent_prof_amt1" class="col-sm-3 col-form-label">Partner Profit Amount 1</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_prof_amt1" type="text" value="0.00" />
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="agent_id2" class="col-sm-3 col-form-label">Partner ID 2</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_id2" type="text" value="<?php echo $agent_id2 ?>"/>
                                                </div>
                                            </div>    
                                           
                                            <div class="position-relative row form-group"><label for="agent_perc2" class="col-sm-3 col-form-label">Partner Percentage 2</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_perc2" type="text" value="<?php echo $agent_perc2 ?>"/>
                                                </div>
                                            </div>
                                            
                                            <div class="position-relative row form-group"><label for="agent_prof_amt2" class="col-sm-3 col-form-label">Partner Profit Amount 2</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_prof_amt2" type="text" value="0.00" />
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="agent_id3" class="col-sm-3 col-form-label">Partner ID 3</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_id3" type="text" value="<?php echo $agent_id3 ?>" />
                                                </div>
                                            </div>    
                                           
                                            <div class="position-relative row form-group"><label for="agent_perc3" class="col-sm-3 col-form-label">Partner Percentage 3</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_perc3" type="text"  value="<?php echo $agent_perc3; ?>"/>
                                                </div>
                                            </div>
                                            
                                            <div class="position-relative row form-group"><label for="agent_prof_amt3" class="col-sm-3 col-form-label">Partner Profit Amount 3</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_prof_amt3" type="text" value="0.00" />
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="agent_id4" class="col-sm-3 col-form-label">Partner ID 4</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_id4" type="text" value="<?php echo $agent_id4 ?>" />
                                                </div>
                                            </div>    
                                           
                                            <div class="position-relative row form-group"><label for="agent_perc4" class="col-sm-3 col-form-label">Partner Percentage 4</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_perc4" type="text" value="<?php echo $agent_perc4 ?>" />
                                                </div>
                                            </div>
                                            
                                            <div class="position-relative row form-group"><label for="agent_prof_amt4" class="col-sm-3 col-form-label">Partner Profit Amount 4</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_prof_amt4" type="text" value="0.00" />
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="agent_id5" class="col-sm-3 col-form-label">Partner ID 5</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_id5" type="text" value="<?php echo $agent_id5 ?>"/>
                                                </div>
                                            </div>    
                                           
                                            <div class="position-relative row form-group"><label for="agent_perc5" class="col-sm-3 col-form-label">Partner Percentage 5</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_perc5" type="text"  value="<?php echo $agent_perc5 ?>"/>
                                                </div>
                                            </div>
                                            
                                            <div class="position-relative row form-group"><label for="agent_prof_amt5" class="col-sm-3 col-form-label">Partner Profit Amount 5</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_prof_amt5" type="text"  value="0.00"/>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="agent_id6" class="col-sm-3 col-form-label">Partner ID 6</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_id6" type="text" value="<?php echo $agent_id6 ?>"/>
                                                </div>
                                            </div>    
                                           
                                            <div class="position-relative row form-group"><label for="agent_perc6" class="col-sm-3 col-form-label">Partner Percentage 6</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_perc6" type="text"  value="<?php echo $agent_perc6 ?>"/>
                                                </div>
                                            </div>
                                            
                                            <div class="position-relative row form-group"><label for="agent_prof_amt6" class="col-sm-3 col-form-label">Partner Profit Amount 6</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="agent_prof_amt6" type="text"  value="0.00"/>
                                                </div>
                                            </div>
                                                <button class="btn btn-info" type="submit" name="submit" >Save Changes</button>
                                                <input type="button" onclick="window.location = 'payment';" class="btn btn-secondary" name="close_name" value="Close"/> 
                                            </div>
                                        </form>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                  
               </div>
          <!-- </div>
          <div>  -->
    
</body>

</html>
<?php include 'footer.php'; ?>
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