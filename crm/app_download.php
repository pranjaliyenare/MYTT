<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="./main.css" rel="stylesheet"></head>
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; 
      include 'database.php'; 
?>

<?php
    if(isset($_POST['submit_name'])) {
        $img      = "MYTT_APP.apk";
        $temp = $_FILES['apk_file']['tmp_name'];
        move_uploaded_file($temp, "app/".$img);
       
        if(!empty($_FILES['apk_file']['name']))
        {
          mysqli_query($conn, "UPDATE `msd_app_table` SET `apk_file`='".$img."',`status`=1, `date`='".date("Y-m-d H:i:s")."'");
          echo '<script> alert("Updated Successfully...!!!"); </script>';
          echo "<script>window.location = 'app_download';</script>";
        }
        else
        {
          echo '<script> alert("Not Update...!!!"); </script>';
          echo "<script>window.location = 'app_download';</script>";
        }        
    }   
?>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title" style="padding: 10px;">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                        <i class="fa fa-download" aria-hidden="true"></i>
                            </i>
                        </div>
                        <div>Download App
                            <div class="page-title-subheading">
                            </div>
                        </div>
                    </div>

                    <div class="page-title-actions">
                        <div class="d-inline-block dropdown">
                        
                        <?php if($_SESSION['ROLE'] == 'admin'){
                            echo '<button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal">Add App</button>';
                        }
                        ?>
                        
                        </div>
                    </div>

                </div>
            </div>
     <?php 
     $query = "SELECT * FROM `msd_app_table` WHERE `status` != 2";
         if ($result = $conn->query($query)) {
            while ($row = $result->fetch_assoc()) {
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title"></h5>
                        <form class="" method="post">
                                <div class="position-relative row form-group" ><label for="apkfile" class="col-sm-3 col-form-label" style="font-weight: bold;">APK file</label>
                                    <div class="col-sm-9"> <label name="apkfile" id="apkfile" class="apkfile"> <?php echo $row["apk_file"] ?> </label>
                                    </div>
                                </div>
                                <div class="position-relative row form-group" ><label for="releaseDate" class="col-sm-3 col-form-label" style="font-weight: bold;">Release Date</label>
                                    <div class="col-sm-9"> <label name="releaseDate" id="releaseDate" class="bank_class"> <?php echo date('d-m-Y',strtotime($row["date"])); ?> </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="position-relative row form-group">
                                    <div class="col-sm-9"> 
                                        <a href="app/<?php echo $row["apk_file"] ?>" class="btn btn-primary" download rel="noopener noreferrer" target="_blank"><i class="fa fa-download"></i> Download</a>
                                    </div>
                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item-success list-group-item">
                                        <b>How to Install MYTT App?</b> <br>
                                        <b>Ans :</b> <br>
                                        1. Click to Download button <br>
                                        2. Open Download Folder and Install MYTT App <br>
                                        3. Click On <b>Install Anyway</b> <br>
                                        4. Click On Open.
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            }
        }
    ?> 
    </div> 
</body>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
</html>


<?php include 'footer.php'; ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New App</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-content">
                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-6 card">
                                    <div class="card-body"><h5 class="card-title"></h5>
                                        <form class="" method="post" action="app_download" enctype="multipart/form-data">
                                                    <div class="position-relative row form-group div_comp_name_class"><label for="comp_name_id" class="col-sm-3 col-form-label">Account Holder Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="comp_name" id="comp_name_id" class="form-control border-0 comp_name_class" value="MYTHINK TANK MULTIMEDIA PVT LTD" required>
                                                      </div>
                                                    </div>
                                                    <div class="position-relative row form-group div_accno_class"><label for="apk_file" class="col-sm-3 col-form-label">apk File</label>
                                                        <div class="col-sm-9"><input name="apk_file" id="apk_file" type="file" class="form-control"  required></div>
                                                    </div>
                                                </div>
                                                <div class="position-relative row form-group div_pan_class">
                                                    <div class="col-sm-9"> 
                                                            <input type="submit" class="btn btn-primary" name="submit_name" value="Save"/>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        </div>
    </div>
</div>
