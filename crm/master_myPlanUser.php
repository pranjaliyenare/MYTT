<link href="./main.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<!doctype html>
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
    <title>My Plan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">    
    <link href="./main.css" rel="stylesheet"></head>
<style>
    * {
  margin: 0;
  padding: 0;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
ul {
  list-style-type: none;
}

a {
  color: #e95846;
  text-decoration: none;
}

.pricing-table-title {
  text-transform: uppercase;
  font-weight: 700;
  font-size: 2.6em;
  color: #FFF;
  margin-top: 15px;
  text-align: left;
  margin-bottom: 25px;
  text-shadow: 0 1px 1px rgba(0,0,0,0.4);
}

.pricing-table-title a {
  font-size: 0.6em;
}

.clearfix:after {
  content: '';
  display: block;
  height: 0;
  width: 0;
  clear: both;
}
/** ========================
 * Contenedor
 ============================*/
.pricing-wrapper {
  width: 100%;
  margin: 40px auto 0;
}

.pricing-table {
  margin: 0 10px 20px;
  text-align: center;
  width: 250px;
  float: left;
  -webkit-box-shadow: 0 0 15px rgba(0,0,0,0.4);
  box-shadow: 0 0 15px rgba(0,0,0,0.4);
  -webkit-transition: all 0.25s ease;
  -o-transition: all 0.25s ease;
  transition: all 0.25s ease;
}

.pricing-table:hover {
  -webkit-transform: scale(1.06);
  -ms-transform: scale(1.06);
  -o-transform: scale(1.06);
  transform: scale(1.06);
}

.pricing-title {
  color: #FFF;
  background: #e95846;
  padding: 20px 0;
  font-size: 20px;
  text-transform: uppercase;
  text-shadow: 0 1px 1px rgba(0,0,0,0.4);
}

.pricing-table.recommended .pricing-title {
  background: #1c81c3;
}

.pricing-table.recommended .pricing-action {
  background: #1c81c3;
}

.pricing-table .price {
  background: #272c4a;
  font-size: 30px;
  font-weight: 700;
  padding: 20px 0;
  text-shadow: 0 1px 1px rgba(0,0,0,0.4);
  color: #FFF;
}

.pricing-table .price sup {
  font-size: 0.4em;
  position: relative;
  left: 5px;
}

.table-list {
  background: #FFF;
  color: #403d3a;
}

.table-list li {
  font-size: 16px;
  font-weight: 700;
  padding: 12px 8px;
}

.table-list li:before {
  /* content: "\f00c"; */
  font-family: 'FontAwesome';
  color: #3fab91;
  display: inline-block;
  position: relative;
  right: 5px;
  font-size: 16px;
} 

.table-list li span {
  font-weight: 400;
  font-size: 14px;
}

.table-list li span.unlimited {
  color: #FFF;
  background: #e95846;
  font-size: 0.9em;
  padding: 5px 7px;
  display: inline-block;
  -webkit-border-radius: 38px;
  -moz-border-radius: 38px;
  border-radius: 38px;
}


.table-list li:nth-child(2n) {
  background: #F0F0F0;
}

.table-buy {
  background: #FFF;
  padding: 10px;
  text-align: left;
  overflow: hidden;
}

.table-buy p {
  float: left;
  color: #37353a;
  font-weight: 700;
  font-size: 2.4em;
}

.table-buy p sup {
  font-size: 0.5em;
  position: relative;
  left: 5px;
}

.table-buy .pricing-action {
  float: right;
  color: #FFF;
  background: #e95846;
  padding: 5px 10px;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  font-weight: 700;
  /* font-size: 1.4em; */
  text-shadow: 0 1px 1px rgba(0,0,0,0.4);
  -webkit-transition: all 0.25s ease;
  -o-transition: all 0.25s ease;
  transition: all 0.25s ease;
}

.table-buy .pricing-action:hover {
  background: #cf4f3e;
}

.recommended .table-buy .pricing-action:hover {
  background: #228799;  
}

/** ================
 * Responsive
 ===================*/
 @media only screen and (min-width: 768px) and (max-width: 959px) {
  .pricing-wrapper {
    width: 768px;
  }

  .pricing-table {
    width: 236px;
  }
  
  .table-list li {
    font-size: 16px;
  }
 }

 @media only screen and (max-width: 767px) {
  .pricing-wrapper {
    width: 420px;
  }

  .pricing-table {
    display: block;
    float: none;
    margin: 0 0 20px 0;
    width: 80%;
  }
 }

@media only screen and (max-width: 479px) {
  .pricing-wrapper {
    width: 300px;
  }
} 
h1, h2, h3, h4, h5, h6, ul {
    margin-top: 0;
    margin-bottom: 0;
    font-family :sans-serif;
}

</style>
    <body>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <?php  if($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "customer") { ?>
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                <i class="fa fa-table" aria-hidden="true" ></i>
                                </div>
                                <div>My Plan</div>
                            </div>
                        </div>
                    </div>      
          <div class="row">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title"></h5>
                        <form class="" method="post" action="">
                            <div class="position-relative row form-group">
                                <label for="exampleEmail" class="col-sm-3 col-form-label"><b> Plan Name :</b></label>
                                          
                                        <div class="col-sm-6">
                                           <select class="mb-2 form-control" name="plan_name" id="plan_id" >
                                              <option value="0">Select...</option>
                                              <?php 
                                                    $sql = mysqli_query($conn, "SELECT * FROM `msd_customer_plan_table` WHERE `customer_id` ='".$_SESSION['USERID']."' AND `status`!=2");
                                                    $row = mysqli_num_rows($sql);
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                        if($_POST['plan_name'] == $row['plan_id']) { $selected='selected'; }
                                                        echo "<option value='". $row['plan_id'] ."' ".$selected.">" .$row['plan_name'] ."</option>" ;
                                                        $selected ="";
                                                    }   
                                              ?>
                                              </select>
                                        </div>                                     
                                        <div class="col-sm-2">
                                        <input class="mb-2 mr-2 btn btn-primary" type="submit" name="submit" value="Search" />
                                    </div>
                                </div>
                               
                        </form>
                    </div>
                </div>
            </div>
        </div>     
        <?php  
            $query = "SELECT * FROM `msd_customer_plan_table` WHERE `customer_id` = '".$_SESSION['USERID']."' AND `status`!= 2";
            if(isset($_POST['submit'])){ 
              if($_POST['plan_name'] != "0"){
                  //$query = "SELECT * FROM `msd_customer_plan_table` WHERE `customer_id` = '".$_SESSION['USERID']."' AND `status`!= 2";
               //} else {
                  $query = "SELECT * FROM `msd_customer_plan_table` WHERE `customer_id` = '".$_SESSION['USERID']."' AND `plan_id` = '".$_POST['plan_name']."' AND `status`!= 2";
               }                
            }
        ?>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <form method="POST" action="master_myPlan.php">                  
                    <!-- Start pricing Table-->
                    <div class="pricing-wrapper clearfix">
                <?php 
                        if ($result = $conn->query($query)) {
                            while ($row = $result->fetch_assoc()) {
                                $plan_id = $row["plan_id"];
                                $plan_name = $row["plan_name"];
                                $deposit_amt = $row["deposit_amt"];
                                $duration = $row["duration"];
                                $profit_perc = $row["profit_perc"];
                                $princ_perc = $row["princ_perc"];
                                $start_date = $row["start_date"];
                                $end_date = $row["end_date"];
                                $perc_return = $row["perc_return"];
                                $active_status = $row["active_status"];
                                $perc_return= $row["perc_return"];
                                $customer_id = $row["customer_id"];
                                $customer_name = $row["customer_name"];
                ?>
                    
                        <!-- Titulo -->                                    
                        <div class="pricing-table recommended">
                             <?php 
                              if($active_status == 'active') {
                                   echo "<div><label style= 'color: #008000; font-weight: bold;'>Active</label></div>";
                               } else if($active_status == 'inactive') {
                                 echo "<label style= 'color: #16aaff; font-weight: bold;'>Inactive</label>";
                               } else if($active_status == 'expire') {
                                 echo "<label style= 'color: #d92550; font-weight: bold;'>Expired</label>";
                               }
                             ?>
                            <h3 class="pricing-title" style="margin-top: 0; margin-bottom: 0;"><?php echo $plan_name; ?></h3>
                            <div class="price"><?php echo intval($deposit_amt); ?>-<?php echo $currency; ?></div>
                            <!-- Lista de Caracteristicas / Propiedades -->
                            <ul class="table-list">
                                <li><i class="fas fa-check" style="color:green;"></i>  <?php echo $duration; ?> Months</li>
                                <li><i class="fas fa-check" style="color:green;"></i>  <span>Profit Percentage</span> <?php echo $profit_perc; ?>%</li>
                                <?php if($perc_return == 'YES') { ?>
                                <li><i class="fas fa-check" style="color:green;"></i>  <span>Principal Percentage</span> <?php echo $princ_perc; ?>%</li>
                                <?php } ?>
                                <li><i class="fas fa-check" style="color:green;"></i>  <span>Start Date</span> <?php echo date("d/m/Y", strtotime($start_date)); ?></li>
                                <li><i class="fas fa-check" style="color:green;"></i>  <span>End Date</span> <?php echo date("d/m/Y", strtotime($end_date)); ?></li>
                                <!-- <li>Base de datos <span class="unlimited">ilimitadas</span></li>
                                <li>Cuentas de correo <span class="unlimited">ilimitadas</span></li>
                                <li>CPanel <span>incluido</span></li> -->
                            </ul>
                            <!-- Contratar / Comprar -->
                            <div class="table-buy">
                                <!-- <p>$100<sup>/ mes</sup></p>-->
                                <a href="report_Passbook_customer?planid=<?php echo base64_encode($plan_id); ?>" class="pricing-action">Passbook</a> 
                            </div>
                        </div> 
                        <?php
                            }
                        }
                        ?>
                        <br/><br/>
                        </div>                        
                        <!-- End pricing Table -->
                    </form>
                </div>
            </div>                  
        </div>        
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