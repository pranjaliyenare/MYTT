<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; ?>
<?php include 'database.php'; ?>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>User Approval</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
        <meta name="msapplication-tap-highlight" content="no">
        <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->


    </head>
    <body>
            <div class="app-main__outer">
                    <div class="app-main__inner">
                        <?php  if($_SESSION['ROLE'] == "admin") { ?>
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                    <!-- <i class="fa fa-fw" aria-hidden="true" ></i> -->
                                    <i class="fa fa-check-circle" aria-hidden="true" ></i>
                                    </div>
                                    <div>User Approval
                                        <div class="page-title-subheading"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title"></h5>
                                    <!-- <form class="" method="post" action="master_approval_db"> -->
                                    <div class="table-responsive">
                                    <?php
                                        if($_SESSION['ROLE'] == 'admin'){
                                            $query = 'SELECT `register_id`, concat(`register_fname`," ",`register_lname`) AS name, concat(`register_addr1`,", ",`register_addr2`,", ",`register_city`,", ",`register_state`,", ",`register_pincode`,", ",`register_country`) AS address, `register_mobno`, `register_email`, `register_approved_status` AS status, `register_activate_status`, comment, `agent_login_id`, `agent_login_checked`, `date` FROM `msd_register_customer_table` WHERE `register_status` !=2 ORDER BY `msd_register_customer_table`.`date` DESC';
                                        } else {
                                            $query = 'SELECT `register_id`, concat(`register_fname`," ",`register_lname`) AS name, concat(`register_addr1`,", ",`register_addr2`,", ",`register_city`,", ",`register_state`,", ",`register_pincode`,", ",`register_country`) AS address, `register_mobno`, `register_email`, `register_approved_status` AS status, register_activate_status, comment, agent_login_id, agent_login_checked, `date` FROM `msd_register_customer_table` WHERE `register_status` !=2 AND `reference_id` = "'.$_SESSION['USERID'].'" ORDER BY `msd_register_customer_table`.`date` DESC';
                                        }
                                        $i = 0;
                                            echo '<table id="myTable" class="mb-0 table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Sr. No.</th>
                                                        <th>ID</th>
                                                        <th>User Name</th>
                                                        <th>Address</th>
                                                        <th>Mobile Number</th>
                                                        <th>Email</th>
                                                        <th>Add Comment</th>
                                                        <th></th>
                                                        <th>Approval</th>
                                                        <th>Activated</th>
                                                        <th>Promote As Partner</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>';
                                                if ($result = $conn->query($query)) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            //$field1name = echo ++$i;
                                                            $register_id = $row["register_id"];
                                                            $name = $row["name"];
                                                            $address = $row["address"];
                                                            $register_mobno = $row["register_mobno"];
                                                            $register_email = $row["register_email"];
                                                            $status = $row["status"];
                                                            $comment = $row["comment"];
                                                            $activate = $row["register_activate_status"];
                                                            $agent_login_checked = $row["agent_login_checked"];
                                                    echo'<tr>
                                                    <td>'.++$i.'</td>
                                                    <td>'.$register_id.'</td>
                                                    <td>'.$name.'</td>
                                                    <td>'.$address.'</td>
                                                    <td>'.$register_mobno.'</td>
                                                    <td>'.$register_email.'</td>
                                                    <td id="tdedit" onfocusout="javascript:tdOnchange();" contenteditable="true">'.$comment.'</td>
                                                    <td><a href="master_user_kyc?id='.base64_encode($register_id).'&path='.base64_encode('master_user_approval').'"" class="btn btn-success">Check KYC</a></td>
                                                    <td>';

                                                    if($status == "not approved") {
                                                    echo '<a href="master_approval_db?mode=approved&id='.$register_id.'" style="color: mediumseagreen;"> <i class="fa-2x fa fa-check" style="font-size:24px"></i> </a> <a href="master_approval_db?mode=rejected&id='.$register_id.'" style="color: red;"> <i class="fa-2x fa fa-close" style="font-size:24px"></i></a>';
                                                    } else if($status == "approved")  {
                                                        echo '<a href="master_approval_db?mode=rejected&id='.$register_id.'" style="color: red;"> <i class="fa-2x fa fa-close" style="font-size:24px"></i></a>';
                                                    } else if($status == "rejected")  {
                                                            echo '<a href="master_approval_db?mode=approved&id='.$register_id.'" style="color: mediumseagreen;"> <i class="fa-2x fa fa-check" style="font-size:24px"></i> </a> <lable style="color: red;">Rejected</lable>';
                                                    }
                                                    echo '</td>
                                                    <td>';

                                                    if($activate == "deactivate") {
                                                    echo '<a href="master_approval_db?mode=activate&id='.$register_id.'" class="btn btn-success">activate </a>';
                                                    } else  {
                                                    echo '<a href="master_approval_db?mode=deactivate&id='.$register_id.'" class="btn btn-danger">deactivate</a>';
                                                    }
                                                    echo '</td><td>';
                                                        if($agent_login_checked == 'YES') {
                                                            echo '<a href="master_approval_db?mode=addAgentNo&id='.$register_id.'" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-danger">NO </a>';
                                                        } else {
                                                            echo '<a href="master_approval_db?mode=addAgentYes&id='.$register_id.'" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-success">YES</a>';
                                                        }
                                                    
                                                    echo' </td></tr>';

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
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>
        // function chkClick() {
        //     var table = document.getElementById('myTable');
        //     var jsonChkArr = [];
        //     for(var i =0,row;row = table.tBodies[0].rows[i];i++){
        //        var col = row.cells;
        //        var jsonObjChk = {
        //            id : col[1].innerHTML,
        //            name : col[2].innerHTML,
        //            address : col[3].innerHTML,
        //            mob : col[4].innerHTML,
        //            email : col[6].innerHTML,
        //            chkvalue : 'YES',
        //          }             
        //          jsonChkArr.push(jsonObjChk);             
        //     }
        //   console.log(jsonChkArr);
        //     $.ajax({
        //             type: "GET",
        //             url: "master_approval_db.php",
        //             dataType: 'Json_chk',
        //             data: {'Json_chk_comment':jsonChkArr},
        //             success: function(data) {
        //                 $.each(data, function(result) {
        //                     //$("#tdedit").html(result);
        //                 });
        //             }
                
        //     });
        // }
        
        function tdOnchange() {
        
            var table = document.getElementById('myTable');
            var jsonArr = [];
            for(var i =0,row;row = table.tBodies[0].rows[i];i++){
               var col = row.cells;
               var jsonObj = {
                   id : col[1].innerHTML,
                   comment : col[6].innerHTML
                 }             
              jsonArr.push(jsonObj);             
            }
          //console.log(jsonArr);
            $.ajax({
                    type: "POST",
                    url: "master_approval_db.php",
                    //dataType: 'Json',
                    data: {'json_comment':jsonArr},
                    success: function(data) {
                        $.each(data, function(result) {
                            //console.log(result);
                        });
                    }               
                });        
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