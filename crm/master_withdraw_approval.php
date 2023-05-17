<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; 
      include 'database.php';

      if (isset($_POST['btnapprove'])) {
        //if(count($_POST)>0) {
        date_default_timezone_set('Asia/Kolkata');
        mysqli_query($conn,"UPDATE `msd_transaction_withdraw_table` SET `approve_status`= 'approved', `approve_date` = '".date('Y-m-d H:i:s', strtotime($_POST['apprv_date']))."' WHERE `withdraw_id`='" .$_POST['id']. "'");
          
        if ($_POST['type'] == 'customer') {    
          $query = mysqli_query($conn, 'SELECT `user_id` AS id, `amount`, concat(`register_fname`," ", `register_lname`) AS name, `register_email` AS email, `msd_transaction_withdraw_table`.`date` AS approvedate FROM `msd_transaction_withdraw_table` LEFT JOIN `msd_register_customer_table` ON `register_id` = `user_id` WHERE `withdraw_id` = "'. $_POST['id'].'" AND `register_status` !=2');
          $my_id_array=mysqli_fetch_assoc($query);
          $id=$my_id_array['id']; 
          $name=$my_id_array['name'];
          $email=$my_id_array['email'];
          $date=date('d/m/Y H:i:s', strtotime($my_id_array['approvedate']));
          $amount= $my_id_array['amount'];
        } else if($_POST['type'] == 'agent') {
          $query = mysqli_query($conn, 'SELECT `user_id` AS id, `amount`, concat(agent_id, "-", agent_name) AS name, `agent_email` AS email, `msd_transaction_withdraw_table`.date AS approvedate FROM `msd_transaction_withdraw_table` LEFT JOIN `msd_register_comp_agent_table` ON `agent_id` = `user_id` WHERE `withdraw_id` = "'. $_POST['id'].'" AND `msd_register_comp_agent_table`.`status` !=2');
          $my_id_array=mysqli_fetch_assoc($query);
          $id=$my_id_array['id']; 
          $name=$my_id_array['name'];
          $email=$my_id_array['email'];
         $date=date('d/m/Y H:i:s', strtotime($my_id_array['approvedate']));
         $amount= $my_id_array['amount']; 
      }
        $notf_query = "INSERT INTO `msd_notification_table`(`user_id`, `comment_subject`, `comment_text`, `comment_type`, `start_date`) VALUES ('".$id."','MYTT-Withdraw','<b>Hello ". $name.",</b> <br/> Your Withdrawal Amount INR <b> ". $amount." </b> has been Successfully Processed On Date <b>". date("d/m/Y")."</b>','withdraw', '".date('Y-m-d')."')";
        $result2 = $conn->query($notf_query);
    // Send User Approval Email
    $to = strtolower($email);
    $subject = "MyThink Tank Withdraw Approved!";    
    $message = "<html>
               <head>
                    <title>Welcome to MyThink Tank !</title>                
                </head>
                <body>
                <div> <img src='https://crm.mytt.in/assets/images/logo.png' alt='MYTT' style='width: 80px; height: 80px;'>
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <b>".date("l jS \ F Y") ." </b></div>
                    <p><b>Dear ". $name.", </b></p>
                <p>Your Withdrawal Request For ₹ ".$amount." on date ".$date." has been Approved. </p>
                <p>Within 24hr Your Amount Transferred to your bank account.</p>                
              
                <p>For Any Questions you may have, do not hesitate to contact the MyThink Tank Support Team,</p>
                <p><b>Email</b>- support@mytt.in</p>
                <p><b>Website</b>- <u>www.mytt.in</u></p>
                 </body>
                </html>";
      
                $header = "From:info@mytt.in \r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
      
        $retval = mail($to,$subject,$message,$header);
    
         if( $retval == true ) {
            //echo "Message sent successfully...";
         }else {
            //echo "Message could not be sent...";
         }
         $query="INSERT INTO `msd_rej_appr_mail_table`(`user_id`, `to`, `from`, `subject`, `message`, `type`) VALUES ('".$id."','".$to."', 'info@mytt.in', '".$subject."', '".$message."', 'withdraw approved')";
         $result = $conn->query($query);
         echo "<script>window.location = 'master_withdraw_approval';</script>";
       
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
    <title>Withdraw Approval</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">

<link href="./main.css" rel="stylesheet"></head>
<body>
                <div class="app-main__outer">
                    <div class="app-main__inner">
                    <?php if ($_SESSION['ROLE'] == "admin") { ?>
                        <div class="app-page-title" style="padding: 10px;">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                    <i class="fa fa-check-circle" aria-hidden="true" ></i>
                                    </div>
                                    <div>Withdraw Approval
                                        <div class="page-title-subheading">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title"></h5>

                                    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                                            <li class="nav-item">
                                                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                                                    <span>Partner</span>
                                                </a>
                                            </li>
                                            
                                            <li class="nav-item">
                                                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                                                    <span>Customer</span>
                                                </a>
                                            </li>
                                    </ul>

                            <div class="tab-content">                        
                                <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body"><h5 class="card-title">Partner Details</h5>
                                            <form class="">
                                            <div class="table-responsive">
                                            <?php
                                            if ($_SESSION['ROLE'] == "admin") {
                                                $query = 'SELECT withdraw_id, concat(agent_id, "-", agent_name) as user_id, bank_id, amount, msd_transaction_withdraw_table.comment AS comment, approve_status FROM `msd_transaction_withdraw_table` INNER JOIN `msd_register_comp_agent_table` ON `agent_id` = `user_id` WHERE `type`= "agent" AND `msd_register_comp_agent_table`.status != 2 ORDER BY `msd_transaction_withdraw_table`.`withdraw_id` DESC';
                                            } else {
                                                $query = '';
                                            }
                                            echo '<table id="myTable" class="mb-0 table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>User Name</th>
                                                    <th>Bank Name</th>
                                                    <th>Amount</th>
                                                    <th>Add Comment</th>
                                                    <th>Approval</th>
                                                </tr>
                                                </thead>
                                                <tbody>';
                                        if ($result = $conn->query($query)) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $withdraw_id = $row["withdraw_id"];
                                                        $user_id = $row["user_id"];
                                                        $bank_id = $row["bank_id"];
                                                        $amount = $row["amount"];
                                                        $status = $row["approve_status"];
                                                        $comment = $row["comment"];
                                                echo'<tr>
                                                <td>'.$withdraw_id.'</td>
                                                <td>'.$user_id.'</td>
                                                <td>'.$bank_id.'</td>
                                                <td>'.$amount.'</td>
                                                <td id="tdedit" onfocusout="javascript:tdOnchange();" contenteditable="true">'.$comment.'</td>
                                                <td>';
                                                
                                                if($status == "not approved") {
                                                    echo '<a href="" data-id="'.$withdraw_id.'" style="color: mediumseagreen;" class="agent_approve" data-toggle="modal" data-target=".agent_approval_modal"><i class="fa-2x fa fa-check" style="font-size:24px"></i></a> <a href="master_approval_db?mode=wrejected&id='.$withdraw_id.'" style="color: red;"> <i class="fa-2x fa fa-close" style="font-size:24px"></i></a>';
                                                } else if($status == "approved")  {  
                                                    echo '<a href="master_approval_db?type=agent&mode=wrejected&id='.$withdraw_id.'" style="color: red;"><i class="fa-2x fa fa-close" style="font-size:24px"></i></a>';
                                                } else if($status == "rejected")  {
                                                    echo '<lable style="color: red;">Rejected</lable>';
                                                }
                                                echo '</td>
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

                                <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body"><h5 class="card-title">Customer Details</h5>
                                            <form class="">
                                            <div class="table-responsive">
                                                <?php
                                                    $query = 'SELECT withdraw_id, concat(user_id, "-", register_fname, " ", register_lname ) as user_id, bank_id, amount, msd_transaction_withdraw_table.comment AS comment, approve_status FROM `msd_transaction_withdraw_table` INNER JOIN `msd_register_customer_table` ON `register_id` = `user_id` WHERE  `type`= "customer" AND status != 2 ORDER BY `msd_transaction_withdraw_table`.`withdraw_id` DESC';
                                    
                                                    echo '<table id="myTable" class="mb-0 table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>User Name</th>
                                                                <th>Bank Name</th>
                                                                <th>Amount</th>
                                                                <th>Add Comment</th>
                                                                <th>Approval</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>';
                                                    if ($result = $conn->query($query)) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    $withdraw_id = $row["withdraw_id"];
                                                                    $user_id = $row["user_id"];
                                                                    $bank_id = $row["bank_id"];
                                                                    $amount = $row["amount"];
                                                                    $status = $row["approve_status"];
                                                                    $comment = $row["comment"];
                                                            echo'<tr>
                                                            <td>'.$withdraw_id.'</td>
                                                            <td>'.$user_id.'</td>
                                                            <td>'.$bank_id.'</td>
                                                            <td>'.$amount.'</td>
                                                            <td id="tdedit" onfocusout="javascript:tdOnchange();" contenteditable="true">'.$comment.'</td>
                                                            <td>';
                                                            
                                                            if($status == "not approved") {
                                                                echo '<a href="" data-id="'.$withdraw_id.'" style="color: mediumseagreen;" class="approve" data-toggle="modal" data-target=".approval_modal"><i class="fa-2x fa fa-check" style="font-size:24px"></i></a> <a href="master_approval_db?mode=wrejected&id='.$withdraw_id.'" style="color: red;"> <i class="fa-2x fa fa-close" style="font-size:24px"></i></a>';
                                                            } else if($status == "approved")  {  
                                                                echo '<a href="master_approval_db?type=customer&mode=wrejected&id='.$withdraw_id.'" style="color: red;"><i class="fa-2x fa fa-close" style="font-size:24px"></i></a>';
                                                            } else if($status == "rejected")  {
                                                                echo '<lable style="color: red;">Rejected</lable>';
                                                            }
                                                            echo '</td>
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
                </div>
                </div>
                </div>
                </div>            

        <script>

            function tdOnchange() {

            var table = document.getElementById('myTable');
            var jsonArr = [];
            for(var i =0,row;row = table.tBodies[0].rows[i];i++){
                var col = row.cells;
                var jsonObj = {
                    id : col[0].innerHTML,
                    comment : col[4].innerHTML
                    }

                jsonArr.push(jsonObj);
                
            }
            console.log(jsonArr);
                $.ajax({
                        type: "POST",
                        url: "master_approval_db.php",
                        dataType: 'Json',
                        data: {'json_comment_with':jsonArr},
                        success: function(data) {
                            $.each(data, function(result) {
                                //$("#tdedit").html(result);
                            });
                        }
                    
                });
            
            }

            $('.approve').click(function() {
                $(".modal-body").html();
                var id = $(this).attr('data-id');
                $(".id").val(id);
            });
            $('.agent_approve').click(function() {
                $("#modal-body1").html();
                var id = $(this).attr('data-id');
                $(".id").val(id);
            });
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

<div class="modal fade approval_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Customer Approve Withdraw</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="#">
                    <input type="hidden" id="id" class="id" name="id" />   
                    <input type="hidden" id="mode" class="mode" name="mode" value="wapproved"/>   
                    <input type="hidden" id="type" class="type" name="type" value="customer"/>   
                    <input type="datetime-local" id="apprv_date" class="form-control apprv_date" name="apprv_date" />   <br>
                    <button class="btn btn-success btnapprove" id="btnapprove" name="btnapprove" type="submit" >Approved</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade agent_approval_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Partner Approve Withdraw</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body1">
                <form method="POST" action="#">
                    <input type="hidden" id="id" class="id" name="id" />   
                    <input type="hidden" id="mode" class="mode" name="mode" value="wapproved"/>   
                    <input type="hidden" id="type" class="type" name="type" value="agent"/>   
                    <input type="datetime-local" id="apprv_date" class="form-control apprv_date" name="apprv_date" /> <br>
                    <button class="btn btn-success btnapprove" id="btnapprove" name="btnapprove" type="submit" >Approved</button>
                </form>
            </div>
        </div>
    </div>
</div>
