<link href="./main.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<!doctype html>
<?php include 'header.php'; 
      include 'database.php';

    if(isset($_POST['btnAdd'])) {  
          // Insert Value
          $sql = "INSERT INTO `msd_allocate_offer_table`(`customer_name`, `offer_name`, `start_date`, `end_date`) VALUES ('".$_POST['customer_id']."','".$_POST['Offer_name']."','".$_POST['start_dt']."','".$_POST['end_dt']."')";
        
          if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Your Form Submitted Successfully');</script>";
            echo "<script>window.location = 'master_allocateOffer';</script>";
          } else {
            echo "<script>alert('Do not Submit, Please Fill All Data...!!!');</script>";
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
    <title>Allocate Offers</title>
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
                                <i class="fa fa-tasks" aria-hidden="true" ></i>
                                </div>
                                <div>Allocate Offers</div>
                            </div>
                        </div>
                    </div>           
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form method="POST" action="master_addAllocateOffer.php">
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <div class="col-md-12 mb-3">
                                        <label for="customer_id">Customer name</label>
                                        <input type="hidden" name="cust_name_hidden" id="cust_name_hidden">
                                        <?php   
                                                    if($_SESSION['ROLE'] == "admin") {
                                                            echo '<select class="mb-2 form-control" name="customer_id" id="customer_id" >';
                                                            //if($_POST['customer_id'] != "") {echo '<option selected value= "'.$_POST['customer_name'].'">'.$userId.'</option>'; }
                                                            $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE  `msd_register_customer_table`.`register_status` != 2");
                                                            $row = mysqli_num_rows($sql);
                                                            while ($row = mysqli_fetch_array($sql)) {
                                                                if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                                echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                                $selected ="";
                                                        }
                                                        echo '</select>';
                                                    } else if($_SESSION['ROLE'] == "manager") {
                                                        echo '<select class="mb-2 form-control" name="customer_id" id="customer_id" >';
                                                        $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE reference_id = '".$_SESSION['USERID']."' AND `msd_register_customer_table`.`register_status` != 2");
                                                        $row = mysqli_num_rows($sql);
                                                        while ($row = mysqli_fetch_array($sql)) {
                                                            if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                            echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                            $selected ="";
                                                    }
                                                    echo '</select> ';
                                                } else if($_SESSION['ROLE'] == "employee") {
                                                    echo '<select class="mb-2 form-control" name="customer_id" id="customer_id" >';
                                                    $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE reference_id = '".$_SESSION['USERID']."' AND `msd_register_customer_table`.`register_status` != 2");
                                                    $row = mysqli_num_rows($sql);
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                        if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                        echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ; 
                                                        $selected ="";
                                                }
                                                echo '</select>';
                                            } else if($_SESSION['ROLE'] == "agent") {
                                                echo '<select class="mb-2 form-control" name="customer_id" id="customer_id" >';
                                                $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE agent_id = '".$_SESSION['USERID']."' AND `msd_register_customer_table`.`register_status` != 2");
                                                $row = mysqli_num_rows($sql);
                                                while ($row = mysqli_fetch_array($sql)) {
                                                    if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                    echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                    $selected ="";
                                            }
                                            echo '</select>';
                                        }
                                        ?>
                                        <!-- <input type="text" class="form-control customer_name_class" id="customer_name" name="customer_id" placeholder="Customer name" required=""> -->
                                        <div class="invalid-feedback">
                                            Please provide a Customer Name.
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3" id="Offerper_div_id">
                                        <label for="Offer_name">Select Offer</label>
                                        <?php 
                                            echo '<select class="form-control Offer_name" name="Offer_name" id="Offer_name" type="text" >';
                                                echo '<option value="0">Select Offer...</option>';
                                                $sql1 = mysqli_query($conn, "SELECT * FROM `msd_offer_table` WHERE `status` != 2");
                                            
                                                $row1 = mysqli_num_rows($sql1);
                                                while ($row1 = mysqli_fetch_array($sql1)) {
                                                    echo "<option value='". $row1['offer_id'] ."'>" .$row1['offer_name'] ."</option>" ;
                                                }
                                            echo '</select>';
                                        ?>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="start_dt">Start Date</label>
                                        <input type="date" class="form-control start_dt" id="start_dt" name="start_dt" required="" value="<?php  echo date('Y-m-d');  ?>">
                                        <div class="invalid-feedback">
                                            Please provide a Start Date.
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="end_dt">End Date</label>
                                        <input type="date" class="form-control enddt" id="end_dt" name="end_dt" value="" required>
                                        <div class="invalid-feedback">
                                            Please provide a End Date.
                                        </div>
                                    </div>
                                    
                                </div>
                                </div>
                                
                                <button class="btn btn-primary btnAddClass" id="btnAdd" name="btnAdd" type="submit" >Allocate</button>
                            </form>
                        </div>
                    </div>
                </div>
</div>
</body>
</html>
<?php include 'footer.php'; ?>
<?php } else { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="widget-content-wrapper" id="divImg">
                            <img  src="assets/images/404-error.jpg" alt="mytt"  style="width:100%; "/>
                        </div>
                    </div>
                </div>                                
            </div>
        </div>
    </body>
</html>
<?php } ?>