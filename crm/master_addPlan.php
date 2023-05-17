<link href="./main.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<!doctype html>
<?php include 'header.php'; 
      include 'database.php';

    if(isset($_POST['btnAdd'])) {  

        if(isset($_POST['invalidCheck'])){
          $empid =  $_POST['emp'];
          $empperc =  $_POST['emp_perc'];
          $check = 'YES';
          $perc = $_POST['emp_perc']."%";
          $incentive = $_POST['dep_amt']*$_POST['emp_perc']/100;
        } else {
          $empid =  "0";
          $empperc = "0";
          $check = 'NO';
          $incentive = 0.00;
        }

          if(isset($_POST['OfferCheck'])){            
            $Offercheck = 'YES';
            $Offer_name =  $_POST['Offer_name'];
          } else {
            $Offer_name = "0";
            $Offercheck = 'NO';
          }

        $query = mysqli_query($conn, "SELECT lpad(MAX(`id`)+1,4,'0')id FROM `msd_customer_plan_table`");
        $my_id_array=mysqli_fetch_assoc($query);
        $my_id=$my_id_array['id']; 
        if($my_id == "")  {
            $my_id = "0001";
        }
        $planid = 'MSP'.$my_id; 
    
        if (isset($planid)){          
          // Insert Value
          $sql = "INSERT INTO `msd_customer_plan_table`(`plan_id`, `plan_new_id`, `plan_name`, `customer_id`, `customer_name`, `deposit_amt`, `currency`, `duration`, `profit_perc`, `princ_perc`, `start_date`, `end_date`, `perc_return`, `emp_checked`, `emp_id`, `emp_perc`, `emp_incentive`) VALUES ('".$planid."','".$_POST['plan_name']."', '".$_POST['planname']."','".$_POST['customer_id']."','".$_POST['cust_name_hidden']."','".$_POST['dep_amt']."','".$_POST['currency']."','".$_POST['duration']."','".$_POST['prof_perc']."', '".$_POST['princ_perc']."', '".$_POST['start_dt']."','".$_POST['end_dt']."','".$_POST['radio1']."', '".$check."', '".$empid."', '".$empperc."', '".$incentive."')";
        }
          if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Your Form Submitted Successfully');</script>";
            echo "<script>window.location = 'transaction_percentage';</script>";
          } else {
            echo "<script>alert('Do not Submit, Please Fill All Data...!!!');</script>";
          }          
    }
?>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Add Plan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">    
    <link href="./main.css" rel="stylesheet"></head>
<style>
    /* .form-control {
        width: 50%;
    } */
    label {
        font-weight: bold;
    }
</style>
    <body>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <?php if ($_SESSION['ROLE'] == "admin") { ?>
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                <i class="fa fa-table" aria-hidden="true" ></i>
                                </div>
                                <div>Add Plan</div>
                            </div>
                        </div>
                    </div>           
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form method="POST" action="master_addPlan.php">
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                            <?php
                                                $query = mysqli_query($conn, "SELECT lpad(MAX(`id`)+1,4,'0')id FROM `msd_customer_plan_table`");
                                                $my_id_array=mysqli_fetch_assoc($query);
                                                $my_id=$my_id_array['id']; 
                                                if($my_id == "")  {
                                                    $my_id = "0001";
                                                }
                                                $id = 'MSP'.$my_id;                                             
                                            ?>   
                                        <label for="plan_id">Plan ID</label>
                                        <input type="text" class="form-control" id="plan_id" style="font-weight: bold;" name="plan_id_name" value="<?php echo $id; ?>" readonly required="">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="customer_id">Customer name</label>
                                        <input type="hidden" name="cust_name_hidden" id="cust_name_hidden">
                                                <?php   
                                                    if($_SESSION['ROLE'] == "admin") {
                                                        echo '<select class="mb-2 form-control" name="customer_id" id="customer_id" >';
                                                            //if($_POST['customer_id'] != "") {echo '<option selected value= "'.$_POST['customer_name'].'">'.$userId.'</option>'; }
                                                            $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE  `msd_register_customer_table`.`register_status` != 2");
                                                            $row = mysqli_num_rows($sql);
                                                            while ($row = mysqli_fetch_array($sql)) {
                                                                if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                                echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                                $selected ="";
                                                        }
                                                        echo '</select>';
                                                    } else if($_SESSION['ROLE'] == "manager") {
                                                            echo '<select class="mb-2 form-control" name="customer_id" id="customer_id" >';
                                                            $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE reference_id = '".$_SESSION['USERID']."' AND `msd_register_customer_table`.`register_status` != 2");
                                                            $row = mysqli_num_rows($sql);
                                                            while ($row = mysqli_fetch_array($sql)) {
                                                                if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                                echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                                $selected ="";
                                                        }
                                                        echo '</select> ';
                                                    } else if($_SESSION['ROLE'] == "employee") {
                                                            echo '<select class="mb-2 form-control" name="customer_id" id="customer_id" >';
                                                            $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE reference_id = '".$_SESSION['USERID']."' AND `msd_register_customer_table`.`register_status` != 2");
                                                            $row = mysqli_num_rows($sql);
                                                            while ($row = mysqli_fetch_array($sql)) {
                                                                if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                                echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ; 
                                                                $selected ="";
                                                        }
                                                        echo '</select>';
                                                    } else if($_SESSION['ROLE'] == "agent") {
                                                            echo '<select class="mb-2 form-control" name="customer_id" id="customer_id" >';
                                                            $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE agent_id = '".$_SESSION['USERID']."' AND `msd_register_customer_table`.`register_status` != 2");
                                                            $row = mysqli_num_rows($sql);
                                                            while ($row = mysqli_fetch_array($sql)) {
                                                                if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                                echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                                $selected ="";
                                                        }
                                                        echo '</select>';
                                                    }
                                                ?>
                                    </div>
                                
                                        <div class="col-md-4 mb-3">
                                            <label for="plan_name">Plan Name</label>
                                            <input type="hidden" class="form-control planname_class" id="planname" name="planname" placeholder="Plan Name" >
                                            <select class="form-control plan_name_class" id="plan_name" name="plan_name" required="">
                                            <option value="0">Select Plan...</option>
                                            <?php 
                                                $sql = mysqli_query($conn, "SELECT * FROM `msd_plan_table` WHERE `status` != 2");
                                                $row = mysqli_num_rows($sql);
                                                while ($row = mysqli_fetch_array($sql)) {
                                                    echo "<option value='". $row['plan_id'] ."' ".$selected.">" .$row['plan_name'] ."</option>" ;
                                                }                                            
                                            ?>
                                            </select>
                                    </div>
                                                                   
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="dep_amt">Deposit Amount</label>
                                        <input type="number" class="form-control dep_amt_class" id="dep_amt" name="dep_amt" placeholder="Deposit Amount" step="any" required="">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="duration_id">Duration</label>
                                        <input type="text" class="form-control duration_class" id="duration" name="duration" placeholder="Month Duration" readonly required="">
                                    </div>
                                         
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="prof_perc">Profit Percentage</label>
                                        <div class="input-group">                                                
                                            <input type="text" class="form-control prof_perc_class" id="prof_perc" name="prof_perc" placeholder="Profit Percentage" required="">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">%</span>
                                            </div>
                                        </div>
                                        <!-- <input type="text" class="form-control prof_perc_class" id="prof_perc" name="prof_perc" placeholder="Profit Percentage" required=""> -->
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="princ_perc">Principal Percentage</label>
                                        <div class="input-group">                                                
                                            <input type="text" class="form-control princ_perc_class" id="princ_perc" name="princ_perc" placeholder="Principal Percentage" required="">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="start_dt">Start Date</label>
                                        <input type="date" class="form-control start_dt" id="start_dt" name="start_dt" required="" value="<?php  echo date('Y-m-d');  ?>">
                                        
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="end_dt">End Date</label>
                                        <input type="date" class="form-control enddt" id="end_dt" name="end_dt" value="" required>
                                        
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="currency">Currency</label>
                                        <select class="form-control currency_class" id="currency" name="currency" required="">
                                            <option value="INR">INR</option>
                                            <option value="AED">AED</option>
                                            <option value="USD">USD</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3" id="divPrinc_ret_id">
                                        <label for="pric_amount">Principal Return</label>
                                        <fieldset class="position-relative form-group">
                                            <div class="position-relative form-check"><label class="form-check-label"><input name="radio1" type="radio" id="rbtnYesId" value="YES" class="form-check-input"> YES</label></div>
                                            <div class="position-relative form-check"><label class="form-check-label"><input name="radio1" type="radio" id="rbtnNoId" value="NO" class="form-check-input">NO</label></div>
                                        </fieldset>                                        
                                    </div>
                                </div>
                                <?php if($_SESSION['ROLE'] != null && $_SESSION['ROLE'] != "customer") { ?>
                                <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="emp_id">Employee</label>
                                            <input class="" style="display: flex;" type="checkbox" id="invalidCheck" name="invalidCheck" value="NO" onclick="myFunction()">
                                        </div>
                                        <div class="col-md-4 mb-3" id="emp_div_id" style="display: none;">
                                            <label for="emp_id">Employee Name</label>
                                            <?php 
                                                    echo '<select class="form-control emp_class" name="emp" id="emp_id" type="text" required>';
                                                    if($_SESSION['ROLE'] != "employee") {    
                                                        echo '<option value="0">Select...</option>';
                                                        $sql1 = mysqli_query($conn, "SELECT * FROM `msd_register_comp_employee_table` WHERE `status` != 2");
                                                    } else {
                                                        $sql1 = mysqli_query($conn, "SELECT * FROM `msd_register_comp_employee_table` WHERE emp_id = '".$_SESSION['USERID']."' AND `status` != 2");
                                                    }
                                                        $row1 = mysqli_num_rows($sql1);
                                                        while ($row1 = mysqli_fetch_array($sql1)) {
                                                            echo "<option value='". $row1['emp_id'] ."'>" .$row1['emp_name'] ."</option>" ;
                                                        }
                                                    echo '</select>';
                                                ?>
                                                <input type="hidden" name="emp_hidden" id="emp_hidden">
                                            
                                        </div>                              
                                        <div class="col-md-4 mb-3" id="empper_div_id" style="display: none;">
                                            <label for="emp_perc">Employee Percentage</label>
                                            <input type="number" class="form-control" id="emp_perc" value="0" name="emp_perc" >
                                           
                                        </div> 
                                </div>
                                <?php  }   ?> 
                               
                                <button class="btn btn-primary btnAddClass" id="btnAddId" name="btnAdd" type="submit" onclick="javascript:ResisterOnclick(this)">Submit</button>
                            </form>
                        </div>
                    </div>                    
                </div>   
                <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>               
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
                <script>
                        // Example starter JavaScript for disabling form submissions if there are invalid fields
                        (function() {
                            'use strict';
                            window.addEventListener('load', function() {
                                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                var forms = document.getElementsByClassName('needs-validation');
                                // Loop over them and prevent submission
                                var validation = Array.prototype.filter.call(forms, function(form) {
                                    form.addEventListener('submit', function(event) {
                                        if (form.checkValidity() === false) {
                                            event.preventDefault();
                                            event.stopPropagation();
                                        }
                                        form.classList.add('was-validated');
                                    }, false);
                                });
                            }, false);
                        })();
                        function durationSelect() {
                            var d = $(".start_dt").val();
                            console.log(d.toLocaleDateString());
                            d.setMonth(d.getMonth() - 3);
                            console.log(d.toLocaleDateString());
                        }
                    </script>
    
            <script type="text/javascript"> 

                $(document).ready(function() {

                    // ------------------ [ Language dropdown Change Event ] --------------
                    $("#plan_name").change(function() {
                        
                        var planId = $(this).val();
                        $(this).fadeIn();
                        
                        $.ajax({
                            url: 'master_plan_select.php?ajax_plan_id='+planId,
                            type: 'POST',
                            dataType: 'Json',
                            cache:false,
                            
                            success: function(data) {
                                    var items = "";
                                    $(".duration_class").empty();
                                    $("#prof_perc").empty();
                                    $('#end_dt').empty();
                                    $(".planname_class").empty();

                                    //Add Values in Controls
                                    $(".duration_class").val(data.plan_duration); 
                                    $(".prof_perc_class").val(data.plan_profit_perc); 
                                    $(".princ_perc_class").val(data.plan_principle_perc); 
                                    $(".planname_class").val($("#plan_name option:selected").text()); 
                                    
                                    //alert(data.plan_principle_perc);
                                    //Set End Date
                                    $(".dep_amt_class").attr({
                                        "max" : data.plan_max_criteria,  
                                        "min" : data.plan_min_criteria   
                                    });
                                    if(data.plan_principle_perc == 0.00) {
                                        $("#rbtnNoId").prop("checked", true);
                                    } else {
                                        $("#rbtnYesId").prop("checked", true);
                                    }

                                    var date = $(".start_dt").val();                
                                    var d = new Date(date.replace(/-/g, "/"));
                                    d.setMonth(d.getMonth() + parseInt(data.plan_duration));
                                    //d.setMonth(d.getMonth() + 6);
                                    var dt = d.toLocaleDateString('fr-CA');
                                    $('#end_dt').val(dt);                                     
                            },
                            error: function( error )
                            {
                                alert( error );
                            }
                        });
                    });
                });

                function ResisterOnclick() {
                    $("#cust_name_hidden").val($("#customer_id option:selected").text());    
                }
                
                function myFunction() {
                    if($("#invalidCheck").is(":checked")){
                        $("#invalidCheck").val("YES");        
                    } else {
                        $("#invalidCheck").val("NO");  
                    }
                    var x = document.getElementById("emp_div_id");
                    var y = document.getElementById("empper_div_id");
                    if (x.style.display === "none") {
                        x.style.display = "block";
                    } else {
                        x.style.display = "none";
                        $("#emp_id").val("0"); 
                    }
                    if (y.style.display === "none") {
                        y.style.display = "block";
                    } else {
                        y.style.display = "none";
                        $("#emp_perc").val("0"); 
                    }
                }

                function OfferFunction() {
                    if($("#OfferCheck").is(":checked")){
                        $("#OfferCheck").val("YES");        
                    } else {
                        $("#OfferCheck").val("NO");  
                    }
                    var x = document.getElementById("Offerper_div_id");
                   
                    if (x.style.display === "none") {
                        x.style.display = "block";
                    } else {
                        x.style.display = "none";
                        $(".Offer_name option:selected").val("0"); 
                    }                    
                }

                $('input.start_dt').change(function () { 
                    var date = $(".start_dt ").val();      
                    var d = new Date(date.replace(/-/g, "/"));
                    if ($("#duration").val() == "20") {
                        d.setMonth(d.getMonth() + 20);
                    } else if ($("#duration").val() == "6") {
                        d.setMonth(d.getMonth() + 6);
                    } else if ($("#duration").val() == "12") {
                        d.setMonth(d.getMonth() + 12);
                    } 
                    var dt = d.toLocaleDateString('fr-CA');
                    $('.enddt').val(dt);    

                });
            </script>
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
    