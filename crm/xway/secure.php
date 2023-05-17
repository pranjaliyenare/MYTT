<?php
$xwaykey='bc8f751c566fc2991e0b9bcf4642f39e'; // Provided by swipez admin
$hash = $xwaykey."|".$_POST['account_id']."|".$_POST['amount']."|".$_POST['reference_no']."|".$_POST['return_url'];
$secure_hash = md5($hash);


?>
<html>
<body oncontextmenu="return false;">
<form  method="post" action="https://h7sak8am43.swipez.in/xway/secure" name="frmTransaction" id="frmTransaction" onSubmit="return validate()">
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
<!-- <input name="udf1" type="hidden" size="60" value="<?php echo $_POST['udf1']?>" />
<input name="udf2" type="hidden" size="60" value="<?php echo $_POST['udf2']?>" />
<input name="udf3" type="hidden" size="60" value="<?php echo $_POST['udf3']?>" />
<input name="udf4" type="hidden" size="60" value="<?php echo $_POST['udf4']?>" />
<input name="udf5" type="hidden" size="60" value="<?php echo $_POST['udf5']?>" /> -->
<input name="secure_hash" type="hidden" size="60" value="<?php echo $secure_hash;?>" />
</form>

</body>
<script type="text/javascript">

document.getElementById("frmTransaction").submit();

</script>
</html>

