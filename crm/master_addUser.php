<link href="./main.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<!doctype html>
<?php include 'header.php'; 
      include 'database.php';
?>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Add Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">
    
<link href="./main.css" rel="stylesheet"></head>
<style>
    /* .form-control {
        width: 50%;
    } */
    label {
        font-weight: bold;
    }
</style>
    <body>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <?php if ($_SESSION['ROLE'] == "admin") { ?>
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                <i class="fa fa-user-plus" aria-hidden="true" ></i>
                                </div>
                                <div>Add Profile</div>
                            </div>
                        </div>
                    </div>           
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form method="POST" action="master_register_db.php" enctype="multipart/form-data" id="uploadForm" class="needs-validation" novalidate="">
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                    <?php
                                                $query = mysqli_query($conn, "SELECT lpad(MAX(`id`)+1,4,'0')id FROM `msd_register_customer_table`");
                                                $my_id_array=mysqli_fetch_assoc($query);
                                                $my_id=$my_id_array['id']; 
                                                if($my_id == "")  {
                                                    $my_id = "0001";
                                                }
                                                $id = 'MS'.$my_id.'C';                                             
                                            ?>   
                                        <label for="register_id">ID</label>
                                        <input type="text" class="form-control" id="register_id" style="font-weight: bold;" name="register_id_name" value="<?php echo $id; ?>" readonly required="">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="reference_id">Reference Id</label>
                                        <input class="form-control reference_class" type="text" name="reference" id="reference_id" placeholder="Reference Id" value="<?php if($_SESSION['ROLE'] == 'admin' || $_SESSION['ROLE'] == 'customer') { echo 'MS0003G'; } else { echo $_SESSION['USERID']; } ?>" required>
                                        <div class="invalid-feedback">
                                            Please provide a Reference Id.
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="first_name">First name</label>
                                        <input type="text" class="form-control first_name_class" id="first_name" name="first_name" placeholder="First name" required="">
                                        <div class="invalid-feedback">
                                            Please provide a First Name.
                                        </div>
                                    </div>
                                </div>    
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="middle_name">Middle Name</label>
                                        <input type="text" class="form-control middle_name_class" id="middle_name" name="middle_name" placeholder="Middle name">
                                        <div class="invalid-feedback">
                                            Please provide a Middle Name.
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="last_name">Last name</label>
                                        <input type="text" class="form-control last_name_class" id="last_name" name="last_name" placeholder="Last name" required="">
                                        <div class="invalid-feedback">
                                            Please provide a Last Name.
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="dob">Date Of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob" required="">
                                        <div class="invalid-feedback">
                                            Please provide a Date Of Birth.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="nominee_name">Nominee Name</label>
                                        <input type="text" class="form-control" id="nominee_name" name="nominee_name" placeholder="Nominee Name" required="">
                                        <div class="invalid-feedback">
                                            Please provide a Nominee Name.
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="nominee_relation">Relation With Nominee</label>
                                        <!-- <input type="text" class="form-control" id="nominee_relation" name="nominee_relation" placeholder="Relation With Nominee" required=""> -->
                                        <select type="text" class="form-control" id="nominee_relation" name="nominee_relation" required="">
                                                    <option value="Father">Father</option>
                                                    <option value="Mother">Mother</option>
                                                    <option value="Sister">Sister</option>
                                                    <option value="Brother">Brother</option>
                                                    <option value="Daughter">Daughter</option>
                                                    <option value="Son">Son</option>
                                                    <option value="Wife">Wife</option>
                                                    <option value="Husband">Husband</option>
                                                    <!-- <option value="Friend">Friend</option> -->
                                            </select>
                                        <div class="invalid-feedback">
                                            Please provide a Relation With Nominee.
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="mobno">Mobile</label>
                                        <input type="text" class="form-control" id="mobno" name="mobno" placeholder="Mobile" required="">
                                        <div class="invalid-feedback">
                                            Please provide a Mobile.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="email">Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            </div>
                                            <input type="email" class="form-control email_class" id="email" name="email" placeholder="Email" aria-describedby="inputGroupPrepend" required="">
                                            
                                            <div class="invalid-feedback">
                                                Please provide a valid Email.
                                            </div>
                                        </div>
                                        <span id='result' class="result text-danger"></span>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="password_id">Password</label>
                                        <input class="form-control" type="password" placeholder="Format (eg - abc@123)" name="password" id ="password_id" pattern="(?=.*\d)(?=.*[\W_]).{7,}" title="Minimum of 7 characters. Should have at least one special character and one number." required="">
                                        <!-- <label class="label--desc">Format (eg - abc@123)</label> -->
                                        <span id='message'></span>
                                        <div class="invalid-feedback">
                                            Please provide a Password.
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="confirm_password_id">Confirm Password</label>
                                        <input class="form-control" type="password" placeholder="Format (eg - abc@123)" id ="confirm_password_id" name="repassword" pattern="(?=.*\d)(?=.*[\W_]).{7,}" title="Minimum of 7 characters. Should have at least one special character and one number."    required="">
                                        <div class="invalid-feedback">
                                            Please provide a Confirm Password.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="address1">Address 1</label>
                                        <input type="text" class="form-control" id="address1" name="address1" placeholder="Address" required="">
                                        <div class="invalid-feedback">
                                            Please provide a Address 1.
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="address2">Address 2</label>
                                        <input type="text" class="form-control" id="address2" name="address2" placeholder="Address" required="">
                                        <div class="invalid-feedback">
                                            Please provide a Address 2.
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="state">State</label>
                                        <input type="hidden" name="state_hidden" id="state_hidden">       
                                        <!-- <input type="text" class="form-control" id="state" name="state" placeholder="State" required=""> -->
                                        <?php 
                                                echo '<select class="form-control state_class" name="state" id="state_id" type="text" required><option disabled selected value="0">Select State...</option>';
                                                     $sql = mysqli_query($conn, "SELECT * FROM `all_states`  ");
                                                     $row = mysqli_num_rows($sql);
                                                     while ($row = mysqli_fetch_array($sql)) {
                                                         echo "<option value='". $row['state_code'] ."'>" .$row['state_name'] ."</option>" ;
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
                                                         echo "<option value='". $row1['city_code'] ."'>" .$row1['city_name'] ."</option>" ;
                                                     }
                                                echo '</select>';
                                            ?>
                                        <div class="invalid-feedback">
                                            Please provide a city.
                                        </div>
                                    </div>                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="pincode">Pincode</label>
                                        <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pincode" required="">
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
                                    <div class="col-md-6 mb-3">
                                        <label for="amount">Amount</label>
                                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount (eg. 123000)" required="">
                                        <div class="invalid-feedback">
                                            Please provide a Amount.
                                        </div>
                                    </div>                              
                                    <div class="col-md-6 mb-3">
                                        <label for="file">Image</label>
                                        <input type="file" class="form-control" name="file" id="file" accept="image/*"/>
                                        <div class="invalid-feedback">
                                            Please provide a Image.
                                        </div>
                                    </div>                                    
                                </div>
                                
                                <?php //if($_SESSION['ROLE'] != null && $_SESSION['ROLE'] != "customer") { ?>
                                <!-- <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <input class="" type="checkbox" id="invalidCheck" name="invalidCheck" value="NO" onclick="myFunction()">
                                        </div>
                                        <div class="col-md-4 mb-3" id="emp_div_id" style="display: none;">
                                            <label for="emp_id">Employee Name</label>
                                            <?php 
                                                    // echo '<select class="form-control emp_class" name="emp" id="emp_id" type="text" ><option value="0">Select...</option>';
                                                    //     $sql1 = mysqli_query($conn, "SELECT * FROM `msd_register_comp_employee_table` WHERE `status` != 2");
                                                    //     $row1 = mysqli_num_rows($sql1);
                                                    //     while ($row1 = mysqli_fetch_array($sql1)) {
                                                    //         echo "<option value='". $row1['emp_id'] ."'>" .$row1['emp_name'] ."</option>" ;
                                                    //     }
                                                    // echo '</select>';
                                                ?>
                                                <input type="hidden" name="emp_hidden" id="emp_hidden">
                                            
                                        </div>                              
                                        <div class="col-md-4 mb-3" id="empper_div_id" style="display: none;">
                                            <label for="emp_perc">Employee Percentage</label>
                                            <input type="number" class="form-control" id="emp_perc" value="0" name="emp_perc" >
                                           
                                        </div> 
                                </div> -->
                                <?php  //}   ?> 
                                <button class="btn btn-primary btnAddClass" id="btnAddId" name="add" type="submit" onclick="javascript:RegisterOnclick(this)">Submit</button>
                            </form>
                        </div>
                    </div>                    
                </div>                  
            <!-- </div>
        </div> -->

    
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>        
    <!-- Main JS-->
    <script src="js/global.js"></script>
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

    <script>      
        $('#password_id, #confirm_password_id').on('keyup', function () {
        if ($('#password_id').val() == $('#confirm_password_id').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else 
            $('#message').html('Not Matching').css('color', 'red');
        });
        
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

        function RegisterOnclick() {
            
            $("#state_hidden").val($("#state_id option:selected").text());
            $("#city_hidden").val($("#city_id option:selected").text());
            $("#emp_hidden").val($("#emp_id option:selected").text());
            
            var name = $(".first_name_class").val() + " " + $(".last_name_class").val();
            alert("Hiii...! "+ name +" Your Username "+ $(".email_class").val());
        }
      </script>
      
      <script>         
          $( "select[name='state']" ).change(function () {
          var stateID = $(this).val();
          
          if(stateID) {
              $.ajax({
                  type: "POST",
                  url: "master_register_db.php",
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

    $("#email").blur(function() {
        var email = $('#email').val();
        // if email field is null then return
        if(email == "") {
            return;
        }
        // send ajax request if email is not empty
        $.ajax({
                url: 'master_register_db.php',
                type: 'post',
                data: {
                    'email':email,
                    'email_check':1,
            },
            success:function(response) {	
                // clear span before error message
                $("#email_error").remove();
                // adding span after email textbox with error message
                $("#result").text(response);
            },
            error:function(e) {
                $("#result").html("Something went wrong");
            }
        });
    });
</script>

    </body>
</html>
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