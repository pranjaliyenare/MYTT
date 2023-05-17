<?php
    $xwaykey='a6e27b4e9b1055f3e5bb17bc214e10ed'; // Provided by swipez admin
     $hash = $xwaykey."|".$_POST['account_id']."|".$_POST['amount']."|".$_POST['reference_no']."|".$_POST['return_url'];
     $secure_hash = md5($hash);
    // Add Data in Mytt Database
        include 'database.php';
        $query= "INSERT INTO `msd_xway_pay_accdtl_table`(`account_id`, `vendor_id`, `reference_no`, `amount`, `description`, `return_url`, `name`, `address`, `city`, `state`, `postal_code`, `mobile`, `email`, `userid`, `paymentby`, `plan_id`, `Udf4`, `Udf5`, `Secure_hash`) VALUES ('". $_POST['account_id']."', '". $_POST['vendor_id']."', '". $_POST['reference_no']."','". $_POST['amount']."','". $_POST['description']."','". $_POST['return_url']."','". $_POST['name']."','". $_POST['address']."','". $_POST['city']."','". $_POST['state']."','". $_POST['postal_code']."','". $_POST['phone']."','". $_POST['email']."','". $_POST['udf1']."','". $_POST['udf2']."','". $_POST['udf3']."','". $_POST['udf4']."','". $_POST['udf5']."','". $secure_hash."')";
        $result = $conn->query($query);
        //  if($result)
        // {
        //     echo "<script>alert('Your Data Submitted Successfully')</script>";
        // }
        // else
        // {
        //     echo "<script>alert('Your Data Not Submitted Successfully')</script>";
        // }
?>
<html>
    <body oncontextmenu="return false;">
        <form  method="post" action="https://www.swipez.in/xway/secure" name="frmTransaction" id="frmTransaction" onSubmit="return validate()">
            <input name="account_id" type="hidden" value="<?php echo $_POST['account_id'] ?>">
            <input name="return_url" type="hidden" size="60" value="<?php echo $_POST['return_url'] ?>" />
            <input name="reference_no" type="hidden" value="<?php echo  $_POST['reference_no'] ?>" />
            <input name="amount" type="hidden" value="<?php echo $_POST['amount']?>"/>
            <input name="description" type="hidden" value="<?php echo $_POST['description'] ?>" /> 
            <input name="name" type="hidden" maxlength="255" value="<?php echo $_POST['name'] ?>" />
            <input name="address" type="hidden" maxlength="255" value="<?php echo $_POST['address'] ?>" />
            <input name="city" type="hidden" maxlength="255" value="<?php echo $_POST['city'] ?>" />
            <input name="state" type="hidden" maxlength="255" value="<?php echo $_POST['state'] ?>" />
            <input name="postal_code" type="hidden" maxlength="255" value="<?php echo $_POST['postal_code'] ?>" />
            <input name="phone" type="hidden" maxlength="255" value="<?php echo $_POST['phone'] ?>" />
            <input name="email" type="hidden" size="60" value="<?php echo $_POST['email']?>" />
            <input name="vendor_id" type="hidden" value="<?php echo $_POST['vendor_id']?>" />
            <input name="udf1" type="hidden" size="60" value="<?php echo $_POST['udf1']?>" />
            <input name="udf2" type="hidden" size="60" value="<?php echo $_POST['udf2']?>" />
            <input name="udf3" type="hidden" size="60" value="<?php echo $_POST['udf3']?>" />
            <input name="udf4" type="hidden" size="60" value="<?php echo $_POST['udf4']?>" />
            <input name="udf5" type="hidden" size="60" value="<?php echo $_POST['udf5']?>" />
            <input name="secure_hash" type="hidden" size="60" value="<?php echo $secure_hash;?>" />
        </form>
        
        <script type="text/javascript">
        document.getElementById("frmTransaction").submit();
        </script>
    </body>
</html>

