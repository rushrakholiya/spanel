<?php
include_once 'db_connect.php';
include_once 'function.php'; 
define("SITE_URL", get_site_url($mysqli)); 
define("SITE_NAME", get_site_name($mysqli)); 

$mailtemplate = $mysqli->prepare("SELECT meta_value FROM options WHERE meta_key = 'mail_template'");
$mailtemplate->execute();
$mailtemplate->store_result();                  
$mailtemplate->bind_result($metavalue);
$mailtemplate->fetch();

/*Logic for one month before expiration */
$myDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+1 month" ));

$supportexpdate = $mysqli->prepare("SELECT user_id FROM app_register_service_master
 WHERE support_expiry_date = '$myDate'");

$supportexpdate->execute();
$supportexpdate->store_result();                  
$supportexpdate->bind_result($user_id);
$userid = "";
while ($supportexpdate->fetch()) {	
	$userid .= $user_id.",";
}
$userid = rtrim($userid,",");

if($userid != ""):

	$stmt = $mysqli->prepare("SELECT app_registerid,contact_name,emailid,productid,support_expiry_date FROM app_register_master WHERE app_registerid IN(".$userid.")");
	$stmt->execute();
	$stmt->store_result();                                          
	$stmt->bind_result($app_registerid,$contact_name,$emailid,$productid,$support_expiry_date);

	       
	$one_month_expiration_message = $mysqli->prepare("SELECT meta_value FROM options WHERE meta_key ='one_day_expiration_message'");
	$one_month_expiration_message->execute();
	$one_month_expiration_message->store_result();                  
	$one_month_expiration_message->bind_result($one_month_expiration_message);
	$one_month_expiration_message->fetch();                    

	$cleanedFrom = "info@jmscpos.com";
	$filename ="cron_log.txt";
	while ($stmt->fetch()) {
		
		$metavalue = str_replace("#REGISTRANTNAME",$contact_name,$metavalue);
		$metavalue = str_replace("#APPLICATIONNAME",$contact_name,$metavalue);
		$metavalue = str_replace("#APPREGISTERID",SITE_NAME,$metavalue);
		$metavalue = str_replace("#PRODUTNAME",get_product_name($mysqli,$productid),$metavalue);
		$metavalue = str_replace("#EXPIRYDATE",$support_expiry_date,$metavalue);
		$meta_key = str_replace("#MESSAGE", $one_month_expiration_message, $metavalue);

		$to = $emailid;
				
		$subject = 'Important - one month remain';	
		$headers = "From: " . $cleanedFrom . "\r\n";
		$headers .= "Reply-To: ". strip_tags($cleanedFrom) . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


		if (mail($to, $subject, $metavalue, $headers)) {
	      $str = "#".$app_registerid."-"."Mail sent for one month";
	    } else {
	      $str = "#".$app_registerid."-"."Mail not sent for one month";
	    }	

	    $fd = fopen($filename, "a");   
	   	fwrite($fd, $str . "\n");
	   	fclose($fd);
	}

endif;
/*End logic for one month before expiration */


/*Logic for before one week expiration */
$week_ago = date('Y-m-d', strtotime('+7 days', strtotime(date("Y-m-d"))));

$supportexpdate = $mysqli->prepare("SELECT user_id FROM app_register_service_master
 WHERE support_expiry_date = '$week_ago'");

$supportexpdate->execute();
$supportexpdate->store_result();                  
$supportexpdate->bind_result($user_id);
$userid = "";
while ($supportexpdate->fetch()) {	
	$userid .= $user_id.",";
}
$userid = rtrim($userid,",");

if($userid != ""):

	$stmt = $mysqli->prepare("SELECT app_registerid,contact_name,emailid,productid,support_expiry_date FROM app_register_master WHERE support_expiry_date = '$week_ago'");
	$stmt->execute();
	$stmt->store_result();                                          
	$stmt->bind_result($app_registerid,$contact_name,$emailid,$productid,$support_expiry_date);

	$one_week_expiration_message = $mysqli->prepare("SELECT meta_value FROM options WHERE app_registerid IN(".$userid.")");
	$one_week_expiration_message->execute();
	$one_week_expiration_message->store_result();                  
	$one_week_expiration_message->bind_result($one_week_expiration_message);
	$one_week_expiration_message->fetch(); 


	$cleanedFrom = "info@xyz.com";
	$filename ="cron_log.txt";
	while ($stmt->fetch()) {
		
		$metavalue = str_replace("#REGISTRANTNAME",$contact_name,$metavalue);
		$metavalue = str_replace("#APPLICATIONNAME",$contact_name,$metavalue);
		$metavalue = str_replace("#APPREGISTERID",SITE_NAME,$metavalue);
		$metavalue = str_replace("#PRODUTNAME",get_product_name($mysqli,$productid),$metavalue);
		$metavalue = str_replace("#EXPIRYDATE",$support_expiry_date,$metavalue);
		$meta_key = str_replace("#MESSAGE", $one_week_expiration_message, $metavalue);
		$to = $emailid;
				
		$subject = 'Important - one week remain';	
		$headers = "From: " . $cleanedFrom . "\r\n";
		$headers .= "Reply-To: ". strip_tags($cleanedFrom) . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		if (mail($to, $subject, $metavalue, $headers)) {
	      $str = "#".$app_registerid."-"."Mail sent for one week";
	    } else {
	      $str = "#".$app_registerid."-"."Mail not sent for one week";
	    }	

	    $fd = fopen($filename, "a");   
	   	fwrite($fd, $str . "\n");
	   	fclose($fd);
	}
endif;
/*End logic for before one week expiration */

/*Logic for expiration */
$supportexpdate = $mysqli->prepare("SELECT user_id FROM app_register_service_master
 WHERE support_expiry_date < CURDATE() AND current_status = 2"); 
$supportexpdate->execute();
$supportexpdate->store_result();                  
$supportexpdate->bind_result($user_id);
$userid = "";
while ($supportexpdate->fetch()) {	
	$userid .= $user_id.",";
}
$userid = rtrim($userid,",");

if($userid != ""):
	$stmt = $mysqli->prepare("SELECT app_registerid,contact_name,emailid,productid,support_expiry_date FROM app_register_master WHERE app_registerid IN(".$userid.")");
	$stmt->execute();
	$stmt->store_result();                                          
	$stmt->bind_result($app_registerid,$contact_name,$emailid,$productid,$support_expiry_date);
	while ($stmt->fetch()) {	
		$service_extended = $mysqli->prepare("UPDATE app_register_service_master
 		SET current_status = ? WHERE user_id = ?");
	   	$update_current_status = 0;
	    $service_extended->bind_param('ii', $update_current_status,$app_registerid);
	   	$service_extended->execute();
	}
endif;
/*Logic for expiration */

/*Logic for day of expiration */
$service_extended = date('Y-m-d', strtotime(date("Y-m-d")));
$supportexpdate = $mysqli->prepare("SELECT user_id FROM app_register_service_master
 WHERE support_expiry_date = '$service_extended' AND current_status = 1");

$supportexpdate->execute();
$supportexpdate->store_result();                  
$supportexpdate->bind_result($user_id);
$userid = "";
while ($supportexpdate->fetch()) {	
	$userid .= $user_id.",";
}
$userid = rtrim($userid,",");

if($userid != ""):
$stmt = $mysqli->prepare("SELECT app_registerid,contact_name,emailid,productid,support_expiry_date FROM app_register_master WHERE app_registerid IN(".$userid.")");
$stmt->execute();
$stmt->store_result();                                          
$stmt->bind_result($app_registerid,$contact_name,$emailid,$productid,$support_expiry_date);

$one_day_expiration_message = $mysqli->prepare("SELECT meta_value FROM options WHERE meta_key ='one_day_expiration_message'");
$one_day_expiration_message->execute();
$one_day_expiration_message->store_result();                  
$one_day_expiration_message->bind_result($one_day_expiration_message);
$one_day_expiration_message->fetch(); 

$cleanedFrom = "info@xyz.com";
$filename ="cron_log.txt";
while ($stmt->fetch()) {
	
	$metavalue = str_replace("#REGISTRANTNAME",$contact_name,$metavalue);
	$metavalue = str_replace("#APPLICATIONNAME",$contact_name,$metavalue);
	$metavalue = str_replace("#APPREGISTERID",SITE_NAME,$metavalue);
	$metavalue = str_replace("#PRODUTNAME",get_product_name($mysqli,$productid),$metavalue);
	$metavalue = str_replace("#EXPIRYDATE",$support_expiry_date,$metavalue);
	$meta_key = str_replace("#MESSAGE", $one_day_expiration_message, $metavalue);
	$to = $emailid;
			
	$subject = 'Important - service extended';	
	$headers = "From: " . $cleanedFrom . "\r\n";
	$headers .= "Reply-To: ". strip_tags($cleanedFrom) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	if (mail($to, $subject, $metavalue, $headers)) {
      $str = "#".$app_registerid."-"."Mail sent for service extended";
    } else {
      $str = "#".$app_registerid."-"."Mail not sent for service extended";
    }	

    $service_extended = $mysqli->prepare("UPDATE app_register_service_master SET currentstatus = ?
   	WHERE user_id = ?");
   	$update_current_status = 2;
    $service_extended->bind_param('ii', $update_current_status,$app_registerid);
   	$service_extended->execute();

    $fd = fopen($filename, "a");   
   	fwrite($fd, $str . "\n");
   	fclose($fd);
}
endif;
/*Logic for day of expiration */
?>