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
    <title>Allocate Customer Offers</title>
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
                        <i class="fa fa-gift" aria-hidden="true" ></i>
                        </div>
                        <div>Allocate Customer Offers
                            <div class="page-title-subheading"> </div>
                        </div>
                    </div>
                
                    <div class="page-title-actions" id="divBtnAdd">
                        <div class="d-inline-block dropdown btn mr-2 mb-2 btn-primary">
                           <a href="master_addAllocateOffer"  style="color: white;">
                                Create Customer Offers
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
                                      //$query = "SELECT `customer_name` id, CONCAT(`customer_name`,' - ',`register_fname`,' ', `register_lname`) AS name, allo.`offer_name` AS offer_id, plan.`offer_name` AS offer_name, `offer_description`, `start_date`, `end_date`,`offer_status` FROM `msd_allocate_offer_table` allo LEFT JOIN `msd_register_customer_table` ON `customer_name` = `register_id` AND `register_approved_status` = 'approved' AND `register_status` != 2 INNER JOIN `msd_offer_table` plan ON allo.`offer_name` = `offer_id` AND plan.`status` != 2 WHERE allo.`status` != 2";
                                      $query = "SELECT allo.`customer_name` AS customer_id, CONCAT(`customer_name`,' - ',`register_fname`,' ', `register_lname`) AS cust_name, allo.`offer_name` AS offer_id, plan.`offer_name` AS offer_name, `offer_description`, `start_date`, `end_date`,`offer_status`, allo.`id` FROM `msd_allocate_offer_table`  allo LEFT JOIN `msd_register_customer_table` ON `customer_name` = `register_id` AND `register_approved_status` = 'approved' AND `register_status` != 2 LEFT JOIN `msd_offer_table` plan ON allo.`offer_name` = `offer_id` AND plan.`status` != 2 WHERE allo.`status` != 2";
                                    } else {
                                      $query = "SELECT plan.* FROM `msd_plan_table` plan LEFT JOIN `msd_register_customer_table` ON `customer_id` = `register_id` AND `register_status` != 2 AND `register_approved_status` = 'approved' WHERE status != 2 AND `reference_id` = '".$_SESSION['USERID']."';";
                                    }
                                        
                                        $i = 0;
                                        echo '<table id="table_Id" class="mb-0 table table-bordered">
                                                <thead>
                                                <tr>
                                                <th>Sr. No.</th>
                                                <th style="display:none">ID</th>
                                                <th>Customer Name</th>
                                                <th>Offer Name</th>
                                                <th>Offer Description</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Offer Status</th>
                                                <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>';
                                            if ($result = $conn->query($query)) {
                                              while ($row = $result->fetch_assoc()) {
                                                        $id = $row["id"];
                                                        $customer_id = $row["customer_id"];
                                                        $customer_name = $row["cust_name"];
                                                        $offer_id = $row["offer_id"];
                                                        $Offer_name = $row["offer_name"];
                                                        $offer_description = $row["offer_description"];
                                                        $start_date = $row["start_date"];
                                                        $end_date = $row["end_date"];
                                                        $off_stat = $row["offer_status"];
                                                       echo'<tr>
                                                       <td>'.++$i.'</td>
                                                       <td style="display:none">'.$id.'</td>
                                                       <td>'.$customer_name.'</td>
                                                       <td>'.$offer_id." - ".$Offer_name.'</td>
                                                       <td>'.$offer_description.'</td>
                                                       <td>'.$start_date.'</td>
                                                       <td>'.$end_date.'</td>
                                                       <td>';
                                              
                                                        if($off_stat == "used") {
                                                          echo '<div class="badge badge-info">Used</div>';
                                                         } else if($off_stat == "valid")  {  
                                                             echo '<div class="badge badge-success">Valid</div>';
                                                         } else if($off_stat == "rejected")  {
                                                             echo '<div class="badge badge-danger">Rejected</div>';
                                                         }
                                                         echo '</td><td>';
                                                         if($off_stat != "used") {
                                                          echo '<a href="" data-id="'.$id.'" name="edit_name" class="btn btn-info edit" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit" aria-hidden="true" title="Edit Profile"></i> </a>';
                                                          echo '&nbsp;<a href="" data-id="'.$id.'" name="delete_name" class="btn btn-danger delete" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash" aria-hidden="true" title="Delete Profile"></i> </a>';
                                                         } else {
                                                          echo '<label class="badge badge-light">Used</label>';
                                                         }
                                                        echo '</td>';
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
                 $('.edit').click(function() {
                      var id = $(this).attr('data-id');
                      $.ajax({url:"master_offer_db.php?ajaxoffer_id="+id,
                          cache:false,
                          success:function(result){
                          $(".modal-body").html(result);
                      }});
                  }); 
                  
                  
                  
              </script> 
              <script>
                  $('.delete').click(function() {
                    $(".modal-body1").html();
                      var id = $(this).attr('data-id');
                      $("#id").val(id);
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
                                <img  src="assets/images/404-error.jpg" alt="mytt"  style="width:100%;"/>
                            </div>
                        <!-- </div> -->
                    </div>                                
                </div>
            </div>
        </body>
    </html>
    <?php } ?> 
<!-- Small modal -->

  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit offers</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                      
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="deleteModalLabel">Delete offers</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body1" style="text-align: center;">
                <form method="POST" action="master_offer_db.php">
                    <h1>Delete Account</h1>
                    <p>Are you sure you want to delete your Offer?</p>
                    <input type="hidden" id="id" name="id" />    
                    <button class="btn btn-danger btnAlloDelete" id="btnAlloDelete" name="btnAlloDelete" type="submit" >Delete</button>
                </form>
              </div>
          </div>
      </div>
  </div>

