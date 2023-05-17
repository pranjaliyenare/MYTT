<link href="./main.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php
include 'header.php';
include 'database.php';

  $userid = $_SESSION["USERID"];
  $user_id = base64_decode($_GET['id']);
  $query = mysqli_query($conn, "SELECT * FROM `msd_register_customer_table` WHERE `register_id` = '".$user_id."' AND `register_status` != 2");
  $my_id_array=mysqli_fetch_assoc($query);
  $reg =$my_id_array['register_id'];
  $name= $my_id_array['register_fname']." ".$my_id_array['register_lname'];
  $email =$my_id_array['register_email'];
  $mobno =$my_id_array['register_mobno'];
  $addr =$my_id_array['register_addr1'];
  $city =$my_id_array['register_city'];
  $state =$my_id_array['register_state'];
  $pincode =$my_id_array['register_pincode'];

?>
<?php
    if(isset($_POST['submit'])) {  

        $uploadPath = 'Transaction/';
              if(!empty($_FILES['file']['name'])) {
                  if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath.date('d-m-Y')."trans".$_POST['user_id'].$_FILES['file']['name'])) {
                      //echo '<script> alert("File has been uploaded successfully."); </script>';
                  } else {
                      //echo '<script> alert("File upload failed, please try again."); </script>';
                  }
              }

              if($_FILES['file']['name']) {
                  $profile = date('d-m-Y')."trans".$_POST['user_id'].$_FILES['file']['name'];            
              } else {
                  $profile = "";
              }

        $query= "INSERT INTO `msd_transaction_payment_table`(`user_id`, `name`, `plan_id`, `amount`, `pay_type`, `transaction_id`, `description`, `image`, `payment_by`, `approve_status`) VALUES ('".$_POST['user_id']."','".$_POST['name']."','".$_POST['plan_id']."','".$_POST['amount']."','".$_POST['radio2']."','". $_POST['transaction_id']."','".$_POST['description']."','".$profile."','".$_SESSION["USERID"]."','not approved')";
        $result = $conn->query($query);
        
        if($result)
        {
            echo "<script>alert('Payment Submitted Successfully')</script>";
            echo "<script>window.location = 'payment';</script>";
        }
        else
        {
            echo "<script>alert('Your Data Not Save!!')</script>";
        }            
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Offline Payment.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">
    
<link href="./main.css" rel="stylesheet"></head>
<style>
    @media all and (min-width: 481px) and (max-width: 2000px) {
        .form-control {
            width: 50%;
        }
    }
    label {
        font-weight: bold;
    }
</style>
<body>
    
         <div class="app-main__outer">
             <div class="app-main__inner">
                    <?php if($_SESSION["ROLE"] == "admin") { ?>
                 <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon ">
                                        <i class="fa fa-credit-card" aria-hidden="true" ></i>
                                    </div>
                                    Add Offline Payment   
                                </div>
                            </div>          
                 </div>          
                 <div class="tab-content">
                     <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title"></h5>
                                         
                                        <form class="" method="POST" enctype="multipart/form-data" id="uploadForm">
                                            <div class="position-relative row form-group"><label for="lblname" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <label name="lblname" ><?php echo $name ?></label>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group" style="display:none;"><label for="name" class="col-sm-2 col-form-label">*Name</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="name" type="text" value="<?php echo $name ?>"  readonly/>
                                                </div>
                                            </div> 
                                            <div class="position-relative row form-group"><label for="user_id" class="col-sm-2 col-form-label">*User ID</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="user_id" type="text" value="<?php echo $user_id ?>" required readonly/>
                                                </div>
                                            </div>        
                                            <div class="position-relative row form-group"><label for="trd_date_id" class="col-sm-2 col-form-label">Date</label>
                                                    <div class="col-sm-10"><input name="date" id="trd_date_id"  type="datetime-local" class="form-control" value="<?php echo date('Y-m-d'); ?>" required></div>
                                            </div>                                    
                                            <div class="position-relative row form-group"><label for="plan_id" class="col-sm-2 col-form-label">Plan</label>
                                                <div class="col-sm-10">
                                                   <select class="mb-2 form-control" name="plan_id" id="plan_id" required>
                                                      <!-- <option value="0">Select...</option> -->
                                                      <?php 
                                                            $sql = mysqli_query($conn, "SELECT * FROM `msd_customer_plan_table` WHERE `customer_id` ='".$user_id."' AND `active_status`='active' AND `status`!=2 ORDER BY id DESC");
                                                            $row = mysqli_num_rows($sql);
                                                            while ($row = mysqli_fetch_array($sql)) {
                                                                $d1 = strtotime($row['start_date']);
                                                                $d2 = strtotime(date('Y-m-d'));
                                                                $day_diff = $d2 - $d1;
                                                                $day_cnt = round($day_diff/(60*60*24));
                                                                if ($day_cnt <= 8) {
                                                                    echo "<option value='". $row['plan_id'] ."'>". $row['plan_name'] . "~" .$row['plan_id'] ."</option>" ;
                                                                }
                                                            }   
                                                      ?>
                                                   </select>
                                                </div>
                                            </div>
                                            
                                            <div class="position-relative row form-group"><label for="amount" class="col-sm-2 col-form-label" >*Amount</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="amount" type="number" required/>
                                                </div>
                                            </div>
                                            <div class="position-relative form-group"><div id="display"></div></div>
                                            <div class="position-relative form-group"><label for="receiptno_id" class="">Payment Type</label>
                                                <div class="position-relative form-check">
                                                    <div class="position-relative form-check form-check-inline"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="cash" checked >Cash</label></div>
                                                    <div class="position-relative form-check form-check-inline"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="upi" checked >UPI</label></div>
                                                    <div class="position-relative form-check form-check-inline"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="cheque">Cheque</label></div>
                                                    <div class="position-relative form-check form-check-inline"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" value="neft"> NEFT/IMPS</label></div>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group" ><label for="transaction_id" class="col-sm-2 col-form-label">Transaction Id</label>
                                                <div class="col-sm-10">
                                                    <input name="transaction_id" id="transaction_id" placeholder="Enter Transaction Id" style="text-transform:uppercase" type="text" class="form-control" required>
                                                </div>
                                            </div>           
                                            <div class="position-relative row form-group"><label for="description" class="col-sm-2 col-form-label">*Description</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" name="description" type="text" ></textarea>
                                                </div>
                                            </div>    
                                            <div class="position-relative row form-group"><label for="file" class="col-sm-2 col-form-label">*Upload Image</label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control" name="file" id="file" accept="image/x-png,image/gif,image/jpeg"/>
                                                </div>
                                            </div>                                        
                                                <button class="btn btn-info" type="submit" name="submit" >Submit</button>
                                                <input type="button" onclick="window.location = 'payment';" class="btn btn-secondary" name="close_name" value="Close"/>                                                
                                           </div>
                                        </form>
                                   </div>
                               </div>
                           </div>
                        </div>
                    </div>
                </div> 
    <script>
        $("#file").change(function () {
            filePreview(this);
        });
        $('#uploadForm + embed').remove();
        $('#uploadForm').after('<embed src="'+e.target.result+'" width="450" height="300">');

        function filePreview(input) {
             
            if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#uploadForm + img').remove();
                $('#uploadForm').after('<img src="'+e.target.result+'" width="200" height="200"/>');
            };
            reader.readAsDataURL(input.files[0]);
            }
        }
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
