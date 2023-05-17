<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<?php 
      include 'header.php';
      include 'database.php';      
?>

<!doctype html>
<html lang="en">
<style>
    .switch {
      position: relative;
      display: block;
      vertical-align: top;
      width: 80px;
      height: 30px;
      padding: 3px;
      margin: 0 10px 10px 0;
      background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
      background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
      border-radius: 18px;
      box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
      cursor: pointer;
    }
    .switch-input {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
    }
    .switch-label {
      position: relative;
      display: block;
      height: inherit;
      font-size: 10px;
      text-transform: uppercase;
      background: #eceeef;
      border-radius: inherit;
      box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
    }
    .switch-label:before, .switch-label:after {
      position: absolute;
      top: 50%;
      margin-top: -.5em;
      line-height: 1;
      -webkit-transition: inherit;
      -moz-transition: inherit;
      -o-transition: inherit;
      transition: inherit;
    }
    .switch-label:before {
      content: attr(data-off);
      right: 11px;
      color: #aaaaaa;
      text-shadow: 0 1px rgba(255, 255, 255, 0.5);
    }
    .switch-label:after {
      content: attr(data-on);
      left: 11px;
      color: #FFFFFF;
      text-shadow: 0 1px rgba(0, 0, 0, 0.2);
      opacity: 0;
    }
    .switch-input:checked ~ .switch-label {
   	  background: #3f6ad8;
      box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
    }
    .switch-input:checked ~ .switch-label:before {
      opacity: 0;
    }
    .switch-input:checked ~ .switch-label:after {
      opacity: 1;
    }
    .switch-handle {
      position: absolute;
      top: 4px;
      left: 4px;
      width: 28px;
      height: 28px;
      background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
      background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
      border-radius: 100%;
      box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
    }
    .switch-handle:before {
      content: "";
      position: absolute;
      top: 50%;
      left: 50%;
      margin: -6px 0 0 -6px;
      width: 12px;
      height: 12px;
      background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
      background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
      border-radius: 6px;
      box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
    }
    .switch-input:checked ~ .switch-handle {
      left: 48px;
      box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
    }
    /* Transition
        ========================== */
    .switch-label, .switch-handle {
      transition: All 0.3s ease;
      -webkit-transition: All 0.3s ease;
      -moz-transition: All 0.3s ease;
      -o-transition: All 0.3s ease;
    }
    
</style>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Plan Edit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">

</head>
<body>
    <div class="app-main__outer">
         <div class="app-main__inner">
         <?php if ($_SESSION['ROLE'] == "admin") { ?>
            <div class="app-page-title" style="padding: 10px;">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                        <i class="fa fa-table" aria-hidden="true" ></i>
                        </div>
                        <div>Plan Edit
                            <div class="page-title-subheading"> </div>
                        </div>
                    </div>
                
                    <div class="page-title-actions" id="divBtnAdd">
                        <div class="d-inline-block dropdown btn mr-2 mb-2 btn-primary">
                           <a href="master_addPlan"  style="color: white;">
                           <i class="fa fa-plus" aria-hidden="true" ></i>
                           </a>
                        </div>
                    </div>
                  </div>
                </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body"><h5 class="card-title"></h5>
                                <form class="" method="get" action="">
                                <div class="table-responsive">
                                  <input type="hidden" id="hdnID" name="hdnName" >
                                  <?php
                                      if($_SESSION['ROLE'] == "admin") {
                                        $query = "SELECT * FROM `msd_customer_plan_table` WHERE status != 2";
                                      } else {
                                        $query = "SELECT plan.* FROM `msd_customer_plan_table` plan LEFT JOIN `msd_register_customer_table` ON `customer_id` = `register_id` AND `register_status` != 2 AND `register_approved_status` = 'approved' WHERE status != 2 AND `reference_id` = '".$_SESSION['USERID']."';";
                                      }
                                          
                                        $i = 0;
                                        echo '<table id="table_Id" class="mb-0 table table-bordered">
                                                <thead>
                                                <tr>
                                                <th>Sr. No.</th>
                                                <th>Plan ID</th>
                                                <th>Plan Name</th>
                                                <th>Customer Name</th>
                                                <th>Deposit Amount</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Percentage Return</th>
                                                <th>Action</th>
                                                <th>Aggrement And Cheque</th>
                                                </tr>
                                                </thead>
                                                <tbody>';
                                        if ($result = $conn->query($query)) {
                                                    while ($row = $result->fetch_assoc()) {

                                                        $plan_id = $row["plan_id"];
                                                        $plan_name = $row["plan_name"];
                                                        $customer_id = $row["customer_id"];
                                                        $customer_name = $row["customer_name"];
                                                        $deposit_amt = $row["deposit_amt"];
                                                        $start_date = $row["start_date"];
                                                        $end_date = $row["end_date"];
                                                        $perc_return = $row["perc_return"];
                                                        $princ_perc = $row["princ_perc"];
                                                        $active_status= $row["active_status"];
                                                        echo'<tr>
                                                        <td>'.++$i.'</td>
                                                        <td>'.$plan_id.'</td>
                                                        <td>'.$plan_name.'</td>
                                                        <td>'.$customer_id.'~'.$customer_name.'</td>
                                                        <td>'.$deposit_amt.'</td>
                                                        <td>'.$start_date.'</td>
                                                        <td>'.$end_date.'</td>
                                                        <td>'.$perc_return.'</td>
                                                        <td>';
                                                        if($active_status == "active") {
                                                           echo '<a href="" data-id="'.$row['plan_id'].'" name="edit_name" class="btn btn-info edit" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-edit" aria-hidden="true" title="Edit Profile"></i> </a>';
                                                        } else if($active_status == "inactive")  {
                                                           echo '<a href="" data-id="'.$row['plan_id'].'" name="edit_name" class="btn btn-info edit" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-edit" aria-hidden="true" title="Edit Profile"></i> </a>';
                                                        } else if($active_status == "expired")  {
                                                           echo '<label style="font-family: auto;color: red;">Expired</label>';
                                                        }
                                                        echo '</td>
                                                              <td style="text-align: center;">
                                                                <a href="master_addAgreement?id='.base64_encode($customer_id).'&plan_id='.base64_encode($plan_id).'" class="btn btn-transition btn-sm btn-outline-info" >Add</a>
                                                              </td>
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
                     <script>
                       $('.edit').click(function() {
                            var id = $(this).attr('data-id');
                            $.ajax({url:"master_plan_db.php?ajaxplanid="+id,cache:false,success:function(result){
                                $(".modal-body").html(result);
                            }});
                        });
                        
                        $("#chkActive").click(function () {
                            if ($(this).is(":checked")) {
                                $("#chkVal").val("active");
                            } else {
                                $("#chkVal").val("inactive");
                            }
                        });
                       
                    </script> 
    </body>
</html>
<?php
include "footer.php";
?>
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
<!-- Small modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    
            </div>
        </div>
    </div>
</div>

