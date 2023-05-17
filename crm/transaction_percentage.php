<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; 
      include 'database.php';

    if(isset($_POST['submit'])) {
        if($_POST['plan_name'] == '0') {
            echo "<script>alert('Please Select Plan...');</script>";
          } else {
           $sqlDel = mysqli_query($conn, "DELETE FROM `msd_transaction_role_perc_table` WHERE `customer_id` = '". $_POST['customer_id_name']."' AND `plan_id` = '".$_POST['plan_name']."' ");
           mysqli_query($conn,"UPDATE `msd_register_customer_table` SET register_profit_perc = '".$_POST['customer_perc']."', `register_agent_profit_perc` = '".$_POST['agent_perc1']."', `register_status`= 1 WHERE `register_id`='".$_POST['customer_id_name']."'");
           $sql = "INSERT INTO `msd_transaction_role_perc_table`(`customer_id`, `plan_id`, `customer_perc`, `agent_id1`, `agent_perc1`, `agent_id2`, `agent_perc2`, `agent_id3`, `agent_perc3`, `agent_id4`, `agent_perc4`, `agent_id5`, `agent_perc5`, `agent_id6`, `agent_perc6`) VALUES ('". $_POST['customer_id_name']."', '".$_POST['plan_name']."','". $_POST['customer_perc']."','". $_POST['agent_id1']."','". $_POST['agent_perc1']."','". $_POST['agent_id2']."','". $_POST['agent_perc2']."','". $_POST['agent_id3']."','". $_POST['agent_perc3']."','". $_POST['agent_id4']."','". $_POST['agent_perc4']."','". $_POST['agent_id5']."','". $_POST['agent_perc5']."','". $_POST['agent_id6']."','". $_POST['agent_perc6']."')";
          
           if (mysqli_query($conn, $sql)) {
               echo "<script>window.location = 'report_percentage';</script>";
               echo "<script>alert('New record created successfully...');</script>";
           } else {
               echo "<script>window.location = 'report_percentage';</script>";
               echo "<script>alert('Record Not Add...!!!');</script>";
           }
        }
    }

      if(isset($_POST['close'])) {
        echo "<script>window.location = 'master_user_profiledtl';</script>";
      }
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Role Percentage</title>
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
                        <i class="fa fa-percent">  </i>
                     </div>
                     <div>Role Percentage
                         <div class="page-title-subheading"> </div>
                     </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title"></h5>
                        <form class="" method="post" action="transaction_percentage">
                        <div class="position-relative row form-group">
                            <label for="exampleEmail" class="col-sm-2 col-form-label"><b>Customer :</b></label>
                                        <div class="col-sm-6">
                                            <?php 
                                                if($_SESSION['ROLE'] == "admin") {
                                                        echo '<select onchange="custChange()" class="mb-2 form-control" name="customer_name" id="customer_id" >';
                                                        $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE  `msd_register_customer_table`.`register_status` != 2");
                                                        $row = mysqli_num_rows($sql);
                                                        while ($row = mysqli_fetch_array($sql)) {
                                                            if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                            echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                            $selected ="";
                                                        }
                                                    echo '</select>
                                                    <div class="select-dropdown"></div>';
                                                }  else if($_SESSION['ROLE'] == "manager") {
                                                    echo '<select class="mb-2 form-control" name="customer_name" id="customer_id" >';
                                                    $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE reference_id = '".$_SESSION['USERID']."' AND `msd_register_customer_table`.`register_status` != 2 AND `register_approved_status` = 'approved'");
                                                    $row = mysqli_num_rows($sql);
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                        if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                        echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                        $selected ="";
                                                    }
                                                echo '</select>
                                                <div class="select-dropdown"></div>';
                                                } else if($_SESSION['ROLE'] == "employee") {
                                                    echo '<select class="mb-2 form-control" name="customer_name" id="customer_id" >';
                                                    $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE `reference_id` = '".$_SESSION['USERID']."' AND `msd_register_customer_table`.`register_status` != 2 AND `register_approved_status` = 'approved'");
                                                    $row = mysqli_num_rows($sql);
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                        if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                        echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ; 
                                                        $selected ="";
                                                    }
                                                echo '</select>
                                                <div class="select-dropdown"></div>';
                                                } else if($_SESSION['ROLE'] == "agent") {
                                                    echo '<select class="mb-2 form-control" name="customer_name" id="customer_id" >';
                                                    $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE agent_id = '".$_SESSION['USERID']."' AND `msd_register_customer_table`.`register_status` != 2 AND `register_approved_status` = 'approved'");
                                                    $row = mysqli_num_rows($sql);
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                        if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                        echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                        $selected ="";
                                                    }
                                                    echo '</select>
                                                    <div class="select-dropdown"></div>';
                                                }
                                            ?>
                                        </div>
                                        <input class="mb-2 mr-2 btn btn-primary" type="submit" name="search" value="Search" />
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
                if(isset($_POST['search'])) {
                 $sql = mysqli_query($conn, "SELECT * FROM `msd_transaction_role_perc_table` WHERE customer_id =  '".$_POST['customer_name']."'");
                 $my_array=mysqli_fetch_assoc($sql);    
                 if(isset($my_array))    {                                       
                 $cust_id       =$my_array["customer_id"]; 
                 $cust_perc     =$my_array["customer_perc"]; 
                 $agent_id1     =$my_array["agent_id1"];
                 $agent_perc1   = $my_array["agent_perc1"];
                 $agent_id2     =$my_array["agent_id2"];
                 $agent_perc2   = $my_array["agent_perc2"];
                 $agent_id3     =$my_array["agent_id3"];
                 $agent_perc3   = $my_array["agent_perc3"];
                 $agent_id4     =$my_array["agent_id4"];
                 $agent_perc4   = $my_array["agent_perc4"];
                 $agent_id5     =$my_array["agent_id5"];
                 $agent_perc5   = $my_array["agent_perc5"];
                 $agent_id6     =$my_array["agent_id6"];
                 $agent_perc6   = $my_array["agent_perc6"];
                 $plan_id   = $my_array["plan_id"];
                 } else {
                    $cust_id       ="";
                    $cust_perc     =0.00;
                    $agent_id1     ="";
                    $agent_perc1   =0.00;
                    $agent_id2     ="";
                    $agent_perc2   =0.00;
                    $agent_id3     ="";
                    $agent_perc3   =0.00;
                    $agent_id4     ="";
                    $agent_perc4   =0.00;
                    $agent_id5     ="";
                    $agent_perc5   =0.00;
                    $agent_id6     ="";
                    $agent_perc6   =0.00;
                }

                 $sqlCust = mysqli_query($conn, "SELECT agent_id, register_id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE `register_id` = '".$_POST['customer_name']."'");
                 $cust_array=mysqli_fetch_assoc($sqlCust);  
                 if($cust_array != null) {                                       
                    $agent1 =$cust_array["agent_id"]; 
                 } else {
                    $agent1 = $agent_id1;
                 }

                 $sqlAg1 = mysqli_query($conn, "SELECT `reference_id` FROM `msd_register_comp_agent_table` WHERE  `agent_id` = '".$agent1."' AND status != 2");
                 $ag1_array =mysqli_fetch_assoc($sqlAg1); 
                 if($ag1_array != null) {                                                                
                    $agent2  =$ag1_array["reference_id"]; 
                 } else {
                    $agent2 = $agent_id2;
                 }

                 $sqlAg2 = mysqli_query($conn, "SELECT `reference_id` FROM `msd_register_comp_agent_table` WHERE  `agent_id` = '".$agent2."' AND status != 2");
                 $ag2_array =mysqli_fetch_assoc($sqlAg2);  
                 if($ag2_array != null) {                                                                                
                    $agent3  =$ag2_array["reference_id"]; 
                 } else {
                    $agent3 = $agent_id3;
                 }

                 $sqlAg3 = mysqli_query($conn, "SELECT `reference_id` FROM `msd_register_comp_agent_table` WHERE  `agent_id` = '".$agent3."' AND status != 2");
                 $ag3_array =mysqli_fetch_assoc($sqlAg3);   
                 if($ag3_array != null) {                                                              
                    $agent4  =$ag3_array["reference_id"]; 
                 } else {
                    $agent4 = $agent_id4;
                 }

                 $sqlAg4 = mysqli_query($conn, "SELECT `reference_id` FROM `msd_register_comp_agent_table` WHERE  `agent_id` = '".$agent4."' AND status != 2");
                 $ag4_array =mysqli_fetch_assoc($sqlAg4);   
                 if($ag4_array != null) {                                                              
                    $agent5  =$ag4_array["reference_id"]; 
                 } else {
                    $agent5 = $agent_id5;
                 }

                 $sqlAg5 = mysqli_query($conn, "SELECT `reference_id` FROM `msd_register_comp_agent_table` WHERE`agent_id` = '".$agent5."' AND status != 2");
                 $ag5_array =mysqli_fetch_assoc($sqlAg5);   
                 if($ag5_array != null) {                                                              
                    $agent6  =$ag5_array["reference_id"]; 
                 } else {
                    $agent6 = $agent_id6;
                 }

                 
          echo '<div class="row">
                    <div class="col-lg-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body"><h5 class="card-title"></h5>
                                <form class="" method="post">
                                    <input type="text" name="id" value="'.$_POST['customer_name'].'" style="display: none;"/>
                                    <b>'.$_POST['customer_name'].' - '.$cust_array["name"].'</b><hr>    
                                    <div class="position-relative row form-group" ><label for="customer_perc" class="col-sm-3 col-form-label">Plan</label>
                                        <div class="col-sm-6"> 
                                            <select class="mb-2 form-control" name="plan_name" id="plan_id" ><option value="0">Select...</option>'; 
                                                $sql = mysqli_query($conn, "SELECT * FROM `msd_customer_plan_table` WHERE `customer_id` ='".$_POST['customer_name']."' AND `status`!=2 ORDER BY id DESC");
                                                $row = mysqli_num_rows($sql);
                                                while ($row = mysqli_fetch_array($sql)) {
                                                    if($plan_id == $row['plan_id']) { $selected='selected'; }
                                                    echo "<option value='". $row['plan_id'] ."' ".$selected.">". $row['plan_name'] . "~" .$row['plan_id'] ."</option>" ;
                                                    $selected ="";
                                                }
                                      echo '</select>
                                    </div></div>
                                    <hr>';
                                    if($agent6 != '' && $agent6 != 'MS0001A'){
                                   echo '<div class="position-relative row form-group" ><label for="agent_perc6" class="col-sm-3 col-form-label">Partner 6</label>
                                         <div class="col-sm-6"><input type="text" name="agent_perc6" id="agent_perc6" class="form-control" value="'.  $agent_perc6.'" style="width: 50%;"></div>
                                         <div class="col-sm-3"><input type="text" name="agent_id6" id="agent_id6" class="form-control" value="'. $agent6.'"></div>
                                    </div><hr>';
                                    } else {
                                        echo '<div class="position-relative row form-group" style="display: none;"><label for="agent_perc6" class="col-sm-3 col-form-label">Partner 6</label>
                                         <div class="col-sm-6"><input type="text" name="agent_perc6" id="agent_perc6" class="form-control" value="0.00" style="width: 50%;"></div>
                                         <div class="col-sm-3"><input type="text" name="agent_id6" id="agent_id6" class="form-control" value=""></div>
                                    </div>';
                                    }
                                    
                                    if($agent5 != '' && $agent5 != 'MS0001A'){
                                        echo '<div class="position-relative row form-group" ><label for="agent_perc5" class="col-sm-3 col-form-label">Partner 5</label>
                                         <div class="col-sm-6"><input type="text" name="agent_perc5" id="agent_perc5" class="form-control" value="'.  $agent_perc5.'" style="width: 50%;"></div>
                                         <div class="col-sm-3"><input type="text" name="agent_id5" id="agent_id5" class="form-control" value="'. $agent5.'"></div>
                                    </div><hr>';
                                } else {
                                    echo '<div class="position-relative row form-group" style="display: none;"><label for="agent_perc5" class="col-sm-3 col-form-label">Partner 5</label>
                                    <div class="col-sm-6"><input type="text" name="agent_perc5" id="agent_perc5" class="form-control" value="0.00" style="width: 50%;"></div>
                                    <div class="col-sm-3"><input type="text" name="agent_id5" id="agent_id5" class="form-control" value=""></div>
                               </div>';
                                    }
                                    
                                    if($agent4 != '' && $agent4 != 'MS0001A'){
                                        echo '<div class="position-relative row form-group" ><label for="agent_perc4" class="col-sm-3 col-form-label">Partner 4</label>
                                        <div class="col-sm-6"><input type="text" name="agent_perc4" id="agent_perc4" class="form-control" value="'.  $agent_perc4.'" style="width: 50%;"></div>
                                        <div class="col-sm-3"><input type="text" name="agent_id4" id="agent_id4" class="form-control" value="'. $agent4.'"></div>
                                    </div><hr>';
                                } else {
                                    echo '<div class="position-relative row form-group" style="display: none;"><label for="agent_perc4" class="col-sm-3 col-form-label">Partner 4</label>
                                    <div class="col-sm-6"><input type="text" name="agent_perc4" id="agent_perc4" class="form-control" value="0.00" style="width: 50%;"></div>
                                    <div class="col-sm-3"><input type="text" name="agent_id4" id="agent_id4" class="form-control" value=""></div>
                                </div>';
                                }
                                    
                                    if($agent3 != '' && $agent3 != 'MS0001A'){
                                        echo '<div class="position-relative row form-group" ><label for="agent_perc3" class="col-sm-3 col-form-label">Partner 3</label>
                                         <div class="col-sm-6"><input type="text" name="agent_perc3" id="agent_perc3" class="form-control" value="'.  $agent_perc3.'" style="width: 50%;"></div>
                                         <div class="col-sm-3"><input type="text" name="agent_id3" id="agent_id3" class="form-control" value="'. $agent3.'"></div>
                                    </div><hr>';
                                } else {
                                    echo '<div class="position-relative row form-group" style="display: none;"><label for="agent_perc3" class="col-sm-3 col-form-label">Partner 3</label>
                                    <div class="col-sm-6"><input type="text" name="agent_perc3" id="agent_perc3" class="form-control" value="0.00" style="width: 50%;"></div>
                                    <div class="col-sm-3"><input type="text" name="agent_id3" id="agent_id3" class="form-control" value=""></div>
                               </div>';
                                }
                                    
                                    if($agent2 != '' && $agent2 != 'MS0001A'){
                                        echo '<div class="position-relative row form-group" ><label for="agent_perc2" class="col-sm-3 col-form-label">Partner 2</label>
                                         <div class="col-sm-6"><input type="text" name="agent_perc2" id="agent_perc2" class="form-control" value="'.  $agent_perc2.'" style="width: 50%;"></div>
                                         <div class="col-sm-3"><input type="text" name="agent_id2" id="agent_id2" class="form-control" value="'. $agent2.'"></div>
                                    </div><hr>';
                                } else {
                                    echo '<div class="position-relative row form-group" style="display: none;"><label for="agent_perc2" class="col-sm-3 col-form-label">Partner 2</label>
                                    <div class="col-sm-6"><input type="text" name="agent_perc2" id="agent_perc2" class="form-control" value="0.00" style="width: 50%;"></div>
                                    <div class="col-sm-3"><input type="text" name="agent_id2" id="agent_id2" class="form-control" value=""></div>
                               </div>';
                                }
                                    
                                    if($agent1 != '' && $agent1 != 'MS0001A'){
                                        echo '<div class="position-relative row form-group" ><label for="agent_perc1" class="col-sm-3 col-form-label">Partner 1</label>
                                         <div class="col-sm-6"><input type="text" name="agent_perc1" id="agent_perc1" class="form-control" value="'.  $agent_perc1.'" style="width: 50%;"></div>
                                         <div class="col-sm-3"><input type="text" name="agent_id1" id="agent_id1" class="form-control" value="'. $agent1.'"></div>
                                    </div><hr>';
                                } else {
                                    echo '<div class="position-relative row form-group" style="display: none;"><label for="agent_perc1" class="col-sm-3 col-form-label">Partner 1</label>
                                    <div class="col-sm-6"><input type="text" name="agent_perc1" id="agent_perc1" class="form-control" value="0.00" style="width: 50%;"></div>
                                    <div class="col-sm-3"><input type="text" name="agent_id1" id="agent_id1" class="form-control" value=""></div>
                               </div>';
                                }
                                    echo '
                                    <div class="position-relative row form-group" ><label for="customer_perc" class="col-sm-3 col-form-label">Customer</label>
                                        <div class="col-sm-6"><input type="text" name="customer_perc" id="customer_perc" class="form-control" value="'. $cust_perc.'" style="width: 50%;"></div>
                                        <div class="col-sm-3"><input type="text" name="customer_id_name" id="customer_id" class="form-control" value="'.$_POST['customer_name'].'" ></div>
                                    </div>   
                                    <hr>   
                                    <div class="position-relative row form-check">
                                        <div class="col-sm-10 offset-sm-2">
                                            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                                            <button class="btn btn-secondary" name="close" >Close</button>
                                        </div>
                                    </div>
                                <form>
                        </div>
                    </div>
                </div>
            </div>'; 
               }
           ?>   
</div>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>                                 
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
</body>
</html>
<?php include 'footer.php';?>
