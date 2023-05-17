<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<?php
  include 'database.php';  
  session_start();
?>

<?php 
 
 if(isset($_GET['ajaxofferid'])) {    
   $id = $_GET['ajaxofferid'];
?>
                <?php
                  $query = mysqli_query($conn, "SELECT * FROM `msd_offer_table` WHERE `offer_id` ='".$id."' AND `status`!= 2");
                  $my_array=mysqli_fetch_assoc($query);
                  $offer_id=$my_array["offer_id"];
                  $offer_name=$my_array["offer_name"];
                  $offer_description=$my_array["offer_description"];

                ?>
                          <form method="POST" action="master_offer_db.php">
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                          
                                        <label for="offer_id">Offer ID</label>
                                        <input type="text" class="form-control" id="offer_id" style="font-weight: bold;" name="offer_id" value="<?php echo $id; ?>" readonly required="">
                                    </div>
                                    <div class="col-md-12 mb-3">    
                                        <label for="offer_name">Offer Name</label>
                                        <input type="text" class="form-control dep_amt_class" name="offer_name" id="offer_name" placeholder="Offer Name" value="<?php echo $offer_name; ?>" required="">
                                        
                                    </div>
                                
                                    <div class="col-md-12 mb-3">
                                        <label for="offer_desc">Offer Description</label>
                                        <textarea type="text" class="form-control dep_amt_class" id="offer_desc" name="offer_desc" placeholder="Offer Description" required=""><?php echo $offer_description; ?></textarea>
                                        
                                    </div>                               
                                    </div>
                                <button class="btn btn-primary btnEditClass" id="btnEdit" name="btnEdit" type="submit" onclick="javascript:ResisterOnclick(this)">Save Changes</button>
                            </form>
  <style>
    label {
      font-weight: bold;
    }
  </style>
 
<?php  } ?>

<?php
    if(isset($_POST['btnEdit'])) {          
      mysqli_query($conn,"UPDATE `msd_offer_table` SET `offer_name`='".$_POST['offer_name']."',`offer_description`='".$_POST['offer_desc']."',`status`=1 WHERE `offer_id` = '".$_POST['offer_id']."'"); 
      echo "<script>alert('Offer Updated...!!!');</script>";
      echo "<script>window.location = 'master_editOffer';</script>";
    }
?>


<?php 
 
 if(isset($_GET['ajaxoffer_id'])) {    
   $id = $_GET['ajaxoffer_id'];
?>
                <?php
                
                  $query = mysqli_query($conn, "SELECT * FROM `msd_allocate_offer_table` WHERE `id` = '".$id."'");
                  $row=mysqli_fetch_assoc($query);
                  
                  $offer_id = $row["id"];
                  $customer_name = $row["customer_name"];
                  $offer_name = $row["offer_name"];
                  $start_date = $row["start_date"];
                  $end_date = $row["end_date"];
                  $off_stat = $row["offer_status"];
                  $selected="";
                  $selected1 = "";
                ?>
                          <form method="POST" action="master_offer_db.php">
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                      <div class="form-row" style="display: none;">
                                        <div class="col-md-12 mb-3">
                                          <label for="offer_id">Offer ID</label>
                                              <input type="text" class="form-control" id="offer_id" style="font-weight: bold;" name="offer_id" value="<?php echo $id; ?>" readonly required="">
                                        </div>
                                          
                                      </div>
                                    <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                              <label for="customer_id">Customer name</label>
                                              <?php   
                                                          if($_SESSION['ROLE'] == "admin") {
                                                                  echo '<select class="mb-2 form-control" name="customer_id" id="customer_id" >';
                                                                  $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE  `msd_register_customer_table`.`register_status` != 2");
                                                                  $row = mysqli_num_rows($sql);
                                                                  while ($row = mysqli_fetch_array($sql)) {
                                                                      if($customer_name == $row['id']) { $selected='selected'; }
                                                                      echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                                      $selected ="";
                                                              }
                                                              echo '</select>';
                                                          } else if($_SESSION['ROLE'] == "manager") {
                                                              echo '<select class="mb-2 form-control" name="customer_id" id="customer_id" >';
                                                              $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE reference_id = '".$_SESSION['USERID']."' AND `msd_register_customer_table`.`register_status` != 2");
                                                              $row = mysqli_num_rows($sql);
                                                              while ($row = mysqli_fetch_array($sql)) {
                                                                  if($customer_name == $row['id']) { $selected='selected'; }
                                                                  echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                                  $selected ="";
                                                          }
                                                          echo '</select> ';
                                                      } else if($_SESSION['ROLE'] == "employee") {
                                                          echo '<select class="mb-2 form-control" name="customer_id" id="customer_id" >';
                                                          $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE reference_id = '".$_SESSION['USERID']."' AND `msd_register_customer_table`.`register_status` != 2");
                                                          $row = mysqli_num_rows($sql);
                                                          while ($row = mysqli_fetch_array($sql)) {
                                                              if($customer_name == $row['id']) { $selected='selected'; }
                                                              echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ; 
                                                              $selected ="";
                                                      }
                                                      echo '</select>';
                                                  } else if($_SESSION['ROLE'] == "agent") {
                                                      echo '<select class="mb-2 form-control" name="customer_id" id="customer_id" >';
                                                      $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE agent_id = '".$_SESSION['USERID']."' AND `msd_register_customer_table`.`register_status` != 2");
                                                      $row = mysqli_num_rows($sql);
                                                      while ($row = mysqli_fetch_array($sql)) {
                                                          if($customer_name == $row['id']) { $selected='selected'; }
                                                          echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                          $selected ="";
                                                  }
                                                  echo '</select>';
                                              }
                                              ?>
                                          </div>
                                         
                                        <div class="col-md-6 mb-3">
                                          <label for="Offer_name">Select Offer</label>
                                          <?php 
                                              echo '<select class="form-control Offer_name" name="Offer_name" id="Offer_name" type="text" >';
                                                  echo '<option value="0">Select Offer...</option>';
                                                  $sql1 = mysqli_query($conn, "SELECT * FROM `msd_offer_table` WHERE `status` != 2");
                                              
                                                  $row1 = mysqli_num_rows($sql1);
                                                  while ($row1 = mysqli_fetch_array($sql1)) {
                                                    if($offer_name == $row1['offer_id']) { $selected1 ='selected'; }
                                                      echo "<option value='". $row1['offer_id'] ."' ".$selected1.">" .$row1['offer_name'] ."</option>" ;
                                                      $selected1 ="";
                                                  }
                                              echo '</select>';
                                          ?>
                                        </div>  
                                                                                                                                         
                                    </div>                                
                               
                                <div class="form-row">
                                      <div class="col-md-6 mb-3">
                                            <label for="start_date">Start Date</label>
                                            <input type="date" class="form-control start_dt" id="start_date" name="start_date" required="" value="<?php  echo $start_date;  ?>">
                                            
                                      </div> 
                                    <div class="col-md-6 mb-3">
                                        <label for="end_date">End Date</label>
                                        <input type="date" class="form-control enddt" id="end_date" name="end_date" value="<?php  echo $end_date;  ?>" required>
                                       </div> 
                                </div>

                                <div class="form-row">
                                  <div class="col-md-3 mb-3">
                                        <label for="off_check">Offer Check</label>
                                        <input class="invalidCheckClass"  style="display: flex;" type="checkbox" id="off_check" name="off_check" value="NO" >
                                      </div> 
                                    <div class="col-md-3 mb-3">
                                    <label for="off_stat">Status</label>                                       
                                    <input type="text" style="border:0; font-weight: bold;" class="off_stat_class" id="off_stat" name="off_stat" value="<?php echo $off_stat; ?>" placeholder="Offer Status" required="">
                                    </div>  
                                </div>                 
                                      </div>
                                </div>
                                </div>
                                <button class="btn btn-primary btnEditClass" id="btnAlloEdit" name="btnAlloEdit" type="submit" onclick="javascript:ResisterOnclick(this)">Edit</button>
                                 </form>
  <style>
    label {
      font-weight: bold;
    }
  </style>
  
    <script>
          $(".invalidCheckClass").click(function () {
            if($(".invalidCheckClass").is(":checked")){
                $(".off_stat_class").val("used");       
            } else {
                $(".off_stat_class").val("valid"); 
            }        
        });
    </script>
<?php  } ?>
<!-- End Update Customer Plan -->

<?php
    if(isset($_POST['btnAlloEdit'])) {          
      mysqli_query($conn,"UPDATE `msd_allocate_offer_table` SET `customer_name`='".$_POST['customer_id']."',`offer_name`='".$_POST['Offer_name']."',`start_date`='".$_POST['start_date']."',`end_date`='".$_POST['end_date']."',`offer_status`='".$_POST['off_stat']."' WHERE `id` = '".$_POST['offer_id']."'"); 
      echo "<script>alert('Offer Allocated...!!!');</script>";
      echo "<script>window.location = 'master_allocateOffer';</script>";
    }
?>
<?php
    if(isset($_POST['btnAlloDelete'])) {          
      mysqli_query($conn,"UPDATE `msd_allocate_offer_table` SET `status` = 2 WHERE `id` = '".$_POST['id']."'"); 
      echo "<script>alert('Offer Deleteted...!!!');</script>";
      echo "<script>window.location = 'master_allocateOffer';</script>";
    }
?>
<?php
    if(isset($_POST['btnOfferDelete'])) {          
      mysqli_query($conn,"UPDATE `msd_offer_table` SET `status` = 2 WHERE `offer_id` = '".$_POST['offer_id']."'"); 
      echo "<script>alert('Offer Deleteted...!!!');</script>";
      echo "<script>window.location = 'master_editOffer';</script>";
    }
?>
