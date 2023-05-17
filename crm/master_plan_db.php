<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<!-- Database Declare -->
<?php
  include 'database.php';  
  session_start();
?>

<!-- Start Customer Plan Update -->
<?php 
 
 if(isset($_GET['ajaxplanid'])) {    
   $id = $_GET['ajaxplanid'];
?>
<form method="POST" action="master_plan_db">
<div class="tab-content">
  <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
    <div class="row">
      <div class="col-md-12">
        <div class="main-card mb-3 card">
          <div class="card-body">
              <?php
                  $query = mysqli_query($conn, "SELECT * FROM `msd_customer_plan_table` WHERE `plan_id` ='".$id."' AND `status`!= 2");
                  $my_array=mysqli_fetch_assoc($query);
                  $plan_id=$my_array["plan_id"];
                  $plan_new_id=$my_array["plan_new_id"];
                  $plan_name=$my_array["plan_name"];
                  $customer_id=$my_array["customer_id"];
                  $customer_name=$my_array["customer_name"];
                  $deposit_amt=$my_array["deposit_amt"];
                  $currency=$my_array["currency"];
                  $duration=$my_array["duration"];
                  $profit_perc=$my_array["profit_perc"];
                  $princ_perc=$my_array["princ_perc"];
                  $start_date=$my_array["start_date"];
                  $end_date=$my_array["end_date"];
                  $perc_return=$my_array["perc_return"];
                  $active_status=$my_array["active_status"];
                  $emp_checked =$my_array["emp_checked"];
                  $emp_id=$my_array["emp_id"];
                  $emp_perc=$my_array["emp_perc"];
                           
                  $six = "";
                  $twelth = "";
                  $twenty = "";
                  $selected="";
              ?>
                <div class="position-relative form-group"><label for="plan_id" class="">Plan ID</label><input type="text" class="form-control" id="plan_id" style="font-weight: bold;" name="plan_id" value="<?php echo $plan_id; ?>" readonly required></div>
                <div class="position-relative form-group"><label for="customer_id" class="">Customer ID</label><input type="text" class="form-control" id="customer_id" name="customer_name" value="<?php echo $customer_name; ?>" readonly required=""></div>
                <div class="position-relative form-group">
                  <label for="plan_name" class="">Plan Name</label>
                  <input type="hidden" class="form-control planname_class" id="planname" name="planname" value="<?php echo $plan_name; ?>" placeholder="Plan Name" >
                  <select class="form-control plan_name_class" id="plan_name" name="plan_name" required="">
                    <option value="0">Select Plan...</option>
                    <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM `msd_plan_table` WHERE `status` != 2");
                        $row = mysqli_num_rows($sql);
                        while ($row = mysqli_fetch_array($sql)) {
                            if($plan_new_id == $row['plan_id']) { $selected='selected'; }
                            echo "<option value='".$row['plan_id']."' ".$selected.">" .$row['plan_name'] ."</option>" ;
                            $selected ="";
                        }                                            
                    ?>
                  </select>
                  <!-- <input type="text" class="form-control plan_name_class" id="plan_name" name="plan_name" placeholder="Plan name" value="<?php echo $plan_name; ?>" readonly required=""> -->
                </div>
                <div class="position-relative form-group"><label for="dep_amt" class="">Deposit Amount</label><input type="text" class="form-control dep_amt_class" id="dep_amt" name="dep_amt" placeholder="Deposit Amount" value="<?php echo $deposit_amt; ?>" required=""></div>
                <div class="position-relative form-group"><label for="duration" class="">Duration</label>
                      <input type="text" class="form-control duration_class" id="duration" name="duration" placeholder="Month Duration" value="<?php echo $duration; ?>" readonly required="">
                </div>
                
                <div class="position-relative form-group"><label for="prof_perc" class="">Profit Percentage</label><input type="text" class="form-control prof_perc_class" id="prof_perc" name="prof_perc" placeholder="Profit Percentage" value="<?php echo $profit_perc; ?>" required=""></div>
                <div class="position-relative form-group"><label for="princ_perc">Principal Percentage</label><input type="text" class="form-control princ_perc_class" id="princ_perc" name="princ_perc" placeholder="Principal Percentage" value="<?php echo $princ_perc; ?>" required=""></div>
                <div class="position-relative form-group"><label for="start_dt" class="">Start Date</label><input type="date" class="form-control start_dt" id="start_dt" name="start_dt" required="" value="<?php echo $start_date; ?>"></div>
                <div class="position-relative form-group"><label for="end_dt" class="">End Date</label><input type="date" class="form-control enddt" id="end_dt" name="end_dt" required="" value="<?php echo $end_date; ?>"></div>

                <d<div class="position-relative form-group">
                   <label for="currency">Currency</label>
                   <select class="form-control currency_class" id="currency" name="currency" required="">
                       <option value="INR" <?php if($currency == 'INR') { echo 'selected'; } ?>>INR</option>
                       <option value="AED" <?php if($currency == 'AED') { echo 'selected'; } ?>>AED</option>
                       <option value="USD" <?php if($currency == 'USD') { echo 'selected'; } ?>>USD</option>
                   </select>
               </div>

                <div class="position-relative form-group divPrinc_ret_class" >
                  <label for="pric_amount">Principal Return</label>
                  <fieldset class="position-relative form-group">
                    <div class="position-relative form-check">
                        <label class="form-check-label"><input name="radio1" type="radio" id="rbtnYesId" value="YES" class="form-check-input rbtnYesClass" <?php if($perc_return == 'YES') { echo 'checked'; } ?>> YES</label>
                    </div>
                    <div class="position-relative form-check">
                      <label class="form-check-label">
                      <input name="radio1" type="radio" id="rbtnNoId"  value="NO" class="form-check-input rbtnNoClass" <?php if($perc_return == 'NO') { echo 'checked'; } ?> >NO</label>
                    </div>
                  </fieldset>
                </div>

                <div class="position-relative form-check form-check-inline" <?php if($active_status == 'expire') { echo 'style="display: none;"'; } ?>><label class="form-check-label"  style="color: #3ac47d;"><input type="checkbox" id="chkActive" name="chkActive" class="form-check-input chkActive_class" <?php if($active_status == 'active') { echo "checked"; } ?> ><input type="text" value="<?php echo $active_status; ?>" name="chkVal" id="chkVal" class="chkVal_class" style="border : 0; font-weight: bold;"></label></div>

                <?php //if($_SESSION['ROLE'] != null && $_SESSION['ROLE'] != "customer") { ?>
                    <div class="form-row"  style="<?php if($_SESSION['ROLE'] == null || $_SESSION['ROLE'] != "admin") { echo 'display:none'; } ?>" >
                        <div class="col-md-4 mb-3">
                            <input type="checkbox" id="invalidCheck" class="invalidCheckClass" name="invalidCheck" value="<?php if($emp_checked == 'YES') { echo 'YES'; } else { echo 'NO';} ?>"  <?php if($emp_checked == 'YES') { echo 'checked'; }; ?>>
                        </div>
                        <div class="col-md-4 mb-3 emp_div_class" id="emp_div_id" <?php if($emp_checked == 'NO') { echo 'style="display: none;"';} ?>>
                            <label for="emp_id">Employee Name</label>
                                  <?php 
                                     echo '<select class="form-control emp_class" name="emp" id="emp_id" type="text" >
                                           <option value="0">Select Employee...</option>';
                                              $sql1 = mysqli_query($conn, "SELECT * FROM `msd_register_comp_employee_table` WHERE `status` != 2");
                                              $row1 = mysqli_num_rows($sql1);
                                              while ($row1 = mysqli_fetch_array($sql1)) {
                                                  if($emp_id == $row1['emp_id']) { $selected='selected'; } 
                                                  echo "<option value='". $row1['emp_id'] ."' ".$selected.">" .$row1['emp_name'] ."</option>" ;
                                                  $selected = "";
                                              }
                                          echo '</select>';
                                  ?>
                                <input type="hidden" name="emp_hidden" id="emp_hidden">                                            
                        </div>                              
                        <div class="col-md-4 mb-3 empper_div_class" id="empper_div_id" <?php if($emp_checked == 'NO') { echo 'style="display: none;"';} ?>>
                            <label for="emp_perc">Percentage</label>
                            <input type="number" class="form-control" id="emp_perc" value="<?php echo $emp_perc; ?>" name="emp_perc" >
                        </div>                                   
                    </div>
                <?php // }   ?> 

          </div>
        </div>
      </div>       
    </div>
  </div>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="submit" name="submit" class="btn btn-primary">Save changes</button>    
  </form>
  <style>
    label {
      font-weight: bold;
    }
  </style>
  <script type="text/javascript"> 
    $(document).ready(function() {
      $(".plan_name_class").change(function() {
        
        var planId = $(this).val();
        var planname = $('option:selected',this).text();
        $(this).fadeIn();
        
        $.ajax({
            url: 'master_plan_select.php?ajax_plan_id='+planId,
            type: 'POST',
            dataType: 'Json',
            cache:false,
            
            success: function(data) {
                    var items = "";
                    $(".duration_class").empty();
                    $(".prof_perc_class").empty();
                    $('.enddt').empty();
                    $(".planname_class").val("");

                    //Add Values in Controls
                    $(".duration_class").val(data.plan_duration); 
                    $(".prof_perc_class").val(data.plan_profit_perc); 
                    $(".princ_perc_class").val(data.plan_principle_perc); 
                    $(".planname_class").val(planname); 
                    
                    //alert(data.plan_principle_perc);
                    //Set End Date
                    $(".dep_amt_class").attr({
                        "max" : data.plan_max_criteria,  
                        "min" : data.plan_min_criteria   
                    });
                    if(data.plan_principle_perc == 0.00) {
                        $(".rbtnNoClass").prop("checked", true);
                    } else {
                        $(".rbtnYesClass").prop("checked", true);
                    }

                    var date = $(".start_dt").val();                
                    var d = new Date(date.replace(/-/g, "/"));
                    d.setMonth(d.getMonth() + parseInt(data.plan_duration));
                    //d.setMonth(d.getMonth() + 6);
                    var dt = d.toLocaleDateString('fr-CA');
                    $('.enddt').val(dt);                                     
            },
            error: function( error )
            {
                alert( error );
            }
        });
      });
    });
  

        $(".invalidCheckClass").click(function () {
            if($(".invalidCheckClass").is(":checked")){
                $('.emp_div_class').css('display','block');
                $(".invalidCheckClass").val("YES"); 
                $('.empper_div_class').css('display','block');      
            } else {
                $(".invalidCheckClass").val("NO");  
                $('.emp_div_class').css('display','none');
                $('.empper_div_class').css('display','none');
                $(".emp_class").val("0");
            }        
        });

    $(".chkActive_class").click(function () {
        if ($(this).is(":checked")) {
            $(".chkVal_class").val("active");
        } else {
            $(".chkVal_class").val("inactive");
        }
    });

    

    
</script>
<?php  } ?>

<!-- End Customer Plan Update -->
<!-- Start Update Customer Plan -->
<?php
    if(isset($_POST['submit'])) {   
        if(isset($_POST['invalidCheck'])) {
          $empid =  $_POST['emp'];    
          $empperc =  $_POST['emp_perc'];
          $check = 'YES';
          $incentive = $_POST['dep_amt']*$_POST['emp_perc']/100;
        } else {
          $empid =  "0";    
          $empperc = "0";
          $check = 'NO';
          $incentive = 0.00;
        }

        
      mysqli_query($conn,"UPDATE `msd_customer_plan_table` SET `plan_new_id` = '".$_POST['plan_name']."', `plan_name`='".$_POST['planname']."', `customer_name`='".$_POST['customer_name']."', `deposit_amt`='".$_POST['dep_amt']."', `currency`='".$_POST['currency']."', `duration`='".$_POST['duration']."', `profit_perc`='".$_POST['prof_perc']."', `princ_perc` = '".$_POST['princ_perc']."', `start_date`='".$_POST['start_dt']."', `end_date`='".$_POST['end_dt']."', `perc_return`='".$_POST['radio1']."', `active_status`='".$_POST['chkVal']."', `emp_checked`= '".$check."', `emp_id`= '".$empid."', `emp_perc`= '".$empperc."', `emp_incentive`='".$incentive."' WHERE `plan_id`='".$_POST['plan_id']."'"); 
      echo "<script>alert('Plan Updated...!!!');</script>";
      echo "<script>window.location = 'master_editPlan';</script>";
    }
?>

<!-- End Update Customer Plan -->

<!-- Start Update Customer Plan -->
<?php 
 
 if(isset($_GET['ajaxplan_id'])) {    
   $id = $_GET['ajaxplan_id'];
?>
  <?php
  
    $query = mysqli_query($conn, "SELECT * FROM `msd_plan_table` WHERE `plan_id` ='".$id."' AND `status`!= 2");
    $row=mysqli_fetch_assoc($query);
    $plan_id = $row["plan_id"];
    $plan_name = $row["plan_name"];
    $prof_perc= $row["plan_profit_perc"];
    $prin_perc = $row["plan_principle_perc"];
    $plan_duration = $row["plan_duration"];
    $min_amt = $row["plan_min_criteria"];
    $max_amt = $row["plan_max_criteria"];
    $payout = $row["plan_payout"];
    $profit = $row["plan_add_profit"];

  ?>
            <form method="POST" action="master_plan_db.php">
                  <div class="form-row">
                      <div class="col-md-12 mb-3">
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="plan_id">Plan ID</label>
                                <input type="text" class="form-control" id="plan_id" style="font-weight: bold;" name="plan_id" value="<?php echo $id; ?>" readonly required="">
                          </div>
                          <div class="col-md-6 mb-3">
                              <label for="plan_name">Plan Name</label>
                              <input type="text" class="form-control plan_name_class" id="plan_name" name="plan_name" value="<?php echo $plan_name; ?>" placeholder="Plan name"  required="">
                           </div>  
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="prof_perc">Profit Percentage</label>
                                <input type="text" class="form-control prof_perc_class" id="prof_perc" name="prof_perc" value="<?php echo $prof_perc; ?>" placeholder="Profit Percentage" required="">
                            </div>  
                            <div class="col-md-6 mb-3">
                                <label for="prin_perc">Principal Percentage</label>
                                <input type="text" class="form-control prof_perc_class" id="prin_perc" name="prin_perc" value="<?php echo $prin_perc; ?>" placeholder="Principal Percentage" required="">
                                
                            </div>                                                                                                   
                        </div>                                
                 
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="min_amt">Min Amount</label>
                                <input type="text" class="form-control dep_amt_class" id="min_amt" name="min_amt" value="<?php echo $min_amt; ?>" placeholder="Min Amount" required="">
                              </div> 
                            <div class="col-md-6 mb-3">
                                <label for="max_amt">Max Amount</label>
                                <input type="text" class="form-control dep_amt_class" id="max_amt" name="max_amt" value="<?php echo $max_amt; ?>" placeholder="Max Amount" required="">
                                
                            </div> 
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="plan_duration">Duration</label>
                                <input type="text" class="form-control prof_perc_class" id="plan_duration" name="plan_duration" value="<?php echo $plan_duration; ?>" placeholder="Plan Duration" required="">
                            </div> 
                            <div class="col-md-6 mb-3">
                                <label for="payout">Payout</label>
                                <select class="form-control" id="payout" name="payout" onselect="durationSelect()" required="">
                                    <option value="Monthly" <?php if($payout == 'monthly') { echo 'selected'; } ?>>Monthly</option>
                                    <option value="Maturity" <?php if($payout == 'maturity') { echo 'selected'; } ?>>After Maturity</option>
                                </select>                            
                            </div>
                        </div>
                        <div class="form-row"> 
                            <div class="col-md-6 mb-3">
                                <label for="profit">Add Profit Per</label>
                                <select class="form-control" id="profit" name="profit" required="">
                                    <option value="Day" <?php if($profit == 'Day') { echo 'selected'; } ?>>Day</option>
                                    <option value="Month" <?php if($profit == 'Month') { echo 'selected'; } ?>>Month</option>
                                </select>                            
                            </div>
                        </div>
                      </div>
                      <button class="btn btn-primary btnEditClass" id="btnEdit" name="btnEdit" type="submit" onclick="javascript:ResisterOnclick(this)">Edit</button>
              </form>
        <style>
          label {
            font-weight: bold;
          }
        </style>
 
      <?php  } ?>
<!-- End Update Customer Plan -->

<?php
    if(isset($_POST['btnEdit'])) {          
      mysqli_query($conn,"UPDATE `msd_plan_table` SET `plan_name`='".$_POST['plan_name']."', `plan_profit_perc`='".$_POST['prof_perc']."', `plan_principle_perc`='".$_POST['prin_perc']."', `plan_duration`='".$_POST['plan_duration']."', `plan_min_criteria`='".$_POST['min_amt']."', `plan_max_criteria`='".$_POST['max_amt']."',`plan_payout`='".$_POST['payout']."',`plan_add_profit`='".$_POST['profit']."' WHERE `plan_id` = '".$_POST['plan_id']."'"); 
      echo "<script>alert('Plan Updated...!!!');</script>";
      echo "<script>window.location = 'master_editNewPlan';</script>";
    }
?>
<?php
    if(isset($_POST['btnAlloDelete'])) {          
      mysqli_query($conn,"UPDATE `msd_plan_table` SET `status`= 2 WHERE `plan_id` = '".$_POST['id']."'"); 
      echo "<script>alert('Plan Deleted...!!!');</script>";
      echo "<script>window.location = 'master_editNewPlan';</script>";
    }
?>




