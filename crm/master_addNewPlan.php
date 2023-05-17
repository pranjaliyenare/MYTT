<link href="./main.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<!doctype html>
<?php include 'header.php'; 
      include 'database.php';

    if(isset($_POST['btnAdd'])) {          
        $query = mysqli_query($conn, "SELECT lpad(MAX(`id`)+1,4,'0')id FROM `msd_plan_table`");
        $my_id_array=mysqli_fetch_assoc($query);
        $my_id=$my_id_array['id']; 
        if($my_id == "")  {
            $my_id = "0001";
        }
      echo  $planid = 'PLAN'.$my_id; 
    
        if (isset($planid)){          
          // Insert Value
          $sql = "INSERT INTO `msd_plan_table`(`plan_id`, `plan_name`, `plan_profit_perc`, `plan_principle_perc`, `plan_duration`, `plan_min_criteria`, `plan_max_criteria`, `plan_payout`, `plan_add_profit`, `return_type`) VALUES ('".$planid."','".$_POST['plan_name']."','".$_POST['prof_perc']."','".$_POST['prin_perc']."','".$_POST['duration_id']."','".$_POST['min_amt']."','".$_POST['max_amt']."','".$_POST['payout']."','".$_POST['profit']."', 'profit')";
        }
          if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Your Form Submitted Successfully');</script>";
            echo "<script>window.location = 'master_editNewPlan';</script>";
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
                                <div>Add New Plan</div>
                            </div>
                        </div>
                    </div>           
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form method="POST" action="master_addNewPlan.php">
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                            <?php
                                                $query = mysqli_query($conn, "SELECT lpad(MAX(`id`)+1,4,'0')id FROM `msd_plan_table`");
                                                $my_id_array=mysqli_fetch_assoc($query);
                                                $my_id=$my_id_array['id']; 
                                                if($my_id == "")  {
                                                    $my_id = "0001";
                                                }
                                                $id = 'PLAN'.$my_id;                                             
                                            ?>   
                                        <label for="plan_id">Plan ID</label>
                                        <input type="text" class="form-control" id="plan_id" style="font-weight: bold;" name="plan_id" value="<?php echo $id; ?>" readonly required="">
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="plan_name">Plan Name</label>
                                        <input type="text" class="form-control plan_name_class" id="plan_name" name="plan_name" placeholder="Plan name" required="">
                                         
                                    </div>  
                                    <div class="col-md-4 mb-3">
                                        <label for="duration_id">Duration</label>
                                        <input type="text" class="form-control prof_perc_class" id="duration_id" name="duration_id" placeholder="Plan Duration" required="">
                                    </div>
                                                               
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="prof_perc">Profit Percentage</label>
                                        <input type="text" class="form-control prof_perc_class" id="prof_perc" name="prof_perc" placeholder="Profit Percentage" required="">
                                        
                                    </div>  
                                    <div class="col-md-4 mb-3">
                                        <label for="prin_perc">Principal Percentage</label>
                                        <input type="text" class="form-control prof_perc_class" id="prin_perc" name="prin_perc" placeholder="Principal Percentage" required="">
                                        
                                    </div>                                  
                                    <div class="col-md-4 mb-3">
                                        <label for="profit">Add Profit Per</label>
                                        <select class="form-control" id="profit" name="profit" required="">
                                            <option value="Day">Day</option>
                                            <option value="Month">Month</option>
                                        </select>
                                    </div>                                    
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="min_amt">Min Amount</label>
                                        <input type="text" class="form-control dep_amt_class" id="min_amt" name="min_amt" placeholder="Min Amount" required="">
                                       </div> 
                                    <div class="col-md-4 mb-3">
                                        <label for="max_amt">Max Amount</label>
                                        <input type="text" class="form-control dep_amt_class" id="max_amt" name="max_amt" placeholder="Max Amount" required="">
                                        
                                    </div> 
                                    <div class="col-md-4 mb-3">
                                        <label for="payout">Payout</label>
                                        <select class="form-control" id="payout" name="payout" onselect="durationSelect()" required="">
                                                    <option value="monthly">Monthly</option>
                                                    <option value="maturity">After Maturity</option>
                                            </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary btnAddClass" id="btnAddId" name="btnAdd" type="submit" onclick="javascript:ResisterOnclick(this)">Submit</button>
                            </form>
                        </div>
                    </div>                    
                </div>   
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>               
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>         
    </body>
</html>
<?php include 'footer.php'; ?>
<?php } else { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="widget-content-wrapper" id="divImg">
                            <img  src="assets/images/404-error.jpg" alt="mytt"  style="width:100%; "/>
                        </div>
                    </div>
                </div>                                
            </div>
        </div>
    </body>
</html>
<?php } ?>