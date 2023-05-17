<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<?php
  include 'database.php';
?>
<?php 
 if(isset($_GET['ajaxnotfid'])) {    
   $id = $_GET['ajaxnotfid'];
?>
<form method="POST" action="master_plan_db">
<div class="tab-content">
  <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
    <div class="row">
      <div class="col-md-12">
        <div class="main-card mb-3 card" style="margin-bottom: 0px!important;">
          <div class="card-body">
                <?php
                    $query = mysqli_query($conn, "SELECT * FROM `msd_notification_table` WHERE `id` =".$id." AND `status`!= 2");
                    $my_array=mysqli_fetch_assoc($query);
                    $comment_subject=$my_array["comment_subject"];
                    $comment_text=$my_array["comment_text"];    
                    $comment_status=$my_array["comment_status"];
                    $comment_type=$my_array["comment_type"];              
                ?>
                <h6 style="text-align: center;"><b><?php echo $comment_subject; ?> </b></h6><hr>
               <?php  if($comment_type == 'welcome') { ?>
                  <p style="text-align: center;"><?php echo $comment_text; ?></p>
                <?php } else { ?>
                  <p><?php echo $comment_text; ?></p>
                <?php } ?>
          </div>
        </div>
      </div>       
    </div>
  </div>   
  </form>
<?php 
   mysqli_query($conn,"UPDATE `msd_notification_table` SET `exp_date` = '".date('Y-m-d h:i:s', strtotime(date('Y-m-d') .' +1 day'))."', `comment_status`= 2,`status`=1 WHERE `id`='".$id."' AND `comment_status`= 1"); 
   
} ?>


