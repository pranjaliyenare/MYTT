<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php';
 
    if($_SESSION['ROLE'] == "customer"){
        $userid = $_SESSION['USERID'];
    } else {
        if(isset($_GET['id'])) {
            $userid = base64_decode($_GET['id']);
        } else {
            $userid = $_SESSION['USERID'];
        }
    }
?>
<?php
    if(isset($_POST['submit'])) {
        include 'database.php';
        $pan_img ="";
        $aadharfr_img ="";
        $aadharbk_img ="";

            $uploadPath = 'Document/'; 
            if(isset($_POST['submit']) && !empty($_FILES['aadhaar_bk_img_name']['name'])){ 
                if(move_uploaded_file($_FILES['aadhaar_bk_img_name']['tmp_name'], $uploadPath.$_FILES['aadhaar_bk_img_name']['name'])){ 
                    $aadharbk_img = $_FILES['aadhaar_bk_img_name']['name'];
                    //echo "File has been uploaded successfully."; 
                } 
            } else { 
                if($_POST['aadhaar_bk_img_name_text'] != ""){
                    $aadharbk_img =$_POST['aadhaar_bk_img_name_text'];
                } else {
                    $aadharbk_img ="";
                }
                //echo 'File upload failed, please try again.';  
            } 

            if(isset($_POST['submit']) && !empty($_FILES['aadhaar_fr_img_name']['name'])){ 
                if(move_uploaded_file($_FILES['aadhaar_fr_img_name']['tmp_name'], $uploadPath.$_FILES['aadhaar_fr_img_name']['name'])){ 
                    $aadharfr_img = $_FILES['aadhaar_fr_img_name']['name'];
                    //echo "File has been uploaded successfully."; 
                } 
            } else { 
                if($_POST['aadhaar_fr_img_name_text'] != ""){
                    $aadharfr_img =$_POST['aadhaar_fr_img_name_text'];
                } else {
                    $aadharfr_img ="";
                }
                //echo 'File upload failed, please try again.';  
            } 
            
            if(isset($_POST['submit']) && !empty($_FILES['pan_img_name']['name'])) { 
                if(move_uploaded_file($_FILES['pan_img_name']['tmp_name'], $uploadPath.$_FILES['pan_img_name']['name'])){ 
                   $pan_img = $_FILES['pan_img_name']['name'];
                    echo "File has been uploaded successfully."; 
                } 
            } else {

                if($_POST['pan_img_name_text'] != ""){
                    $pan_img =$_POST['pan_img_name_text'];
                } else {
                    $pan_img ="";
                }
                //echo 'File upload failed, please try again.';  
            } 
           
        if($_SESSION['ROLE'] == "customer"){ $user_id = $userid;  } else { $user_id = $_POST['username']; }
         $query1="DELETE FROM `msd_user_kyc_table` WHERE `USER_ID` = '$user_id'";
         $result1 = $conn->query($query1);

        $query="INSERT INTO msd_user_kyc_table (`USER_ID`, `AADHAAR_NO`, `AADHAR_FRONT_IMAGE`, `AADHAR_BACK_IMAGE`, `PAN_NO`, `PAN_IMAGE`) VALUES('$user_id', '". $_POST['aadhaar']."', '$aadharfr_img', '$aadharbk_img', '". $_POST['pan']."', '$pan_img')";

         $result = $conn->query($query);

          if($result)
          {
             //echo "<script>alert('Record Added Successfully')</script>";
             echo "<script>alert('Record Added Successfully'); window.location = '".$_POST['path']."';</script>";
          }
          else
          {
             echo "<script>alert('Record Not Added Successfully')</script>";
         }

     }

?>
<?php

        $qry=mysqli_query($conn,"SELECT * FROM msd_user_kyc_table WHERE `USER_ID` = '".$userid."' and STATUS !=2");
        $rowCount=mysqli_num_rows($qry);
        if ($rowCount>0) {
            $rowCheck=mysqli_fetch_assoc($qry);
            $username = $rowCheck['USER_ID'];
            $aadhaarno = $rowCheck['AADHAAR_NO'];
            $aadhaarfrimg = $rowCheck['AADHAR_FRONT_IMAGE'];
            $aadhaarbkimg = $rowCheck['AADHAR_BACK_IMAGE'];
            $panno = $rowCheck['PAN_NO'];
            $panimg = $rowCheck['PAN_IMAGE'];

         }   else {

            $username = "";
            $aadhaarno = "";
            $aadhaarfrimg = "";
            $aadhaarbkimg = "";
            $panno = "";
            $panimg = "";
        }

    //}

    ?>
 <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Add KYC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">

</head>
<body>
<div class="app-main__outer">
                    <div class="app-main__inner">
                        <?php  if($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "customer") { ?>
                        <div class="app-page-title" style="padding: 10px;">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                    <i class="fa fa-id-badge" aria-hidden="true"></i>
                                    </div>
                                    <div>KYC
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
                                    <form class="" method="post" action="master_user_kyc.php" enctype="multipart/form-data">
                                    <input type="hidden" name="path" id="path" class="form-control border-0" value="<?php if(isset($_GET['path'])) { echo base64_decode($_GET['path']); } ?>" readonly>
                                    <div class="position-relative row form-group div_username_class"><label for="username_id" class="col-sm-3 col-form-label">User Name</label>
                                                <div class="col-sm-9">
                                                <input name="username" id="username_id" class="form-control border-0 username_class" required readonly value="<?php echo $userid; ?>"/>
                                                </div>
                                            </div>

                                            <div class="position-relative row form-group div_aadhaar_class"><label for="aadhaar_id" class="col-sm-3 col-form-label">Aadhaar</label>
                                                <div class="col-sm-9"><input name="aadhaar" id="aadhaar_id" placeholder="Enter Aadhaar" type="value" class="form-control" onkeyup="Aadhaar_validation(this.value);" value="<?php echo $aadhaarno; ?>"/>
                                                    <b style="color:red"><span id="aadhaar_status"></span></b> &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label style="color: lightgrey;">Format: 78XX 45XX 97XX<label>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group div_aadhaar_img_class"><label for="aadhaar_fr_img_id" class="col-sm-3 col-form-label">Aadhaar Front Image Upload</label>
                                                <div class="col-sm-9"><input type="file" name="aadhaar_fr_img_name" id="aadhaar_fr_img_id" onchange="readFrontAadharURL(this);" />
                                                <input type="hidden" id="aadhaar_fr_id" class="border-0" name="aadhaar_fr_img_name_text" value="<?php echo $aadhaarfrimg; ?>">
                                                        <img id="fr_aadhaar_blah" src="Document/<?php echo $aadhaarfrimg; ?>" alt="your image" width="180" height="180"/>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group div_aadhaar_img_class"><label for="aadhaar_bk_img_id" class="col-sm-3 col-form-label">Aadhaar Back Image Upload</label>
                                                <div class="col-sm-9"><input type='file' id="aadhaar_bk_img_id" name="aadhaar_bk_img_name" onchange="readBackAadharURL(this);" />
                                                <input type="hidden" id="aadhaar_bk_id" class="border-0" name="aadhaar_bk_img_name_text" value="<?php echo $aadhaarbkimg; ?>"> 
                                                        <img id="bk_aadhaar_blah" src="Document/<?php echo $aadhaarbkimg; ?>" alt="your image" width="180" height="180"/>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group div_pan_class"><label for="pan_id" class="col-sm-3 col-form-label">PAN</label>
                                                <div class="col-sm-9"><input name="pan" id="pan_id" placeholder="Enter PAN" type="text"  MaxLength="10" onkeyup="pan_validate(this.value);" class="form-control" value="<?php echo $panno; ?>" required/>
                                                <b style="color:red"><span id="pan_status"></span></b></div>
                                            </div>

                                            <div class="position-relative row form-group div_pan_img_class"><label for="pan_img_id" class="col-sm-3 col-form-label">PAN Image Upload</label>
                                                <div class="col-sm-9"><input type='file' id="pan_img_id" name="pan_img_name" onchange="readPANURL(this);" />
                                                <input type="hidden" id="pan_img" class="border-0" name="pan_img_name_text" value="<?php echo $aadhaarbkimg; ?>"> 
                                                        <img id="pan_blah" name="pan_name" src="Document/<?php echo $panimg; ?>" alt="your image" width="180" height="180"/>
                                                        <!-- <img id="pan_blah" src="./assets/images/avatars/2.jpg" width="180" height="180"/> -->
                                                </div>
                                            </div>

                                            <div class="position-relative row form-group">
                                                <div class="col-sm-9"> <input type="submit" class="btn btn-primary" name="submit" value="Save"/>
                                                    <input type="button" class="btn btn-secondary" name="close" value="Close" onclick="window.location = '<?php echo base64_decode($_GET['path']); ?>';"/></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

</body>

<script>
    // PAN Validation
        function pan_validate(pan) {
            var regpan = /^([A-Z]){5}([0-9]){4}([A-Z]){1}?$/;

            if (regpan.test(pan) == false && pan != "") {
                document.getElementById("pan_status").innerHTML = "Invalid PAN Number";
            } else {
                document.getElementById("pan_status").innerHTML = "";
            }
        }
// Aadhar Validation
        function Aadhaar_validation()
       {
                var regexp=/^[2-9]{1}[0-9]{3}\s{1}[0-9]{4}\s{1}[0-9]{4}$/;

                var x=document.getElementById("aadhaar_id").value;

            if(regexp.test(x) || x == "")
                {
                    document.getElementById("aadhaar_status").innerHTML = "";

                }
            else{ document.getElementById("aadhaar_status").innerHTML = "Invalid Aadhaar Number";
                }
        }
// Aadhar Front Image
        function readFrontAadharURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#fr_aadhaar_blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
// Aadhar Back Image
        function readBackAadharURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#bk_aadhaar_blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
// PAN Image
        function readPANURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    debugger
                    $('#pan_blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
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