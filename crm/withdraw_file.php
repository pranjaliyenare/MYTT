<?php include 'header.php';
    include 'database.php';
?>
<!doctype html>
<html lang="en">
    <style>
        label {
            font-weight: bold;
        }
    </style>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Withdraw</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">

</head>
<body>
    <div class="app-main__outer">
        <div class="app-main__inner">
          <?php if($_SESSION["ROLE"] == "admin") { ?>
            <div class="app-page-title" style="padding: 10px;">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-download icon-gradient bg-happy-itmeo"> </i>
                        </div>
                        <div>Withdraw
                            <div class="page-title-subheading"> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <form class="" method="post" action="withdraw_file" enctype="multipart/form-data">
                                        <div class="position-relative row form-group div_file_class"><label for="file" class="col-sm-3 col-form-label">Only Excel/CSV File Upload :</label>
                                            <div class="col-sm-6">
                                                <input type="file" name="file" id="file" class="form-control" required>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary" name="submit_name" value="Import"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
        <?php
            include 'database.php';
            if (isset($_POST['submit_name'])) {
                $file = $_FILES['file']['tmp_name'];
                $handle = fopen($file, "r");
                $c = 0;
                while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                    if ($c != 0) {
                        if ($filesop[0]) {
                             $sql = "insert into `msd_transaction_withdraw_table`(`user_id`, `plan_id`, `bank_id`, `amount`, `principal_amount`, `type`, `comment`, `approve_status`, `approve_date`) values ('$filesop[0]','$filesop[1]','$filesop[2]','$filesop[3]','$filesop[4]','$filesop[5]','$filesop[6]','$filesop[7]','".date('Y-m-d H:i:s', strtotime($filesop[8]))."');";
                             $result = $conn->query($sql);
                        }
                    }
                    $c = $c + 1;                  
                } 
                echo "<script>window.location = 'withdraw_file';</script>";                         
            }
        ?>
    <?php } ?>