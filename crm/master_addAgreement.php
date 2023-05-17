<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php';

// if($_SESSION['ROLE'] == "customer"){
//     $userid = $_SESSION['USERID'];
// } else {
     if(isset($_GET['id'])) {
        $userid = base64_decode($_GET['id']);
    //$userid = $user_id;
   } //else {
  //      $userid = $_SESSION['USERID'];
    //}
//}

if(isset($_POST['submit'])) {
    include 'database.php';

        //This is the directory where images will be saved
        $target = "Document/";
        $target = $target . basename($_POST['username'] . "_". $_FILES['agreement']['name']);
        $Description=$_POST['Description'];
        
       
        //This gets all the other information from the form
        $Filename=basename( $_FILES['agreement']['name']);
        // if($Description == ""){
        //     if($Filename == "") 
        //     $Description= $_POST['agreement_text'];
        //     else 
        //     $Description= $Filename;
        // }
        //Writes the Filename to the server
        if(move_uploaded_file($_FILES['agreement']['tmp_name'], $target) || $_POST['agreement_text'] != "") {
            if($_SESSION['ROLE'] == "customer"){ $user_id = $userid;  } else { $user_id = $_POST['username']; }
            $query1="DELETE FROM `msd_agreement_table` WHERE `user_id` = '$user_id'";
            $result1 = $conn->query($query1);
            if($Filename == "") {
                $Filename = $_POST['agreement_text'];
            } 
            // //Writes the information to the database
            mysqli_query($conn, "INSERT INTO `msd_agreement_table`(`user_id`, `agreement_file`, `description`) VALUES ('".$_POST['username']."', '". $Filename."', '".$Description."')");
             //Tells you if its all ok
             echo "<script>alert('The file ". $Filename. " has been uploaded, and your information has been added to the directory');</script>";
             echo "<script>window.location = 'master_user_profiledtl';</script>";
        } else {
            //Gives and error if its not
            echo "<script>alert('Sorry, there was a problem uploading your file.');</script>";
            $a = base64_encode($_POST['username']);
            echo "<script>window.location = 'master_addAgreement?id=".$a." ';</script>";
        }
}
?>

<?php

        $qry=mysqli_query($conn,"SELECT * FROM `msd_agreement_table` WHERE `user_id` = '".$userid."' AND `status` != 2");
        $rowCount=mysqli_num_rows($qry);
        if ($rowCount>0) {
            $rowCheck=mysqli_fetch_assoc($qry);            
            $username = $rowCheck['user_id'];
            $file = $rowCheck['agreement_file'];
            $description = $rowCheck['description'];
         } else {

            $username = "";
            $file = "";
            $description  = "";
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
    <title>Add Agreement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">

</head>
<body>
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title" style="padding: 10px;">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-id-badge" aria-hidden="true"></i>
                        </div>
                    <div>Agreement
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
                    <form class="" method="post" action="master_addAgreement.php" enctype="multipart/form-data">
                    <div class="position-relative row form-group div_username_class"><label for="username_id" class="col-sm-3 col-form-label"><b>User Name :</b></label>
                        <div class="col-sm-9">
                            <input name="username" id="username_id" class="form-control border-0 username_class" readonly value="<?php echo $userid; ?>"/>
                        </div>
                    </div>
                    <div class="position-relative row form-group" ><label for="agreement_id" class="col-sm-3 col-form-label"><b>Select Agreement :</b></label>
                        <div class="col-sm-9">
                            <input type="file" id="agreement_id" name="agreement" accept=".pdf,.doc">
                            <input type="text" id="agreement2_id" class="border-0" name="agreement_text" value="<?php echo $file; ?>" readonly>
                        </div>
                    </div>
                    <div class="position-relative row form-group" ><label for="description_id" class="col-sm-3 col-form-label"><b>Description :</b></label>
                        <div class="col-sm-9">
                            <textarea id="description_id" class="form-control" rows="2" cols="35" name="Description"><?php echo $description ?></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="position-relative row form-group">
                         <div class="col-sm-9"> <input type="submit" class="btn btn-primary" name="submit" value="Save"/>
                             <input type="button" class="btn btn-secondary" name="close" value="Close" onclick="window.location = 'master_user_profiledtl';"/></div>
                     </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<?php include 'footer.php'; ?>