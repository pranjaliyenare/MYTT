<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

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
        <title>Admin Assistant Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
        <meta name="msapplication-tap-highlight" content="no">

    <link href="./main.css" rel="stylesheet">
    </head>

    <body>
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <?php  if($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "assistant") { ?>
                        <div class="app-page-title" style="padding: 10px;">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                    <i class="fa fa-user-circle" aria-hidden="true" ></i>
                                    </div>
                                    <div>Admin Assistant Profile
                                        <div class="page-title-subheading">
                                        </div>
                                    </div>
                                </div>

                                <?php if($_SESSION['ROLE'] == "admin") { ?>
                                    <div class="page-title-actions" id="divBtnAdd" >
                                        <div class="d-inline-block dropdown btn mr-2 mb-2 btn-primary">
                                            <a id="btnAdd" href="master_addAssProfile"  style="color: white;">
                                                Add Profile
                                            </a>
                                        </div>                                                                               
                                    </div>
                                <?php } ?>
                               
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title"></h5>
                                    <div class="table-responsive" style="height: 600px;">
                                <?php            
                                    if($_SESSION['ROLE'] == "admin") {
                                            $query = "SELECT * FROM msd_register_comp_assistant_table WHERE status!= 2";
                                    } else if($_SESSION['ROLE'] == "assistant") {
                                        $query = "SELECT * FROM `msd_register_comp_assistant_table` WHERE status!= 2 AND `ass_id` = '".$_SESSION["USERID"]."'";
                                    } 

                                        $i = 0;
                                    echo '<table class="mb-0 table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Gender</th>';   
                                                if($_SESSION["ROLE"] == "admin" || $_SESSION["ROLE"] == "assistant"){                                             
                                                 echo '<th>Status</th>';
                                                }
                                                echo'</tr>
                                            </thead>
                                            <tbody>';
                                    if ($result = $conn->query($query)) {
                                        while ($row = $result->fetch_assoc()) {
                                                        
                                            $id = $row["ass_id"];
                                            $name = $row["ass_name"];
                                            $mobile = $row["ass_mobile"];
                                            $email = $row["ass_email"];
                                            $address = $row["ass_address"];
                                            $gender = $row["ass_gender"];

                                            echo'<tr>
                                            <td>'.++$i.'</td>
                                            <td>'.$id.'</td>
                                            <td>'.$name.'</td>
                                            <td>'.$mobile.'</td>
                                            <td>'.$email.'</td>
                                            <td>'.$address.'</td>
                                            <td>'.$gender.'</td>';     
                                            if ($_SESSION["ROLE"] == "admin" || $_SESSION["ROLE"] == "assistant") {
                                                echo'<td>';
                                                if ($_SESSION["ROLE"] == "admin") {
                                                    echo '<a href="master_editAssProfile?&id='.base64_encode($id).'&type='.base64_encode('delete').'" class="btn btn-danger" style= "margin-bottom: 5px; width: 38px;"><i class="fas fa-trash" aria-hidden="true" title="Copy to use trash"></i> </a>';
                                                } 
                                                echo '<a href="master_editAssProfile?id='.base64_encode($id).'&type='.base64_encode('edit').'" class="btn btn-info" style= "margin-bottom: 5px; width: 38px;"><i class="fas fa-edit" aria-hidden="true" title="Copy to use edit"></i> </a>';
                                                echo'</td>';
                                            }
                                                echo '</tr>';
                                                }
                                            $result->free();
                                            echo '</tbody>
                                        </table>';
                                    }
                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                      
    </body>
</html>
<?php include 'footer.php';?>   
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