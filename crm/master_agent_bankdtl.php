<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; 
//$userid = base64_decode($_GET['id']);
if($_SESSION['ROLE'] == "agent"){
    $userid = $_SESSION['USERID'];
} else {
    if(isset($_GET['id'])){
    $userid = base64_decode($_GET['id']);
    } else {
        $userid = $_SESSION['USERID'];
    }
}
?>
<?php
    //if($_SESSION['ROLE'] == "agent"){   
        $qry=mysqli_query($conn,"SELECT * FROM msd_user_bankdtl_table WHERE `ACCOUNT_HOLDER_NAME` = '".$userid."' and STATUS !=2");        
        
        $rowCount=mysqli_num_rows($qry);
        if ($rowCount>0) { 
                
                $rowCheck=mysqli_fetch_assoc($qry);
                $username = $rowCheck['ACCOUNT_HOLDER_NAME'];
                $bankname = $rowCheck['USER_BANK_NAME'];
                $acno = $rowCheck['USER_ACCOUNT_NO'];
                $ifsccode = $rowCheck['USER_IFSC'];
                $bankbranch = $rowCheck['USER_BANK_BRANCH'];
        }   else { 

            $username = "";
            $bankname = "";
            $acno = "";
            $ifsccode = "";
            $bankbranch = "";
     
        } // }
?>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<!doctype html>
<html lang="en">

        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta http-equiv="Content-Language" content="en">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <title>Add Bank Details</title>
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
            <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
            <meta name="msapplication-tap-highlight" content="no">

        </head>
        <body>
            <div class="app-main__outer">
                    <div class="app-main__inner">
                    <?php if($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "agent"){ ?>
                        <div class="app-page-title" style="padding: 10px;">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <!-- <i class="fa fa-fw" aria-hidden="true"></i> -->
                                        <i class="fa fa-fw" aria-hidden="true"></i>
                                    </div>
                                    <div>Bank Details
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
                                    <form class="" method="post" action="master_agent_bankdtl.php">
                                    <div class="position-relative row form-group div_accholdrname_class"><label for="accholdrname_id" class="col-sm-3 col-form-label">Account Holder Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="accholdrname" id="accholdrname_id" class="form-control border-0 accholdrname_class" value="<?php echo $userid; ?>" readonly required>
                                              </div>
                                            </div>

                                        <div class="position-relative row form-group div_bankname_class" ><label for="bankname_id" class="col-sm-3 col-form-label">Bank Name</label>
                                            <div class="col-sm-9">
                                            <select name="bankname_name" id="bankname_id" type="text" class="form-control bank_class" required>
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
                                            <div class="col-sm-9"> <input type="submit" class="btn btn-primary" name="submit" value="Save"/>
                                                <input type="button" onclick="window.location = 'master_displayProfile?role=<?php echo base64_encode('agent'); ?>';" class="btn btn-secondary" name="close" value="Close"/></div>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                            </div>

                        </div>
                    </div>

</body>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>
    window.onload = function(){
        $('.bank_class').select2();
    }
   
    </script>
</html>
<?php
include 'database.php';
 if(isset($_POST['submit'])) {      
        // insert the data if data is not exist
        $table="msd_user_bankdtl_table";
        $field =array("`ACCOUNT_HOLDER_NAME`, `USER_BANK_NAME`, `USER_ACCOUNT_NO`, `USER_IFSC`, `USER_BANK_BRANCH`, `TYPE`");
        $data =array("'".$_POST['accholdrname']."', '". $_POST['bankname_name']."', '". $_POST['accno_name']."', '". $_POST['IFSC_name']."', '". $_POST['branch_name']."', 'agent'");
        
         $field_values= implode(',',$field);
         $data_values=implode(',',$data);
         if($_SESSION['ROLE'] == "agent"){ $user_id = $userid;  } else { $user_id = $_POST['accholdrname']; }         
         $query1="DELETE FROM `msd_user_bankdtl_table` WHERE `ACCOUNT_HOLDER_NAME` = '$user_id'";
         $result1 = $conn->query($query1);

        $query="INSERT INTO". " ".$table." (".$field_values. ") VALUES(".$data_values.")";
        $result = $conn->query($query);
        
         if($result)
         {
           // header("location: master_tr3ser_profiledtl");
           echo "<script>window.location = 'master_displayProfile?role=".base64_encode("agent")."';</script>";
         }
         else
         {
            echo "<script>alert('Record Not Added...!!!')</script>";
        }
    }
 ?>

<?php include 'footer.php'; ?>
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