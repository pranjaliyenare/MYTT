<?php
   $whitelist = [
    // IPv4 address
    '127.0.0.1', 
  
    // IPv6 address
    '::1'
  ];
  
      if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) 
      {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "allianza_crm_mytt";
      } else {
        $servername = "allianza.in";
        $username = "allianza_crm_mytt";
        $password = "3,mx-M=EsMHW";
        $dbname = "allianza_crm_mytt";
      }
  
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    } 
  
    // $projects = array();
    // $records = mysqli_query($conn, "SELECT `register_id` FROM `msd_register_customer_table` WHERE `register_approved_status` = 'approved' AND `register_activate_status`= 'activate' AND `register_status` != 2");
    
    //   while ($project =  mysqli_fetch_assoc($records))
    //   {
    //       $projects[] = $project;
    //   }
    //   foreach ($projects as $project)
    //   { 
    //       $query = mysqli_query($conn, "SET sql_mode = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");     
    //       $query = mysqli_query($conn, "SELECT `register_id`, `agent_id`, SUM(PAY.amount) AS amt, `register_profit_perc` cust_perc, `register_agent_profit_perc` agent_perc FROM `msd_register_customer_table` CUST LEFT JOIN `msd_xway_pay_response_table` PAY ON CUST.`register_id` = PAY.`userid`  AND PAY.`status` != 'failed' WHERE `register_id` = '". $project["register_id"]."' AND `register_approved_status` = 'approved' AND `register_status` != 2");
    //       $reg_array = mysqli_fetch_assoc($query);            
        
    //       $custperc = $reg_array["cust_perc"]/100;
    //       $agentperc = $reg_array["agent_perc"]/100;
          
    //       $custperc1 =  ($reg_array["amt"]*$custperc);
    //       $agentperc1 = $reg_array["amt"]*$agentperc;

    //       $cust_profit =  $custperc1/30;
    //       $agent_profit = $agentperc1/30;
          
    //       $record = mysqli_query($conn, "INSERT INTO `msd_profit_table`(`userid`, `admin_id`, `mgr_id`, `emp_id`, `agent_id`, `amount`, `agent_perc`, `cust_percentage`, `agent_profit_amount`, `cust_profit_amount`, `type`) VALUES ('".$reg_array["register_id"]."','".$reg_array["agent_id"]."','','','','".$reg_array["amt"]."','".$reg_array["agent_perc"]."','".$reg_array["cust_perc"]."','".$agent_profit."','".$cust_profit."','customer')");
          
    //   }
    $plan_array = array();
    $query = mysqli_query($conn, "SELECT * FROM `msd_customer_plan_table` WHERE `compo_plan` = 'YES' AND `active_status` = 'active' AND `status` != 2");
    //$plan_array = mysqli_fetch_assoc($query);  
    while ($planarray =  mysqli_fetch_assoc($query))
    {
       $plan_array[] = $planarray;
    }
    foreach ($plan_array as $planarray)
    { 
    
        $date = $planarray["start_date"];
        $day = date("d", strtotime($date));
        $month =  date("m", strtotime($date));
        $year =  date("Y", strtotime($date));
        $dayToday = date("d", strtotime(date("Y-m-d")));
        $monthToday =  date("m", strtotime(date("Y-m-d")));
        $yearToday =  date("Y", strtotime(date("Y-m-d")));
        if($day == $dayToday) { 
          $profit_query =  mysqli_query($conn, "SELECT * FROM `msd_profit_table` WHERE `plan_id` = '".$planarray['plan_id']."' AND `status` !=2 ORDER BY id DESC LIMIT 1;");
          $profit_array = mysqli_fetch_assoc($profit_query); 
          if(isset($profit_array)) {
            $total_amt = $profit_array['amount'] + $profit_array['cust_profit_amount'];
            $profit_amt = $total_amt*$profit_array['cust_percentage']/100;
            $record = mysqli_query($conn, "INSERT INTO `msd_profit_table`(`userid`, `admin_id`, `plan_id`, `amount`, `cust_percentage`, `cust_profit_amount`, `type`) VALUES ('".$profit_array['userid']."', '".$profit_array['admin_id']."', '".$profit_array['plan_id']."', '".$total_amt."', '".$profit_array['cust_percentage']."','".$profit_amt."', 'customer')");
        } else {
            $plan_query = mysqli_query($conn, "SELECT * FROM `msd_customer_plan_table` WHERE `compo_plan` = 'YES' AND `plan_id` = '".$planarray['plan_id']."' AND `status` != 2");
            $p_array = mysqli_fetch_assoc($plan_query);  
            echo $profit_amt = $p_array["deposit_amt"]*$p_array['profit_perc']/100;
            $record = mysqli_query($conn, "INSERT INTO `msd_profit_table`(`userid`, `admin_id`, `plan_id`, `amount`, `cust_percentage`, `cust_profit_amount`, `type`) VALUES ('".$p_array['customer_id']."', 'MS0001A', '".$p_array['plan_id']."', '".$p_array['deposit_amt']."', '".$p_array['profit_perc']."','".$profit_amt."', 'customer')");
        } 
      }
    }   
// Cron Job New Plan Add Profit Per Month
    $newplanquery = mysqli_query($conn, "SELECT PLAN.`plan_id` plan_id, `start_date`, `end_date`, `customer_id` FROM `msd_plan_table` NEWPLAN INNER JOIN `msd_customer_plan_table` PLAN ON PLAN.`plan_new_id` = NEWPLAN.`plan_id` AND PLAN.`status` != 2 AND PLAN.`active_status` = 'active' WHERE NEWPLAN.`plan_payout` = 'maturity' AND NEWPLAN.`status` != 2");
    while ($newplan1 =  mysqli_fetch_assoc($newplanquery))
    {
        $newplans[] = $newplan1;
    }
    
    if (!empty($newplans)) {
        foreach ($newplans as $newplan) {
              $date = $newplan["start_date"];
              $day = date("d", strtotime($date));
              $dayToday = date("d", strtotime(date("Y-m-d")));

              if ($day == $dayToday) {                 
                 $query = mysqli_query($conn, "SELECT PERC.*, Sum(amount) amt FROM `msd_transaction_role_perc_table` PERC RIGHT JOIN `msd_xway_pay_response_table` PAY ON PERC.`customer_id` = PAY.`userid` AND PERC.`plan_id` = PAY.`plan_id` AND PAY.`status` != 'failed' WHERE PERC.`customer_id` = '".$newplan["customer_id"]."' AND PERC.`plan_id` = '".$newplan["plan_id"]."' AND PERC.`status` != 2");
                 $reg_array = mysqli_fetch_assoc($query);
                 
                     $custperc   = $reg_array["customer_perc"]/100;
                     $agentperc1 = $reg_array["agent_perc1"]/100;
                     $agentperc2 = $reg_array["agent_perc2"]/100;
                     $agentperc3 = $reg_array["agent_perc3"]/100;
                     $agentperc4 = $reg_array["agent_perc4"]/100;
                     $agentperc5 = $reg_array["agent_perc5"]/100;
                     $agentperc6 = $reg_array["agent_perc6"]/100;
                  
                     $cust_profit =  ($reg_array["amt"]*$custperc);
                     $agent_profit1 = $reg_array["amt"]*$agentperc1;
                     $agent_profit2 = $reg_array["amt"]*$agentperc2;
                     $agent_profit3 = $reg_array["amt"]*$agentperc3;
                     $agent_profit4 = $reg_array["amt"]*$agentperc4;
                     $agent_profit5 = $reg_array["amt"]*$agentperc5;
                     $agent_profit6 = $reg_array["amt"]*$agentperc6;

                    $record = mysqli_query($conn, "INSERT INTO `msd_profit_table`(`userid`, `admin_id`, `plan_id`, `amount`, `cust_percentage`, `cust_profit_amount`, `agent_id`, `agent_perc`, `agent_profit_amount`, `agent_id2`, `agent_perc2`, `agent_profit_amount2`, `agent_id3`, `agent_perc3`, `agent_profit_amount3`, `agent_id4`, `agent_perc4`, `agent_profit_amount4`, `agent_id5`, `agent_perc5`, `agent_profit_amount5`, `agent_id6`, `agent_perc6`, `agent_profit_amount6`, `type`) VALUES ('".$reg_array["customer_id"]."','".$reg_array["agent_id1"]."','".$reg_array["plan_id"]."', '".$reg_array["amt"]."','".$reg_array["customer_perc"]."','".$cust_profit."','".$reg_array["agent_id1"]."','".$reg_array["agent_perc1"]."','".$agent_profit1."','".$reg_array["agent_id2"]."','".$reg_array["agent_perc2"]."','".$agent_profit2."','".$reg_array["agent_id3"]."','".$reg_array["agent_perc3"]."','".$agent_profit3."','".$reg_array["agent_id4"]."','".$reg_array["agent_perc4"]."','".$agent_profit4."','".$reg_array["agent_id5"]."','".$reg_array["agent_perc5"]."','".$agent_profit5."','".$reg_array["agent_id6"]."','".$reg_array["agent_perc6"]."','".$agent_profit6."','customer')");
                    if ($record) {
                        echo 'success';
                    } else {
                      echo 'failed';
                    }                 
             }
        }
    }
  
?>  