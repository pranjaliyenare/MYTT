<link href="./main.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="./assets/scripts/main.js"></script>
<?php
   include 'header.php'; 
   include 'database.php';
   $role = $_SESSION['ROLE'];
?>
<?php 
      $id = base64_decode($_GET['id']);
      if(base64_decode($_GET['type']) == "edit"){
            $query = mysqli_query($conn, "SELECT * FROM `msd_register_customer_table` WHERE `register_id` = '".$id."'");
            
            $my_array=mysqli_fetch_assoc($query);            
            $my_id=$my_array["register_id"]; 
            $agent_id=$my_array["agent_id"];
            $reference_id=$my_array["reference_id"]; 
            $fname=$my_array["register_fname"]; 
            $mname=$my_array["register_mname"]; 
            $lname=$my_array["register_lname"]; 
            $dob=$my_array["register_dob"]; 
            $register_nominee_name=$my_array["register_nominee_name"]; 
            $register_nominee_relation=$my_array["register_nominee_relation"]; 
            $addr1=$my_array["register_addr1"]; 
            $addr2=$my_array["register_addr2"]; 
            $city=$my_array["register_city"]; 
            $state=$my_array["register_state"]; 
            $city_code=$my_array["register_city_id"]; 
            $state_code=$my_array["register_state_id"]; 
            $pincode=$my_array["register_pincode"]; 
            $country=$my_array["register_country"]; 
            $mobno=$my_array["register_mobno"];
            $email=$my_array["register_email"]; 
            $password=$my_array["register_password"]; 
            $repassword=$my_array["register_repassword"]; 
            $invest_amount=$my_array["register_invest_amount"]; 
            $image = $my_array["register_image"]; 
            $register_emp_checked=$my_array["register_emp_checked"]; 
            $register_emp_name=$my_array["register_emp_name"]; 
            $register_emp_perc = $my_array["register_emp_perc"]; 

            $selected="";
            $selected1 = "";
        }
        
?>
<!doctype html>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Edit Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">
    
<link href="./main.css" rel="stylesheet"></head>
<style>
    
    label {
        font-weight: bold;
    }
</style>
    <body>
            <div class="app-main__outer">
                <div class="app-main__inner">
                <?php  if($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "customer") { ?>
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                <i class="fa fa-user-plus" aria-hidden="true" ></i>
                                </div>
                                <div>Edit Profile</div>
                            </div>
                        </div>
                    </div>           
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form method="POST" action="master_register_db.php" enctype="multipart/form-data" id="uploadForm" class="needs-validation" novalidate="">
                            <input type="hidden" name="path" id="path" class="form-control border-0" value="<?php if(isset($_GET['path'])) { echo base64_decode($_GET['path']); } ?>" readonly>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">                                  
                                        <label for="first_name">ID</label>
                                        <input type="text" class="form-control" id="register_id" style="font-weight: bold;" name="register_id_name" value="<?php echo $id; ?>" readonly required="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="reference_id">Reference Id</label>
                                        <input class="form-control reference_class" type="text" name="reference" id="reference_id" placeholder="Reference Id" value="<?php echo $agent_id; ?>" required>
                                        <div class="invalid-feedback">
                                            Please provide a Reference Id.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="first_name">First name</label>
                                        <input type="text" class="form-control first_name_class" id="first_name" name="first_name" placeholder="First name" value="<?php echo $fname; ?>" required="">
                                        <div class="invalid-feedback">
                                            Please provide a First Name.
                                        </div>
                                    </div>
                                    
                                
                                    <div class="col-md-4 mb-3">
                                        <label for="middle_name">Middle Name</label>
                                        <input type="text" class="form-control middle_name_class" id="middle_name" name="middle_name" placeholder="Middle name" value="<?php echo $mname; ?>" >
                                        <div class="invalid-feedback">
                                            Please provide a Middle Name.
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="last_name">Last name</label>
                                        <input type="text" class="form-control last_name_class" id="last_name" name="last_name" placeholder="Last name" value="<?php echo $lname; ?>" required="">
                                        <div class="invalid-feedback">
                                            Please provide a Last Name.
                                        </div>
                                    </div>
                                </div>  
                                <div class="form-row">  
                                    <div class="col-md-4 mb-3">
                                        <label for="dob">Date Of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $dob; ?>" required="">
                                        <div class="invalid-feedback">
                                            Please provide a Date Of Birth.
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="nominee_name">Nominee Name</label>
                                        <input type="text" class="form-control" id="nominee_name" name="nominee_name" placeholder="Nominee Name" value="<?php echo $register_nominee_name ?>" required="">
                                        <div class="invalid-feedback">
                                            Please provide a Nominee Name.
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="nominee_relation">Relation With Nominee</label>
                                        <!-- <input type="text" class="form-control" id="nominee_relation" name="nominee_relation" placeholder="Relation With Nominee" required=""> -->
                                        <select type="text" class="form-control" id="nominee_relation" name="nominee_relation" required="">
                                                    <option  value="<?php echo $register_nominee_relation ?>"><?php echo $register_nominee_relation ?></option>
                                                    <option value="Father">Father</option>
                                                    <option value="Mother">Mother</option>
                                                    <option value="Sister">Sister</option>
                                                    <option value="Brother">Brother</option>
                                                    <option value="Daughter">Daughter</option>
                                                    <option value="Wife">Wife</option>
                                                    <option value="Husband">Husband</option>
                                                    <option value="Son">Son</option>
                                                    <!-- <option value="Friend">Friend</option> -->
                                            </select>
                                        <div class="invalid-feedback">
                                            Please provide a Relation With Nominee.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-row">                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="address1">Address 1</label>
                                        <input type="text" class="form-control" id="address1" name="address1" placeholder="Address"  value="<?php echo $addr1 ?>" required="">
                                        <div class="invalid-feedback">
                                            Please provide a Address 1.
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="address2">Address 2</label>
                                        <input type="text" class="form-control" id="address2" name="address2" placeholder="Address" value="<?php echo $addr2 ?>" required="">
                                        <div class="invalid-feedback">
                                            Please provide a Address 2.
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="state">State</label>
                                        <input type="hidden" name="state_hidden" id="state_hidden">       
                                        <!-- <input type="text" class="form-control" id="state" name="state" placeholder="State" required=""> -->
                                        <?php 
                                                echo '<select class="form-control state_class" name="state" id="state_id" type="text" required> <option value= "0">Select</option>';
                                                     $sql = mysqli_query($conn, "SELECT * FROM `all_states`  ");
                                                     $row = mysqli_num_rows($sql);
                                                     while ($row = mysqli_fetch_array($sql)) {
                                                        if($state_code == $row['state_code']) { $selected='selected'; }
                                                         echo "<option value='". $row['state_code'] ."' ".$selected.">" .$row['state_name'] ."</option>" ;
                                                         $selected ="";
                                                     }
                                                echo '</select>';
                                            ?>
                                        <div class="invalid-feedback">
                                            Please provide a state.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="city">City</label>
                                        <input type="hidden" name="city_hidden" id="city_hidden">
                                        <!-- <input type="text" class="form-control" id="city" name="city" placeholder="City" required=""> -->
                                        <?php 
                                                echo '<select class="form-control city_class" name="city" id="city_id" type="text" required>';
                                                     $sql1 = mysqli_query($conn, "SELECT * FROM `all_cities`");
                                                     $row1 = mysqli_num_rows($sql1);
                                                     while ($row1 = mysqli_fetch_array($sql1)) {
                                                        if($city_code == $row1['city_code']) { $selected1='selected'; } else { $selected1 =""; }
                                                         echo "<option value='". $row1['city_code'] ."' ".$selected1.">" .$row1['city_name'] ."</option>" ;
                                                         $selected ="";
                                                     }
                                                echo '</select>';
                                            ?>
                                        <div class="invalid-feedback">
                                            Please provide a city.
                                        </div>
                                    </div>                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="pincode">Pincode</label>
                                        <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pincode"  maxlength="6" value="<?php echo $pincode ?>" required="">
                                        <div class="invalid-feedback">
                                            Please provide a Pincode.
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="India" readonly required="">
                                        <div class="invalid-feedback">
                                            Please provide a Country.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="amount">Amount</label>
                                        <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $invest_amount ?>" placeholder="Amount (eg. 123000)" required="">
                                        <div class="invalid-feedback">
                                            Please provide a Amount.
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="file">Image</label>
                                        <input type="file" class="form-control" name="file" id="file" accept="image/*"/>
                                        <input class="picturebox" id="profile" name="userfile" type="hidden" value="<?php echo $image; ?>" />
                                        <div class="invalid-feedback">
                                            Please provide a Image.
                                        </div>
                                    </div>
                                      
                                </div>
                                
                                <button class="btn btn-info btn--blue" name="edit" type="submit" onclick="javascript:RegisterOnclick(this)">Save Changes</button>
                                <button class="btn btn-secondary btn--red" type="submit" name="cancel">Cancel</button>
                            </form>
        
                            <script>
                                // Example starter JavaScript for disabling form submissions if there are invalid fields
                                (function() {
                                    'use strict';
                                    window.addEventListener('load', function() {
                                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                        var forms = document.getElementsByClassName('needs-validation');
                                        // Loop over them and prevent submission
                                        var validation = Array.prototype.filter.call(forms, function(form) {
                                            form.addEventListener('submit', function(event) {
                                                if (form.checkValidity() === false) {
                                                    event.preventDefault();
                                                    event.stopPropagation();
                                                }
                                                form.classList.add('was-validated');
                                            }, false);
                                        });
                                    }, false);
                                })();
                            </script>
                        </div>
                    </div>
                    
                </div>
                  
            <!-- </div>
        </div> -->

                <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
                <script>
                
                $('#password_id, #confirm_password_id').on('keyup', function () {
                if ($('#password_id').val() == $('#confirm_password_id').val()) {
                    $('#message').html('Matching').css('color', 'green');
                } else 
                    $('#message').html('Not Matching').css('color', 'red');
                });
                window.onload = function() {
                    
                    if("<?php echo $_SESSION['ROLE']; ?>" == "admin") {
                    $('.reference_class').attr('readonly', false);
                } else {
                    $('.reference_class').attr('readonly', true);
                }        
                }
            

                function RegisterOnclick() {
                    $("#state_hidden").val($("#state_id option:selected").text());
                    $("#city_hidden").val($("#city_id option:selected").text());
                    $("#emp_hidden").val($("#emp_id option:selected").text());                    
                }
                
            </script>
            <script>
                window.onload = function() {
                        $('#uploadForm + img').remove();
                        $('#uploadForm').after('<img id="image_id" src="assets/images/avatars/<?php echo $image; ?>" width="200" height="200"/>');
                        var x = document.getElementById("emp_div_id");
                        var y = document.getElementById("empper_div_id");
                        if($("#invalidCheck").is(":checked")){               
                            x.style.display = "block";
                            y.style.display = "block";
                        } else {
                            x.style.display = "none";
                            y.style.display = "none";
                        }
                }
                $( "select[name='state']" ).change(function () {
                var stateID = $(this).val();
                
                if(stateID) {
                    $.ajax({
                        url: "state_city_ddl.php",
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
                    $('select[name="city"]').empty();
                }
            });

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
                    function myFunction() {
                    if($("#invalidCheck").is(":checked")){
                        $("#invalidCheck").val("YES");        
                    } else {
                        $("#invalidCheck").val("NO");  
                    }
                    var x = document.getElementById("emp_div_id");
                    var y = document.getElementById("empper_div_id");
                    if (x.style.display === "none") {
                        x.style.display = "block";
                    } else {
                        x.style.display = "none";
                        $("#emp_id").val("0"); 
                    }
                    if (y.style.display === "none") {
                        y.style.display = "block";
                    } else {
                        y.style.display = "none";
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