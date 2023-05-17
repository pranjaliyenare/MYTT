<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="./main.css" rel="stylesheet"></head>
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; 
      include 'database.php'; 
?>

<?php
    // if(isset($_POST['IFSC_name'])){
    //     $ifsc = $_POST['IFSC_name'];
    //     $json=@file_get_contents('https://ifsc.razorpay.com/'.$ifsc);
    //     $arr=json_decode($json);
    //     //if(isset($arr->BRANCH)){
    //         echo "Branch:-".$arr->BRANCH."<br/>";
    //     //}
    // }

     if(isset($_POST['submit_name'])) {
        $query="INSERT INTO `msd_comp_bank_dtl_table`(`Bank_Name`, `Branch`, `Account_Number`, `IFSC`, `Account_Holder_Name`) VALUES ('".$_POST['bankname_name']."','".$_POST['branch_name']."','".$_POST['accno_name']."','".$_POST['IFSC_name']."','".$_POST['accholdrname']."')";
        $result = $conn->query($query);
 
          if($result)
          {
             echo "<script>alert('Record Added Successfully')</script>";
             echo "<script>window.location = 'master_comp_accountdtl';</script>";
          }
          else
          {
             echo "<script>alert('Record Not Added Successfully')</script>";
             echo "<script>window.location = 'master_comp_accountdtl';</script>";
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
    <title>Bank Account Details.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">


<body>
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title" style="padding: 10px;">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                        <i class="fa fa-bank" aria-hidden="true"></i>
                            </i>
                        </div>
                        <div>Account Details
                            <div class="page-title-subheading">
                            </div>
                        </div>
                    </div>

                    <div class="page-title-actions">
                        <div class="d-inline-block dropdown">
                        
                        <?php if($_SESSION['ROLE'] == 'admin'){
                            echo '<button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal">Add Bank</button>';
                        }
                        ?>
                        
                        </div>
                    </div>

                </div>
            </div>
     <?php 
     $query = "SELECT * FROM `msd_comp_bank_dtl_table` WHERE `status` != 2";
         if ($result = $conn->query($query)) {
            while ($row = $result->fetch_assoc()) {
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title"></h5>
                        <form class="" method="post">
                                <div class="position-relative row form-group div_bankname_class" ><label for="bankname_id" class="col-sm-3 col-form-label" style="font-weight: bold;">Bank Name</label>
                                    <div class="col-sm-9">: <label name="bankname_name" id="bankname_id" class="bank_class" style = "font-family:georgia,garamond,serif;font-size:14px;font-style:italic;"> <?php echo $row["Bank_Name"] ?> </label>
                                    </div>
                                </div>

                                <div class="position-relative row form-group div_branch_class" ><label for="branch_id" class="col-sm-3 col-form-label"  style="font-weight: bold;">Branch</label>
                                    <div class="col-sm-9">: <label name="branch_name" id="branch_id" class="branch_class" style = "font-family:georgia,garamond,serif;font-size:14px;font-style:italic;" ><?php echo $row["Branch"] ?></label></div>
                                </div>

                                <div class="position-relative row form-group div_accno_class"><label for="accno_id" class="col-sm-3 col-form-label"  style="font-weight: bold;">Account Number</label>
                                    <div class="col-sm-9">: <label name="accno_name" id="accno_id" class="" style = "font-family:sans-serif,garamond,serif;font-size:14px;font-style:italic;"><?php echo $row["Account_Number"] ?></label></div>
                                </div>

                                <div class="position-relative row form-group div_IFSC_class"><label for="IFSC_id" class="col-sm-3 col-form-label"  style="font-weight: bold;">IFSC</label>
                                    <div class="col-sm-9">: <label name="IFSC_name" id="IFSC_id" placeholder="Enter IFSC" type="text" class="" style = "font-family:sans-serif,garamond,serif;font-size:14px;font-style:italic;"><?php echo $row["IFSC"] ?></label></div>
                                </div>

                                <div class="position-relative row form-group div_accholdrname_class"><label for="accholdrname_id" class="col-sm-3 col-form-label"  style="font-weight: bold;">Account Holder Name</label>
                                    <div class="col-sm-9">: <label name="accholdrname" id="accholdrname_id" placeholder="Enter Account Holder Name" type="text" class="" style = "font-family:georgia,garamond,serif;font-size:14px;font-style:italic;"><?php echo $row["Account_Holder_Name"] ?></label></div>
                                </div>
                               
                            </div>
                        </form>
                        </div>
                </div>
            </div>
            <?php
            }
        }
    ?> 
    </div> 
</body>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
</html>


<?php include 'footer.php'; ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-content">
                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-6 card">
                                    <div class="card-body"><h5 class="card-title"></h5>
                                        <form class="" method="post" action="master_comp_accountdtl">
                                                <div class="position-relative row form-group div_accholdrname_class"><label for="accholdrname_id" class="col-sm-3 col-form-label">Account Holder Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="accholdrname" id="accholdrname_id" class="form-control border-0 accholdrname_class" value="MYTHINK TANK MULTIMEDIA PVT LTD" required>
                                                      </div>
                                                    </div>

                                                <div class="position-relative row form-group div_bankname_class" ><label for="bankname_id" class="col-sm-3 col-form-label">Bank Name</label>
                                                    <div class="col-sm-9">
                                                        <select name="bankname_name" id="bankname_id" type="text" class="form-control bank_class"  required>
                                                            <option selected value="<?php if(isset($bankname)){ echo $bankname; } else { echo "--select--"; } ?>"><?php if(isset($bankname)){ echo $bankname; } else { echo "--select--"; } ?></option>
                                                                    <?php
                                                                        $sql = mysqli_query($conn, "SELECT * FROM `bank_name_table` WHERE status != 2");
                                                                        $row = mysqli_num_rows($sql);
                                                                        while ($row = mysqli_fetch_array($sql)){
                                                                            echo "<option value='". $row['bank_name'] ."'>" .$row['bank_name'] ."</option>" ;
                                                                        }
                                                                    ?>
                                                        </select>
                                                    </div>
                                                    </div>

                                                    <div class="position-relative row form-group div_branch_class" ><label for="branch_id" class="col-sm-3 col-form-label">Branch</label>
                                                    <div class="col-sm-9"><input name="branch_name" id="branch_id" placeholder="Enter Bank Branch Name"  type="text" class="form-control branch_class" value="<?php if(isset($bankbranch)) { echo $bankbranch; } else { echo ""; } ?>" required>
                                                    </div>
                                                    </div>

                                                    <div class="position-relative row form-group div_accno_class"><label for="accno_id" class="col-sm-3 col-form-label">Account Number</label>
                                                        <div class="col-sm-9"><input name="accno_name" id="accno_id" placeholder="Enter Account No" type="number" class="form-control" value="<?php if(isset($acno)) { echo $acno; } else { echo ""; } ?>" required></div>
                                                    </div>

                                                    <div class="position-relative row form-group div_IFSC_class"><label for="IFSC_id" class="col-sm-3 col-form-label">IFSC</label>
                                                        <div class="col-sm-9"><input name="IFSC_name" id="IFSC_id" placeholder="Enter IFSC" type="text" style="text-transform:uppercase"  class="form-control" value="<?php if(isset($ifsccode)) { echo $ifsccode; } else { echo ""; } ?>" required></div>
                                                    </div>

                                                    <div class="position-relative row form-group div_pan_class">
                                                        <div class="col-sm-9"> 
                                                                <input type="submit" class="btn btn-primary" name="submit_name" value="Save"/>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
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
</div>
