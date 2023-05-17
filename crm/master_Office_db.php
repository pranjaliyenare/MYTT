
<?php
include 'database.php';
if(isset($_POST['bank_submit'])) {
    $query="INSERT INTO `msd_comp_deposit_dtl_table`(`deposit_date`, `deposit_amt`, `payment_type`, `received_name`, `deposit_transfer_bank`) VALUES ('".$_POST['date']."','".$_POST['deposit']."','".$_POST['radio2']."','".$_POST['receivedname']."','".$_POST['transferBank_name']."')";
    $result = $conn->query($query);
 
      if($result)
      {
         echo "<script>alert('Record Added Successfully')</script>";
         echo "<script>window.location = 'master_office_add';</script>";
      }
      else
      {
         echo "<script>alert('Record Not Added Successfully')</script>";
         echo "<script>window.location = 'master_office_add';</script>";
     }
}

if(isset($_POST['trade_submit'])) {
    $query="INSERT INTO `msd_comp_trade_dtl_table`(`trade_date`, `trade_transfer_name`, `from_bank`, `trade_account`, `trade_amount`) VALUES ('".$_POST['trd_date']."','".$_POST['trd_rec_name']."','".$_POST['trd_transferBank_name']."','".$_POST['trd_acc_name']."','".$_POST['trd_amt']."')";
        $result = $conn->query($query);
     
          if($result)
          {
             echo "<script>alert('Record Added Successfully')</script>";
             echo "<script>window.location = 'master_office_add';</script>";
          }
          else
          {
             echo "<script>alert('Record Not Added Successfully')</script>";
             echo "<script>window.location = 'master_office_add';</script>";
         }
    }


if(isset($_POST['pft_loss_submit'])) {
     $query="INSERT INTO `msd_comp_profit_loss_dtl_table`(`pft_loss_date`, `trade_acc_name`, `profit_or_loss`, `profit_amt`, `loss_amt`) VALUES ('".$_POST['pft_loss_date']."','".$_POST['pft_loss_acc_name']."','".$_POST['radiopl']."','".$_POST['profit']."','".$_POST['loss']."')";
        $result = $conn->query($query);
     
          if($result)
          {
             echo "<script>alert('Record Added Successfully')</script>";
             echo "<script>window.location = 'master_office_add';</script>";
          }
          else
          {
             echo "<script>alert('Record Not Added Successfully')</script>";
             echo "<script>window.location = 'master_office_add';</script>";
         }
    }
if(isset($_POST['wd_submit'])) {
   $query="INSERT INTO `msd_comp_withdraw_dtl_table`(`wd_date`, `wd_transfer_name`, `wd_trade _acc`, `wd_transfer_bank`, `wd_amount`) VALUES ('".$_POST['wd_req_date']."','".$_POST['wd_rec_name']."','".$_POST['wd_trd_acc_name']."','".$_POST['wd_transferBank_name']."','".$_POST['withdraw']."')";
        $result = $conn->query($query);
     
          if($result)
          {
             echo "<script>alert('Record Added Successfully')</script>";
             echo "<script>window.location = 'master_office_add';</script>";
          }
          else
          {
             echo "<script>alert('Record Not Added Successfully')</script>";
             echo "<script>window.location = 'master_office_add';</script>";
         }
    }

//  if(isset($_SESSION["MO_USER_NAME"])){
//     echo "<script>window.location = 'master_office_add';</script>";
//  } else {
//     echo "<script>window.location = 'master_Office_Login';</script>";
//  }

// if(isset($_POST['submit'])) {
//    $close_amt = $_POST['deposit']-$_POST['withdraw']+$_POST['profit']-$_POST['loss'];
//    $closeamt = $_POST['open_amt']+$close_amt;
//     $query="INSERT INTO `msd_comp_profit_loss_dtl_table`(`add_date`, `open_amt`, `deposit`, `withdraw`, `profit`, `loss`, `close_amt`) VALUES ('".$_POST['date']."','".$_POST['open_amt']."','".$_POST['deposit']."','".$_POST['withdraw']."','".$_POST['profit']."','".$_POST['loss']."','".$closeamt."')";
//         $result = $conn->query($query);
        
//           if($result)
//           {
//              echo "<script>alert('Record Added Successfully')</script>";
//              echo "<script>window.location = 'master_office_add';</script>";
//           }
//           else
//           {
//              echo "<script>alert('Record Not Added Successfully')</script>";
//          }
// } else {
//     echo "Empty Array";
// }
// if (isset($_POST['td_json_comment'])) {
//     $objtd = $_POST['td_json_comment'];
//     $date= date('Y-m-d');
//         $resultDelete = mysqli_query($conn,"DELETE FROM `msd_comp_profit_dtl_table` WHERE `W/D_Req_Date` = '".date('Y-m-d')."' ");
     
//       foreach($objtd as $item) {
//              $date = $_POST['amount_name']; 
//              $mysqltime = $req_date = date("Y-m-d", strtotime($item['2']));
//              $req_date = date("Y-m-d", strtotime($item['10']));

//             $result = mysqli_query($conn,"INSERT INTO `msd_comp_profit_dtl_table`(`Investor_Name`, `Date`, `Amount_Received`, `Received_BY`, `Transfer_To_Bank`, `Tranferred_Amount`, `Trade_A/C`, `Trade_Amount`, `Trade_Profit`, `W/D_Req_Date`, `W/D_Amount`, `W/D_Transfer_To_Bank`, `Trade_A/C_Balance`, `Trade_Transfer_To_Bank`, `Bank_A/C_Balance`, `Total_Balance`) VALUES ('".$item['1']."','".$mysqltime."','".$item['3']."','".$item['4']."','".$item['5']."','".$item['6']."','".$item['7']."','".$item['8']."','".$item['9']."','".$req_date."','".$item['11']."','".$item['12']."','".$item['13']."','".$item['14']."','".$item['15']."','".$item['16']."')");
//         }
//             if($result)
//          {
//             echo "Your Form Submitted Successfully";
//             }
//          else
//          {
//             echo "Your Form Not Submitted, Please Try Again After sometime..!!!";
//         }
//            return $result;
// } else {
//     echo "Empty Array";
// }





?>