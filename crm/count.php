<?php
    $profit_amt = 0.00;
    $withdraw_amt = 0.00;
    $deposit_amt = 0.00;
    $month_withdraw_amt = 0.00;
    $month_deposit_amt= 0.00;
    $month_profit_amt = 0.00;
    $day_deposit_amt= 0.00;
    $day_profit_amt= 0.00;
    $day_withdraw_amt= 0.00;

    $year = date("Y");
    $month = date("m");
    $day = date("d");
    $date = date("Y-m-d");
    $monthdate = date("Y-m");
    
    //Yearly deposit
    $dep_query = mysqli_query($conn, "SELECT SUM(amount) as amt FROM `msd_xway_pay_response_table` WHERE `status` != 'failed' AND `pay_status` !=2;");
    while ($rowdepo = mysqli_fetch_assoc($dep_query)) {
            $deposit_amt = $rowdepo["amt"];
    }
     

    // Yearly Profit
    $profit_query = mysqli_query($conn, "SELECT SUM(cust_profit_amount) AS amount, YEAR(PROFIT.`date`) AS year FROM `msd_profit_table` AS PROFIT INNER JOIN `msd_register_customer_table` AS CUST ON `register_id` = `userid`  AND `register_status` != 2 WHERE  `status` != 2 ");
    while ($row = mysqli_fetch_assoc($profit_query)) {
       $profit_amt = $row["amount"];
    }
       
    // Yearly Withdraw
    $query = mysqli_query($conn, "SELECT SUM(`amount`) AS amount FROM `msd_transaction_withdraw_table` AS WITHDRAW WHERE `approve_status` = 'approved' AND `status` != 2;");
    while ($rowWith = mysqli_fetch_assoc($query)) {
        $withdraw_amt = $rowWith["amount"];
    }
        
    //Monthly deposit
    $month_dep_query = mysqli_query($conn, "SELECT DATE_FORMAT(`pay_date`,'%Y-%m') AS MONTH, MONTH(`pay_date`), SUM(amount) as amt FROM `msd_xway_pay_response_table` INNER JOIN `msd_register_customer_table` ON `register_id` = `userid`  AND `register_status` != 2 WHERE  `status` != 'failed' AND `pay_status` !=2 AND DATE_FORMAT(`pay_date`,'%Y-%m') ='".$monthdate."' GROUP BY MONTH");
    while ($month_dep_array = mysqli_fetch_assoc($month_dep_query)) {
        //if ($month_dep_array["MONTH"] == $monthdate) {
            $month_deposit_amt = $month_dep_array["amt"];
        //}
    }
    //Monthly Profit
    $month_profit_query = mysqli_query($conn, "SELECT DATE_FORMAT(PROFIT.date,'%Y-%m') AS MONTH, SUM(`cust_profit_amount`) AS amount, MONTH(PROFIT.`date`) FROM `msd_profit_table` AS PROFIT INNER JOIN `msd_register_customer_table` AS CUST ON `register_id` = `userid`  AND `register_status` != 2 WHERE  `status` != 2 AND DATE_FORMAT(PROFIT.date,'%Y-%m') = '".$monthdate."' GROUP BY MONTH");
    while ($month_profit_array = mysqli_fetch_assoc($month_profit_query)) {
       // if ($month_profit_array["MONTH"] == $monthdate) {
            $month_profit_amt = $month_profit_array["amount"];
       // }
    }
    //Monthly Withdraw
    $month_query = mysqli_query($conn, "SELECT DATE_FORMAT(WITHDRAW.date,'%Y-%m') AS MONTH, SUM(`amount`) AS amount, MONTH(WITHDRAW.`date`) FROM `msd_transaction_withdraw_table` AS WITHDRAW  WHERE  `approve_status` = 'approved' AND`status` != 2 AND DATE_FORMAT(WITHDRAW.date,'%Y-%m') ='".$monthdate."' GROUP BY MONTH;");
    while ($month_with_array = mysqli_fetch_assoc($month_query)) {
       // if ($month_with_array["MONTH"] == $monthdate) {
            $month_withdraw_amt = $month_with_array["amount"];
       // }
    }

    //Daily deposit
    $day_dep_query = mysqli_query($conn, "SELECT DATE(`pay_date`) AS day, SUM(amount) as amt FROM `msd_xway_pay_response_table` INNER JOIN `msd_register_customer_table` ON `register_id` = `userid`  AND `register_status` != 2 WHERE  `status` != 'failed' AND `pay_status` !=2 AND DATE(`pay_date`) = '".$date."' GROUP BY day;");
    while ($day_rowdepo = mysqli_fetch_assoc($day_dep_query)) {
       // if ($day_rowdepo["day"] == $date) {
            $day_deposit_amt = $day_rowdepo["amt"];
      //  }
    }
    // Daily Profit
    $day_profit_query = mysqli_query($conn, "SELECT SUM(`cust_profit_amount`) AS amount, DATE(PROFIT.`date`) AS day FROM `msd_profit_table` AS PROFIT INNER JOIN `msd_register_customer_table` AS CUST ON `register_id` = `userid`  AND `register_status` != 2 WHERE DATE(PROFIT.`date`) = '".$date."' AND `status` != 2 GROUP BY day;");
    while ($day_row = mysqli_fetch_assoc($day_profit_query)) {
       // if ($day_row["day"] == $date) {
            $day_profit_amt = $day_row["amount"];
       // }
    }

    // Daily Withdraw
    $day_with_query = mysqli_query($conn, "SELECT SUM(`amount`) AS amount, DATE(WITHDRAW.`date`) AS day FROM `msd_transaction_withdraw_table` AS WITHDRAW INNER JOIN `msd_register_customer_table` ON `register_id` = `user_id` AND `register_status` != 2 WHERE `approve_status` = 'approved' AND`status` != 2 AND DATE(WITHDRAW.`date`) = '".$date."' GROUP BY day;");
    //$day_with_query = mysqli_query($conn, "SELECT SUM(`amount`) AS amount, DATE(WITHDRAW.`date`) AS day FROM `msd_transaction_withdraw_table` AS WITHDRAW INNER JOIN `msd_register_customer_table` ON `register_id` = `user_id` AND `register_status` != 2 WHERE `approve_status` = 'approved' AND`status` != 2 AND DATE(WITHDRAW.`date`) = '2022-10-22' GROUP BY day");
    while ($day_rowWith = mysqli_fetch_assoc($day_with_query)) {
       // if ($day_rowWith["day"] == $date) {
            $day_withdraw_amt = $day_rowWith["amount"];
       // }
    }
?>