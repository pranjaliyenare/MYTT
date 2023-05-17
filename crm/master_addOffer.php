<link href="./main.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<!doctype html>
<?php include 'header.php'; 
      include 'database.php';

    if(isset($_POST['btnAdd'])) {  

        $query = mysqli_query($conn, "SELECT lpad(MAX(`id`)+1,4,'0')id FROM `msd_offer_table`");
        $my_id_array=mysqli_fetch_assoc($query);
        $my_id=$my_id_array['id']; 
        if($my_id == "")  {
            $my_id = "0001";
        }
       echo $offer_id = 'OFFER'.$my_id; 
    
        if (isset($offer_id)){          
          // Insert Value
          $sql = "INSERT INTO `msd_offer_table`( `offer_id`, `offer_name`, `offer_description`) VALUES ('".$offer_id."','".$_POST['offer_name']."','".$_POST['offer_desc']."')";
        }
          if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Your Form Submitted Successfully');</script>";
            echo "<script>window.location = 'master_editOffer';</script>";
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
    <title>Add Offers</title>
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
                                <div>Add Offers</div>
                            </div>
                        </div>
                    </div>           
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <form method="POST" action="master_addOffer.php">
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                            <?php
                                                $query = mysqli_query($conn, "SELECT lpad(MAX(`id`)+1,4,'0')id FROM `msd_offer_table`");
                                                $my_id_array=mysqli_fetch_assoc($query);
                                                $my_id=$my_id_array['id']; 
                                                if($my_id == "")  {
                                                    $my_id = "0001";
                                                }
                                                $id = 'OFFER'.$my_id;                                             
                                            ?>   
                                        <label for="offer_id">Offer ID</label>
                                        <input type="text" class="form-control" id="offer_id" style="font-weight: bold;" name="offer_id" value="<?php echo $id; ?>" readonly required="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="offer_name">Offer Name</label>
                                        <input type="text" class="form-control dep_amt_class" name="offer_name" id="offer_name" placeholder="Offer Name" required="">
                                        
                                    </div>
                                
                                    <div class="col-md-12 mb-3">
                                        <label for="offer_desc">Offer Description</label>
                                        <textarea type="text" class="form-control dep_amt_class" id="offer_desc" name="offer_desc" placeholder="Offer Description" required=""></textarea>
                                        
                                    </div>                               
                                    </div>
                                 

                                <button class="btn btn-primary btnAddClass" id="btnAddId" name="btnAdd" type="submit" onclick="javascript:ResisterOnclick(this)">Submit</button>
                            </form>
                        </div>
                    </div>                    
                </div>   
                <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>               
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            </div>
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