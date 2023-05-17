<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!doctype html>
<?php include 'header.php';
      include 'database.php';
      
      $id = base64_decode($_GET['id']);
      if(base64_decode($_GET['type']) == "edit") {
        
            $query = mysqli_query($conn, "SELECT * FROM `msd_register_comp_accountant_table` WHERE acc_id = '".$id."' and `status` != 2");
            $my_array=mysqli_fetch_assoc($query);

            $my_id=$my_array["acc_id"];
            $reference_id=$my_array["reference_id"];
            $name=$my_array["acc_name"];
            $mobile=$my_array["acc_mobile"];
            $email=$my_array["acc_email"];
            $pass=$my_array["acc_password"];
            $address=$my_array["acc_address"];
            $gender=$my_array["acc_gender"];
            $image=$my_array["acc_image"];
            
      }
    //Delete Record
    if(base64_decode($_GET['type']) == "delete") {
            mysqli_query($conn,"UPDATE `msd_register_comp_accountant_table` SET `status`= 2 WHERE `acc_id` = '".$id."'");
            mysqli_query($conn,"UPDATE `msd_login_table` SET `status` = 2 WHERE `userid`='".$id."'");
            echo "<script>window.location = 'master_displayAccountant';</script>";
    }
?>

<?php
include 'database.php';
    //Edit Record
    if(isset($_POST['submit'])) {

        $uploadPath = 'assets/images/avatars/';
        if(isset($_POST['submit']) && !empty($_FILES['file']['name'])){
            if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath.$_FILES['file']['name'])){
                //echo '<script> alert("File has been uploaded successfully."); </script>';
            }else{
                //echo '<script> alert("File upload failed, please try again."); </script>';
            }
        }
        if($_FILES['file']['name']){
            $profile = $_FILES['file']['name'];            
        } else {
            $profile = $_POST['userfile'];
        }

            mysqli_query($conn,"UPDATE `msd_register_comp_accountant_table` SET `reference_id`='".$_SESSION["ADMINID"]."',`acc_name`='". $_POST['name']."', `acc_mobile`='". $_POST['mobile']."', `acc_email`='". strtolower($_POST['email'])."', `acc_address`='". $_POST['address']."', `acc_gender`='". $_POST['radio2']."',`acc_image`='". $profile."', `status`=1 WHERE `acc_id`= '".$id."'");
            mysqli_query($conn,"UPDATE `msd_login_table` SET `username` = '". strtolower($_POST['email'])."', `status` = 1 WHERE `userid`='".$id."'");
            echo "<script>window.location = 'master_displayAccountant';</script>";
    }
 ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Edit Accountant Profile.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">

</head>
<style>
    .form-control {
        width: 50%;
    }
    label {
        font-weight: bold;
    }
</style>
<body>
                <div class="app-main__outer">
                    <div class="app-main__inner">
                    <?php  if($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "accountant") { ?>
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon ">
                                        <i class="fas fa-edit" aria-hidden="true" ></i>
                                    </div>
                                    Edit Accountant Profile
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="main-card mb-3 card">
                                            <div class="card-body"><h5 class="card-title"></h5>
                                            <form class="" method="POST" name="uploadFormname" enctype="multipart/form-data" id="uploadForm">
                                                <div class="position-relative row form-group"><label for="name_id" class="col-sm-2 col-form-label">ID</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="id" style="font-weight: bold;" name="id_name" class="form-control border-0" readonly value="<?php echo $id; ?>">
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group"><label for="reference_id" class="col-sm-2 col-form-label">Reference Id</label>
                                                    <div class="col-sm-10">
                                                        <input name="reference" id="reference_id" placeholder="Enter Reference Id" type="text" class="form-control reference_class" value="<?php echo $reference_id; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group"><label for="name_id" class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input name="name" id="name_id" placeholder="Enter Name" type="text" class="form-control" value="<?php echo $name; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group"><label for="mobile_id" class="col-sm-2 col-form-label">Mobile</label>
                                                    <div class="col-sm-10"><input name="mobile" id="mobile_id" placeholder="Enter Mobile" type="text" pattern="\d*" maxlength="10" class="form-control" value="<?php echo $mobile; ?>" required></div>
                                                </div>
                                                <div class="position-relative row form-group"><label for="email_id" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10"><input name="email" id="email_id" placeholder="Enter Username" type="email" class="form-control" value="<?php echo $email; ?>" required></div>
                                                </div>
                                                
                                                <div class="position-relative row form-group"><label for="address_id" class="col-sm-2 col-form-label">Address</label>
                                                    <div class="col-sm-10"><input name="address" id="address_id" placeholder="Enter Address" type="text" class="form-control" value="<?php echo $address; ?>" required></div>
                                                </div>
                                                
                                                <fieldset class="position-relative row form-group">
                                                    <legend class="col-form-label col-sm-2">Gender</legend>
                                                    <div class="col-sm-10">
                                                        <div class="position-relative form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" id="rbtn_male_id" value="male" required> Male</label></div>
                                                        <div class="position-relative form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" id="rbtn_female_id" value="female" required> Female </label></div>
                                                        <div class="position-relative form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input" id="rbtn_other_id" value="other" required>Other</label></div>
                                                    </div>
                                                </fieldset>
                                                <div class="position-relative row form-group"><label for="image_id" class="col-sm-2 col-form-label">Image</label>
                                                    <div class="col-sm-10">
                                                    <form method="post" name="uploadFormname" enctype="multipart/form-data" id="uploadForm">
                                                        <input type="file" name="file" id="file" accept="image/*"/>
                                                        <input class="picturebox" id="profile" name="userfile" type="hidden" value="<?php echo $image; ?>" />
                                                        </br>
                                                        </br>
                                                        <button class="btn btn-info" type="submit" name="submit" onclick="javascript:ResisterOnclick(this)">Save Changes</button>
                                                        <input type="button" onclick="window.location = 'master_displayAccountant';" class="btn btn-secondary" name="close_name" value="Close"/>
                                                    </form>                                                    
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
                  <div>


</body>

<script>


window.onload = function() {
            <?php
                if($gender=="male"){
                echo 'document.getElementById("rbtn_male_id").checked = true';
                } else if($gender=="female"){
                echo 'document.getElementById("rbtn_female_id").checked = true';
                } else
                if($gender=="other"){
                echo 'document.getElementById("rbtn_other_id").checked = true';
                }
            ?>

                    if("<?php echo $_SESSION['ROLE']; ?>" == "admin") {
                        $('.reference_class').attr('readonly', false);
                    } else {
                        $('.reference_class').attr('readonly', true);
                    }
                  
        $('#uploadForm + img').remove();
        $('#uploadForm').after('<img id="image_id" src="assets/images/avatars/<?php echo $image; ?>" width="450" height="300"/>');
        
}
    $("#file").change(function () {
        $("#profile").val("");
        filePreview(this);
    });
    $('#uploadForm + embed').remove();
    $('#uploadForm').after('<embed src="'+e.target.result+'" width="450" height="300">');

         function filePreview(input) {

            if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#uploadForm + img').remove();
                $('#uploadForm').after('<img id="image_id" src="'+e.target.result+'" width="450" height="300"/>');
            };
            reader.readAsDataURL(input.files[0]);
            }
        }
</script>
<script>        
        $( "select[name='state']" ).change(function () {
    var stateID = $(this).val();
    
    if(stateID) {
        $.ajax({
            url: "state_city_ddl",
            dataType: 'Json',
            data: {'id':stateID},
            success: function(data) {
                $('select[name="city"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="city"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
            }
        });


    }else{
        //$('select[name="city"]').empty();
    }
});
function ResisterOnclick() {
    $("#state_hidden").val($("#state_id option:selected").text());
    $("#city_hidden").val($("#city_id option:selected").text());
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