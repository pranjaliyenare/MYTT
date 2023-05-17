<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; 
      include 'database.php';
?>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Bank Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">
</head>
    <style>
   table thead 
   {
    text-align: center;
   }
   table tbody
   {
    text-align: center;
   }
   
    #table-wrapper {
        position:relative;
    }
    #table-scroll {
      height:500px;
      overflow:auto;  
      margin-top:20px;
    }
    #table-wrapper table {
        width:100%;

    }
    #table-wrapper table * {
      color:black;
    }
    #table-wrapper table thead th .text {
      position:absolute;   
      top:-20px;
      z-index:2;
      height:20px;
      width:35%;
      border:1px solid red;
    }
    #table-wrapper #table-scroll table thead th{
      background : #3f6ad8;
      position: sticky;
      top: 0;
      border:1px solid white;
    }
   
</style>
<body>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title" style="padding: 10px;">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div>Bank Details
                        <div class="page-title-subheading"></div>
                    </div>
                </div>
                <div class="page-title-actions" id="divBtnAdd" >
                    <button class="btn" onclick="ExportExcel('xlsx')" style="background: #3d9852; color:white;"><i class="fa fa-file-excel-o" style="font-size:24px"></i></button>
                </div>
            </div>
        </div>
       

     <?php
            echo '<div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title"></h5>
                            <form>
                                <div class="table_Div" id="table_Div_id">            
                                    <div class="table-responsive">';
                                        if ($_SESSION["ROLE"] == "admin") {
                                            $query = "SELECT `ACCOUNT_HOLDER_NAME`, CONCAT(register_fname , ' ', register_lname) AS name, `USER_BANK_NAME`, `USER_ACCOUNT_NO`, `USER_IFSC`,`USER_BANK_BRANCH` FROM `msd_user_bankdtl_table` LEFT JOIN `msd_register_customer_table` ON `register_id` = `ACCOUNT_HOLDER_NAME` AND register_status != 2 WHERE `STATUS` != 2 AND TYPE = 'customer' UNION SELECT `ACCOUNT_HOLDER_NAME`, `agent_name` AS name, `USER_BANK_NAME`, `USER_ACCOUNT_NO`, `USER_IFSC`,`USER_BANK_BRANCH` FROM `msd_user_bankdtl_table` bnk LEFT JOIN `msd_register_comp_agent_table` ag ON `agent_id` = `ACCOUNT_HOLDER_NAME` AND ag.`status` != 2 WHERE bnk.`STATUS` != 2 AND TYPE = 'agent'";
                                        } else {
                                            $query = "";
                                        }
                                        $i =0;
                                   
                                    echo '<div id="table-wrapper">            
                                        <div id="table-scroll">
                                            <table id="tblData" class="mb-0 table table-bordered">
                                            <thead>
                                            <tr>
                                            <th>Sr.No.</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Bank name</th>
                                            <th>Account Number</th>
                                            <th>Branch</th>
                                            <th>IFSC</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr style="font-weight: bolder;"><td colspan="6" style="text-align: center;">Opening Balance</td>
                                                <td>0</td>
                                            </tr>';
                                    if ($result = $conn->query($query)) {
                                                while ($row = $result->fetch_assoc()) {

                                                    $id = $row["ACCOUNT_HOLDER_NAME"];
                                                    $name = $row["name"];
                                                    $USER_BANK_NAME = $row["USER_BANK_NAME"];
                                                    $USER_ACCOUNT_NO = $row["USER_ACCOUNT_NO"];
                                                    $USER_IFSC = $row["USER_IFSC"];
                                                    $USER_BANK_BRANCH = $row["USER_BANK_BRANCH"];

                                                  
                                                    echo'<tr>
                                                    <td>'.++$i.'</td>
                                                    <td>'.$id.'</td>
                                                    <td>'.$name.'</td>
                                                    <td>'.$USER_BANK_NAME.'</td>
                                                    <td>'.$USER_ACCOUNT_NO.'</td>
                                                    <td>'.$USER_BANK_BRANCH.'</td>
                                                    <td>'.$USER_IFSC.'</td>
                                                    </tr>';
                                                    }
                                                    $result->free();
                                                    echo '</tbody>
                                                  
                                                </table></div></div>';
                                    }



                                

                            echo '</p>
                            </div>
                            <div><form></div>
                            </div>
                        </div>
                    </div></div></div>';
                                
                        ?>
                    </div>
    <script type="text/javascript" src="dist/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    <script>
        function ExportExcel(type, fn, dl) {
            var elt = document.getElementById('tblData');
            var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
            return dl ?
               XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
               XLSX.writeFile(wb, fn || ('Bank_Details_Report.' + (type || 'xlsx')));
        }

    </script>
    
</body>
</html>
<?php include 'footer.php';?>