<?php
include("db_connect.php");
include("function.php");
//include ("../db.php");
//include ("../common.php");
$dongal_id  = $_GET["did"];
$store_id= $_GET["sid"];
$os_id = $_GET['os'];

$xml_string ="";
if ((strlen($store_id) > 0))

{

	//$validate_store_id = onefielddata("select store_id from app_register_master where  DATEDIFF(support_expiry_date,CURDATE()) >= 0 and store_id='$store_id'");
	$validate_store_idObj = $mysqli->prepare("select store_id from app_register_master where  DATEDIFF(support_expiry_date,CURDATE()) >= 0 and store_id='$store_id'");
    $validate_store_idObj->execute();
    $validate_store_idObj->store_result();                  
    $validate_store_idObj->bind_result($validate_store_id);
    $validate_store_idObj->fetch();


$dongal_verification_required="";
if ($validate_store_id != "")
{	
	$dongal_verification_requiredObj = $mysqli->prepare("select dongal_verification_required from app_register_master where   store_id='$store_id'");
    $dongal_verification_requiredObj->execute();
    $dongal_verification_requiredObj->store_result();                  
    $dongal_verification_requiredObj->bind_result($dongal_verification_required);
    $dongal_verification_requiredObj->fetch();

}
if ($dongal_verification_required == "")
$dongal_verification_required ="Y";
$download_allow ="N";
$app_support_expiry_date = "";
//if ((strlen($dongal_id) > 0) &&(strlen($store_id) > 0))


if ((strlen($dongal_id) > 0) &&($dongal_verification_required =="Y" || $dongal_verification_required == "1" ))
{	 
	$app_register_donagal_idObj = $mysqli->prepare("select app_register_master.app_registerid,app_register_donagal_id from app_register_dongal_master,app_register_master where app_register_master.app_registerid = app_register_dongal_master.app_registerid  and FIND_IN_SET('$dongal_id', app_register_dongal_master.dongal_id)>0 and app_register_master.store_id='$store_id'");	
	//and DATEDIFF(app_register_master.support_expiry_date,CURDATE()) >= 0 and app_register_master.store_id='$store_id'

    $app_register_donagal_idObj->execute();
    $app_register_donagal_idObj->store_result();                  
    $app_register_donagal_idObj->bind_result($app_registerid,$app_register_donagal_id);
    $app_register_donagal_idObj->fetch();          


    $support_expiry_dateObj = $mysqli->prepare("select app_register_donagal_id,support_expiry_date,number_of_user from app_register_dongal_master,app_register_service_master
 	where app_register_service_master.user_id = app_register_dongal_master.app_registerid  and FIND_IN_SET('$dongal_id', app_register_dongal_master.dongal_id)>0 AND app_register_service_master.user_id='$app_registerid' AND service_id='$os_id'"); 	
    $support_expiry_dateObj->execute();
    $support_expiry_dateObj->store_result();                  
    $support_expiry_dateObj->bind_result($app_register_donagal_id,$app_support_expiry_date,$number_of_user);
    $support_expiry_dateObj->fetch();

    if ($app_register_donagal_id >0)
	 $download_allow="Y";

}
if ($dongal_verification_required =="N" || $dongal_verification_required == "0")
$download_allow ="Y";
if ($download_allow =="Y" || $download_allow=="1")
{
		$customer_download_ftp_url = finsettingval($mysqli,"ftp_url");
		$customer_download_ftp_unm = finsettingval($mysqli,"ftp_username");
		$customer_download_ftp_pass = finsettingval($mysqli,"ftp_password");

	$pdb_file_allowedObj = $mysqli->prepare("select pdb_file_allowed from app_register_master where store_id='$store_id'");		
    $pdb_file_allowedObj->execute();
    $pdb_file_allowedObj->store_result();                  
    $pdb_file_allowedObj->bind_result($pdb_file_allowed);
    $pdb_file_allowedObj->fetch();

if ($pdb_file_allowed == "")
$pdb_file_allowed ="N";

		$xml_string .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		$xml_string .= "<response>";
		$xml_string .= "<customer_download_ftp_url>$customer_download_ftp_url</customer_download_ftp_url>";
		$xml_string .= "<customer_download_ftp_unm>$customer_download_ftp_unm</customer_download_ftp_unm>";
		$xml_string .= "<customer_download_ftp_pass>$customer_download_ftp_pass</customer_download_ftp_pass>";
		$xml_string .= "<customer_pdb_file_allowed>$pdb_file_allowed </customer_pdb_file_allowed>";
		$xml_string .= "<customer_support_expiry_date>$app_support_expiry_date</customer_support_expiry_date>";
		$xml_string .= "<customer_number_of_user>$number_of_user</customer_number_of_user>";
		
		$xml_string .= "</response>";
	 }
	 else
	{
		$xml_string .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		$xml_string .= "<response>";
		$xml_string .= "<customer_support_expiry_date>$app_support_expiry_date</customer_support_expiry_date>";
		$xml_string .= "<customer_number_of_user>$number_of_user</customer_number_of_user>";
		$xml_string .= "</response>";
}
}

echo($xml_string);
  ?>