<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!doctype html>
<?php include 'header.php';
      include 'database.php';
      $role = base64_decode($_GET['role']);

      $id = base64_decode($_GET['id']);
      if(base64_decode($_GET['type']) == "edit"){
        if($role == "manager"){
            $query = mysqli_query($conn, "SELECT * FROM `msd_register_comp_manager_table` WHERE mgr_id = '".$id."' and `status` != 2");

            $my_array=mysqli_fetch_assoc($query);

            $my_id=$my_array["mgr_id"];
            $reference_id=$my_array["reference_id"];
            $name=$my_array["mgr_name"];
            $mobile=$my_array["mgr_mobile"];
            $email=$my_array["mgr_email"];
            $pass=$my_array["mgr_password"];
            $re_password=$my_array["mgr_re_password"];
            $address=$my_array["mgr_address"];
            $city=$my_array["mgr_city"];
            $state=$my_array["mgr_state"];
            $gender=$my_array["mgr_gender"];
            $image=$my_array["mgr_image"];
            $city_code=$my_array["mgr_city_code"]; 
            $state_code=$my_array["mgr_state_code"]; 

        } else if($role == "employee"){
            $query = mysqli_query($conn, "SELECT * FROM `msd_register_comp_employee_table`  WHERE emp_id = '".$id."' and `status` != 2");
            $my_array=mysqli_fetch_assoc($query);

            $my_id=$my_array["emp_id"];
            $reference_id=$my_array["reference_id"];
            $name=$my_array["emp_name"];
            $mobile=$my_array["emp_mobile"];
            $email=$my_array["emp_email"];
            $pass=$my_array["emp_password"];
            $re_password=$my_array["emp_re_password"];
            $address=$my_array["emp_address"];
            $city=$my_array["emp_city"];
            $state=$my_array["emp_state"];
            $gender=$my_array["emp_gender"];
            $image=$my_array["emp_image"];
            $city_code=$my_array["emp_city_code"]; 
            $state_code=$my_array["emp_state_code"]; 

        } else if($role == "agent"){
            $query = mysqli_query($conn, "SELECT * FROM `msd_register_comp_agent_table` WHERE agent_id = '".$id."' and `status` != 2");
            $my_array=mysqli_fetch_assoc($query);

            $my_id=$my_array["agent_id"];
            $reference_id=$my_array["reference_id"];
            $name=$my_array["agent_name"];
            $mobile=$my_array["agent_mobile"];
            $email=$my_array["agent_email"];
            $pass=$my_array["agent_password"];
            $re_password=$my_array["agent_re_password"];
            $address=$my_array["agent_address"];
            $city=$my_array["agent_city"];
            $state=$my_array["agent_state"];
            $gender=$my_array["agent_gender"];
            $image=$my_array["agent_image"];
            $city_code=$my_array["agent_city_code"]; 
            $state_code=$my_array["agent_state_code"]; 


        }
      }
    //Delete Record
    if(base64_decode($_GET['type']) == "delete"){
        if($role == "manager") {
            mysqli_query($conn,"UPDATE `msd_register_comp_manager_table` SET  `status` = 2 WHERE `mgr_id`='" . $id . "'");
            mysqli_query($conn,"UPDATE `msd_login_table` SET `status` = 2 WHERE `userid`='" . $id . "'");
            echo "<script>window.location = 'master_displayProfile?role=".base64_encode("manager")."';</script>";
        } else if($role == "employee") {
            mysqli_query($conn,"UPDATE `msd_register_comp_employee_table` SET  `status` = 2 WHERE `emp_id`='" . $id . "'");
            mysqli_query($conn,"UPDATE `msd_login_table` SET `status` = 2 WHERE `userid`='" . $id . "'");
            echo "<script>window.location = 'master_displayProfile?role=".base64_encode("employee")."';</script>";
           } else if($role == "agent")  {
             mysqli_query($conn,"UPDATE `msd_register_comp_agent_table` SET  `status` = 2 WHERE `agent_id`='" . $id . "'");
             mysqli_query($conn,"UPDATE `msd_login_table` SET `status` = 2 WHERE `userid`='" . $id . "'");
            echo "<script>window.location = 'master_displayProfile?role=".base64_encode("agent")."';</script>";
           }
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
        $mob =  $_POST['mobile'];
        if($role == "manager") {
            mysqli_query($conn,"UPDATE `msd_register_comp_manager_table` SET `reference_id` = '".$_POST['reference']."', `mgr_name` = '". $_POST['name']."', `mgr_mobile` ='".$mob."', `mgr_email` = '". strtolower($_POST['email'])."', `mgr_address` = '". $_POST['address']."', `mgr_city_code`='". $_POST['city']."', `mgr_state_code`='". $_POST['state']."',  `mgr_city` ='".$_POST['city_hidden']."', `mgr_state` = '".$_POST['state_hidden']."', `mgr_gender`='". $_POST['radio2']."', `mgr_image` ='". $profile."', `status` = 1 WHERE `mgr_id`='" . $id . "'");
            mysqli_query($conn,"UPDATE `msd_login_table` SET `username` = '". strtolower($_POST['email'])."', `status` = 1 WHERE `userid`='" . $id . "'");
            echo "<script>window.location = 'master_displayProfile?role=".base64_encode("manager")."';</script>";
        } else if($role == "employee") {
            mysqli_query($conn,"UPDATE `msd_register_comp_employee_table` SET `reference_id` = '".$_POST['reference']."', `emp_name` = '". $_POST['name']."', `emp_mobile` ='".$mob."', `emp_email` = '". strtolower($_POST['email'])."', `emp_address` = '". $_POST['address']."', `emp_city_code`='". $_POST['city']."', `emp_state_code`='". $_POST['state']."', `emp_city` ='".$_POST['city_hidden']."', `emp_state` = '".$_POST['state_hidden']."', `emp_gender`='". $_POST['radio2']."', `emp_image` ='". $profile."', `status` = 1 WHERE `emp_id`='" . $id . "'");
            mysqli_query($conn,"UPDATE `msd_login_table` SET `username` = '". strtolower($_POST['email'])."', `status` = 1 WHERE `userid`='" . $id . "'");
            echo "<script>window.location = 'master_displayProfile?role=".base64_encode("employee")."';</script>";
        } else if($role == "agent")  {
            $ref = substr($_POST['reference'], -1);
            if($ref == 'E') {
                $ref_mgr_emp = $_POST['reference'];
            }  else if($ref == 'G') {
                $query = mysqli_query($conn,"SELECT * FROM msd_register_comp_agent_table WHERE status!= 2 AND `agent_id` = '".$_POST['reference']."'"); 
                $agent_ref_id=mysqli_fetch_assoc($query);
                echo  $ref_mgr_emp = $agent_ref_id['refer_emp_mgr_id']; 

            } else {
                $ref_mgr_emp = $_POST['reference'];
            }
            mysqli_query($conn,"UPDATE `msd_register_comp_agent_table` SET `admin_id` = '".$_SESSION["ADMINID"]."', `refer_emp_mgr_id`= '".$ref_mgr_emp."', `reference_id` = '".$_POST['reference']."', `agent_name` = '". $_POST['name']."', `agent_mobile` ='".$mob."', `agent_email` = '". strtolower($_POST['email'])."', `agent_address` = '". $_POST['address']."', `agent_city_code`='". $_POST['city']."', `agent_state_code`='". $_POST['state']."', `agent_city` = '".$_POST['city_hidden']."', `agent_state` = '".$_POST['state_hidden']."', `agent_gender`='". $_POST['radio2']."', `agent_image` ='". $profile."', `status` = 1 WHERE `agent_id`='" . $id . "'");
            mysqli_query($conn,"UPDATE `msd_login_table` SET `username` = '". strtolower($_POST['email'])."', `status` = 1 WHERE `userid`='" . $id . "'");
            //header("Location: master_displayProfile");
            echo "<script>window.location = 'master_displayProfile?role=".base64_encode("agent")."';</script>";
        }
    }

 ?>

<!-- <html lang="en">

<head>
    <title>Add Profile</title>
<link href="./main.css" rel="stylesheet">
</head>
<body> -->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Edit Profile.</title>
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
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon ">
                                    <i class="fas fa-edit" aria-hidden="true" ></i>
                                        </i>
                                    </div>
                                    Edit <?php if($role == "manager") { echo "Manager"; } else if($role == "employee") { echo "Employee"; } else if($role == "agent") { echo "Partner"; } ?> Profile
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
                                                <div class="col-sm-10"><input name="reference" id="reference_id" placeholder="Enter Reference Id" type="text" class="form-control reference_class" value="<?php echo $reference_id; ?>" required>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="name_id" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10"><input name="name" id="name_id" placeholder="Enter Name" type="text" class="form-control" value="<?php echo $name; ?>" required>
                                                <div class="invalid-feedback">
                                                    Please choose a Name.
                                                </div>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="mobile_id" class="col-sm-2 col-form-label">Mobile</label>
                                                <div class="col-sm-10"><input name="mobile" id="mobile_id" placeholder="Enter Mobile" type="text" maxlength="10" class="form-control" value="<?php echo $mobile; ?>" required></div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="email_id" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10"><input name="email" id="email_id" placeholder="Enter Username" type="email" class="form-control"value="<?php echo $email; ?>" required></div>
                                            </div>
                                            
                                            <div class="position-relative row form-group"><label for="address_id" class="col-sm-2 col-form-label">Address</label>
                                                <div class="col-sm-10"><input name="address" id="address_id" placeholder="Enter Address" type="text" class="form-control" value="<?php echo $address; ?>" required></div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="state_id" class="col-sm-2 col-form-label">State</label>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo '<select class="mb-2 form-control state_class" name="state" id="state_id" type="text" required>
                                                        <option selected value= "'.$state_code.'">'.$state.'</option>';
                                                     $sql = mysqli_query($conn, "SELECT * FROM `all_states`  ");
                                                     $row = mysqli_num_rows($sql);
                                                     while ($row = mysqli_fetch_array($sql)) {
                                                         echo "<option value='". $row['state_code'] ."'>" .$row['state_name'] ."</option>" ;
                                                     }
                                                    echo '</select>';
                                                ?>
                                                <input type="hidden" name="state_hidden" id="state_hidden">
                                            
                                            </div>
                                            </div>

                                            <div class="position-relative row form-group"><label for="city_id" class="col-sm-2 col-form-label">City</label>
                                                <div class="col-sm-10">
                                                <?php 
                                                echo '<select class="mb-2 form-control city_class" name="city" id="city_id" type="text"><option selected value= "'.$city_code.'">'.$city.'</option>';
                                                     $sql1 = mysqli_query($conn, "SELECT * FROM `all_cities`");
                                                     $row1 = mysqli_num_rows($sql1);
                                                     while ($row1 = mysqli_fetch_array($sql1)) {
                                                         echo "<option value='". $row1['city_code'] ."'>" .$row1['city_name'] ."</option>";
                                                        // echo "$('select[name="city"]').append('<option value="'.$row1['city_code'].'">'.$row1['city_name'] .'</option>')";
                                                     }
                                                echo '</select>';
                                                ?>
                                                <input type="hidden" name="city_hidden" id="city_hidden">
                                                    <!-- <input name="city" id="city_id" placeholder="Enter City" type="text" class="form-control" value="<?php echo $city; ?>" required> -->
                                                </div>
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
                                                <!-- <button class="btn btn-secondary" name="close" onclick="master_displayProfile">Close</button> -->
                                                <input type="button" onclick="window.location = 'master_displayProfile?role=<?php echo base64_encode($role) ?>'" class="btn btn-secondary" name="close_name" value="Close"/>
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
        $('#uploadForm').after('<img id="image_id" src="assets/images/avatars/<?php echo $image; ?>" width="200" height="200"/>');
        
}
    $("#file").change(function () {
        $("#profile").val("");
        filePreview(this);
    });
    $('#uploadForm + embed').remove();
    $('#uploadForm').after('<embed src="'+e.target.result+'" width="200" height="200">');

         function filePreview(input) {

            if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#uploadForm + img').remove();
                $('#uploadForm').after('<img id="image_id" src="'+e.target.result+'" width="200" height="200"/>');
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