<link href="./main.css" rel="stylesheet">
<script type="text/javascript" src="./assets/scripts/main.js"></script>

<?php include 'header.php'; 
      include 'database.php';
?>
<?php
// Create a function for converting the amount in words
function numberTowords(float $amount)
{
   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
   // Check if there is any number after decimal
   $amt_hundred = null;
   $count_length = strlen($num);
   $x = 0;
   $string = array();
   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
     40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
  $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
  while( $x < $count_length ) {
       $get_divider = ($x == 2) ? 10 : 100;
       $amount = floor($num % $get_divider);
       $num = floor($num / $get_divider);
       $x += $get_divider == 10 ? 1 : 2;
       if ($amount) {
         $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
         $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
         $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
         '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
         '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
         }else $string[] = null;
       }
   $implode_to_Rupees = implode('', array_reverse($string));
   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
   return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
}
 
?>

<!-- <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> -->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Receipt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">
</head>
<style type="text/css">
@media print
{
body * { visibility: hidden; }
#divContent * { visibility: visible; }
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
                    <div>Receipt
                        <div class="page-title-subheading"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title"></h5>
                        <form class="" method="post" action="#">
                        <div class="position-relative row form-group">
                            <label for="exampleEmail" class="col-sm-2 col-form-label"><b>Customer :</b></label>
                                        <div class="col-sm-6">
                                                <?php 
                                                    if($_SESSION['ROLE'] == "admin") {
                                                            echo '<select onchange="custChange()" class="mb-2 form-control" name="customer_name" id="customer_id" >';
                                                            $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE  `register_approved_status` = 'approved' AND `register_status` != 2");
                                                            $row = mysqli_num_rows($sql);
                                                            while ($row = mysqli_fetch_array($sql)) {
                                                                if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                                echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                                $selected ="";
                                                        }
                                                        echo '</select>
                                                        <div class="select-dropdown"></div>';
                                                    } else if($_SESSION['ROLE'] == "manager") {
                                                        echo '<select onchange="custChange()" class="mb-2 form-control" name="customer_name" id="customer_id" >';
                                                        $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE reference_id = '".$_SESSION['USERID']."' AND `register_approved_status` = 'approved' AND `register_status` != 2");
                                                        $row = mysqli_num_rows($sql);
                                                        while ($row = mysqli_fetch_array($sql)) {
                                                            if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                            echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                            $selected ="";
                                                    }
                                                    echo '</select>
                                                    <div class="select-dropdown"></div>';
                                                } else if($_SESSION['ROLE'] == "employee") {
                                                    echo '<select onchange="custChange()" class="mb-2 form-control" name="customer_name" id="customer_id" >';
                                                    $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE reference_id = '".$_SESSION['USERID']."' AND `register_approved_status` = 'approved' AND `register_status` != 2");
                                                    $row = mysqli_num_rows($sql);
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                        if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                        echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ; 
                                                        $selected ="";
                                                }
                                                echo '</select>
                                                <div class="select-dropdown"></div>';
                                            } else if($_SESSION['ROLE'] == "agent") {
                                                echo '<select onchange="custChange()" class="mb-2 form-control" name="customer_name" id="customer_id" >';
                                                $sql = mysqli_query($conn, "SELECT register_id AS id, concat(register_fname, ' ' ,register_lname) AS name FROM `msd_register_customer_table` WHERE agent_id = '".$_SESSION['USERID']."' AND `register_approved_status` = 'approved' AND s`register_status` != 2");
                                                $row = mysqli_num_rows($sql);
                                                while ($row = mysqli_fetch_array($sql)) {
                                                    if($_POST['customer_name'] == $row['id']) { $selected='selected'; }
                                                    echo "<option value='". $row['id'] ."' ".$selected.">" .$row['name'] ."</option>" ;
                                                    $selected ="";
                                            }
                                            echo '</select>
                                            <div class="select-dropdown"></div>';
                                        }
                                    ?>
                                        </div>
                                        <input class="mb-2 mr-2 btn btn-primary" type="submit" name="submit" value="Search" />
                        </div>
                        
                        </form>
                        </div>
                </div>
            </div>
        </div>

        <?php
         if(isset($_POST['submit'])){
             $cnt= "SELECT COUNT(*) CNT FROM `msd_xway_pay_response_table` AS PAY WHERE `userid` = '".$_POST['customer_name']."' AND `status` != 2";
            $i = 0;
             $queryr = "SELECT `register_id`, `register_fname`, `register_lname`, PAY.`date` dt, amount, transaction_id, mode FROM `msd_register_customer_table` LEFT JOIN `msd_xway_pay_response_table` AS PAY ON `userid` = `register_id` AND `status` != 2 WHERE `register_id` = '".$_POST['customer_name']."' AND `register_status` != 2 ORDER BY dt DESC   ";
             if ($result = $conn->query($queryr)) {
                 while ($row = $result->fetch_assoc()) {
                     $dt = $row["dt"];
                     $userId =$row['register_fname']." ".$row['register_lname'];
                     $register_id = $row["register_id"];
                     $amount = $row["amount"];
                     $transaction_id = $row["transaction_id"];
                     $mode = $row["mode"];
                     $get_amount= numberTowords($amount);
         echo '<input type="button" class="mb-2 mr-2 btn btn-success active" value="Print" onclick="printDiv('.++$i.')"> 
              
                <div class="tab-content">
                    <div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel">
                    <div class="row"></div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="main-card mb-3 card" id="divContent'.$i.'">
                                    <!-- <img width="100%" src="assets/images/MindStayCircleLogo.png" alt="Card image cap" class="card-img-top" style="width: 100px; height: 100px;"> MyThink Tank Multimedia Pvt Ltd -->
                                    <div class="card-body" style="border: solid; border-color: #1a75c6;" >
                                        <!-- <h5 class="card-title">Card title</h5><h6 class="card-subtitle">Card subtitle</h6> -->
                                        <!-- Some quick example text to build on the card title and make up the bulk of the cards content. -->
                                        <!-- <button class="btn btn-secondary">Button</button> -->
                                        <!-- #######  YAY, I AM THE SOURCE EDITOR! #########-->
                                        <h3 style="text-align: center;"><img src="./assets/images/logo.png" alt="Logo" width="100" height="100" /><span style="color: #1a75c6;">&nbsp;&nbsp;&nbsp;&nbsp;<strong style="text-shadow: -1px 1px 0 #fff;">MyThink Tank Multimedia Pvt Ltd</strong></span></h3>
                                        <hr />
                                        <p style="text-align: center;"><strong>Office No.102, Gandharva Galaxia, Above Naturals Ice-Cream, Magarpatta Rd, Hadapsar, Pune-411028</strong></p>
                                        <hr />
                                        <p style="text-align: center;font-size: x-large;"><strong>&nbsp; Payment Receipt</strong></p><br/>
                                        <p style="text-align: center;"><strong>MYTT Account No.: </strong><strong>'.$register_id.'</strong><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Date: '.date("d-m-Y", strtotime($dt)).' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</strong></p>
                                        <p style="text-align: left;"><strong>Received amount is <u>&nbsp;&nbsp;&nbsp;&nbsp;</u></strong><strong><u>'.$amount.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u></strong><strong>&nbsp;/- </strong></p>
                                        <p style="text-align: left;"><strong>(In words - <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></strong><strong><u>'.$get_amount.' Only</u></strong><strong><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u></strong><strong>).</strong></p>
                                        <p style="text-align: left;"><strong>From Mr/Mrs <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></strong><strong><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$userId.'</u></strong><strong><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></strong><strong>.</strong></p>
                                        <p style="text-align: left;"><strong>Reference number is &ndash;&nbsp; <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></strong><strong><u>&nbsp;&nbsp;&nbsp;'.$transaction_id.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</u></strong><strong>.</strong></p>
                                        <p style="text-align: left;"><strong>This Transaction done via - <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></strong><strong><u>Online Transfer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &amp; Cash&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u></strong><strong><u>&nbsp;</u></strong><strong>.</strong></p>
                                        <p style="text-align: center;"><strong>&nbsp;</strong></p>
                                        <p style="text-align: right;"><strong>&nbsp; For MyThink Tank,</strong></p> <img src="./assets/images/myttStamp.png" alt="Stamp" width="150" height="140" style="float: right;"/> <br><br/><br/
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div></div>';
                 }
                }
            }
                ?>
          
    </div></div>
</div>
<script>
      
        function printDiv(id) {
           var str1 = "divContent";
           var str3 =  str1.concat(id);
          
            var divContents = document.getElementById(str3).innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html>');
            a.document.write('<body> <br>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
      
       function generatePDF(id) {
         var doc = new jsPDF();  //create jsPDF object
         var str1 = "divContent";
         var str3 =  str1.concat(id);
          doc.fromHTML(`<html><head><title>Receipt</title></head><body>` + document.getElementById(str3).innerHTML + `</body></html>`, // page element which you want to print as PDF
          15,
          15, 
          {
            'width': 170  //set width
          },
          function(a) 
           {
            doc.save("Receipt.pdf"); // save file name as HTML2PDF.pdf
          });
        }
    </script>
</body>
</html>
<?php include 'footer.php';?>