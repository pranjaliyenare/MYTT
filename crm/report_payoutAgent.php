
<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

<?php include 'header.php'; 
      include 'database.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Partner Payout Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">
</head>
    <style>
   table thead 
   {
    text-align: center;
   }
   table tbody
   {
    text-align: center;
   }
   
    #table-wrapper {
        position:relative;
    }
    #table-scroll {
      height:500px;
      /* overflow:auto;   */
      /* overflow-x: auto; */
      width:100%;
      margin-top:20px;
    }
    #table-wrapper table {
        width:100%;

    }
    #table-wrapper table * {
      color:black;
    }
    #table-wrapper table thead th .text {
      position:absolute;   
      top:-20px;
      z-index:2;
      height:20px;
      width:35%;
      border:1px solid red;
    }
    #table-wrapper #table-scroll table thead th{
      background : #3f6ad8;
      position: sticky;
      top: 0;
      border:1px solid white;
    }
    .app-main {
        display: block;
    }
</style>
<body>
<div class="app-main__outer">
    <div class="app-main__inner">
        <?php if($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "accountant") { ?>
        <div class="app-page-title" style="padding: 10px;">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-file"></i>
                    </div>
                    <div>Partner Payout Report
                        <div class="page-title-subheading"></div>
                    </div>
                </div>
                <div class="page-title-actions" id="divBtnAdd" >
                    <button class="btn" onclick="ExportExcel('xlsx')" style="background: #3d9852; color:white;"><i class="fa fa-file-excel-o" style="font-size:20px"></i></button>
                </div>
            </div>
        </div>    
        
        <div class="row">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title"></h5>
                        <form class="" method="post" action="#">
                            <div class="divider"></div>
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustom01">From Date</label> 
                                        <input type="date" name="stdt" class="form-control" id="datefilterfrom" data-date-split-input="true" value="<?php if(isset($_POST['stdt'])) { echo $_POST['stdt']; } else { echo date("Y-m-d"); } ?>">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustom02">To Date</label>
                                        <input type="date" name="expdt" class="form-control" id="datefilterto" data-date-split-input="true" value="<?php if(isset($_POST['expdt'])) { echo $_POST['expdt']; } else { echo date("Y-m-d"); } ?>"> 
                                    </div>                                    
                                
                                    <div class="col-md-4 mb-3">
                                        <br/>
                                    <input class="mb-2 mr-2 btn btn-primary" type="submit" name="submit" value="Search" onclick="javascript:btnOnclick();"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        echo '<div class="row">
          <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title"></h5>
                  <form>
                  <h6><b>Start Date :</b> <label id="stdtLabel">'; if(isset($_POST['stdt'])) { echo date('d-M-Y', strtotime($_POST["stdt"])); } else { echo date("d-M-Y"); } echo '</label></h6>
                  <h6><b>End Date  :</b> <label id="enddtLabel">'; if(isset($_POST['expdt'])) { echo date('d-M-Y', strtotime($_POST["expdt"])); } else { echo date("d-M-Y"); } echo '</label></h6>
                    <div class="table_Div" id="table_Div_id">            
                        <div class="table-responsive">';
                        $projects = array();
                        $records = mysqli_query($conn, "SET sql_mode = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");     
                        //$records = mysqli_query($conn, "SELECT * FROM `msd_register_comp_agent_table` WHERE `status` != 2;");
                        $records = mysqli_query($conn, "SELECT `agent_id`, `agent_name`, `USER_BANK_NAME`,`USER_ACCOUNT_NO`,`USER_IFSC` FROM `msd_register_comp_agent_table` agent LEFT JOIN `msd_user_bankdtl_table` bank ON `ACCOUNT_HOLDER_NAME` = `agent_id` AND `TYPE` = 'agent' AND bank.`STATUS` != 2 WHERE agent.`status` != 2 ORDER BY `agent_id`;");
 
                        while ($project =  mysqli_fetch_assoc($records))
                        {
                            $projects[] = $project;
                        }
                        $i =0;                                   
                                echo '<div id="table-wrapper">            
                                        <div id="table-scroll">
                                            <table id="tblData" class="mb-0 table table-bordered" style="width:100%;" >
                                            <thead>
                                            <tr>
                                            <th>Sr.No.</th>
                                            <th>Partner ID</th>
                                            <th>Partner Name</th>
                                            <th>Bank Name</th>
                                            <th>Acc. No.</th>
                                            <th>IFSC</th>
                                            <th>Total Profit</th>
                                            </tr>
                                            </thead>
                                            <tbody>';
                                           
                                    foreach ($projects as $project)
                                    {
                                        $profit =0.00;
                                        $queryProfit = mysqli_query($conn, "SET sql_mode = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");     
                                        
                                        if(isset($_POST['submit'])){
                                            //$queryProfit = mysqli_query($conn,"SELECT PROFIT.`userid` id, SUM(PROFIT.`cust_profit_amount`) profit_amt FROM `msd_profit_table` PROFIT WHERE PROFIT.`userid` = '". $project["id"]."' AND `plan_id` = '". $project["plan"]."' AND PROFIT.`status` != 2 AND Date_Format(`date`,'%Y-%m-%d') BETWEEN '".$_POST['stdt']."' AND '".$_POST['expdt']."'");
                                            $queryProfit = mysqli_query($conn,"SELECT SUM(PROFIT.amt) AS profit FROM (SELECT *, `agent_profit_amount` amt FROM `msd_profit_table` WHERE `admin_id` = '".$project["agent_id"]."' UNION SELECT *, `agent_profit_amount2` amt FROM `msd_profit_table` WHERE `agent_id2` = '".$project["agent_id"]."' UNION SELECT *, `agent_profit_amount3` AS amt FROM `msd_profit_table` WHERE `agent_id3` = '".$project["agent_id"]."' UNION SELECT *, `agent_profit_amount4` AS amt FROM `msd_profit_table` WHERE `agent_id4` = '".$project["agent_id"]."' UNION SELECT *, `agent_profit_amount5` AS amt FROM `msd_profit_table` WHERE `agent_id5` = '".$project["agent_id"]."' UNION SELECT *, `agent_profit_amount6` AS amt FROM `msd_profit_table` WHERE `agent_id6` = '".$project["agent_id"]."') PROFIT WHERE `status` != 2 AND Date_Format(PROFIT.`date`,'%Y-%m-%d') BETWEEN '".$_POST['stdt']."' AND '".$_POST['expdt']."'");
                                        } else {
                                            $queryProfit = mysqli_query($conn, "SELECT SUM(PROFIT.amt) AS profit FROM (SELECT *, `agent_profit_amount` amt FROM `msd_profit_table` WHERE `admin_id` = '".$project["agent_id"]."' UNION SELECT *, `agent_profit_amount2` amt FROM `msd_profit_table` WHERE `agent_id2` = '".$project["agent_id"]."' UNION SELECT *, `agent_profit_amount3` AS amt FROM `msd_profit_table` WHERE `agent_id3` = '".$project["agent_id"]."' UNION SELECT *, `agent_profit_amount4` AS amt FROM `msd_profit_table` WHERE `agent_id4` = '".$project["agent_id"]."' UNION SELECT *, `agent_profit_amount5` AS amt FROM `msd_profit_table` WHERE `agent_id5` = '".$project["agent_id"]."' UNION SELECT *, `agent_profit_amount6` AS amt FROM `msd_profit_table` WHERE `agent_id6` = '".$project["agent_id"]."') PROFIT WHERE `status` != 2");
                                        }
                                        //+(PROFIT.`cust_profit_amount`*3)
                                        $profitdtl_array = mysqli_fetch_assoc($queryProfit);
                                        if(isset($profitdtl_array)){
                                            if ($profitdtl_array["profit"]) {
                                                    $profit = $profitdtl_array["profit"];
                                            }
                                        } 
                                        echo '<tr>
                                        <td>'.++$i.'</td>
                                        <td>'.$project["agent_id"].'</td>
                                        <td style="text-align: left;">'.$project["agent_name"].'</td>
                                        <td style="text-align: left;">'.$project["USER_BANK_NAME"].'</td>
                                        <td>'."'".$project["USER_ACCOUNT_NO"].'</td>
                                        <td>'.$project["USER_IFSC"].'</td>
                                        <td style="text-align: right;">'.$profit.'</td>
                                        </tr>';
                                    }
                                    echo '</tbody>                                    
                                    </table></div></div>
                                </p>
                            </div>
                        <div><form></div>
                    </div>
                </div>
            </div></div></div>';
        ?>
</div>

    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script>
        function btnOnclick() {
                document.getElementById("stdtLabel").innerHTML = $("#datefilterfrom").val();
                document.getElementById("enddtLabel").innerHTML = $("#datefilterto").val();
               
            //$("label.stdtlabel").innerHTML ($("#datefilterfrom").val());
            //$("label.enddtLabel").innerHTML ($("#datefilterto").val());
        }

        function ExportExcel(type, fn, dl) {
            var elt = document.getElementById('tblData');
            var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
            return dl ?
               XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
               XLSX.writeFile(wb, fn || ('Partners-Payout-Report.' + (type || 'xlsx')));
        }

    </script>
    
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